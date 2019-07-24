<?php
require_once 'main_files/init.php';


\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

$token = $_POST['stripeToken'];
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip_code = sanitize($_POST['zip_code']);
$country = sanitize($_POST['country']);
$tax = sanitize($_POST['tax']);
$sub_total = sanitize($_POST['sub_total']);
$grand_total= sanitize($_POST['grand_total']);
$cart_id = sanitize($_POST['cart_id']);
$description = sanitize($_POST['description']);
$charge_amount = number_format($grand_total,2)*100;
$metadata = array(
  "cart_id" => $cart_id,
  "tax" => $tax,
  "sub_total" => $sub_total,
);

try{
  $charge = \Stripe\Charge::create(array(
    "amount" => $charge_amount,
    "currency" => CURRENCY,
    "source" => $token,
    "description" => $description,
    "receipt_email" => $email,
    "metadata" => $metadata)
  );

  //update inventory
  $itemQ = $db->query("SELECT * FROM cart WHERE cart_id = '{$cart_id}'");
  $iresults = mysqli_fetch_assoc($itemQ);
  $items = json_decode($iresults['items'],true);
  foreach($items as $item){
    $newSizes = array();
    $item_id = $item['id'];
    $productQ = $db->query("SELECT sizes FROM products WHERE products_id = '{$item_id}'");
    $product = mysqli_fetch_assoc($productQ);
    $sizes = sizesToArray($product['sizes']);
    foreach($sizes as $size){
      if($size['size'] == $item['size']){
        $q = $size['quantity'] - $item['quantity'];
        $newSizes[] = array('size' => $size['size'], 'quantity' => $q);
      }else{
        $newSizes[] = array('size' => $size['size'], 'quantity' => $size['quantity']);

      }
    }
    $sizeString = sizesToString($newSizes);
    $db->query("UPDATE products SET sizes = '{$sizeString}' WHERE products_id = '{$item_id}'");
  }

  //Update cart

  $db->query("UPDATE cart SET paid = 1 WHERE cart_id = '{$cart_id}'");
  $db->query("INSERT INTO transactions
    (charge_id,cart_id,full_name,email,street,street2,city,state,zip_code,country,sub_total,tax,grand_total,description,txn_type) VALUES
    ('$charge->id','$cart_id','$full_name','$email','$street','$street2','$city','$state','$zip_code','$country','$sub_total','$tax','$grand_total','$description','$charge->object')");

  $domain = ($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerpartial.php';
?>
  <h1 class="text-center text-success">Thank You</h1>
  <p>Your Cart has been succesfully charged <?=money($grand_total);?>. You have been emailed a receipt.
    Please check your spam folder if it is not in your inbox. Additionally you can print this page as a receipt</p>
  <p>Your receipt number is:<strong><?=$cart_id;?></strong></p>
  <p>Your order will be shipped to the address below.</p>
  <address>
    <?=$full_name;?><br>
    <?=$street;?><br>
    <?=(($street2 != '')?$street2.'<br>':'');?>
    <?=$city. ', '.$state.' '.$zip_code;?><br>
    <?=$country;?><br>
  </address>
<?php
  include 'includes/footer.php';


} catch(\Stripe\Error\Card $e){
  echo $e;
}

?>
