<?php

    include 'User.php';
    if (isset($_POST["submit"])) {
        // Variables fname and lname hold the first and last name.
        $fname = trim($_POST['fname'], " ");
        $lname = trim($_POST['lname'], " ");
        $fullName = $_POST['fullName'];
        if (empty($fullName)) {
            // New object created.
            $user = new User($fname, $lname);
    
            // Variable returnMsg stores the value determining if invalid entry is done in input fields.
            $returnMsg = $user->isValid();
            if ($returnMsg == $fname)
                $ferrMsg = "*Only alphabets allowed";
            elseif ($returnMsg == $lname)
                $lerrMsg = "*Only alphabets allowed";
            else
                $greetings = $returnMsg;
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
    <title>Assignment 1</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
    <section class="user-details">
        <div class="container">
            <h2>USER DETAILS</h2>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="input-form">
                First Name: <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname?>" maxlength=25><br>
                <span class="error">
                    <?php if ($returnMsg == $fname) echo $ferrMsg; ?>
                </span><br>

                Last Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname?>" maxlength=25><br>
                <span class="error">
                    <?php if ($returnMsg == $lname) echo $lerrMsg; ?>
                </span><br>

                Full Name: <input type="text" name="fullName" placeholder="Full Name" value ="<?php if ($greetings != "") echo $fname." ".$lname ?>" disabled><br>
                <span class="error">
                    <?php if (!empty($err)) echo $err; ?>
                </span><br>
                <input  class="submit-button" type="submit" name="submit" value="Submit"> 
            </form>
            <?php if (!empty($greetings)) { ?>
            <div class="greetings">Hello
            <?php echo $greetings; }?>
            </div>  
        </div>
    </section>
</body>
</html>
