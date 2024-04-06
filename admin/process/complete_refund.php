<?php
//require_once "../admin_guard.php";
session_start();
require_once("../classes/payment.php");


    if ($_GET && isset($_GET['t'])) {
        $title = $_GET["t"];
        $refund = $payment->refund_by_title($title);

        

        if (!$refund || empty($refund["transaction_id"])) {
            // Handle the case where the transaction ID is missing or empty
            $_SESSION['error_paying'] = "Invalid payment details.";
            header("location:../refund_business.php?t=$title");
            exit;
        }

        $response = $payment->paystack_initialize($refund["pp_amt"] * 100, $refund["business_email"], $refund["transaction_id"]);

        if ($response && $response->status == 1) {
            $paymentpage = $response->data->authorization_url;
            $_SESSION["ref_id"] = $refund["transcation_id"];
            header("location: $paymentpage");
            exit;
        } else {
            
            $_SESSION['error_paying'] = "Failed to initiate payment. Try again.";
            header("location:../refund_business.php?t=$title");
            exit;
        }
    }
?>
