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
        <a href="profiles.php">Profiles</a>
        <a class="option" href="pages.php">Pages</a>
        <a href="posts.php">Posts</a>
        <a href="delete.php">Delete</a>
        <a href="../../index.php">Log Out</a>
    </div>

    <?php
      //This block of php code gets all the profile information and
      //stores it in 2D array called pages
      $sql = "SELECT * FROM page;";
      $pages = array();

      if($result = $conn->query($sql))
      {
        $resultCheck = $result->num_rows;
        if($resultCheck>0)
        {
          $count = 0;
          while($row = mysqli_fetch_assoc($result))
          {
              $pages[$count] = array();
              $pages[$count]['PageID'] = $row['Page_ID'];
              $pages[$count]['PageName'] = $row['Page_name'];
              $pages[$count]['Views'] = $row['View_count'];
              $pages[$count]['Description'] = $row['Description'];
              $pages[$count]['Image'] = $row['Image'];
              $count = $count+1;
          }
        }
      }
    ?>

    <div class="content">
        <br><br><br><br><br>
        <?php if(count($pages)>0): ?>
        <table>
          <thead>
            <tr>
              <th><?php echo implode('</th><th>', array_keys(current($pages))); ?></th>
            </tr>
          </thead>
          <tbody>
            <!-- iterating through each profile and printing the values -->
            <?php foreach($pages as $p): ?>
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
