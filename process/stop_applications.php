<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/Business.php";


    if($_POST && isset($_POST["stop_applications"]))
    {

        $id = $_POST["id"];


        $disable = $business->disable_application($id);

        if($disable)
        {
            $_SESSION["stop_application"] = "Project won't receive application anymore";
            header("location:../business_projects.php");
        }else
        {
            $_SESSION["cant_stop_application"] = "An error occured";
            header("location:../business_projects.php");
        }

    }