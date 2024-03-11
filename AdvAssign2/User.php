<?php

require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Class consisting of two functions for email validation and sending email to user.
 * @param string $email is passed to the class which is the user's input email value.
 * 
 */
class User {
    public string $email;
    public function __construct($email) {
        $this->email = $email;
    }

    /**
     * Checks if the email is valid or not. 
     * Abstract apai is used to check the deliverability of the email.
     * @return integer 0 if the email is invalid and 1 if the email is valid.
     * 
     */
    public function validity() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return 0;
        }
        
        else {
            $api_key = "038c427c27d1417397129856c0f90f04";
            $ch = curl_init();
            curl_setopt_array($ch,[
                CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$this->email",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true
            ]);
            $result = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($result,true);
            if ($data['deliverability'] === "DELIVERABLE")
                return 1;
            else
                return 0;
        }
    }

    /**
     * Function to send welcome email to the user from aspeified mail.
     * Library used is PHPMailer.
     * 
     */
    public function welcomeEmail() {
        $newEmail = new PHPMailer();
        try {
            $newEmail->isSMTP();
            $newEmail->Host = 'smtp.gmail.com';
            $newEmail->SMTPAuth = true;
            // Email address from which mail is to be send.
            $newEmail->Username = 'sayandutta0587@gmail.com';
            $newEmail->Password = 'yyojcrmqcluoqpyz';
            $newEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $newEmail->Port = 587;
            $newEmail->setFrom('sayandutta0587@gmail.com','Sayan');
            // Contains the user's email address to which mail is to be sent.
            $newEmail->addAddress($this->email);
            $newEmail->addReplyTo('sayandutta0587@gmail.com','Sayan');
            $newEmail->isHTML(true);
            $newEmail->Subject = 'Welcome Email';
            $newEmail->Body = 'Thanks for submission.';
            $newEmail->AltBody = 'Plain Text';
            $newEmail->send();
        }
        catch (Exception $e) {
            echo 'The email cannot be sent'.$newEmail->ErrorInfo;
        }
    }
}

?>