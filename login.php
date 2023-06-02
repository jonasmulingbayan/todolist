<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: todos.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
<?php include_once "navbar.php"; ?>

  <div class="wrapper">
    <section class="form login">
      <header>Login</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Todo List">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="register.php">Signup now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

  <?php include_once "footer.php"; ?>

</body>
</html>
