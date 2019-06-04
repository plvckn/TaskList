<?php
require_once("Initialize.php");
include_once("Header.php");

if(!user_is_logged() or !is_admin()){header("Location: Login.php");}

$user_list = find_all_users();


if(is_get_request()){
  if(isset($_GET['id'])){
    $task_id = $_GET['id'];
  }
}
?>


<body>
  <div id="content">
    <h1>Assign task to user</h1>
      Select user id to assign task</br>
      <form method="post">
      <select name = "userselect">
        <?php while($user = mysqli_fetch_assoc($user_list)){?>
        <option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?></option>
        <?php } ?>
      </select>
      <input type="hidden" name="taskID" value= "<?php echo $task_id ?>" >
      <input type="submit" name="submit" value="Assign" ><br/>
    </form>
      </div>
      <br/><a href="Admin_page.php" >Go back</a>
</body>
<?php
  if(is_post_request()){
    if(isset($_POST['userselect']) and isset($_POST['taskID'])){
      if(!task_assigned($_POST['userselect'], $_POST['taskID'])){
        insert_into_assigned_task($_POST['userselect'], $_POST['taskID']);
      }
      echo "task already assigned to this user";
    }
  }
 ?>
