<?php
require_once('Initialize.php');
include_once('Header.php');

if(is_get_request()){
  task_completed($_GET['id'], $_SESSION['id']);
  header("Location: User_page.php?completed=true");
}
?>
