<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/General.php");

  if($_POST && isset($_POST["message_ideal"]))
  {
    $business_id = $_POST["business_id"];
    $marketer_id = $_POST["marketer_id"];
    $message = $_POST["message"];
    $email = $_POST["email"];
    $message_type = $_POST["message_type"];

    $message_ideal = $general->message_ideal($business_id, $marketer_id, $message, $email, $message_type);

    if($message_ideal)
    {
        $_SESSION["success_message"] = "We have received your message";
        header("location:../message_ideal.php");
        die();
    }else
    {
        $_SESSION["error_message"] = "We couldn't receive your message";
        header("location:../message_ideal.php");
        die();
    }
  }