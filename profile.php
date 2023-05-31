<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }


$sqlUser = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
$sqlquery = mysqli_query($conn, $sqlUser);
$row = mysqli_fetch_assoc($sqlquery);
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$password = $row['password'];

if(isset($_POST['submit'])){

  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);
  $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

  $sqlUser = "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$password}' WHERE unique_id = {$_SESSION['unique_id']}";
  $sqlquery = mysqli_query($conn, $sqlUser);
  if($sqlquery){
    header("location: profile.php");
  }else{
    echo "Something went wrong. Please try again!";
  }
}
?>


<?php include_once "header.php"; ?>
<body>
<?php include_once "navbar.php"; ?>
  <div class="wrapper">
    
    <section class="form signup">
      <header>Profile Information</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" value = "<?php echo $fname ?>">
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" value = "<?php echo $lname ?>">
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" onkeypress="if(event.keyCode==32)event.returnValue=false;" value = "<?php echo $email ?>" readonly>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" value = "<?php echo $password ?>">
          <i class="fas fa-eye"></i>
        </div>
        <!--
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>-->
        <div class="field button">
          <input type="submit" name="submit" value="Update Information">
        </div>
      </form>

    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="javascript/pass-show-hide.js"></script>
  <?php include_once "footer.php"; ?>

</body>
</html>
