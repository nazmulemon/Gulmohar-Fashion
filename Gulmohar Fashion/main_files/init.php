<?php

$db = mysqli_connect('localhost','root','','shoptime');
if(mysqli_connect_error()){
    echo 'Database Connection fail with following error: '.mysqli_connect_error();
    die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/shoptime/config.php';
require_once BASEURL.'helpers/helpers.php';
require BASEURL.'vendor/autoload.php';

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
  $cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['SBUser'])){
  $user_id = $_SESSION['SBUser'];
  $query = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ',$user_data['full_name']);
  $user_data['first'] = $fn[0];
  $user_data['last'] = $fn[1];
}

if(isset($_SESSION['success_flash'])){
  echo '<div class="bg-success"><p class="text-center text-success">'.$_SESSION['success_flash'].'</p></div>';
  unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
  echo '<div class="bg-danger"><p class="text-center text-danger">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}
//session_destroy();
