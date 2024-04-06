<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/General.php");
    require_once("../classes/Marketer.php");
    require_once("../classes/Business.php");
    require_once("../classes/sanitizer.php");

if($_POST && isset($_POST["delete"]))
    {
        $delete = $_POST["deleted"];
       
        $del = $general->delete_application($delete);

        if($del)
        {
            $_SESSION["application_deleted"] = "You've successfully deleted the application";
            header("location:../marketer_applications.php");
            die();
        }
    }