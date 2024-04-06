<?php
session_start();

if(!isset($_SESSION["business_is_online"]) && !isset($_SESSION["marketer_is_online"])){
    $_SESSION["error_message"] = "You must be logged in to continue.";
    header("location:index.php");
    exit();
}

?>