<?php
//connecting to the database
include_once 'dbh.php';


$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$sql = "SELECT * FROM profile;";

if($result = $conn->query($sql))
{
  $resultCheck = $result->num_rows;
  if($resultCheck>0)
  {
    $ID = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      if($row['Username']==$username && $row['Password']==$password)
      {
        $info[0] = $row['Profile_ID'];
        $ID = $info[0];
        $info[1] = $row['Username'];
        $info[2] = $row['Fname'];
        $info[3] = $row['Lname'];
        $info[4] = $row['Date_created'];

        //creating a session
        session_start();
        $_SESSION['userInfo'] = $info;
        header("Location: ../page/userPage.php");
      }
    }
    if($ID == 0)
    {
      header("Location: ../index.php?LoginFailed");
    }
  }
}
