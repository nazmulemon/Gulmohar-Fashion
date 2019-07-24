<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #b00234 ;">
  <div class="container">
    <a href="/shoptime/admin/index.php" class="navbar-brand" style="color:white";>Beauty Glamour Admin</a>
    <ul class="nav navbar-nav">
      <li><a href="brands.php" style="color:white";>Brands</a></li>
      <li><a href="categories.php" style="color:white";>Categories</a></li>
        <li><a href="products.php" style="color:white";>Products</a></li>
        <li><a href="restore.php" style="color:white";>Archived</a></li>
        <?php if(has_permission('admin')): ?>
        <li><a href="users.php" style="color:white";>Users</a></li>
      <?php endif; ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle = "dropdown" style="color:white";>Hello <?=$user_data['first'];?>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="change_password.php">Change Password</a></li>
        <li><a href="logout.php">Log Out</a></li>
        
      </ul>
      </li>

        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role= "menu">
            <li><a href="#"></a></li>
          </ul>
        </li>-->
    </div>
  </nav>
