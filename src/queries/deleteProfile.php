<?php
include_once '../includes/dbh.php';

//Delete a profile record based on Profile_ID

$ID = mysqli_real_escape_string($conn,$_POST['ID']);

$sql = "DELETE FROM profile WHERE Profile_ID='$ID';";

if($conn->query($sql))
{
    session_start();
    $_SESSION['check'] = 1;
}
header("Location: ../page/admin/delete.php");
