<?php
    error_reporting(E_ALL);
    session_start();
    require_once "../classes/payment.php";

    if($_POST && isset($_POST["complete"]))
    {
        $ref = $_POST["ref"];


        $complete = $payment->complete_payment($ref);

        if($complete)
        {
            $_SESSION["payment_has_been_completed"] = "Payment Completed Successfully";
            header("location:../first_payment.php");
        }else
        {
            $_SESSION["payment_complete_error"] = "An error Occured";
            header("location:../first_payment.php");
        }
    }


    if($_POST && isset($_POST["cancel"]))
    {
        $ref = $_POST["ref"];


        $complete = $payment->cancel_payment($ref);

        if($complete)
        {
            $_SESSION["payment_has_been_completed"] = "Payment Cancelled Successfully";
            header("location:../first_payment.php");
        }else
        {
            $_SESSION["payment_complete_error"] = "An error Occured";
            header("location:../first_payment.php");
        }
    }



    if($_POST && isset($_POST["refund_business"]))
    {
        $ref = $_POST["ref"];
        
        $data = $payment->get_payment_by_ref($ref);

        
        $email = $data["business_email"];
        $amt = $data["pp_amt"];
        $ref = $_POST["ref"];
        $percent = $data["pp_percentage"];
        $title =$data["project_title"];

        $insert = $payment->insert_payment($amt, $ref, $percent, $email, $title);
        
        if($insert)
        {
            $_SESSION["payment_input_success"] = $insert;
            header("location:../refund_business.php?t=$title");
        }else
        {
            $_SESSION["payment_input_error"] = "An error occured";
            header("location:../refund_business.php");
        }
    }