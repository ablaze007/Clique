<?php
//connecting to the database
include_once 'dbh.php';

//SELECT with prepared statements
$data = 12345;
$sql = "SELECT * FROM profile WHERE Password=?;";
if($stmt = $conn->prepare($sql))
{
  $stmt->bind_param("i",$data);
  $stmt->execute();
  $stmt->bind_result($lname);

  while($stmt->fetch())
  {
    echo $lname . "<br/>";
  }
}

$stmt->close();
$conn->close();

/*
$sql = "SELECT * FROM profile;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck>0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    echo $row['Fname'] . "<br/>";
  }
}
else {
  echo "None";
}
*/
header("Location: ../index.php?Selection=success");
