<?php
include_once 'dbh.php';

$username = mysqli_real_escape_string($conn,$_POST['username']);

$sql = "SELECT * from profile WHERE Username='$username';";

if($result = $conn->query($sql))
{
  $resultCheck = $result->num_rows;

  if($resultCheck==1)
    header("Location: ../usernameVerify.php#?Username=UNAVAILABLE");
  else {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../register.php");
  }
}
else {
  header("Location: ../usernameVerify.php?Username=FAILED");
}
