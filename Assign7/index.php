<?php

    if (isset($_POST["login"])) {
        // Fetching the user name and password.
        $username = $_POST["uname"];
        $password = $_POST["pswd"];
        // Checking for valid username and password.
        if ($username == "sayan" && $password == "123") {

            // Starting session on valid user login.
            session_start();
            $_SESSION['userName'] = $username;
            if (isset($_GET['redirect'])) {
                header('location:'. $_GET['redirect']);
            }
            else {
                header('location:questions.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section class="main">
        <div class="container">
            <div class="login">
                <div class="login-form">
                    <h3>User Login</h3>
                    <form action="" method="post">
                        <label for="uname">Username:</label><br>
                        <input type="text" name="uname" class ="username"><br>
                        <label for="pswd">Password:</label><br>
                        <input type="password" name="pswd" class="password"><br>
                        <a href="" class="submit"><input type="submit" name="login" value="Login"></a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
