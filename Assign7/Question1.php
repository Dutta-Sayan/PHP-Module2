<?php

    session_start();
    $user = $_SESSION['userName'];
    if($user == false) {
        header('location:index.php?redirect=Question1.php?q=1');
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
    <div class="container">
        <div class="question">
            1. Create a form with below fields:
                Estimate Time: 2h
                First Name - User will input only alphabets
                Last Name - User will input only alphabets
                Full name: User cannot enter a value in Full name field. It will be disabled by default. When the first name and last name fields are filled, this field outputs the sum of the above 2 fields.
                <br>Submit Button-
                On submit, the form gets submitted and the page will reload
                Hello [full-name]” will appear on the page
                <br>
        </div>
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>


</body>
</html>