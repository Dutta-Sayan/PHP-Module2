<?php

if (isset($_POST["submit"])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $marks = $_POST['marks'];
    $user = new User($fname, $lname);
    $returnMsg = $user->isValid();
    if ($returnMsg == 1)
        $errMsg = "*Only alphabets allowed";
    else if (!empty($returnMsg)) {
        $greetings = $returnMsg;
        if (isset($_FILES["image"])) {
            $imgPath = $user->isValidImage();
        }
        $marksArr = $user->processMarks($marks);
        $table = $user->createTable($marksArr);
    }
}
class User {
    public $fname, $lname;
    public function __construct($fname, $lname) {
        $this->fname = $fname;
        $this->lname = $lname;
    }
    public function isValid() {
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
    public function isValidImage() {
        $file = $_FILES["image"];
        $targetDir = "uploads/";
        $target = $targetDir . basename($_FILES['image']['name']);
        $tempFileName = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($tempFileName, $target)) {
            return $target;       
        }
    }
    public function processMarks($marks) {
        $marksArr = explode("\n", $marks);
        $res=array();
        $j=0;
        foreach($marksArr as $i){
            $res[$j] = explode("|",$i);
            $j++;
        }
        return $res;
    }
    public function createTable($marksArr) {
        if(count($marksArr) > 0) {
            $table = '<h3>Your Result</h3><br><table class="Result">';
            $table.= '<tr><th>'."Subject".'</th>'.'<th>'."Marks".'</th></tr>';
            foreach($marksArr as $subjectrow){
                $table.= '<tr>';
                foreach($subjectrow as $res){
                    $table.='<td>'.$res.'</td>';
                }
                $table.= '</tr>';
            }
            $table.= '</table>';
        }
        return $table;
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
</head>

<body>
    <section class="user-details">
        <div class="container">
            <h2>USER DETAILS</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form"enctype="multipart/form-data">
                <label for="">First Name: </label><input type="text" name="fname" placeholder="First Name"><br>
                <label for="">Last Name: </label><input type="text" name="lname" placeholder="Last Name"><br>
                <label for="">Full Name: </label><input class="fullname" type="text" name="fullName" placeholder="Full Name"
                    value="<?php if ($error != 1)echo $fname . " " . $lname ?>" disabled><br>
                <label for="image">Upload your image </label><input class="image-input" type="file" name="image"><br>
                <label for="marks">Enter your marks:</label>
                <textarea name="marks" id="" cols="30" rows="3"></textarea><br>
                <input class="submit-button" type="submit" name="submit" value="Submit">
            </form>
            <div class="greetings-wrapper">
                <span class="greetings">
                    <?php if (!empty($greetings)) echo $greetings; ?><br>
                    <img src="./<?php echo $imgPath?>" alt="">
                </span>
            </div>
            <div class="marks-table">
                <?php echo $table;?>
            </div>
            <span class="error">
                <?php if (!empty($errMsg))
                    echo $errMsg; ?>
            </span>
        </div>
    </section>
</body>

</html>