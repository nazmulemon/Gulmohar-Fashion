<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/shoptime/main_files/init.php';
unset($_SESSION['SBUser']);
header('Location: login.php');
?>
