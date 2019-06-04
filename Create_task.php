<?php
require_once("Initialize.php");
include_once("Header.php");

if(!user_is_logged() or !is_admin()){header("Location: Login.php");}
?>


<div id="content">
  <h1>Create new task</h1>

  <form action="Create_task.php" method="post">
    Task description:<br />
    <input type="text" name="description" value=""><br />
    <input type="submit" name="submit" value="Submit" ><br />
  </form>
  <a href="Admin_page.php">Go back</a>

<?php
  if(is_post_request()){
    $errors = [];
    if(empty($_POST['description'])){
      echo $errors[] = "Task description cannot be empty";
    }
    if(empty($errors)){
      if(insert_task($_POST['description'])){
        display_successful_task_insert(); ?>
        <li><a href="Admin_page.php">View tasks</a></li> <?php
      }
    }
  }
 ?>
