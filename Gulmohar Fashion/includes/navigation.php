<?php

$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);

?>
<nav class="navbar navbar-default navbar-light navbar-fixed-top" style="background-color: #3c1758;">
  <div class="container">
    <a href="/shoptime/index.php" class="navbar-brand" style="color:white">Beauty Glamour</a>
    <ul class="nav navbar-nav">
      <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
        <?php
        $parent_id = $parent['categories_id'];
        $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
        $cquery = $db->query($sql2);
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white";><?php echo $parent['category']; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role= "menu">
            <?php while($child = mysqli_fetch_assoc($cquery)) : ?>
              <li><a href="category.php?cat=<?=$child['categories_id'];?>"><?php echo $child['category']; ?></a></li>
            <?php endwhile; ?>
          </ul>
        </li>
      <?php endwhile; ?>
      <li><a href="cart.php" style="color:white";><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
    </ul>
  </div>
</nav>
