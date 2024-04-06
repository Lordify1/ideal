<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Payment extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function paystack_verify($ref)
        {
            $headers=["Content-Type: application/json", "Authorization: Bearer sk_test_8032c6e60905af9189ee53cc49c12992a04f9ccd"];
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

        public function pending_payments(){

            $sql = "SELECT * FROM project_payment WHERE pp_status = 'PENDING'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;

        }

        public function completed_payments(){

            $sql = "SELECT * FROM project_payment WHERE pp_status = 'COMPLETED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;
            
        }

        public function cancelled_payments(){

            $sql = "SELECT * FROM project_payment WHERE pp_status = 'CANCELLED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;
            
        }


        public function get_payment_by_ref($id)
        {
            try
            {
                $sql = "SELECT * FROM project_payment WHERE transaction_id = ? LIMIT 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
            }
        }

        public function pending_payments_complete(){

            $sql = "SELECT * FROM project_payment_balance WHERE pp_status = 'PENDING'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;

        }

        public function completed_payments_complete(){

            $sql = "SELECT * FROM project_payment_balance WHERE pp_status = 'COMPLETED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;
            
        }

        public function cancelled_payments_complete(){

            $sql = "SELECT * FROM project_payment_balance WHERE pp_status = 'CANCELLED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $all;
            
        }

        // public function business_by_id($id)
        // {
        //     $sql = "SELECT business_name FROM businesses WHERE business_id = ? LIMIT 1";
        //     $stmt = $this->dbconn->prepare($sql);
        //     $stmt->execute([$id]);
        //     $business = $stmt->fetch(PDO::FETCH_ASSOC);
        //     return $business;
        // }

        public function payment_sum(){

            $sql = "SELECT * FROM project_payment";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $total = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $total;

        }

        public function payment_status($trid)
        {
            $sql = "UPDATE refund_business SET pp_status = 'COMPLETED' WHERE transaction_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $tr = $stmt->execute([$trid]);
            return $tr;
        }


        public function add_to_industry($industry){

            $sql = "INSERT INTO industry WHERE industry_name = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $industry = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $industry;

        }


        public function payment_by_title($title)
        {
            $sql ="SELECT * FROM project_payment WHERE project_title = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$title]);
            $pays = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pays;
        }

        public function refund_by_title($title)
        {
            $sql ="SELECT * FROM business_refund WHERE project_title = ? LIMIT 1";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$title]);
            $refund = $stmt->fetch(PDO::FETCH_ASSOC);
            return $refund;
        }


        public function complete_payment($ref)
        {
            $sql = "UPDATE project_payment SET pp_status = 'COMPLETED' WHERE transaction_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stat = $stmt->execute([$ref]);
            return $stat;
        }

        public function cancel_payment($ref)
        {
            $sql = "UPDATE project_payment SET pp_status = 'CANCELLED' WHERE transaction_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stat = $stmt->execute([$ref]);
            return $stat;
        }


        public function complete_payment_complete($ref)
        {
            $sql = "UPDATE project_payment_balance SET pp_status = 'COMPLETED' WHERE transaction_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stat = $stmt->execute([$ref]);
            return $stat;
        }

        public function cancel_payment_complete($ref)
        {
            $sql = "UPDATE project_payment_balance SET pp_status = 'CANCELLED' WHERE transaction_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stat = $stmt->execute([$ref]);
            return $stat;
        }

        // public function total_project_payments()
        // {
        //     $sql = "SELECT SUM(pp_amt) AS total FROM project_payment WHERE pp_status = 'COMPLETED'";
        //     $stmt = $this->dbconn->prepare($sql);
        //     $stmt->execute();
        //     $total = $stmt->fetch(PDO::FETCH_ASSOC);
        //     return $total;
        // }

       

        public function insert_payment($amt, $transactid, $percentage, $email, $title)
        {
            $sql = "INSERT INTO business_refund (pp_amt,transaction_id, pp_percentage, business_email, project_title) VALUES (?,?,?,?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $insertion = $stmt->execute([$amt, $transactid, $percentage, $email,$title]);
            return $insertion;
        }
    
    }

$payment = new Payment();
?>