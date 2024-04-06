<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Business.php");
    
    if($_POST && isset($_POST["business_reg"])){


        $name = sanitizer($_POST["compname"]);
        $compname = strtoupper($name);
        $compemail = sanitizer($_POST["compemail"]);
        $comppassword = $_POST["comppassword"];
        $confirmpwd = $_POST["confirmpwd"];
        $state = $_POST["state"];
        $lga = $_POST["lgas"];


        $name_check = $business->business_name($compname);

        $name = $name_check["business_name"];
        
        if($name == $compname)
        {
            $_SESSION["error_message"] = "Business name already exist";
            header("location:../business_register.php");
            die();
        }

        $email_check = $business->business_email($compemail);

        $email = $email_check["business_email"];
        
        if($email == $compemail)
        {
            $_SESSION["error_message"] = "Email already exist";
            header("location:../business_register.php");
            die();
        }

        if(strlen($comppassword) < 8)
        {
            $_SESSION["error_message"] = "Password should be 8 or more characters";
            header("location:../business_register.php");
            die();
        }

        if(strlen($confirmpwd) < 8 || $confirmpwd != $comppassword)
        {
            $_SESSION["error_message"] = "Passwords should be same and 8 or more characters";
            header("location:../business_register.php");
            die();
        }

        

        $rsp = $business->business_register($compname, $compemail, $comppassword, $confirmpwd, $state, $lga);

        if($rsp){
            $_SESSION["business_is_online"] = $rsp;
            //redirect to dashboard
            header("location:../business_dashboard.php");
        }else{
            $_SESSION["error_message"] = "Registration wasn't successful. Please try again";
            header("location:../business_register.php");
        }

    }else{
        #we send them back to the registration form register.php
        $_SESSION["errormessage"] = "Please complete the form";
        header("location:../business_register.php");
    }



    #we want to retrieve the form data


?>