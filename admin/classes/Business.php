<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Business extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function active_businesses(){

            $sql = "SELECT * FROM businesses WHERE business_status = 'active'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $active = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $active;

        }

        public function blocked_businesses()
        {

            $sql = "SELECT * FROM businesses WHERE business_status = 'blocked'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $blocked;

        }


        public function pending_businesses()
        {

            $sql = "SELECT * FROM businesses WHERE business_status = 'pending'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $pending;

        }


        public function all_businesses()
        {

            $sql = "SELECT * FROM businesses";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $all;


        }

       
        public function state($id)
        {
            $sql = "SELECT state_name FROM state WHERE state_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $state = $stmt->fetch(PDO::FETCH_ASSOC);
            return $state;
        }

        public function lga($id)
        {
            $sql = "SELECT lga_name FROM lga WHERE lga_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $lga = $stmt->fetch(PDO::FETCH_ASSOC);
            return $lga;
        }

        public function industry($id)
        {
            $sql = "SELECT industry_name FROM industry WHERE industry_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $industry = $stmt->fetch(PDO::FETCH_ASSOC);
            return $industry;
        }


        public function search_business($email)
        {
            $sql = "SELECT * FROM businesses WHERE business_email LIKE '%' ? '%' LIMIT 3";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$email]);
            $emailed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $emailed;

            if($emailed)
            {
                return true;
            }else
            {
                return false;
            }
        }
    }

$business = new Business();

?>