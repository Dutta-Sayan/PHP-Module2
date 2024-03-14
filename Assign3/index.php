<?php

    include 'User.php';
    if (isset($_POST["submit"])) {
        // Variables 'fname' and 'lname' hold the first and last name.
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $fullName = $_POST['fullName'];
        $marks = $_POST['marks'];

        if (empty($fullName)) {
            // New object created.
            $user = new User($fname, $lname);

            // Variable 'returnMsg' stores the value determining if invalid entry is done in input fields.
            $returnMsg = $user->isValid();
            if ($returnMsg == $fname)
                $ferrMsg = "*Error";
            else if ($returnMsg == $lname)
                $lerrMsg = "*Error";
            else {
                if (isset($_FILES["image"])) {
                    $imgPath = $user->isValidImage();
                    if ($imgPath == "") {
                        $imgErr = "Not a valid image!";
                    }
                    else {
                        // Variable 'marksArr' stores a 2-D array containing subject name and marks
                        $marksArr = $user->processMarks($marks);
                        if ($marksArr == 0)
                            $marksErr = "*Invalid format";
                        else {
                            $greetings = $returnMsg;
                            $name = $fname." ".$lname;
                            // The result to be displayed in table format is stored in 'table' variable.
                            $table = $user->createTable($marksArr);
                        }
                    }
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
    <title>Assignment 3</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script><?php include 'app.js'; ?></script>
</head>

<body>
    <section class="user-details">
        <div class="container">
            <h2>USER DETAILS</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form" enctype="multipart/form-data">
                
                <!-- Input area for first name. -->
                <label for="">First Name: </label><input type="text" class ="fname" name="fname" placeholder="Enter only alphabets (Max 25 characters)" value="<?php echo $fname?>" maxlength=25 pattern="^[a-zA-Z ]{1,25}$" required><br>
                <span class="error ferror"><?php echo $ferrMsg; ?></span><br>

                <!-- Input area for last name. -->
                <label for="">Last Name: </label><input type="text" class="lname" name="lname" placeholder="Enter only alphabets (Max 25 characters)" value="<?php echo $lname?>" maxlength=25 pattern="^[a-zA-Z ]{1,25}$" required><br>
                <span class="error lerror"><?php echo $lerrMsg; ?></span><br>

                <!-- Area for displaying full name. -->
                <label for="">Full Name: </label><input class="fullname" type="text" name="fullName" placeholder="Full Name" value="<?php echo $name ?>" disabled><br>
                <span class="error fullErr"><?php echo $err; ?></span><br>

                <!-- Input area for image upload and marks entry. -->
                <label for="image">Upload your image </label><input class="image-input" type="file" name="image" accept="image/*" required><br>
                <span class="error"><?php echo $imgErr; ?></span><br>
                <label for="marks">Enter your marks:</label>
                <textarea name="marks" id="" cols="30" rows="3" placeholder="Enter in the format: Subject|Marks. Max marks can be 3 digits."></textarea><br>
                <span class="error marksErr"><?php echo $marksErr; ?></span><br>
            
                <input class="submit-button" type="submit" name="submit" value="Submit">
            </form>

            <?php if (!empty($greetings)) { ?>
                <div class="greetings">Hello
                    <?php echo $greetings; ?>
                    <div class="user-img">
                    <img src="./<?php echo $imgPath?>" alt="">
                    </div>
                    <div class="marks-table">
                        <?php echo $table;?>
                    </div>
                </div> 
            <?php }?>
        </div>
    </section>
</body>
</html>
