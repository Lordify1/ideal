<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/Business.php";

if($_POST && isset($_POST["project_status_complete"]))
    {
        $change_status = $_POST["status"];
        $proid = $_POST["id"];
        $change = $business->project_status($change_status, $proid);
       

        if($change)
        {
            $_SESSION["success_message"] = "Operation successful";
            header("location:../business_projects.php");
            exit();
        }
    }