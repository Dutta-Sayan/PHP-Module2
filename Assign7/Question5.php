<?php

    session_start();
    $user = $_SESSION['userName'];
    if($user == false) {
        header('location:index.php?redirect=Question5.php?q=5');
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
            5. Add a new single text field to the above form that will accept email id. Do not use email id input field type.
            Estimate Time: 6h 
            <br>
        </div>
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>
</body>
</html>