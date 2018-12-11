<?php
include_once '../../includes/dbh.php';

$content = mysqli_real_escape_string($conn,$_POST['Message']);
$date =  mysqli_real_escape_string($conn,date("Y-m-d"));
$receiverID = mysqli_real_escape_string($conn,$_POST['RID']);

session_start();
$userInfo = $_SESSION['userInfo'];
$senderID = $userInfo[0];


//following code is to find new PostID for tje post
//find the ID of last post record and add one to it for new ID
$count = 0;
$sqlTemp = "SELECT MAX(Message_ID) AS max FROM message;";
if($result = $conn->query($sqlTemp)->fetch_array())
{
  $count = $result['max'];
}
if($count==0)
  $count=5000;
$id = $count+1;

$sql = "INSERT INTO message VALUES('$id','$senderID','$receiverID','$content','$date');";

if($conn->query($sql))
  header("Location: ../../page/user/inbox.php?SUCCESS");
else
{
  header("Location: ../../page/user/inbox.php?FAILED");
}
