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
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>
</body>
</html>