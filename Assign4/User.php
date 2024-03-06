<?php

    /**
     * This class validates the input given by user.
     * 
     * @param string: contains class variables fname and lname
     * 
     * @return object
     */
    class User {
        public string $fname, $lname, $mobNo;

        /**
         * Class contructor which initializes the fname and lname variables.
         * 
         * @param string: first and last name are passed for initialization to class variables.
         */
        public function __construct($fname, $lname, $mobNo) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->mobNo = $mobNo;
        }
        public function isValid() {
            $pattern = "/^[a-zA-Z]+$/";
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
            if (move_uploaded_file($tempFileName, $target)) {
                return $target;       
            }
            else 
                return "";
        }

        /**
         * Checks if the number is valid or not.
         * The number must be an Indian mobile number.
         * @return mixed returns 1 in case of invalid number and the number as string if valid.
         */
        public function isValidNumber() {
            if (!preg_match("/^(\+91)[0-9]{10}$/",$this->mobNo)) {
                return 1;
            }
            else {
                return $this->mobNo;
            }
        }

        /**
         * Takes the marks input and breaks it down and stores in an array.
         * Each array value contains two fields (subject, marks).
         * @return mixed 'res' containing each subject's name and marks and 0 on invalid entry.
         */
        public function processMarks($marks) {
            $marksArr = explode("\n", $marks);
            $res = array();
            $j = 0;
            foreach ($marksArr as $i) {
                $res[$j] = explode("|", $i);
                $j++;
            }
            $subPattern = "/[a-zA-Z]{1,10}/";
            $marksPattern = "/[0-9]{1,3}/";
            foreach ($res as $i) {
                if (!preg_match ($subPattern, $i[0]) || !preg_match ($marksPattern, $i[1]))
                    return 0;
            }
            return $res;
        }

        /**
         * Creates an html table from the marks input.
         * The table contains two columns containing subject name and marks.
         * @param $marksArr contains the string of subject name and marks.
         * @return string containing the html table
         */
        public function createTable($marksArr) {
            if(count($marksArr) > 0) {
                $table = '<h3>Your Result</h3><br><table class="Result">';
                $table .= '<tr><th>'."Subject".'</th>'.'<th>'."Marks".'</th></tr>';
                foreach($marksArr as $subjectrow){
                    $table .= '<tr>';
                    foreach($subjectrow as $res){
                        $table .= '<td>'.$res.'</td>';
                    }
                    $table .= '</tr>';
                }
                $table .= '</table>';
            }
            return $table;
        }
    }
?>