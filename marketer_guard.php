<?php
session_start();
require_once("classes/Marketer.php");

if(isset($_SESSION["marketer_is_online"])){

    
    $id = $_SESSION["marketer_is_online"];
    $data = $market->get_userbyid($id);

    $fname  =$data["marketer_fname"];
    $lname  =$data["marketer_lname"];
    $email  =$data["marketer_email"];
    $phone  =$data["marketer_phone"];
    $dob  =$data["marketer_dob"];
    $availability =$data["marketer_availability"];
    $experience  =$data["experience_id"];
    $bio =$data["marketer_bio"];
    $gender =$data["marketer_gender"];
    $state  =$data["state_id"];
    $category =$data["category_id"];
    $project =$data["project_type"];
    $pay =$data["pay_method"];
    $account =$data["state_id"];
    $lga =$data["lga_id"];
    $portfolio =$data["portfolio"];   
    $status = $data["marketer_status"];

    if($fname !== null && $lname !== null && $email !== null && $phone !== null && $dob !== null && $availability !== null && $experience !== null && $bio !== null &&$gender !== null && $state  !== null && $category !== null && $project !== null && $pay !== null && $account !== null && $lga !== null && $portfolio !== null && $id !== null)
    {
        $activation = $market->activate($id);
    }
    
    if($fname == null || $lname == null || $email == null || $phone == null || $dob == null || $availability == null || $experience == null || $bio == null ||$gender == null || $state  == null || $category == null || $project == null || $pay == null || $account == null || $lga == null || $portfolio == null)
    {
        $deactivation = $market->deactivate($id);
        
    }
    
    if($status == 'blocked')
    {
        $_SESSION["error_message"] = "Your account has been restricted.";
        unset($_SESSION["marketer_is_online"]);
        header("location:index.php");
        exit();
    }
}else{
    $_SESSION["error_message"] = "You must be logged in to continue.";
    header("location:marketer_login.php");
    exit();
}

?>