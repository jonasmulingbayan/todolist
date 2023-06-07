<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "todolist";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

  error_reporting(0);
  date_default_timezone_set('Asia/Manila');
  $currentdate = date('Y-m-d');
  $currentdates = date('Y-m-d:H:i:s A');
?>
