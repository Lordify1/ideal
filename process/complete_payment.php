<?php
require_once "../business_guard.php";
require_once("../classes/Payment.php");


    if ($_GET && isset($_GET['t'])) {
        $title = $_GET["t"];
        $payments = $payment->complete_payment($title);

        if (!$payments || empty($payments["transaction_id"])) {
            // Handle the case where the transaction ID is missing or empty
            $_SESSION['error_paying'] = "Invalid payment details.";
            header("location:../complete_payment.php?t=$title");
            exit;
        }

        $response = $payment->paystack_initialize($payments["pp_amt"] * 100, $payments["business_email"], $payments["transaction_id"]);

        if ($response && $response->status == 1) {
            $paymentpage = $response->data->authorization_url;
            $_SESSION["ref_id"] = $payments["transcation_id"];
            header("location: $paymentpage");
            exit;
        } else {
            // Handle payment initialization failure
            $_SESSION['error_paying'] = "Failed to initiate payment. Try again.";
            header("location:../complete_payment.php?t=$title");
            exit;
        }
    }
?>
