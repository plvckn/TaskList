<?php
require_once('Initialize.php');

  if(is_get_request()){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      delete_task_by_id($id);
    }
    if(isset($_GET['task_id'])){
      delete_assigned_task($_GET['task_id'], $_GET['user_id']);;
      header("Location: Admin_page.php");
    }

  }

 ?>
