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
      <div class="header">CLIQUE</div>

    <div class="topnav">
        <a href="../userPage.php">Home</a>
        <a href="inbox.php">Inbox</a>
        <a href="posts.php">Posts</a>   <!-- search -->
        <a href="pages.php">Pages</a>   <!-- search -->
        <a class="active" href="people.php">People</a>
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

    <!--  OUTPUT zone  -->
    <div class="body">
        <div class="text">
          <!-- CODE to display the profile of the searched profile  -->
          <?php
            //this PHP code gets profile info from database
            $PID = $_POST['PID'];
            if(!empty($PID)): ?>
            <?php
              $sql = "SELECT * FROM profile;";

              if($result = $conn->query($sql))
              {
                $resultCheck = $result->num_rows;
                if($resultCheck>0)
                {
                  while($row = mysqli_fetch_assoc($result))
                  {
                    if($row['Profile_ID']==$PID)
                    {
                      $check = 2;
                      $fname = $row['Fname'];
                      $lname = $row['Lname'];
                      $username = $row['Username'];
                      $date = $row['Date_created'];
                    }
                  }
                }
              }
            ?>
            <div class="people-userinfo" style="font-size: 20px;">
              <b><?php echo $fname." ".$lname;?>

              <span class="message-button" style="float:right;">
                <!-- <button type="submit">MESSAGE</button> -->
                <input type="button" onclick="location.href='#';" value="Message" />
              </span>
              <span class="message-area" style="display: none; float: right;">
                <form action="../../queries/create/createMessage.php" method="POST">
                  <input type="hidden" name="RID" value="<?=$PID;?>"/>
                  <textarea name="Message" placeholder="type message here" pattern=".{2,100}" title="must be 2-100 characters"></textarea>
                  <button type="submit">Send</button>
                </form>
              </span>
              <br/></b>
              <?php echo "@".$username;?><br/>

              Joined <?php echo $date?>
              <br/><br/>

            </div>
            <hr>
            <br>
            <!-- Following div is for showing the posts of the searched profile -->
            <div>
              <div style="font-family: 'Roboto', sans-serif; font-size: 20px; font-weight: bolder;">
                Recent posts by <?php echo $fname?>
              </div>
              <!-- to get all the post for the searched Profile -->
              <?php
                //This block of php code gets all the posts of the profile
                //and stores it in 2D array called posts
                $sql = "SELECT * FROM post WHERE Profile_ID='$PID' ORDER BY Post_ID DESC;";
                $posts = array();

                if($result = $conn->query($sql))
                {
                  $resultCheck = $result->num_rows;
                  if($resultCheck>0)
                  {
                    $count = 0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $posts[$count] = array();
                        $posts[$count]['PostID'] = $row['Post_ID'];
                        $posts[$count]['ProfileID'] = $row['Profile_ID'];
                        $posts[$count]['PageID'] = $row['Page_ID'];
                        $posts[$count]['Date'] = $row['Date_created'];
                        $posts[$count]['Content'] = $row['Content'];
                        $count = $count +1;
                    }
                  }
                }
              ?>
              <!-- TO display the posts -->
              <?php if($resultCheck==0): ?>
              <br/>  No posts to display..
              <?php endif; ?>

              <?php if($resultCheck>0): ?>
              <!-- //printing all the posts -->
              <br>

              <?php foreach($posts as $p): ?>
                <div class="post-view">
                <a href="#">                    <!-- after pressing on a post -->
                <div class="print-posts">
                  <b><?php echo $fname." ".$lname?></b> @<?php echo $username?>
                  <br>
                  <?php echo $p['Content'];?>
                  <br/>
                  <br/>
                  <?php
                  //to get the page name for a post
                  $PageID = $p['PageID'];
                  $sql = "SELECT * FROM page WHERE Page_ID='$PageID';";

                  if($result = $conn->query($sql))
                  {
                    $resultCheck = $result->num_rows;
                    if($resultCheck>0)
                    {

                      while($row = mysqli_fetch_assoc($result))
                      {
                           echo $row['Page_name'];
                      }
                    }
                  }
                  ?>
                  <div style="float:right;">
                    <i class="fa fa-fw fa-calendar"></i><?php echo $p['Date'];?>
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



              <?php endforeach; ?>




            <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

    </div>

    <div class="sidebar-right">
        <br>
        <div class="search-container">
            <form action="#" method="POST">
                <input type="text" placeholder="Enter firstname" name="fname">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <!--php code searches for the given Profile_ID-->
        <?php
          $fname = $_POST['fname'];
          if(!empty($fname))
          {
            $fname = mysqli_real_escape_string($conn,$_POST['fname']);
            $sql = "SELECT * FROM profile WHERE Fname LIKE '$fname%';";

            if($result = $conn->query($sql))
            {
              $tempCount = $result->num_rows;
              if($tempCount>0)
              {
                $resultProfiles = array();
                $count = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                  $resultProfiles[$count] = array();
                  $resultProfiles[$count]['Username'] = $row['Username'];
                  $resultProfiles[$count]['Fname'] = $row['Fname'];
                  $resultProfiles[$count]['Lname'] = $row['Lname'];
                  $resultProfiles[$count]['ID'] = $row['Profile_ID'];
                  $count = $count+1;
                }
              }
              else
                $tempCount = -1;
            }
          }
        ?>
        <!--PHP code to print some of the profile data if found-->
        <div class="posts">
        <?php if($tempCount>0): ;?>
            <?php foreach($resultProfiles as $r): ;?>
              <form action="#" method="POST"/>
                <?php
                  $ProfileID = $r['ID'];
                  $username = $r['Username'];
                ?>
                <input type="hidden" name="PID" value="<?=$ProfileID?>"/>
                <input type="hidden" name="username" value="<?=$username?>"/>
                <button type="submit">
                  <?php echo $r['Fname']." ".$r['Lname']." @ ".$username; ?>
                </button>
              </form>
              <hr>
            <?php endforeach; ?>
        <?php endif; ?>
        <!--PHP code if profile not found -->
        <div class="text">
        <?php if($tempCount==-1): ;?>
          Profile not found!!
        <?php endif; ?>
        </div>
      </div>

    </div>

    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>

    <script>
        $('.post-view a').click(function(){
            $('.comments').animate({height: "toggle", opacity: "toggle"}, 300);
        });
        $('.message-button input').click(function(){
            $('.message-area').animate({height: "toggle", opacity: "toggle"}, 300);
        });
    </script>


</body>

</html>
