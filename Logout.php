<?php
require_once("Initialize.php");

if(user_is_logged())
{
  unset($_SESSION['id']);
  if(isset($_SESSION['role'])){
    unset($_SESSION['role']);
  }
  header("Location: Login.php");
} else echo "User is not logged in";
 ?>
