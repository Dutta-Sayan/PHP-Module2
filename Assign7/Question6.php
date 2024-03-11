<?php

    session_start();
    $user = $_SESSION['userName'];
    if($user == false) {
        header('location:index.php?redirect=Question6.php?q=6');
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
            6. When the user submits the above form, 2 copies of the data will get created in a doc format. One will store on the server and the other will be downloaded to the user submitting the data. The information in the doc should be presented in a well-defined manner.
            Estimate Time: 4h 
            <br>
        </div>
        <h3>Choose question</h3>
        <ul class="questions">
            <li><a href="Question1.php?q=1">Question 1</a></li>
            <li><a href="Question2.php?q=2">Question 2</a></li>
            <li><a href="Question3.php?q=3">Question 3</a></li>
            <li><a href="Question4.php?q=4">Question 4</a></li>
            <li><a href="Question5.php?q=5">Question 5</a></li>
            <li><a href="Question6.php?q=6">Question 6</a></li>
            <li><a href="Question7.php?q=7">Question 7</a></li>
        </ul>
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>
</body>
</html>