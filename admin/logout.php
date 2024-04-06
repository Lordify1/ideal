<?php
    error_reporting(E_ALL);
    session_start();
    require_once("classes/Admin.php");

    $admin = new Admin();
    $ad = $admin->logout();

    header("location:login.php");
    

?>