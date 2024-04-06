<?php  
    error_reporting(E_ALL);

    require_once("Db.php");

    class User extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function all_users(){

            $sql = "SELECT * FROM marketers_";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $category;

        }

    }


?>