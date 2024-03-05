<?php

    include 'User.php';
    if (isset($_POST["submit"])) {
        // Variables fname and lname hold the first and last name.
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $fullName = $_POST['fullName'];
        if (empty($fullName)) {
            // New object created.
            $user = new User($fname, $lname);

           // Variable returnMsg stores the value determining if invalid entry is done in input fields.
            $returnMsg = $user->isValid();
            if ($returnMsg == 1)
                $errMsg = "*Only alphabets allowed";
            else if (!empty($returnMsg)) {
                $greetings = $returnMsg;
                if (isset($_FILES["image"])) {
                    $imgPath = $user->isValidImage();
                }
            }
        }
        else {
            $err = "Can't edit full name";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>

<body>
    <section class="user-details">
        <div class="container">
            <h2>USER DETAILS</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form"enctype="multipart/form-data">
                First Name: <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname?>" maxlength=25 pattern="^[a-zA-Z]+$" required><br>
                Last Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname?>" maxlength=25 pattern="^[a-zA-Z]+$" required><br>
                Full Name: <input class="fname" type="text" name="fullName" placeholder="Full Name" value="<?php if ($greetings != "") echo $fname . " " . $lname ?>" disabled><br>
                <span class="error">
                    <?php if (!empty($err)) echo $err; ?>
                </span><br>
                Upload your image <input class="image-input" type="file" name="image"><br>
                <input class="submit-button" type="submit" name="submit" value="Submit">
            </form>
            <div class="greetings-wrapper">
                <span class="greetings">
                    <?php if (!empty($greetings)) echo $greetings; ?><br>
                    <img src="./<?php echo $imgPath?>" alt="">
                </span>
            </div>
            <span class="error">
                <?php if (!empty($errMsg))
                    echo $errMsg; ?>
            </span>
        </div>
    </section>
</body>

</html>