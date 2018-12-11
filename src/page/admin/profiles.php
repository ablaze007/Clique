<?php
//connecting to the database
include_once '../../includes/dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Admin Page
    </title>
    <link rel="stylesheet" href="../../css/style_page.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="navbar"> </div>
    <div class="sidebar">
        <a class="active" href="../adminPage.php">Admin Options</a>
        <a class="option" href="profiles.php">Profiles</a>
        <a href="pages.php">Pages</a>
        <a href="posts.php">Posts</a>
        <a href="delete.php">Delete</a>
        <a href="../../index.php">Log Out</a>
    </div>


    <?php
      //This block of php code gets all the profile information and
      //stores it in 2D array called profiles
      $sql = "SELECT * FROM profile;";
      $profiles = array();

      if($result = $conn->query($sql))
      {
        $resultCheck = $result->num_rows;
        if($resultCheck>0)
        {
          $count = 0;
          while($row = mysqli_fetch_assoc($result))
          {
              $profiles[$count] = array();
              $profiles[$count]['ID'] = $row['Profile_ID'];
              $profiles[$count]['username'] = $row['Username'];
              $profiles[$count]['Fname'] = $row['Fname'];
              $profiles[$count]['Lname'] = $row['Lname'];
              $profiles[$count]['DOB'] = $row['DOB'];
              $profiles[$count]['Phone'] = $row['Phone'];
              $profiles[$count]['Email'] = $row['Email'];
              $profiles[$count]['Date'] = $row['Date_created'];
              $count = $count+1;
          }
        }
      }
    ?>

    <div class="content">
        <br><br><br><br><br>
        <?php if(count($profiles)>0): ?>
        <table>
          <thead>
            <tr>
              <th><?php echo implode('</th><th>', array_keys(current($profiles))); ?></th>
            </tr>
          </thead>
          <tbody>
            <!-- iterating through each profile and printing the values -->
            <?php foreach($profiles as $p): ?>
              <tr>
                <td><?php echo implode('</td><td>',$p); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
        <br>
    </div>
</body>
</html>
</html>

<!--
$profiles[count]['ID'] = $row['Profile_ID'];
$profiles[count]['username'] = $row['Username'];
$profiles[count]['Fname'] = $row['Fname'];
$profiles[count]['Lname'] = $row['Lname'];
$profiles[count]['DOB'] = $row['DOB'];
$profiles[count]['Phone'] = $row['Phone'];
$profiles[count]['Email'] = $row['Email'];
$profiles[count]['Date'] = $row['Date_created'];

$profiles[count][0] = $row['Profile_ID'];
$profiles[count][1] = $row['Username'];
$profiles[count][2] = $row['Fname'];
$profiles[count][3] = $row['Lname'];
$profiles[count][4] = $row['DOB'];
$profiles[count][5] = $row['Phone'];
$profiles[count][6] = $row['Email'];
$profiles[count][7] = $row['Date_created'];

<th>Profile_ID</th>
<th>Username</th>
<th>Firstname</th>
<th>Lastname</th>
<th>DOB</th>
<th>Phone</th>
<th>Email</th>
<th>Date_created</th>
-->
