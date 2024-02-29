<?php
$errMsg = "";
$greetings;
$returnMsg;
if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = new User($fname, $lname);
    $returnMsg = $user->isValid();
    if ($returnMsg == 1)
        $errMsg = "*Only alphabets allowed";
    else if (!empty($returnMsg)){
        $greetings = $returnMsg;
        if (isset($_FILES["image"])){
            $imgPath = $user->isValidImage();
        }
    }
}
class User
{
    public $fname, $lname;
    public function __construct($fname, $lname)
    {
        $this->fname = $fname;
        $this->lname = $lname;
    }
    public function isValid()
    {
        $this->fname =$this->test_input($this->fname);
        $this->lname =$this->test_input($this->lname);
        $greetings = "";
        if (!preg_match("/^[a-zA-Z ]+$/", $this->fname))
            return 1;
        else if (!preg_match("/^[a-zA-Z ]+$/", $this->lname))
            return 1;
        else {
            $greetings = "Hello $this->fname $this->lname";
            return $greetings;
        }
    }
    public function isValidImage()
    {
        $file = $_FILES["image"];
        $targetDir = "uploads/";
        $target = $targetDir . basename($_FILES['image']['name']);
        $tempFileName = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($tempFileName, $target)) {
            return $target;       
        }
    }
    public function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
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
                First Name: <input type="text" name="fname" placeholder="First Name"><br>
                Last Name: <input type="text" name="lname" placeholder="Last Name"><br>
                Full Name: <input class="fname" type="text" name="fullName" placeholder="Full Name"
                    value="<?php if ($error != 1)
                        echo $fname . " " . $lname ?>" disabled><br>
                    Upload your image <input class="image-input" type="file" name="image"><br>
                    <input class="submit-button" type="submit" name="submit" value="Submit">
            </form>
            <div class="greetings-wrapper">
                <span class="greetings">
                    <?php echo $greetings; ?><br>
                    <img src="./<?php echo $imgPath?>" alt="">
                </span>
            </div>
            <span class="error">
                <?php if ($errMsg != "")
                    echo $errMsg; ?>
            </span>
        </div>
    </section>
</body>

</html>