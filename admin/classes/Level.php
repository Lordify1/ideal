<?php
    error_reporting(E_ALL);

    require_once("Db.php");

    class Level extends Db{

        private $dbcon ;
    

        public function __construct(){
            $this->dbcon = $this->connect();
        }

        public function fetch_level(){

            $sql = "SELECT * FROM level";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $levels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $levels;
        }

    }

    // $le = new Level();
    // print_r($le->fetch_level());
?>