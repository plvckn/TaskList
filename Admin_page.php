<?php
require_once("Initialize.php");
include_once("Header.php");

if(!user_is_logged() or !is_admin()){header("Location: Login.php");}

$task_list = find_all_tasks();
$assigned_task_list = find_assigned_tasks();
?>



 <div id="content">
   <div class="Task listing">
     <h1>Tasks</h1>
       <a href="Create_task.php">Create new task</a>

     <table class="list">
       <tr>
        <th>ID</th>
        <th>Description</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
       </tr>

       <?php while($task = mysqli_fetch_assoc($task_list)){ ?>
        <tr>
          <td><?php echo $task['id']; ?></td>
          <td><?php echo $task['description']; ?></td>
          <td><a href= "<?php echo 'delete.php?id=' . $task['id'];?>">Delete</a></td>
          <td><a href="<?php echo 'Assign_task.php?id=' . $task['id'];?>">Assign</a></td>
        </tr><?php } ?> </table>
        Note: you cannot delete tasks which are assigned to users;
      </div>
        <br/><br/>
          <h2>Assigned tasks</h2>
              <table class="list">
                <tr>
                 <th>TASK ID</th>
                 <th>USER ID</th>
                 <th>Completed</th>
                 <th>&nbsp;</th>
               </tr>

                <?php while($assigned_task = mysqli_fetch_assoc($assigned_task_list)){ ?>
                 <tr>
                   <td><?php echo $assigned_task['task_id']; ?></td>
                   <td><?php echo $assigned_task['user_id']; ?></td>
                   <td><?php echo $assigned_task['completed']; ?></td>
                   <td><a href="<?php echo 'delete.php?task_id=' . $assigned_task['task_id'] . '&user_id=' . $assigned_task['user_id']; ?>" >Unassign</a></td>
                 </tr><?php } ?></table></div>
