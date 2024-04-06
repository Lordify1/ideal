<?php

require_once "classes/Payment.php";


    if(isset($_GET["trxref"]))
    {
        $ref = $_SESSION["ref_id"];
        $stat = 'COMPLETED';
        $status = $stat;
        $paid = $payment->paystack_verify($ref);
        $status = $payment->payment_status($status, $ref);
        $_SESSION["half_payment_completed"] = "Operation Successful"; 
        header("location:business_dashboard.php");
        exit();
    }else
    {
        header("location:index.php");
    }
