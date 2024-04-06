<?php
    error_reporting(E_ALL);
    require_once("classes/General.php");


    if($_GET && isset($_GET["newsletter"])){

        $name = $_GET["name"];
        $email = $_GET["email"];


$newsletter = $general->insert_newsletter();

    if($newsletter == 1){
        echo "<div class='alert alert-success'>" . "Registration successful" . "</div>";
    }

    }


?>