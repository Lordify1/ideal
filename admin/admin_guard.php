<?php
    error_reporting(E_ALL);

    if(!isset($_SESSION["admin_online"])){
        echo "<div>" . $_SESSION["error_message"] = "You must be logged in as an Admin inorder to access this page";
        header("location:login.php");
        exit();
    }


?>