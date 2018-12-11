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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
</head>

<body>
    <!-- <div class="header">Social Network</div> -->
    <div class="header">CLIQUE</div>

    <div class="topnav">
        <a href="../userPage.php">Home</a>
        <a href="inbox.php">Inbox</a>
        <a href="posts.php">Posts</a>   <!-- search -->
        <a class="active" href="pages.php">Pages</a>   <!-- search -->
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
          <!-- CODE to display the searched page  -->
          <?php
            //this PHP code gets profile info from database
            $PageIDx = $_POST['PageIDx'];
            if(!empty($PageIDx)): ?>

            <?php
              $check = $_POST['pageCheck'];
              if($check == "2"): ;?>
              <!-- PAGE EDIT MODE -->
              <div class="new-page-creation" align="center">
                <?php $PNamex = $_POST['PName']; ?>
                <b>EDIT PAGE - <?php echo $PNamex; ?></b><br/><br/>

                <form action="../../queries/update/updatePage.php" method="POST">
                  <div class="new-page-top-part">
                    <input type="hidden" name="id" value="<?=$PageIDx;?>"/>
                    <input type="text" name="name" placeholder="Page name" autofocus required pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                    <input type="text" name="des" placeholder="Description" required pattern=".{10,100}" title="must be 10-20 characters"/><br/><br/>
                    <input type="text" name="other" placeholder="Field/Subject" required pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                    <input type="text" name="img" placeholder="Image" pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                  </div>

                  <b>Pick page type</b> <br/>
                  <div class="new-page-bottom-part" style="margin-top:2%;">
                    <input type="radio" name="type" value="entertainment"/><label>Entertainment</label>
                    <input type="radio" name="type" value="informative"/><label>Informative</label><br/><br/>
                  </div>

                  <button type="submit"> CREATE </button>
                </form>
              </div>
            <?php endif; ?>

            <?php $checkSearch=$_POST['search'];
            if(($check == "1")||$checkSearch=="YES"): ;?>
            <!-- DISPLAY THE PAGE -->

              <?php
              //increase the view count
                $sqlCount = "UPDATE page SET View_count=View_count+1 WHERE Page_ID='$PageIDx';";
                if(!($conn->query($sqlCount)))
                  echo "Error in view count increment";
              //get followers count
                $sqlCount = "SELECT COUNT(*) as count FROM follows WHERE Page_ID='$PageIDx';";
                if($result = $conn->query($sqlCount))
                {
                  $resultCount = $result->num_rows;
                  if($resultCount>0)
                  {
                    $row = mysqli_fetch_assoc($result);
                    $followers = $row['count'];
                  }
                }
              ?>
              <?php
              //getting page info
                $sql = "SELECT * FROM page WHERE Page_ID='$PageIDx';";
                if($result = $conn->query($sql))
                {
                  $pageCheck = $result->num_rows;
                  if($pageCheck>0)
                  {
                    $pageInfo = array();
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $pageInfo = $row;
                    }
                  }
                }
              ?>

             <!--  <?php echo $pageInfo['Page_name'];?><br/><br/>
              <?php echo $pageInfo['Description'];?><br/><br/>
              Views - <?php echo $pageInfo['View_count'];?>
              Followers - <?php echo $followers; ?> -->

              <div class="page-info">
                <div style="font-size: 30px; text-align: center; margin-bottom: -25px; font-weight: bold;"><?php echo $pageInfo['Page_name'];?></div><br/><br/>
                <hr>
                <span>
                <form action="../../queries/create/createFollow.php" method="POST">
                  <input type="hidden" name="PageID" value="<?=$PageIDx;?>" />
                  <button type="submit">
                  FOLLOW
                  </button>
                </form>
                </span>

                <span style="float: right; margin-right: -8%; margin-top: -.5%">
                  <i class="fa fa-eye"></i> <?php echo $pageInfo['View_count'];?>
                </span>

                <?php echo $pageInfo['Description'];?><br/><br/>
                Followers: <?php echo $followers; ?>
              </div>

              <br/><br/>
              <!-- OPTION to create a new post -->
              <div class="post-textarea">
              <form action="../../queries/create/createPost.php" method="POST">
                <input type="hidden" name="PageID" value="<?=$PageIDx; ?>" />
                <textarea name="content" placeholder="Write a post..." pattern=".{2,100}" title="must be 2-100 characters"/></textarea><br/>
                <button type="submit"">POST</button>
              </form>
              </div>

              <!-- to print all the posts on the page -->
              <div>
              <!-- POSTS -->
              <br/>
              <div style="font-family: 'Roboto', sans-serif; font-size: 20px; font-weight: bolder;">
                Posts in <?php echo $pageInfo['Page_name']?>
              </div>
              <br>
                <!-- to get all the post for the searched page -->
                <?php
                  //This block of php code gets all the posts on the page
                  //and stores it in 2D array called posts
                  $sql = "SELECT * FROM post WHERE Page_ID='$PageIDx' ORDER BY Post_ID DESC;";
                  $posts = array();

                  if($result = $conn->query($sql))
                  {
                    $postCheck = $result->num_rows;
                    if($postCheck>0)
                    {
                      $count = 0;
                      while($row = mysqli_fetch_assoc($result))
                      {
                          $posts[$count] = array();
                          $posts[$count] = $row;
                          $count = $count +1;
                      }
                    }
                  }
                ?>
                <!-- TO display the posts -->
                <?php if($postCheck==0): ?>
                <br/>  No posts to display..
                <?php endif; ?>

                <?php if($postCheck>0): ?>
                <!-- //printing all the posts -->
                <?php foreach($posts as $p): ?>

                  <?php
                  //to get the page name for a post
                  $ProID = $p['Profile_ID'];
                  $sql = "SELECT * FROM profile WHERE Profile_ID='$ProID';";

                  if($result = $conn->query($sql))
                  {
                    $proCheck = $result->num_rows;
                    if($proCheck>0)
                    {

                      while($row = mysqli_fetch_assoc($result))
                      {
                          $fname = $row['Fname'];
                          $lname = $row['Lname'];
                          $username = $row['Username'];
                          $date = $row['Date_created'];
                      }
                    }
                  }
                  ?>
                    <div class="post-view">
                      <a href="#">                    <!-- after pressing on a post -->
                      <div class="print-posts">
                        <b><?php echo $fname." ".$lname?></b> @<?php echo $username?>
                        <br>
                        <?php echo $p['Content'];?>
                        <br/>
                        <br/>
                        <?php echo $pageInfo['Page_name'] ?>
                        <div style="float:right;">
                          <i class="fa fa-fw fa-calendar"></i><?php echo $date;?>
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
          <?php endif; ?> <!-- ending displaying a page -->

          <!--If user wants TO create a new Page -->
          <?php
            $create = $_POST['create'];
            if((!empty($create)) && $create == "YES"): ?>
            <div class="new-page-creation" align="center">
              <b>Create a new page</b><br/><br/>

              <form action="../../queries/create/createPage.php" method="POST">
                <div class="new-page-top-part">
                  <input type="text" name="name" placeholder="Page name" autofocus required pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                  <input type="text" name="des" placeholder="Description" required pattern=".{10,100}" title="must be 10-20 characters"/><br/><br/>
                  <input type="text" name="other" placeholder="Field/Subject" required pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                  <input type="text" name="img" placeholder="Image" pattern=".{5,20}" title="must be 5-20 characters"/><br/><br/>
                </div>

                <b>Pick page type</b> <br/>
                <div class="new-page-bottom-part" style="margin-top:2%;">
                  <input type="radio" name="type" value="entertainment"/><label>Entertainment</label>
                  <input type="radio" name="type" value="informative"/><label>Informative</label><br/><br/>
                </div>

                <button type="submit"> CREATE </button>
              </form>
            </div>
          <?php endif; ?>
        </div>
    </div>

    <div class="sidebar-right">
        <br>
        <div class="follow-pages" style="text-align: left; margin-bottom: -15px;">

            <form action="#" method="POST">
              <input type="hidden" name="create" value="YES" />
              Pages you manage
              <button type="submit" style="padding:10px;"> <b><span style="font-size:1.5rem;">+</span></b> </button>
            </form>
        </div>

        <br>
        <!-- To find pageID of all the pages managed by the profile -->
        <?php
        $sql = "SELECT * FROM manages AS m JOIN page AS p ON m.Page_ID = p.Page_ID WHERE Profile_ID='$ID';";

        if($result = $conn->query($sql))
        {
          $resultCheck = $result->num_rows;
          if($resultCheck>0)
          {
            $pages = array();
            $count = 0;
            while($row = mysqli_fetch_assoc($result))
            {
              $pages[$count] = array();
              $pages[$count]['PageName'] = $row['Page_name'];
              $pages[$count]['PageID'] = $row['Page_ID'];
              $count = $count+1;
            }
          }
        }
        ?>
        <hr>
        <div class="posts">
        <?php if($resultCheck>0): ?>
          <?php foreach($pages as $p): ;?>
            <form action="#" method="POST">
              <input type="hidden" name="PName" value="<?=$p['PageName'];?>" />
              <input type="hidden" name="PageIDx" value="<?=$p['PageID'];?>" />
              <div class="left" style="width: 88%; display: inline-block;">
                <button type="submit" name="pageCheck" value="1"><?php echo $p['PageName'];?></button>
              </div>
              <div class="edit" style="width: 12%; display: inline-block; text-align: center; float: right;">
                <button type="submit" name="pageCheck" value="2"><i class="material-icons">mode_edit</i></button>
              </div>
            </form>
            <hr>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php if($resultCheck==0): ?>
          <button type="submit">None</button>
          <hr>
        <?php endif; ?>
        </div>

        <br>
        <br>

        <!-- Pages followed by the user -->
        <div class="follow-pages" style="text-align: left;">
            Pages you follow
        </div>
        <br>
          <!-- To find pageID of all the pages managed by the profile -->
          <?php
            $sql = "SELECT * FROM follows AS f JOIN page AS p ON f.Page_ID = p.Page_ID WHERE Profile_ID='$ID';";

            if($result = $conn->query($sql))
            {
              $resultCheck2 = $result->num_rows;
              if($resultCheck2>0)
              {
                $pages = array();
                $count = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                  $pages[$count] = array();
                  $pages[$count]['PageName'] = $row['Page_name'];
                  $pages[$count]['PageID'] = $row['Page_ID'];
                  $count = $count+1;
                }
              }
            }
          ?>
          <hr>
          <div class="posts">
          <?php if($resultCheck2>0): ?>
            <?php foreach($pages as $p): ;?>
              <form action="#" method="POST">
                <input type="hidden" name="PageIDx" value="<?=$p['PageID'];?>" />
                <input type="hidden" name="search" value="YES"/>
                <button type="submit"><?php echo $p['PageName'];?></button>
              </form>
              <hr>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if($resultCheck2==0): ?>
            <button> None </button>
            <hr>
          <?php endif; ?>

        </div>
        <br><br>

        <div class="follow-pages" style="text-align: left;">
            Find a page
        </div>
        <br>
        <div class="search-container">
            <form action="#" method="POST">
                <input type="text" placeholder="page name.." name="PageName">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <hr>

        <?php
        //TO display the page search results
          $PageName = $_POST['PageName'];
          if(!empty($PageName))
          {
            $PageName = mysqli_real_escape_string($conn,$_POST['PageName']);
            $sql = "SELECT * FROM page WHERE Page_name LIKE '$PageName%';";

            if($result = $conn->query($sql))
            {
              $tempCount = $result->num_rows;
              if($tempCount>0)
              {
                $resultPages = array();
                $count = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                  $resultPages[$count] = array();
                  $resultPages[$count]['PageID'] = $row['Page_ID'];
                  $resultPages[$count]['Page_name'] = $row['Page_name'];
                  $resultPages[$count]['Des'] = $row['Description'];
                  $count = $count+1;
                }
              }
              else
                $tempCount = -1;
            }
          }
        ?>
        <div class="posts">
          <?php if($tempCount>0): ;?>
            <?php foreach($resultPages as $r): ;?>
              <form action="#" method="POST"/>
                <input type="hidden" name="PageIDx" value="<?=$r['PageID']?>"/>
                <input type="hidden" name="search" value="YES"/>
                <button type="submit">
                <?php echo $r['Page_name']; ?> <br/>
                <?php echo $r['Des']; ?>
                </button>
              </form>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if($tempCount==-1): ;?>
            <button type="submit">No such page found!</button>
          <?php endif; ?>
        </div>
        <hr>

    </div>

    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>

    <script>
        $('.post-view a').click(function(){
            $('.comments').animate({height: "toggle", opacity: "toggle"}, 300);
        });
    </script>


</body>

</html>
