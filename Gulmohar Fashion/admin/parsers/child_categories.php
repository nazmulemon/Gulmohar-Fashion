<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/shoptime/main_files/init.php';
$parentID = (int)$_POST['parentID'];
$selected = sanitize($_POST['selected']);
$childQuery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category");
ob_start(); ?>

<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childQuery)): ;?>
  <option value="<?=$child['categories_id'];?>"<?=(($selected == $child['categories_id'])?' selected':'');?>><?=$child['category'];?></option>
<?php endwhile; ?>

<?php echo ob_get_clean(); ?>
