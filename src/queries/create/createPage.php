<?php
include_once '../../includes/dbh.php';

//Creates page and inserts record into page and manages tables
//Need following from the form:
//name - page name
//des - description
//img - img link
//NOTE - also need Profile_ID as SESSION variable

$name = mysqli_real_escape_string($conn,$_POST['name']);
$des = mysqli_real_escape_string($conn,$_POST['des']);
$type = mysqli_real_escape_string($conn,$_POST['type']);
$other = mysqli_real_escape_string($conn,$_POST['other']);

session_start();
$userInfo = $_SESSION['userInfo'];
$PID = $userInfo[0];

$views = 0;
$img = mysqli_real_escape_string($conn,$_POST['img']);

$level = "Owner";
$date =  mysqli_real_escape_string($conn,date("Y-m-d"));

//following code is to find new Profile_ID for new profile
//find the ID of last profile record and add one to it for new ID
$count = 0;
$sqlTemp = "SELECT MAX(Page_ID) AS max FROM page;";
if($result = $conn->query($sqlTemp)->fetch_array())
{
  $count = $result['max'];
}
if($count==0)
  $count=2000;
$id = $count+1;


if($img=="")
{
  $sql = "INSERT INTO page VALUES('$id','$name','$des','$views',NULL);";
}
else
{
  $sql = "INSERT INTO page VALUES('$id','$name','$des','$views','$img');";
}

$sql.= "INSERT INTO manages VALUES('$id','$PID','$level','$date');";

//insert to type based table
if($type == "entertainment")
  $sql.= "INSERT INTO entertainment VALUES('$id','$other');";
else if($type == "informative")
  $sql.= "INSERT INTO informative VALUES('$id','$other');";

if($conn->multi_query($sql))
  header("Location: ../../page/user/pages.php?SUCCESS");
else
{
  header("Location: ../../page/user/pages.php?FAILED");
}
