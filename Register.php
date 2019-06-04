<?php
require_once("Initialize.php");
include_once("Header.php");
 ?>

<div id="content">
  <h1>Create new user</h1>
    <form action="Register.php" method="post">
      Username:<br />
      <input type="text" name="username" value=""><br />
      First name:<br />
      <input type="text" name="first_name" value=""><br />
      Last name:<br />
      <input type="text" name="last_name" value=""><br />
      Email:<br />
      <input type="text" name="email" value=""><br />
      Password:<br />
      <input type="password" name="password1" value="" ><br />
      Confirm Password:<br />
      <input type="password" name="password2" value="" ><br />
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>

<?php
if(is_post_request()) {
    $errors = [];

    if(empty($_POST['password1']) or empty($_POST['password2']) or empty($_POST['username']) or empty($_POST['first_name']) or empty($_POST['last_name']) or empty($_POST['email'])) {
      echo $errors[] = "Error, field cannot be blank.<br/>";
    }
    if($_POST['password1'] !== $_POST['password2']) {
      echo $errors[] = "Error, password values must match.<br/>";
    }
    if(user_exists($_POST['username'])) {
      echo $errors[] = "Error, username is taken.<br/>";
    }
    if(empty($errors)) {
      Insert_user($_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password1'] );
      Display_successful_registration();
    }
  }

?>
