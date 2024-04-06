<?php
    require_once "Database.php";

    class Payment extends DataBase
    {

        private $dbcon;

        public function __construct()
        {
            $this->dbcon = $this->connect();
        }



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

        public function insert_payment($amt, $proid, $transactid, $percentage, $email, $title, $amtleft)
        {
            $sql = "INSERT INTO project_payment (pp_amt, project_id, transaction_id, pp_percentage, business_email, project_title, amt_left) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->dbcon->prepare($sql);
            $insertion = $stmt->execute([$amt, $proid, $transactid, $percentage, $email,$title, $amtleft]);
            return $insertion;
        }


        public function insert_complete_payment($amt, $proid, $transactid, $percentage, $email, $title)
        {
            $sql = "INSERT INTO project_payment_balance (pp_amt, project_id, transaction_id, pp_percentage, business_email, project_title) VALUES (?,?,?,?,?,?)";
            $stmt = $this->dbcon->prepare($sql);
            $inserted = $stmt->execute([$amt, $proid, $transactid, $percentage, $email,$title]);
            return $inserted;
        }


        public function get_payment($title)
        {
            try
            {
                $sql = "SELECT * FROM project_payment WHERE project_title = ?";
                $stmt = $this->dbcon->prepare($sql);
                $stmt->execute([$title]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function complete_payment($title)
        {
            try
            {
                $sql = "SELECT * FROM project_payment_balance WHERE project_title = ?";
                $stmt = $this->dbcon->prepare($sql);
                $stmt->execute([$title]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }


        public function get_payment_by_id($id)
        {
            try
            {
                $sql = "SELECT * FROM project_payment WHERE project_id = ? LIMIT 1";
                $stmt = $this->dbcon->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function payment_balanced($id)
        {
            try
            {
                $sql = "SELECT * FROM project_payment_balance WHERE project_id = ?";
                $stmt = $this->dbcon->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function get_payment_by_id_for_pending_projects($id)
        {
            try
            {
                $sql = "SELECT * FROM project_payment WHERE project_id = ?";
                $stmt = $this->dbcon->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function payment_status($status, $trid)
        {
            $sql = "UPDATE project_payment SET pp_status = ? WHERE transaction_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $tr = $stmt->execute([$status, $trid]);
            return $tr;
        }

        public function payment_percentage($id)
        {
            $sql = "SELECT SUM(pp_percentage) AS total FROM project_payment WHERE project_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $sum = $stmt->fetch(PDO::FETCH_ASSOC);
            return $sum;
        }

    }

    $payment = new Payment;
