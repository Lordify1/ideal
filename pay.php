The page would show the customer all they would pay. So on click of the button that would take them to the next page, the product price and info would be inserted into the db. But as they get to the next page you would show them a button that would say you are about to pay so so so. Then...


this is where you process the payment

1. You fetch the payment from the database and then you initialize it 

<?php
require_once "../business_guard.php";
require_once("../classes/Payment.php");


    if ($_GET && isset($_GET['t'])) {
        $title = $_GET["t"];
        $payments = $payment->get_payment($title);

        if (!$payments || empty($payments["transaction_id"])) {
           
            $_SESSION['error_paying'] = "Invalid payment details.";
            header("location:../confirm_payment.php?t=$title");
            exit;
        }

        $response = $payment->paystack_initialize($payments["pp_amt"] * 100, $payments["business_email"], $payments["transaction_id"]);

        if ($response && $response->status == 1) {
            $paymentpage = $response->data->authorization_url;
            $_SESSION["ref_id"] = $payments["transcation_id"];
            header("location: $paymentpage");
            exit;
        } else {

            $_SESSION['error_paying'] = "Failed to initiate payment. Try again.";
            header("location:../confirm_payment.php?t=$title");
            exit;
        }
    }
?>



That is the process page above

Below is what would be in your class page 


<?php

        public function paystack_verify($ref)
        {
            $headers=["Content-Type : application/json", "Authorization: Bearer sk_test_8032c6e60905af9189ee53cc49c12992a04f9ccd"];
            // step1 = innitialize curl
            $ch = curl_init("https://api.paystack.co/transaction/verify/$ref");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //set this option to prevent the endpoint from forcing ssl point on you
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //s3 = execute the curl session using curl_exec();
            $apiResponse = curl_exec($ch);

            if($apiResponse)
            {
                return json_decode($apiResponse);
            }else
            {
                return false;
            }
        }

        public function paystack_initialize($amount, $email, $ref) // it will get us a redirect url
        {
            $postRequest = array("amount"=>$amount,"email"=>$email,"reference"=>$ref);
            $headers=["Content-Type:application/json", "Authorization: Bearer sk_test_8032c6e60905af9189ee53cc49c12992a04f9ccd"];
            // step1 = innitialize curl
            $ch = curl_init("https://api.paystack.co/transaction/initialize");
            //step2 = set curl options using the function curl_setopt
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postRequest));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //set this option to prevent the endpoint from forcing ssl point on you
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //s3 = execute the curl session using curl_exec();
            $apiResponse = curl_exec($ch); // this will return true or false to us
            //curl doesnt throw exception so try catch is useless here
            if($apiResponse)
            {
                curl_close($ch);
                return json_decode($apiResponse);
            }else
            {
                $r = curl_error($ch);
                //this is curl special way of checking or reporting errors;
                return false;
            }
        }


?>

Dont change anything in the class
