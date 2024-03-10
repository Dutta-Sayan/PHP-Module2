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

        /**
         * Takes the marks input and breaks it down and stores in an array.
         * Each array value contains two fields (subject, marks).
         * @return mixed 'res' containing each subject's name and marks.
         */
        public function processMarks($marks) {
            $pattern = "/^[ ]*[a-zA-Z]+[ ]{0,1}[a-zA-Z]*[|][0-9]{1,3}[ ]*$/";
            $marksArr = explode("\n", $marks);
            for ($i = 0; $i < count($marksArr); $i++) {
                $marksArr[$i] = trim($marksArr[$i]);
                if (!preg_match($pattern, $marksArr[$i])) {
                    return 0;
                }
            }
            $res = array();
            $j = 0;
            foreach ($marksArr as $i) {
                $res[$j] = explode("|", $i);
                $j++;
            }
            print_r($res);
            $subPattern = "/[a-zA-Z]{1,10}/";
            $marksPattern = "/[0-9]{0,3}/";
            foreach ($res as $i) {
                    if (!preg_match ($subPattern, $i[0]) || !preg_match ($marksPattern, $i[1]))
                        return 0;
            }
            return $res;
        }
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