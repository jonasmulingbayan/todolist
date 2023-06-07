<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }

  if(isset($_POST['donetask'])){
    $id = $_POST['taskid'];
    $user_ID = $_POST['user_ID'];
    $status = "FINISHED";

    $sql = mysqli_query($conn, "UPDATE todos SET Todo_status = '$status', date_completed = '$currentdates' WHERE id = '$id' AND user_ID = '$user_ID'");
    if($sql){
      header("location: unfinishedtodo.php?success=Task marked as done");
    }
    else{
        header("location: unfinishedtodo.php?error=Something went wrong");
    }
    
  }

  if(isset($_POST['doneall'])){
    $userid = $_POST['userid'];
    $date = $_POST['currentdate'];
    $status = "FINISHED";

    $sql = mysqli_query($conn, "UPDATE todos SET Todo_status = '$status', date_completed = '$currentdates' WHERE user_ID = '$userid' AND date_added != '$date'");
    if($sql){
      header("location: unfinishedtodo.php?success=All Task marked as done");
    }
    else{
        header("location: unfinishedtodo.php?error=Something went wrong");
    }
    
  }

  if(isset($_POST['edittask'])){
    $taskname = $_POST['task'];
    $id = $_POST['taskid'];
    $user_ID = $_POST['user_ID'];

    $sqlEdit = mysqli_query($conn, "UPDATE todos SET Todo_name = '$taskname' WHERE id = '$id' AND user_ID = '$user_ID'");
    if($sqlEdit){
      header("location: unfinishedtodo.php?success=Task edited successfully");
    }
    else{
        header("location: unfinishedtodo.php?error=Something went wrong");
    }
    
  }
 
  
  if(isset($_POST['removedtask'])){
    $id = $_POST['taskid'];
    $user_ID = $_POST['user_ID'];

    $sql = mysqli_query($conn, "DELETE FROM todos WHERE id = '$id' AND user_ID = '$user_ID'");
    if($sql){
      header("location: unfinishedtodo.php?success=Task removed successfully");
    }
    else{
        header("location: unfinishedtodo.php?error=Something went wrong");
    }
    
  }
?>
<?php include_once "header.php"; ?>
<body> 
<?php include_once "navbar.php"; ?>

    <div id = "todos-section" class="todos-section">
        <section class="form login">
        <form action="todos.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class = "main-header">
                <div class = "left-header">
                    <h1 class = "todo">My unfinished todos</h1>
                </div>
                <div class = "right-header">
                <button id = "for-add" type = "button" class="add-task btn btn-primary" onclick = "window.location.href='todos.php'"><i class ="fa-solid fa-circle-arrow-left"></i> Todos</button>
                </div>
            </div>
            <!-- Button trigger modal -->
            <div class = "todo-list">
            <?php 

            $sqlCount = mysqli_query($conn,"SELECT * FROM todos WHERE date_added != '$currentdate' AND user_ID = {$_SESSION['unique_id']} AND Todo_status = 'NOT FINISHED'");
            $totaltask = mysqli_num_rows($sqlCount); 

            $sqlTask = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED' ORDER BY id ASC";
            $sqlquery = mysqli_query($conn, $sqlTask);
            while($row = mysqli_fetch_assoc($sqlquery)){
                $task = $row['Todo_name'];
                $taskid = $row['id'];
                $uniq_id = $row['user_ID'];
                $date_added = $row['date_added'];
                $todo_status = $row['Todo_status'];
                ?>
                <div id = "main-todo"  class = "main-todo">
                    <?php if($totaltask > 0){?>
                        <div class = "left" style = "line-height:15px;">
                            <div>
                            <span class = "outer"  <?php if($todo_status == "FINISHED"){echo 'style=color:black;text-decoration:line-through;';}?>>
                                <span class = "inner" <?php if($todo_status == "FINISHED"){echo 'style=color:red;';}?> ><?php echo $task ?></span>
                            </span>
                            
                            </div>
                            <span>Date Added: <?php echo $date_added ?></span>
                        </div>
                        
                        <div class = "right">
                            <button id = "buttons" type = "button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#doneTask<?php echo $taskid ?>"><i class ="fa-solid fa-check" title = "Done"></i></button>
                            <button id = "buttons" type = "button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask<?php echo $taskid ?>"><i class ="fa-solid fa-pen-to-square" title = "Edit"></i></button>
                            <button id = "buttons" type = "button" <?php if($todo_status == "FINISHED"){echo 'disabled';}?>  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removedTask<?php echo $taskid ?>"><i class ="fa-solid fa-trash" title = "Delete"></i></button>
                        </div>
                    <?php }
                    ?>
                    
                </div>
                <?php }?>
                <?php if($totaltask > 1){?>
                <hr>
                <div class = "for-checkbox">
                <button type = "button" class="btn btn-success"<?php if($totaltask == 0){echo 'disabled';}?>  data-bs-toggle="modal" data-bs-target="#doneAllTask<?php echo $taskid ?>"><i class ="fa-solid fa-check" title = "Done All"></i> Done All</button>
                </div>
                <?php }?>
                <?php if($totaltask == 0){?>
                <div class = "main-todo">
                <div class = "no-task">
                <img src = "php/images/notask.png" alt = "logo" class = "notask">
                </div>
                </div>
                <?php }?>
            </div>
        </form>
        </section>

