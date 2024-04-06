<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/General.php");
    require_once("../classes/Marketer.php");
    require_once("../classes/Business.php");
    require_once("../classes/sanitizer.php");


if($_POST && isset($_POST["edit_application_btn"]))
    {

        $relevant_experience = sanitizer($_POST["marketerrelevant"]);
        $approach = sanitizer($_POST["marketerapproach"]);
        $strategy = sanitizer($_POST["strategy"]);
        $specific_skills = sanitizer($_POST["specific_skills"]);
        $portfolio = sanitizer($_POST["portfolio"]);
        $timeline = sanitizer($_POST["timeline"]);
        $communication = sanitizer($_POST["communication"]);
        $testimonials = sanitizer($_POST["references"]);
        $additional_information = sanitizer($_POST["additional_information"]); 
        $identifier = sanitizer($_POST["project_id"]);
        $marketer_id = $market->get_userbyid($_SESSION["marketer_is_online"]);
        $business = sanitizer($_POST["business_id"]);

        $proj = sanitizer($_POST["project_id"]);

        $application_id = $_POST["app_id"];

        
        $application_amount = sanitizer($_POST["amount"]);

        

        $application = $general->update_application( $relevant_experience , $approach, $strategy , $specific_skills , $portfolio , $timeline , $communication , $testimonials, $additional_information ,$application_amount, $application_id);


        if($application == 1){
            $_SESSION["success_message"] = "Application has been Updated";
            header("location:../marketer_applications.php");
            exit();
        }else{
            $_SESSION["error_message"] = "Something went wrong";
            header("location:../application.php?identifier=" . $project_id);
            exit();
        }



      
    }