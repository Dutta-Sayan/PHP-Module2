/**
 * Checks if the input field for name is empty or not.
 * If found empty, the form is prevented for being submitted.
 */
$(document).ready(function(){
    $(".input-form").submit(function(e){
        // To store the status if 'fname' or 'lname' is found empty, 'errStatus' is used.
        let errStatus = true;
        let fname = $(".fname").val();
        let lname = $(".lname").val();
        let fullName = $(".fullname").val();
        if (fname.length == 0) {
            $(".ferror").text("Can't be empty!");
            errStatus = false;
        }
        else if (lname.length == 0) {
            $(".lerror").text("Can't be empty!");
            errStatus = false;
        }
        if (errStatus == false) {
            e.preventDefault();
        }
    });
});