<?php
include_once '../../includes/dbh.php';

//Creates page and inserts record into page and manages tables
//Need following from the form:
//name - page name
//des - description
//img - img link
//NOTE - also need Profile_ID as SESSION variable

$content = mysqli_real_escape_string($conn,$_POST['content']);
$date =  mysqli_real_escape_string($conn,date("Y-m-d"));

session_start();
$userInfo = $_SESSION['userInfo'];
$ProfileID = $userInfo[0];

//following code is to find new PostID for tje post
//find the ID of last post record and add one to it for new ID
$count = 0;
$sqlTemp = "SELECT MAX(Comment_ID) AS max FROM comment;";
if($result = $conn->query($sqlTemp)->fetch_array())
{
  $count = $result['max'];
}
if($count==0)
  $count=4000;
$id = $count+1;

$sql = "INSERT INTO comment VALUES('$PostID','$ProfileID','$content','$id','$date');";

if($conn->query($sql))
  header("Location: ../page/userPage.php?SUCCESS");
else
{
  header("Location: ../page/userPage.php?FAILED");
}
