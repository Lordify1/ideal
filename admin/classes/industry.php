<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class Industry extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function get_industry(){

            $sql = "SELECT * FROM industry";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $industry = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $industry;

        }

        public function add_industry($industry_id, $industry_name){
           
            $sql = "INSERT INTO industry (industry_id, industry_name) VALUES (?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $industries = $stmt->execute([$industry_id, $industry_name]);
            return $industries;
            
        }

        public function delete_industry($industry_id){
           
            $sql = "DELETE FROM industry WHERE industry_id = ? ";
            $stmt = $this->dbconn->prepare($sql);
            $industries = $stmt->execute([$industry_id]);
            return $industries;
            
        }

    }


$industry = new Industry();
?>