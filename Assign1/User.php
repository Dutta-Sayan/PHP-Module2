<?php

    /**
     * This class validates the input given by user.
     * 
     * @param string
     * 
     * @return object
     */
    class User {
        public string $fname, $lname;
        
        /**
         * Class contructor which initializes the fname and lname variables.
         * 
         * @param string
         * 
         */
        public function __construct(string $fname, string $lname) {
            $this->fname = $fname;
            $this->lname = $lname;
        }

        /**
         * Checks if the input name follows the general naming pattern.
         * 
         * @param: No parameter is passed.
         * 
         * @return string.
         */
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
    }
?>
