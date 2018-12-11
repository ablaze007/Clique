<?php
//connecting to the database
include_once '../../includes/dbh.php';
?>

<?php
    session_start();
    $userInfo = $_SESSION['userInfo'];
    $ID = $userInfo[0];
    $username = $userInfo[1];
    $fname = $userInfo[2];
    $lname = $userInfo[3];
    $date = $userInfo[4];
?>

<SCRIPT LANGUAGE="JavaScript">
    var theImages = new Array()

    theImages[0] = '../../Misc/png/dog.png'
    theImages[1] = '../../Misc/png/cat.png'
    theImages[2] = '../../Misc/png/fox.png'
    theImages[3] = '../../Misc/png/eagle.png'
    theImages[4] = '../../Misc/png/bear.png'
    theImages[5] = '../../Misc/png/fennec.png'
    theImages[6] = '../../Misc/png/koala.png'
    theImages[7] = '../../Misc/png/owl.png'
    theImages[8] = '../../Misc/png/tiger.png'

    var j = 0
    var p = theImages.length;
    var preBuffer = new Array()
    for (i = 0; i < p; i++){
        preBuffer[i] = new Image()
        preBuffer[i].src = theImages[i]
    }
    var whichImage = "<?php echo $ID%9; ?>";
    function showImage(){
        document.write('<img src="'+theImages[whichImage]+'" width="150px">');
    }
</script>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $fname." ".$lname; ?></title>
    <link rel="stylesheet" href="../../css/style_user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
</head>

