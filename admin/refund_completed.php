<?php
session_start();
require_once "classes/payment.php";


    if(isset($_GET["trxref"]))
    {
        $ref = $_SESSION["ref_id"];
        $status = $stat;
        $paid = $payment->paystack_verify($ref);
        $status = $payment->payment_status($ref);
        $_SESSION["refund_done"] = "Operation Successful"; 
        header("location:first_payment.php");
        exit();
    }else
    {
        header("location:refund_business.php");
    }
