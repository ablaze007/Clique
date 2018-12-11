<?php
include_once '../../includes/dbh.php';

//getting values from the form
//mysqli_real_escape_string is used to prevent SQL injection
$first = mysqli_real_escape_string($conn,$_POST['first']);
$last = mysqli_real_escape_string($conn,$_POST['last']);
session_start();
$username = $_SESSION['username'];
//$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$dob = mysqli_real_escape_string($conn,$_POST['date']);
$date =  mysqli_real_escape_string($conn,date("Y-m-d"));

//following code is to find new Profile_ID for new profile
//find the ID of last profile record and add one to it for new ID
$count = 0;
$sqlTemp = "SELECT MAX(Profile_ID) AS max FROM profile;";
if($result = $conn->query($sqlTemp)->fetch_array())
{
  $count = $result['max'];
}
if($count==0)
  $count = 1000;
$id = $count+1;

$sql = "INSERT INTO profile VALUES('$id','$username','$password','$first','$last','$dob','$phone','$email','$date');";


if($conn->query($sql))
  header("Location: ../../index.php?Register=SUCCESS");
else
{
  header("Location: ../../index.php?Register=FAILED");
}
