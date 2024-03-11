<?php

require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class User {
    public string $email;
    public function __construct($email) {
        $this->email = $email;
    }
    public function validity() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return 0;
        }
        //return 1;
        
        else{
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
    public function welcomeEmail() {
        $newEmail = new PHPMailer();
        try {
            $newEmail->isSMTP();
            $newEmail->Host = 'smtp.gmail.com';
            $newEmail->SMTPAuth = true;
            $newEmail->Username = 'sayandutta0587@gmail.com';
            $newEmail->Password = 'yyojcrmqcluoqpyz';
            $newEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $newEmail->Port = 587;
            $newEmail->setFrom('sayandutta0587@gmail.com','Sayan');
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