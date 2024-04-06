<?php  
    error_reporting(E_ALL);
    require_once("Database.php");

    class State extends DataBase{

        private $dbcon;

        public function __construct(){
            $this->dbcon = $this->connect();
        }

        public function fetch_states(){

            $sql = "SELECT * FROM state";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $states;

            if($states){
                return true;
            }else{
                return false;
            }

        }

    }


?>