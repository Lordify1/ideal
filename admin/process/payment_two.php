<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/payment.php";

    if($_POST && isset($_POST["complete"]))
    {
        $ref = $_POST["ref"];


        $complete = $payment->complete_payment_complete($ref);

        if($complete)
        {
            $_SESSION["payment_has_been_completed"] = "Payment Completed Successfully";
            header("location:../second_payment.php");
        }else
        {
            $_SESSION["payment_complete_error"] = "An error Occured";
            header("location:../second_payment.php");
        }
    }


    if($_POST && isset($_POST["cancel"]))
    {
        $ref = $_POST["ref"];


        $complete = $payment->cancel_payment_complete($ref);

        if($complete)
        {
            $_SESSION["payment_has_been_completed"] = "Payment Cancelled Successfully";
            header("location:../second_payment.php");
        }else
        {
            $_SESSION["payment_complete_error"] = "An error Occured";
            header("location:../second_payment.php");
        }
    }