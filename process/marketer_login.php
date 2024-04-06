<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Marketer.php");


    if($_POST && isset($_POST["signin"])){


        $time = $_POST["login_time"];
        $email = sanitizer($_POST["email"]);
        $pwd = $_POST["pwd"];

        $rsp = $market->login($email, $pwd);
        
        if($rsp){
            $_SESSION["marketer_is_online"] = $rsp["marketer_id"];
            $id = $rsp["marketer_id"];
            $time = $market->login_time($time, $id);
            header("location:../marketer_dashboard.php");
        }else{
            $_SESSION["error_message"] = "Invalid Credentials";
            header("location:../marketer_login.php");
        }
        


    }else{
        $_SESSION["error_message"] = "Invalid access";
        header("location:../marketer_login.php");
        exit();
    }



?>