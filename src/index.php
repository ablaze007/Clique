<!DOCTYPE html>
<html>
<head>
    <title>
        Social Network
    </title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
</head>

<body>
    <div class="login-page">
        <div class="header">
            <p class="title">CLIQUE</p>
            <p class="title-admin">ADMIN</p>
        </div>
        <div class="form">
            <form class="login-form" action="includes/userVerify.php" method="POST">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <p class="Error">LOGIN FAILED</p>

                <button type="submit">Log in</button>
                <p class="message">not registered? <a href="usernameVerify.php">sign up</a></p>
                <p class="admin"><a href="#">login as admin</a></p>
            </form>

            <form class="login-admin" action="includes/adminVerify.php" method="POST">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>

                <button type="submit">Log in</button>
                <p class="admin"><a href="#">login as user</a></p>
            </form>

        </div>
    </div>

    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>

    <script>
        $('.admin a').click(function(){
            $('.title').animate({height: "toggle", opacity: "toggle"}, 300);
            $('.title-admin').animate({height: "toggle", opacity: "toggle"}, 300);
        });
    </script>

    <script>
        $('.admin a').click(function(){
            $('.login-form').animate({height: "toggle", opacity: "toggle"}, 300);
            $('.login-admin').animate({height: "toggle", opacity: "toggle"}, 300);
        });
    </script>

</body>

</html>
