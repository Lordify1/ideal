<?php
    error_reporting(E_ALL);
    session_start();
    require_once("classes/Marketer.php");

    $market->logout();

    header("location:index.php");
    

?>