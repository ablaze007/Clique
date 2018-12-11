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
        <a href="pages.php">Pages</a>
        <a href="posts.php">Posts</a>
        <a class="option" href="delete.php">Delete</a>
        <a href="../../index.php">Log Out</a>
    </div>

    <div class="content">
        <br><br><br><br><br>
        <h2>Delete</h2>
        <form action="#" method="POST">
            <input type="text" name="ID" placeholder="Profile ID" required/>
            <button type="submit">Search</button>
        </form>
        <br/>

        <!--php code searches for the given Profile_ID-->
        <?php
          $ID = $_POST['ID'];
          if(!empty($ID))
          {
            $ID = mysqli_real_escape_string($conn,$_POST['ID']);
            $sql = "SELECT * FROM profile;";

            if($result = $conn->query($sql))
            {
              $resultCheck = $result->num_rows;
              if($resultCheck>0)
              {
                $check = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['Profile_ID']==$ID)
                  {
                    $check = 2;
                    $username = $row['Username'];
                    $fname = $row['Fname'];
                    $lname = $row['Lname'];
                  }
                }
              }
            }
          }
        ?>
        <!--PHP code to print some of the profile data if found-->
        <?php if($check==2): ;?>
          <?php
            session_start();
            $_SESSION['check'] = 0;
          ?>
          Profile: <br/><br/>
          <form action="../../queries/deleteProfile.php" method="POST">
            <input type="hidden" name="ID" value="<?=$ID?>"/>
            <?php echo $ID." - ".$username." - ".$fname." ".$lname; ?>
            <br/><br/>
            <button type="submit">Delete</button>
          </form>
        <?php endif; ?>
        <!--PHP code if profile not found -->
        <?php if($check==1): ;?>
          Profile not found!!
        <?php endif; ?>

        <!-- PHP code to display Deletion success -->
        <?php
        session_start();
        $returnVal = $_SESSION['check'];
        if($returnVal == 1)
          echo "Deletion Successful!";
        $_SESSION['check'] = 0;
         ?>
    </div>
</body>
</html>
</html>
