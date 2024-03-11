<?php

    session_start();
    $user = $_SESSION['userName'];
    if($user == false) {
        header('location:index.php?redirect=Question4.php?q=4');
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
            4. Add a new text field to the above form to accept the phone number from the user. The number will belong to an Indian user. So, the number should begin with +91 and not be more than 10 digits.
            Estimate Time: 3h 
            <br>
        </div>
            <a class="logout" href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
    </div>
</body>
</html>