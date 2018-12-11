<?php

$username = $_POST['username'];
$password = $_POST['password'];

if($username=="admin" && $password =="password")
  header("Location: ../page/adminPage.php");
else
  header("Location: ../index.php?AdminLogin=FAILED");
