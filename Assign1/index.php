<?php
    if(isset($_POST["submit"])) {
        //fname, lname values hold the first and last name.
        $fname= trim($_POST['fname']," ");
        $lname= trim($_POST['lname'], " ");
        //New object created.
        $user = new User($fname,$lname);

        //returnMsg stores the value determining if invalid entry is done in input fields.
        $returnMsg= $user->isValid();
        if($returnMsg==1)
            $ferrMsg= "*Only alphabets allowed";
        elseif($returnMsg==2)
            $lerrMsg = "*Only alphabets allowed";
        else
            $greetings= $returnMsg;
    }
    class User {
        public $fname, $lname;
        public function __construct($fname, $lname) {
            $this->fname = $fname;
            $this->lname = $lname;
        }

        /*
        Checks if the input name follows the general naming pattern,
        and returns the message accordingly.
        */
        public function isValid() {
            // $pattern = "/^[a-zA-Z]+[ ]*[a-zA-Z]+$/";
            $pattern = "/^[a-zA-Z]+$/";
            if (!preg_match($pattern, $this->fname))
                return 1;
            else if (!preg_match($pattern, $this->lname))
                return 2;
            else {
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
                First Name: <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname?>" maxlength=25><br>
                <span class="error"><?php if($returnMsg==1)echo $ferrMsg;?></span><br>

                Last Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname?>" maxlength=25><br>
                <span class="error"><?php if($returnMsg==2)echo $lerrMsg;?></span><br>

                Full Name: <input type="text" name="fullName"placeholder="Full Name" value ="<?php if($greetings!="")echo $fname." ".$lname?>"disabled><br>
                <input  class="submit-button" type="submit" name="submit" value="Submit"> 
            </form>
            <span class="greetings"><?php echo $greetings;?></span>     
        </div>
    </section>
</body>
</html>