<body>
    <!-- <div class="header">Social Network</div> -->
     <div class="header">CLIQUE</div>

    <div class="topnav">
        <a href="../userPage.php">Home</a>
        <a href="inbox.php">Inbox</a>
        <a class="active" href="posts.php">Posts</a>   <!-- search -->
        <a href="pages.php">Pages</a>   <!-- search -->
        <a href="people.php">People</a>
        <a href="../../index.php" style="float: right;">Log Out</a>
    </div>

    <div class="sidebar-back"></div>
    <div class="sidebar">
        <div class="userInfo">
            <div class="profile-image" align="center">
                <SCRIPT LANGUAGE="JavaScript">
                    showImage();
                </script>
            </div>
            <b><?php echo $fname." ".$lname; ?></b><br>
            @<?php echo $username;?>
            <p><i class="fa fa-fw fa-calendar"></i> Joined <?php echo $date;?> </p>
            <br>
        </div>
    </div>

    <!-- OUTPUT ZONE -->
    <div class="body">
        <div class="text">
          <?php
            //get PostIDx to be displayed in OUTPUT zone
            $PostIDx = $_POST['PostIDx'];
            if(!empty($PostIDx)): ?>

            <?php
              $sql = "SELECT * FROM post WHERE Post_ID='$PostIDx';";
              if($result = $conn->query($sql))
              {
                $countCheck = $result->num_rows;
                if($countCheck>0)
                {
                  $postInfo = mysqli_fetch_assoc($result);
                }
              }
            ?>
            <!--print profile info for the post -->
            <?php
              $proID = $postInfo['Profile_ID'];
              $sql = "SELECT * FROM profile WHERE Profile_ID='$proID';";
              if($result = $conn->query($sql))
              {
                $row = mysqli_fetch_assoc($result);
                $fname = $row['Fname'];
                $lname = $row['Lname'];
                $username = $row['Username'];
                // echo $row['Fname']." ".$row['Lname'];
                // echo " @".$row['Username'];
              }
            ?>
            <!-- <br/>
            <b><?php echo $fname." ".$lname?></b> @<?php echo $username?>
            <?php echo $postInfo['Content']; ?>
            <br/><br/> -->

            <div class="post-view">
              <a href="#">                    <!-- after pressing on a post -->
                <div class="print-posts">
                  <b><?php echo $fname." ".$lname?></b> @<?php echo $username?>
                  <br>
                  <?php echo $postInfo['Content'];?>
                  <br/>
                  <br/>

                  <!--print name info for the post -->
                  <?php
                    $pageID = $postInfo['Page_ID'];
                    $sql = "SELECT * FROM page WHERE Page_ID='$pageID';";
                    if($result = $conn->query($sql))
                    {
                      $row = mysqli_fetch_assoc($result);
                      echo $row['Page_name'];
                    }
                  ?>
                  <!-- <?php echo $postInfo['Date_created'];?> -->
                  <div style="float:right;">
                    <i class="fa fa-fw fa-calendar"></i><?php echo $postInfo['Date_created'];?>
                  </div>
                  </div>
                </a>
              </div>

              <div class="comments" style="display: none;">
                <div style="margin-bottom: 10px;">
                  <a href="#upvote"><i class="far fa-arrow-alt-circle-up" style="font-size: 20px;"></i></a>
                  <span class="favorite" style="float: right;"> <a href="#heart"><i class="fa fa-fw fa-heart"></i></span></a>
                  <a href="#downvote"><i class="far fa-arrow-alt-circle-down" style="font-size: 20px;"></i></a>
                </div>
                <hr>
                <span style="font-weight: bolder;"> Comments</span>

                <div class="type-comment">
                  <input type="text" placeholder="add a comment..." name="user-comment">
                  <button type="submit">post</button>
                </div>
                <br>


                <!-- Show coments below -->
                <div class="user-comments" style="margin-bottom:8px;">
                  <b><?php echo $username?> </b> [user comment]
                </div>

              </div>
          <?php endif; ?>

        </div>
    </div>

    <?php
      //This block of php code gets all the recent posts from followed pages and
      //stores it in 2D array called posts
      $sql = "SELECT * FROM post as p JOIN follows as f ON p.Page_ID = f.Page_ID WHERE f.Profile_ID='$ID' ORDER BY p.Date_created DESC;";
      $posts = array();

      if($result = $conn->query($sql))
      {
        $resultCheck = $result->num_rows;
        if($resultCheck>0)
        {
          $count = 0;
          while($row = mysqli_fetch_assoc($result))
          {
            if($count<5)
            {
              $posts[$count] = array();
              $posts[$count] = $row;
              $count = $count+1;
            }
          }
        }
      }
    ?>

    <div class="sidebar-right">
          <!-- PHP Code to display posts from followed pages-->
          <br>
          <div class="follow-pages">
            Recent Posts
          <?php if(count($posts)==0): ?>
              <br><br>No posts to display...
          <?php endif; ?>
          </div>

          <div class="posts" style="color:white;">
              <?php if(count($posts)>0): ?>
              <br>
              <hr>
              <!-- iterating through each post -->
              <?php foreach($posts as $p): ?>

              <form action="#" method="POST">
                <button type="submit">
                <input type="hidden" name="PostIDx" value="<?=$p['Post_ID'];?>"/>

                  <?php echo $p['Content'];?>
                  <br><br>
                  <div style="float:left;">
                      <?php
                      //to get the page name for a post
                      $PageID = $p['Page_ID'];
                      $sql = "SELECT * FROM page WHERE Page_ID='$PageID';";

                      if($result = $conn->query($sql))
                      {
                        $resultCheck = $result->num_rows;
                        if($resultCheck>0)
                        {
                          $row = mysqli_fetch_assoc($result);
                          echo $row['Page_name'];
                        }
                      }
                      //to get the profile name for the post
                      $ProID = $p['Profile_ID'];
                      $sql = "SELECT * FROM profile WHERE Profile_ID='$ProID';";
                      if($result = $conn->query($sql))
                      {
                        $resultCheck = $result->num_rows;
                        if($resultCheck>0)
                        {
                          $row = mysqli_fetch_assoc($result);
                          echo $row['Profile_name'];
                        }
                      }
                      ?>
                  </div>
                  <div style="float:right;">
                      <i class="fa fa-fw fa-calendar"></i> <?php echo $p['Date'];?>
                  </div>
                </button>
              </form>
              <hr>
              <?php endforeach; ?>

              <?php endif; ?>
          </div>
    </div>

    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>

    <script>
        $('.post-view a').click(function(){
            $('.comments').animate({height: "toggle", opacity: "toggle"}, 300);
        });
    </script>


</body>

</html>
