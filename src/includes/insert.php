<?php
//connecting to the database
include_once 'dbh.php';

/*
//getting values from the form
//mysqli_real_escape_string is used to prevent SQL injection
$first = mysqli_real_escape_string($conn,$_POST['first']);
$last = mysqli_real_escape_string($conn,$_POST['last']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$sql = "INSERT INTO profile VALUES($first,$last,$username,$password);";

$conn->query($sql);

*/

/*
//INSERT using prepared statements
$sql = "INSERT INTO profile VALUES(?,?,?,?);";
if($stmt = $conn->prepare($sql))
  echo "Prepare failed";

//values from form

if(!stmt->bind_param("ssss",$first,$last,$username,$password))
{
  echo "Binding parameters failed";
}

//values of variables binded can be changed here and stmt can
//be executed multiple times;

if(!$stmt->execute())
{
  echo "Execution failed";
}

$stmt->close();

*/

//going back to the index file
header("Location: ../index.php?Insertion=success");
