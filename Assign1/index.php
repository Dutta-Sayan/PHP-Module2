<?php
    $errMsg="";
    $greetings;
    $returnMsg;
    if(isset($_POST["submit"])){
        $fname= $_POST['fname'];
        $lname= $_POST['lname'];
        $user = new User($fname,$lname);
        $returnMsg= $user->isValid();
        if($returnMsg==1)
            $errMsg= "*Only alphabets allowed";
        else if(!empty($returnMsg))
            $greetings= $returnMsg;
    }
    class User{
        public $fname, $lname;
        public function __construct($fname, $lname){
            $this->fname = $fname;
            $this->lname = $lname;
        }
        public function isValid(){
            $greetings="";
            if (!preg_match("/^[a-zA-Z ]+$/",$this->fname))
                return 1;
            else if (!preg_match("/^[a-zA-Z ]+$/",$this->lname))
                return 1;
            else
            {
                $greetings = "Hello $this->fname $this->lname";
                return $greetings;
            }
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
        *{
            margin: 0;
            border: 0;
            box-sizing: border-box;
            font-family: 'Arial';
        }
        .container{
            width: 1200px;
            margin: auto;
            height: inherit;
            h2{
                padding-top: 10px;
                text-align: center;
            }
        }
        .user-details{
            background-color: #13053c;
            height: 100vh;
            color:  white;
        }
        .input-form{
            padding: 30px 20px;
            text-align: center;
            input{
                border: 1px solid black;
                border-radius: 10px;
                padding: 5px;
                margin: 5px;
                height: 35px;
                width: 500px;
            }
            .submit-button{
                width: 100px;
            }
        }
        .greetings{
            color: yellow;
            font-size: 20px;
        }
        .error{
            color: red;
            font-size: 14px;
            background-color: white;
            /* padding: 5px; */
        }
    </style>
</head>
<body>
    <section class="user-details">
        <div class="container">
            <h2>USER DETAILS</h2>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="input-form">
                First Name: <input type="text" name="fname" placeholder="First Name"><br>
                Last Name: <input type="text" name="lname" placeholder="Last Name"><br>
                Full Name: <input type="text" name="fullName"placeholder="Full Name" value ="<?php if($error!=1)echo $fname." ".$lname?>"disabled><br>
                <input  class="submit-button" type="submit" name="submit" value="Submit"> 
            </form>
            <span class="greetings"><?php echo $greetings;?></span>
            <span class="error"><?php if($errMsg!="")echo $errMsg;?></span>
        </div>
    </section>
</body>
</html>