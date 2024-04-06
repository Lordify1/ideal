<?php
    error_reporting(E_ALL);
    require_once "../classes/Payment.php";


    if($_POST && isset($_POST["pay"]))
    {
        $email = $_POST["email"];
        $amt = $_POST["amt"];
        $ref = $_POST["ref"];
        $percent = $_POST["percent"];
        $proid = $_POST["proid"];
        $title =$_POST["title"];
        $amtleft = $_POST["amt_left"];

        $insert = $payment->insert_payment($amt, $proid, $ref, $percent, $email, $title, $amtleft);

        if($insert)
        {
            $_SESSION["payment_input_success"] = $insert;
            header("location:../confirm_payment.php?t=$title");
        }else
        {
            $_SESSION["payment_input_error"] = "An error occured";
            header("location:../project_payment.php");
        }
    }

    if($_POST && isset($_POST["complete_pay"]))
    {
        $email = $_POST["email"];
        $amt = $_POST["amt"];
        $ref = $_POST["ref"];
        $percent = $_POST["percent"];
        $proid = $_POST["proid"];
        $title =$_POST["title"];

        $insert = $payment->insert_complete_payment($amt, $proid, $ref, $percent, $email, $title);

        if($insert)
        {
            $_SESSION["payment_input_success"] = $insert;
            header("location:../complete_payment.php?t=$title");
        }else
        {
            $_SESSION["payment_input_error"] = "An error occured";
            header("location:../project_payment.php");
        }
    }
