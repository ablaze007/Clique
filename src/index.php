<!--
MIT License

Copyright (c) 2018 Bhuwan KC & Muraj Shrestha

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

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
