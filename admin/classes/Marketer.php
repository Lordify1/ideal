<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Marketer extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function active_marketers(){

            $sql = "SELECT * FROM marketers WHERE marketer_status = 'active'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $active = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $active;

        }

        public function blocked_marketers(){

            $sql = "SELECT * FROM marketers WHERE marketer_status = 'blocked'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $blocked;

        }


        public function pending_marketers(){

            $sql = "SELECT * FROM marketers WHERE marketer_status = 'pending'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $pending;

        }

        public function all_marketers()
        {

            $sql = "SELECT * FROM marketers";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $all;


        }

        public function experience($id)
        {
            $sql = "SELECT experience_name FROM experience WHERE experience_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $experience = $stmt->fetch(PDO::FETCH_ASSOC);
            return $experience;
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

        public function category($id)
        {
            $sql = "SELECT category_name FROM category WHERE category_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category;
        }




        public function search_marketer($email)
        {
            $sql = "SELECT * FROM marketers WHERE marketer_email LIKE '%' ? '%'";
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

$market = new Marketer();
?>