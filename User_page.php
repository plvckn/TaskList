<?php
require_once("Initialize.php");
include_once("Header.php");

if(!user_is_logged()){header("Location: Login.php");}

$user_tasks = find_user_tasks($_SESSION['id']);
while($task = mysqli_fetch_assoc($user_tasks)){$tasklist[] = $task['task_id'];}
if(!empty($tasklist)){
  $tasklist = implode(', ', $tasklist);
  $user_tasks = find_tasks_by_id($tasklist);
}

?>

  <?php if(isset($_GET['completed'])){echo "Database updated";} ?>

 <div id=content>
   <h1>User tasks</h1>
   <table class="list">
     <tr>
       <th>Task_id</th>
       <th>Description</th>
       <th>&nbsp;</th>
     </tr>
     <?php $completed = 0 ?>
     <?php while($task = mysqli_fetch_assoc($user_tasks)){ ?>
       <tr>
         <td><?php echo $task['id'] ?></td>
         <td><?php echo $task['description'] ?></td>
         <td><a href="<?php echo 'completed.php?id=' . $task['id'] ?>">Complete</a></td>
      <tr>
<?php
} ?>
 </div>
