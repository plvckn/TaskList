<?php

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function Insert_user($username, $first_name, $last_name, $email, $password) {
  global $db;

  $sql = "INSERT INTO user ";
  $sql .= "(username, first_name, last_name, Email, password) ";
  $sql .= "VALUES (";
  $sql .= "'" . $username . "',";
  $sql .= "'" . $first_name . "',";
  $sql .= "'" . $last_name . "',";
  $sql .= "'" . $email . "',";
  $sql .= "'" . password_hash($password, PASSWORD_BCRYPT) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
}

function user_exists($username){
  return find_user_by_username($username);
}

function find_user_by_username($username) {
  global $db;

  $sql = "SELECT * FROM user ";
  $sql .= "WHERE username='" . $username . "'";
  $result = mysqli_query($db, $sql);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  if(!empty($user)){
    return $user;
  } else return false;
}

function user_is_admin($username, $password){
  global $db;

  if($username == "admin"){
    $sql = "SELECT password FROM user ";
    $sql .= "WHERE username='" . $username . "'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if($user['password'] == $password){
      return true;
    } else return false;
  } return false;
}

function find_all_tasks(){
  global $db;

  $sql = "SELECT * FROM task";
  $result = mysqli_query($db, $sql);
  return $result;
}

function find_assigned_tasks(){
  global $db;

  $sql = "SELECT * FROM assigned_task";
  $result = mysqli_query($db, $sql);
  return $result;
}

function insert_task($description){
  global $db;

  $sql = "INSERT INTO task (description) VALUES ('$description')";
  $result = mysqli_query($db, $sql);
  return $result;
}

function display_successful_task_insert(){
  echo "Task added successfully";
}

function delete_task_by_id($id){
  global $db;

  $sql = "DELETE FROM task WHERE id='$id' LIMIT 1";
  mysqli_query($db, $sql);
  header("Location: Admin_page.php");
}

function find_all_users(){
  global $db;

  $sql = "SELECT * FROM user";
  $result = mysqli_query($db, $sql);
  return $result;
}

function insert_into_assigned_task($user_id, $task_id){
  global $db;

  $sql = "INSERT INTO assigned_task (user_id, task_id, completed) VALUES ('$user_id', '$task_id', false)";
  mysqli_query($db, $sql);
  delete_task_by_id($task_id);
  header("Location: Admin_page.php");
}

function store_id_in_session($id)
{
  $_SESSION['id'] = $id;
}

function user_is_logged()
{
  if(isset($_SESSION['id'])){
    return true;
  } return false;
}

function delete_assigned_task($t_id, $u_id){
  global $db;

  $sql = "DELETE FROM assigned_task WHERE task_id='$t_id' AND user_id='$u_id'";

  $result = mysqli_query($db, $sql);
}

function task_assigned($u_id, $t_id){
  global $db;

  $sql = "SELECT * FROM assigned_task WHERE user_id='$u_id' AND task_id='$t_id'";
  $result = mysqli_query($db, $sql);
  $task = mysqli_fetch_assoc($result);
  if(!empty($task)){
    return true;
  }else return false;
}

function find_user_tasks($u_id){
  global $db;

  $tasks = [];
  $sql = "SELECT * FROM assigned_task WHERE user_id='$u_id'";
  $result = mysqli_query($db, $sql);

  return $result;

  while($task = mysqli_fetch_assoc($result)){
    $tasks[] = $task['task_id'];
  }
  $tasklist = implode(',', $tasks);
  $sql = "SELECT * FROM task WHERE id IN '(' . '$tasklist' . ')'";
  $result = mysqli_query($db, $sql);

  return $result;
}

function find_tasks_by_id($tasklist){
  global $db;

  $sql = "SELECT * FROM task WHERE id IN ($tasklist)";
  $result = mysqli_query($db, $sql);
  return $result;
}

function task_completed($t_id, $u_id){
  global $db;

  $sql ="UPDATE assigned_task SET completed=1 WHERE task_id='$t_id' AND user_id='$u_id'";
  mysqli_query($db, $sql);
}

function is_admin(){
  if(isset($_SESSION['role'])){
    return true;
  } else return false;
}


?><?php
function Display_successful_registration() { ?>
    User created successfully <br/>
    Click <a href="Login.php">Here</a> to Log in.
<?php


}
?>
