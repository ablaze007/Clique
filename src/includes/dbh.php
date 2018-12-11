
<?php
//using MAMP
//connecting to the database
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "socialnetwork";

//$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
$conn = new mysqli($dbServername,$dbUsername,$dbPassword,$dbName);

if ($conn->connect_error) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