<!--Done Task Modal -->
<?php 
$sqlDone = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlDone);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="doneTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">
                    
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you done with this task?</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "donetask" class="btn btn-success">Mark as Done</button>
                    <input type="hidden" name="taskid" value="<?php echo $id ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['unique_id'] ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>


<!--Undone Task Modal -->
<?php 
$sqlUndone = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlUndone);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="undoneTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">
                    
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to undone this task?</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "undonetask" class="btn btn-primary">Mark as Undone</button>
                    <input type="hidden" name="taskid" value="<?php echo $id ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['unique_id'] ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>

<!--Done All Task Modal -->
<?php 
$sqlDone = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlDone);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="doneAllTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">
                    
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you done with all of this task?</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "doneall" class="btn btn-success">Mark as Done</button>
                    <input type="hidden" name="userid" value="<?php echo $_SESSION['unique_id'] ?>">
                    <input type="hidden" name="currentdate" value="<?php echo $currentdate ?>">

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>

<!--Undone All Task Modal -->
<?php 
$sqlUndone = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlUndone);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="undoneAllTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">
                    
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you wanted to undone all task?</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "undoneall" class="btn btn-danger">Undone</button>
                    <input type="hidden" name="userid" value="<?php echo $_SESSION['unique_id'] ?>">
                    <input type="hidden" name="currentdate" value="<?php echo $currentdate ?>">

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>

<!--Edit Task Modal -->
<?php 
$sqlEdit = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlEdit);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="editTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">  
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">

                <div class="field input">
                        <label for ="task">Task</label>
                        <input type="text" name="task" class = "form-control" value = "<?php echo $task ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "edittask" class="btn btn-primary">Save Changes</button>
                    <input type="hidden" name="taskid" value="<?php echo $id ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['unique_id'] ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>

<!--Removed Task Modal -->
<?php 
$sqlRemoved = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND date_added != '$currentdate' AND Todo_status = 'NOT FINISHED'";
$sqlquery = mysqli_query($conn, $sqlRemoved);
while($row = mysqli_fetch_assoc($sqlquery)){
    $task = $row['Todo_name'];
    $id = $row['id'];
    ?>
<div class="modal fade" id="removedTask<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "z-index:9999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <form action="unfinishedtodo.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-body">
                    
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you wanted to delete this task?</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name = "removedtask" class="btn btn-danger">Delete</button>
                    <input type="hidden" name="taskid" value="<?php echo $id ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['unique_id'] ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>
   
<!--<?php include_once "footer.php"; ?>-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
