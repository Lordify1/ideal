<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Action extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function block_m($id){
            $sql = "UPDATE marketers SET marketer_status = 'blocked' WHERE marketer_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }

        public function unblock_m($id){
            $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }

        public function activate_m($id){
            $sql = "UPDATE marketers SET marketer_status = 'active' WHERE marketer_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }


        public function block_b($id)
        {
            $sql = "UPDATE businesses SET business_status = 'blocked' WHERE business_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }

        public function unblock_b($id)
        {
            $sql = "UPDATE businesses SET business_status = 'active' WHERE business_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }

        public function activate_b($id)
        {
            $sql = "UPDATE businesses SET business_status = 'active' WHERE business_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);

        }


        public function m_payment($info)
        {
            $sql = "SELECT * FROM payment WHERE payment_status = ? AND marketer_id";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$info]);

        }


       



    }

$action = new Action();

?>