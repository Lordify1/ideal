<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/utilities.php");
    require_once("../classes/Admin.php");


    if($_POST && isset($_POST["login_btn"])){


        //collect the form data && //sanitize
        $email = sanitizer($_POST["email"]);
        $password = $_POST["password"];

        
        //validate

        //instantiate class
        $ad1 = new Admin();
        $admin_confirmed = $ad1->login_admin($email, $password);
        
        if($admin_confirmed){
            //set adminid in session
            $_SESSION["admin_online"] = $admin_confirmed; // this is the id that // was returned from the method
            header("location:../index.php");
            exit();
        }else{
            
            header("location:../login.php");
            exit();
        }
        //call the method



    }else{
        $_SESSION["error_message"] = "Please login the right way";
        header("location:../login.php");
        exit();
    }

?>