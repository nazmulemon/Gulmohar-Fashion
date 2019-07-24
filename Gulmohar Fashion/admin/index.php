<?php

require_once '../main_files/init.php';
if(!is_logged_in()){
  header('Location: login.php');
}

include 'includes/head.php';
include 'includes/navigation.php';
//session_destroy();
?>

<?php
  $txnQuery = "SELECT t.transactions_id,t.cart_id,t.full_name,t.description,t.txn_date,t.grand_total,c.items,c.paid,c.shipped
  FROM transactions t LEFT JOIN cart c ON
  t.cart_id = c.cart_id WHERE c.paid = 1 AND c.shipped = 0
  ORDER BY t.txn_date";
  $txnResults = $db->query($txnQuery);
?>
<div class="col-md-12">
  <h3 class="text-center">Orders To Ship</h3>
  <table class="table table-condensed table-bordered table-striped table-hover">
    <thead>
      <th></th><th>Name</th><th>Descriptions</th><th>Total</th><th>Date</th>
    </thead>
    <tbody>
      <?php while($order = mysqli_fetch_assoc($txnResults)):?>
      <tr>
        <td><a href="orders.php?txn_id=<?=$order['transactions_id'];?>" class="btn btn-xs btn-info">Details</a></td>
        <td><?=$order['full_name'];?></td>
        <td><?=$order['description'];?></td>
        <td><?=$order['grand_total'];?></td>
        <td><?=formatted_date($order['txn_date']);?></td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
</div>





<?php
include 'includes/footer.php';
?>
