<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Marketer.php");
    
    if($_POST && isset($_POST["submit_btn"])){


        $fname = sanitizer($_POST["fname"]);
        $lname = sanitizer($_POST["lname"]);
        $email = sanitizer($_POST["email"]);
        $pwd = $_POST["pwd"];
        $gender = $_POST["gender"];
        $confirmpwd = $_POST["confpwd"];
        $state = $_POST["state"];
        $lga = $_POST["lgas"];
        

        $check = $market->get_email($email);

        if($check["marketer_email"] == $email)
        {
            $_SESSION["error_message"] = "Email already Exist. Try Logging in";
            header("location:../marketer_registration.php");
            die();
        }


        if(strlen($pwd) < 8)
        {
            $_SESSION["error_message"] = "Password should be 8 or more characters";
            header("location:../marketer_registration.php");
            die();
        }

        if(strlen($confirmpwd) < 8 || $confirmpwd != $pwd)
        {
            $_SESSION["error_message"] = "Passwords should be same and 8 or more characters";
            header("location:../marketer_registration.php");
            die();
        }

        $rsp = $market->create_account($fname, $lname, $email, $pwd, $confirmpwd, $state, $lga, $gender);

        if($rsp){
            $_SESSION["marketer_is_online"] = $rsp;
            //redirect to dashboard
            header("location:../marketer_dashboard.php");
        }else{
            $_SESSION["error_message"] = "Registration wasn't successful. Please try again";
            header("location:../marketer_registration.php");
        }

    }else{
        #we send them back to the registration form register.php
        $_SESSION["error_message"] = "Please complete the form";
        header("location:../marketer_registration.php");

        
    
    }



    #we want to retrieve the form data


?>