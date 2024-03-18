/**
 * Checks if the input field for name is empty or not.
 * If found empty, the form is prevented for being submitted.
 */
$(document).ready(function(){
    $(".input-form").submit(function(e){
        // To store the status if 'fname' or 'lname' is found empty, 'errStatus' is used 
        let errStatus = true;
        let fname = $(".fname").val();
        let lname = $(".lname").val();
        let fullName = $(".fullname").val();
        let mobile = $(".mob").val();
        let marks = $(".marks").val();
        $(".marks").val() = marks;
        if (fname.length == 0) {
            $(".ferror").text("Can't be empty!");
            errStatus = false;
        }
        else if (lname.length == 0) {
            $(".lerror").text("Can't be empty!");
            errStatus = false;
        }
        else if (!marks.match(/(^[ ]*[a-zA-Z]+[ ]{0,1}[a-zA-Z]*[|][0-9]{1,3}[ ]*$)/)) {
          $(".marksErr").text("Invalid format");
          errStatus = false;
        }
        else if(!mobile.match(/(^(\+91)[0-9]{10}$)/)) {
            $(".numErr").text("*Invalid number!");
            errStatus = false;
        }
        if (errStatus == false) {
            e.preventDefault();
        }
    });
});