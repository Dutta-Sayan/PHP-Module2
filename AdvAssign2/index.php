<?php

    include 'User.php';
    if(isset($_POST['submit'])) {
        $email = strtolower(trim($_POST['email']));
        $user = new User($email);
        $isValid = $user->validity();
        if($isValid == 1) {
            $user->welcomeEmail();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>