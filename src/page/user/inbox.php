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
</head>

<body>
    <!-- <div class="header">Social Network</div> -->
     <div class="header">CLIQUE</div>

    <div class="topnav">
        <a href="../userPage.php">Home</a>
        <a class="active" href="inbox.php">Inbox</a>
        <a href="posts.php">Posts</a>   <!-- search -->
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

    <div class="body">

      <?php
        $IDx = $_POST['IDx'];
        if(!empty($IDx)): ;
       ?>

      <div class="message">
        <form action="../../queries/create/createMessage.php" method="POST">
          <input type="hidden" name="RID" value="<?=$IDx;?>"/>
          <input type="text" placeholder="type a message..." name="Message"/>
          <button type="submit" style="width:13%;">Send</button>
        </form>
      </div>

        <div class="message-box">

           <?php
              $sql = "SELECT * FROM message WHERE (Sender_ID='$ID' AND Receiver_ID='$IDx') OR (Sender_ID='$IDx' AND Receiver_ID='$ID') ORDER BY Message_ID DESC;";

              if($result = $conn->query($sql))
              {
                $msgs = array();
                $count = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                  $msgs[$count] = array();
                  $msgs[$count] = $row;
                  $count = $count+1;
                }
              }
            ?>
            <br/>
            <?php foreach($msgs as $msg): ;?>
              <?php if($msg['Receiver_ID']==$ID): ;?>
                <div class="outgoing">
                    <?php echo $msg['Content']; ?>
                </div>
                <br/>
                <br/>
                <br/>
              <?php endif; ?>
              <?php if($msg['Sender_ID']==$ID): ;?>
                <div class="incoming">
                    <?php echo $msg['Content']; ?>
                </div>
                <br/>
                <br/>
                <br/>
              <?php endif; ?>
            <?php endforeach; ?>

          <?php endif; ?>

        </div>


    </div>


    <div class="sidebar-right">
          <br>
          <div class="follow-pages">
            Your Messages
          </div>
          <br>
          <hr>
        <div class="posts">
          <?php
            $sql = "SELECT DISTINCT Receiver_ID FROM message WHERE Sender_ID='$ID' ORDER BY Message_ID DESC;";
            if($result = $conn->query($sql))
            {
              $IDs = array();
              $count = 0;
              while($row = mysqli_fetch_assoc($result))
              {
                $IDs[$count] = $row['Receiver_ID'];
                $count=$count+1;
              }
            }
          ?>
          <?php
            $sql = "SELECT DISTINCT Sender_ID FROM message WHERE Receiver_ID='$ID' ORDER BY Message_ID DESC;";
            if($result = $conn->query($sql))
            {
              $ID2s = array();
              $count2 = 0;
              while($row = mysqli_fetch_assoc($result))
              {
                $check = 0;
                foreach($IDs as $id)
                {
                  if($row['Sender_ID']==$id)
                    $check=1;
                }
                if($check==0)
                {
                  $ID2s[$count2] = $row['Sender_ID'];
                  $count2=$count2+1;
                }
              }
            }
          ?>

          <?php foreach($IDs as $id): ?>
            <form action="#" method="POST">
              <input type="hidden" name="IDx" value="<?=$id;?>"/>
              <button type="submit">
                <?php
                  $sql = "SELECT * FROM profile WHERE Profile_ID='$id';";
                  if($result = $conn->query($sql))
                  {
                    $row = mysqli_fetch_assoc($result);
                    echo $row['Fname']." ".$row['Lname'];
                  }
                ?>
              </button>
            </form>
        <?php endforeach; ?>
        <?php foreach($ID2s as $id): ?>
          <form action="#" method="POST">
            <input type="hidden" name="IDx" value="<?=$id;?>"/>
            <button type="submit">
              <?php
                $sql = "SELECT * FROM profile WHERE Profile_ID='$id';";
                if($result = $conn->query($sql))
                {
                  $row = mysqli_fetch_assoc($result);
                  echo $row['Fname']." ".$row['Lname'];
                }
              ?>
            </button>
          </form>
      <?php endforeach; ?>
        </div>
        <hr>
    </div>


</body>

</html>
