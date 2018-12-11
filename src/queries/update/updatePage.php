<?php
include_once '../../includes/dbh.php';


$name = mysqli_real_escape_string($conn,$_POST['name']);
$des = mysqli_real_escape_string($conn,$_POST['des']);
$type = mysqli_real_escape_string($conn,$_POST['type']);
$other = mysqli_real_escape_string($conn,$_POST['other']);
$id = mysqli_real_escape_string($conn,$_POST['id']);
$img = mysqli_real_escape_string($conn,$_POST['img']);

//check previous type for the page
$sqlTemp = "SELECT * FROM entertainment WHERE Page_ID='$id';";
if($result = $conn->query($sqlTemp))
{
  $checkE = $result->num_rows;
}
$sqlTemp = "SELECT * FROM informative WHERE Page_ID='$id';";
if($result = $conn->query($sqlTemp))
{
  $checkI = $result->num_rows;
}

//creating new query for creating page
if($img=="")
{
  $sql = "UPDATE page SET Page_name ='$name', Description='$des' WHERE Page_ID='$id';";
}
else
{
  $sql = "UPDATE page SET Page_name ='$name', Description='$des', Image='$img' WHERE Page_ID='$id';";
}

//insert to type based table
if($type == "entertainment")
{
  if($checkE == 1)
    $sql.= "UPDATE entertainment SET Field='$other' WHERE Page_ID='$id';";
  else
  {
    $sql.= "DELETE FROM informative WHERE Page_ID='$id';";
    $sql.= "INSERT INTO entertainment VALUES('$id','$other');";
  }
}
else if($type == "informative")
{
  if($checkI == 1)
    $sql.=  "UPDATE informative SET Subject='$other' WHERE Page_ID='$id');";
  else
  {
    $sql.= "DELETE FROM entertainment WHERE Page_ID='$id';";
    $sql.= "INSERT INTO informative VALUES('$id','$other');";
  }
}

if($conn->multi_query($sql))
  header("Location: ../../page/user/pages.php?SUCCESS");
else
{
  header("Location: ../../page/user/pages.php?FAILED");
}
