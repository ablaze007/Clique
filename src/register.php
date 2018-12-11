<html>
<head>
    <title>
        Social Network
    </title>
    <link rel="stylesheet" href="css/style_register.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
</head>

<body>
  <?php
  session_start();
  $username = $_SESSION['username'];
  ?>
    <div class="register-page">
        <div class="header">
            <p class="title">CLIQUE</p>
        </div>
        <div class="form">
            <form class="register" action="queries/create/createProfile.php" method="POST">
                <div class="name">
                         <input type="text" name="first" placeholder="first name" autofocus required/>
                        <input type="text" name="last" placeholder="last name" required/>
                </div>
                <div class="other_info">
                    <input type="text" name="username" value="<?=$username?>" disabled>
                    <input type="password" name="password"placeholder="password" pattern=".{5,20}" required title="must be 5-20 characters"/>
                    <input type="email" name="email" placeholder="email" required/>
                    <input type="text" name="phone" placeholder="phone" pattern=".{10,13}" required title="must be 10-13 characters"/>
                    <input type="date" name="date" placeholder="date" required/>
                </div>
                <button>Sign Up</button>
                <p class="message">don't like it? <a href="usernameVerify.php">new username</a></p>
            </form>

        </div>
    </div>

</body>

</html>
