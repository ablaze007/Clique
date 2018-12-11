<?php
include_once '../../includes/dbh.php';

$date = date("Y-m-d");
$PageID = mysqli_real_escape_string($conn,$_POST['PageID']);

session_start();
$userInfo = $_SESSION['userInfo'];
$ProfileID = $userInfo[0];

$sql = "INSERT INTO follows VALUES('$PageID','$ProfileID','$date');";

if($conn->query($sql))
  header("Location: ../../page/user/pages.php?SUCCESS");
else
{
  header("Location: ../../page/user/pages.php?FAILED");
}
