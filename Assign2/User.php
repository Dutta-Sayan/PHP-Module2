<?php

    /**
     * This class validates the input given by user.
     * 
     * @param string: contains class variables fname and lname
     * 
     * @return object
     */
    class User {
        public string $fname, $lname;

        /**
         * Class contructor which initializes the fname and lname variables.
         * 
         * @param string: first and last name are passed for initialization to class variables.
         */
        public function __construct($fname, $lname) {
            $this->fname = $fname;
            $this->lname = $lname;
        }

        /**
         * Checks if the input name follows the general naming pattern.
         * 
         * @return string: on valid input returns the full name and on error returns the error input only.
         */
        public function isValid() {
            $pattern = "/^[a-zA-Z ]{1,25}$/";
            if (!preg_match($pattern, $this->fname))
                return $this->fname;
            else if (!preg_match($pattern, $this->lname))
                return $this->lname;
            else {
                $greetings = $this->fname." ".$this->lname;
                return $greetings;
            }
        }

        /**
         * The function stores the image submitted by user in 'uploads' folder
         * It returns the target address of stored image on successful upload.
         * @return string
         */
        public function isValidImage() {
            $file = $_FILES["image"];
            $targetDir = "uploads/";
            $target = $targetDir . basename($_FILES['image']['name']);
            $tempFileName = $_FILES['image']['tmp_name'];
            $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return "";
            }
            if (move_uploaded_file($tempFileName, $target)) {
                return $target;       
            }
            else
                return "";
        }
    }
?>