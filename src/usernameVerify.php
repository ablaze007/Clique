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
        </div>
        <div class="form">
            <form class="register" method="POST" action="includes/checkUsername.php">
                <input type="text" name="username" placeholder="username" pattern=".{5,10}" required title="must be 5-10 characters">
                <button type="submit">Check Username</button>
                <p class="message">already registered? <a href="index.php">log in</a> </p>
            </form>

        </div>
    </div>

</body>
</html>
