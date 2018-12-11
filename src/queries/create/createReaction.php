<?php
include_once '../../includes/dbh.php';

$type = mysqli_real_escape_string($conn,$_POST['content']);

session_start();
$userInfo = $_SESSION['userInfo'];
$ProfileID = $userInfo[0];
$PostID = $info[1];

$sql = "INSERT INTO comment VALUES('$PostID','$ProfileID','$type');";

if($conn->query($sql))
  header("Location: ../page/userPage.php?SUCCESS");
else
{
  header("Location: ../page/userPage.php?FAILED");
}
