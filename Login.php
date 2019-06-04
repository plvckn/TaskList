<?php
require_once("Initialize.php");
include_once('Header.php');
 ?>

<div id="content">
  <h1>Log in</h1>
  <form action="Login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="" placeholder="username"/><br />
    Password:<br />
    <input type="password" name="password" value=""  placeholder="password" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>
  <br/>
  <li><a href="Register.php">Register</a></li>
    </div>

<?php


  if(is_post_request()) {
    if(isset($_POST['submit'])) {

      if(user_is_admin($_POST['username'], $_POST['password'])){
        $user = find_user_by_username($_POST['username']);
        store_id_in_session($user['id']);
        $_SESSION['role'] = 'admin';
        header("Location: Admin_page.php");
      }

      if(user_exists($_POST['username']))
      {
        $user = find_user_by_username($_POST['username']);
        if(password_verify($_POST['password'], $user['password'])) {
          store_id_in_session($user['id']);
          header("Location: User_page.php");
        }
        else echo "Invalid login information";
      }
      else echo "Invalid login information";
    }
  }
 ?>
