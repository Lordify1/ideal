<?php
session_start();
require_once("classes/Business.php");

if(isset($_SESSION["business_is_online"])){

    
    $id = $_SESSION["business_is_online"];
    $data = $business->get_userbyid($id);
    
    $name = $data["business_name"];    
    $email = $data["business_email"];
    $phone = $data["business_phone_no"];
    $about = $data["about_business"];
    $address = $data["business_address"];
    $state = $data["state_id"];
    $lga = $data["lga_id"];
    $contact = $data["contact_person_name"];
    $industry = $data["industry_id"];
    $pay = $data["pay_method"];
    $account = $data["account_detail"];
    $status = $data["business_status"];

    if($name !== null && $email !== null &&  $phone !== null && $about  !== null && $address !== null && $state !== null &&  $lga !== null && $contact !== null && $industry !== null && $pay !== null && $account !== null)
    {
        $activation = $business->activate($id);
    }

    if($name == null || $email == null ||  $phone == null || $about  == null || $address == null || $state == null ||  $lga == null || $contact == null || $industry == null || $pay == null || $account == null)
    {
        $deactivation = $business->deactivate($id);
    }
    
    if($status == 'blocked')
    {
        $_SESSION["error_message"] = "Your account has been restricted.";
        unset($_SESSION["business_is_online"]);
        header("location:index.php");
        exit();
    }
}else{
    $_SESSION["error_message"] = "You must be logged in to continue.";
    header("location:business_login.php");
    exit();
}

if(isset($_SESSION["marketer_is_online"]) && isset($_SESSION["business_is_online"])){
    unset($_SESSION["marketer_is_online"]);
    unset($_SESSION["business_is_online"]);
    $_SESSION["error_message"] = "You must be logged in to continue.";
    header("location:index.php");
    exit();
}
?>