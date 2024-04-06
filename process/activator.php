<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/Business.php";

    if($_POST && isset($_POST["id"]))
    {
    $id = $_POST["id"];

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

    if($name !== "" && $email !== "" &&  $phone !== "" && $about  !== "" && $address !== "" && $state !== "" &&  $lga !== "" && $contact !== "" && $industry !== "" && $pay !== "" && $account !== "")
    {
        $activation = $business->activate($id);
        $reply = "<div class='alert alert-success'>" . "Profile has been activated and $status" . "</div>";
        echo json_encode($reply);
        exit();
    }

    if($name == "" || $email == "" ||  $phone == "" || $about  == "" || $address == "" || $state == "" ||  $lga == "" || $contact == "" || $industry == "" || $pay == "" || $account == "")
    {
        
        $deactivation = $business->deactivate($id);
        $reply = "<div class='alert alert-danger'>" . "Please complete your profile and $status" . "</div>";
        echo json_encode($reply);
        exit();
    }
    
    }