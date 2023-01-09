<?php
require_once 'queries/frost_api_calls.php';
/* In this file we will check to see if the frost date selection has been submitted and save the selection as a cookie*/

$error_message = "";
$dates_message = "";

//function to sanitize input
function sanitize_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

/* Check to see if the frost date field has been submitted and saves the dates to a cookie if it has been */
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit_frost'])){
    
    
    //function to validate the month
    function validate_month($month){
        if ($month > 0 && $month <= 12){
            return true;
        } else {
            return false;
        }
    }
    
    //function to validate the day depending on the related month
    function validate_day($day, $month){
        if ($day > 0){

            switch ($month) {
                case 2:
                    {
                        if ($day <= 28){
                            return true;
                        } else {
                            return false;
                        }
                    }
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    {
                        if ($day <= 31){
                            return true;
                        } else {
                            return false;
                        }
                    }
                case 4:
                case 6:
                case 9:
                case 11:
                    {
                        if ($day <= 30){
                            return true;
                        } else {
                            return false;
                        }
                    }
            }
        } else {
            return false;
        }
    }
    
    $first_month = sanitize_input($_POST['first_month']);
    $last_month = sanitize_input($_POST['last_month']);
    $first_day = sanitize_input($_POST['first_day']);
    $last_day = sanitize_input($_POST['last_day']);
    
    
    if(validate_month($first_month) && validate_month($last_month) && validate_day($first_day, $first_month) && validate_day($last_day, $last_month)){
        $frost_dates['first'] = $first_day . '-' . $first_month . '-23';
        $frost_dates['last'] = $last_day . '-' . $last_month . '-23';
        /*encode array to store it in cookie. Cookie set to expire in about 4 months*/
        $cookie_frost = json_encode($frost_dates);
        setcookie('frost', $cookie_frost, time() + (86400 * 120), "/");
        /*set cookie inside variable as a workaround for the first time the cookie is set before you reload*/
        $_COOKIE['frost'] = $cookie_frost;
    } else {
        $error_message = "Please enter valid frost dates to see your planting calendar.";
    }
    
}

/* Check to see if a zip code has been entered and saves a related frost date if it is valid */
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit_zip'])){
    $zip_code = sanitize_input($_POST['zip_code']);
    $frost_request = new Frost_API_Call();
    $frost_dates = $frost_request->get_frost_dates($zip_code);
    if (!empty($frost_dates)){
        $cookie_frost = json_encode($frost_dates);
        setcookie('frost', $cookie_frost, time() + (86400 * 120), "/");
        /*set cookie inside variable as a workaround for the first time the cookie is set before you reload*/
        $_COOKIE['frost'] = $cookie_frost;
    } else {
        $error_message = $frost_request->get_error_message();
    }
}

/*Check to see if cookie is set and decode to use the value on rest of site*/
if (isset($_COOKIE['frost'])) {
    $frost_dates = json_decode($_COOKIE['frost'], true);
    $frost_dates['first'] = DateTime::createFromFormat('j-n-y', $frost_dates['first']);
    $frost_dates['last'] = DateTime::createFromFormat('j-n-y', $frost_dates['last']);
    $dates_message = "Based on your selected frost dates, " . $frost_dates['last']->format('M jS') . " in the spring and ". $frost_dates['first']->format('M jS') . " in the fall.";
}
?>