<nav>
    <div class = "nav">
        <a <?php if(isset($_SESSION['unique_id'])){echo 'href=todos.php';}?>>
        <img src = "php/images/todolistlogo.png" alt = "logo" class = "logo">
        </a>
        <?php if(isset($_SESSION['unique_id'])){?>
        <div class = "for-nav">
            <div id = "for-notif" class="dropdown btn-group">
            <?php 
                $sqlCount = mysqli_query($conn, "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND Todo_status = 'NOT FINISHED' AND date_added != '$currentdate'");
                $count = mysqli_num_rows($sqlCount);
                ?>
            <button id = "notif" data-bs-toggle="dropdown" aria-expanded="false" title = "Unfinished todos"><i class = "fa-solid fa-bell"></i><span><?php echo $count ?><?php if($count > 10){echo'+';}?></span></button>
                <ul class="dropdown-menu dropdown-menu-end" style = "z-index:9999999;">
                <?php 
                $sqlNames = "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND Todo_status = 'NOT FINISHED' AND date_added != '$currentdate'";
                $sqlquery = mysqli_query($conn, $sqlNames);
                while($row = mysqli_fetch_assoc($sqlquery)){
                    $todo = $row['Todo_name'];
               
                ?>
                <li><a href="unfinishedtodo.php" class="dropdown-item" title = "View"><?php echo $todo ?></a></li>
                <?php }?>
                <?php if($count == 0){?>
                    <li><a href="" class="dropdown-item" >No unfinished todos</a></li>
                <?php }?>
                </ul>
            </div>
            <?php 
                $sqlUser = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
                $sqlquery = mysqli_query($conn, $sqlUser);
                $row = mysqli_fetch_assoc($sqlquery);
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $fullname = $fname." ".$lname;
                ?>
            <div class="dropdown">
                <button class="dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $fname ?>
                </button>
                <ul class="dropdown-menu">
                <?php   if(isset($_SESSION['unique_id'])){
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <li><a href="profile.php" class="dropdown-item"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a href="finishedtodo.php" class="dropdown-item" ><i class="fa-solid fa-list"></i> Finished Todos</a></li>
                <li><a href="unfinishedtodo.php" class="dropdown-item" ><i class="fa-solid fa-list"></i> Unfinished Todos</a></li>
                <li><a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="dropdown-item logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                <?php }?>
                </ul>
            </div>
        </div>
        <?php }?>
    </div>
    <?php if(isset($_SESSION['unique_id'])){?>
    <div class = "for-date">
        <h5>Date Today: <?php echo $currentdate ?></h5>
    </div>
    <?php 
        $sqlNotif = mysqli_query($conn, "SELECT * FROM todos WHERE user_ID = {$_SESSION['unique_id']} AND Todo_status = 'NOT FINISHED' AND date_added != '$currentdate'");
        if(mysqli_num_rows($sqlNotif) > 0){?>
            <div id = "notification" class="notification align-items-center text-bg-primary border-0" >
         
              <div class="notification-body">
                <p>Hello, <?php echo $fullname ?>! You have <?php echo $count ?> unfinished todos from past days.</p>
              </div>
              <button type="button" onclick = "exitNotification();" class="notification-button" ><i class = "fa-solid fa-circle-xmark"></i></button>
          
          </div>
          <?php
        }?>
    <?php }?>
</nav>

<script>
    window.addEventListener("load", function(){
        setTimeout(
            function open(event){
                document.querySelector(".notification").style.display = "block";
            },
            1000
        )
    });
    function exitNotification(){
        var exitnotification = document.getElementById("notification").style.display = "none";
    }
    setTimeout("exitNotification()",8000);
</script>

