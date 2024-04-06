<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/General.php";


 
if($_POST && isset($_POST["delete_project"])){
    $id = $_POST["deleted"];

    $delete = $general->delete_project($id);

    if($delete == 1){
      //  $_SESSION["success_message"] = "Project Deleted Successfully";
        header("location:../business_projects.php");
        die();
    }else{
       // $_SESSION["error_message"] = "Something went wrong";
        header("location:../business_projects.php");
        die();
    }
}