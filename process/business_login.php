<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Business.php");


    if($_POST && isset($_POST["signin"])){

        $time = $_POST["login_time"];
        $email = sanitizer($_POST["email"]);
        $pwd = $_POST["pwd"];

        $rsp = $business->login($email, $pwd);
        
        if($rsp){
            $_SESSION["business_is_online"] = $rsp["business_id"];
            $id = $rsp["business_id"];
            $time = $business->login_time($time, $id);
            header("location:../business_dashboard.php");
           
        }else{
            $_SESSION["errormessage"] = "Login failed..";
            header("location:../business_login.php");
        }
        


    }else{
        $_SESSION["errormessage"] = "Invalid access";
        header("location:../business_login.php");
        exit();
    }



?>