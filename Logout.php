<?php
require_once("Initialize.php");

if(user_is_logged())
{
  unset($_SESSION['id']);
  header("Location: Login.php");
  if(admin()){
    unset($_SESSION['role']);
  }
} else echo "User is not logged in";
 ?>
