<?php

    session_start();
    $user = $_SESSION['userName'];
    if($user == false) {
        header('location:index.php?redirect=Question7.php?q=7');
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
            7. Create a login form (using session). When logged in, implement pager with all above questions i.e one task per page. We should be able to identify each question by directly opening the page link but only after login. Ex: if i want the 4th question, i click on abc.com?q=4.
                Estimate Time: 8h
                Login page opens if not logged in
                    Once I login, I should be redirected to the Question No.4 page
                Question No. 4 page opens directly if I am logged in
            <br>
        </div>
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>


</body>
</html>