<?php
    require_once("config.php");

    class DataBase{

        private $dbhost = DBHOST;
        private $dbname = DBNAME; 
        private $dbuser = DBUSER; 
        private $dbpassword = DBPASSWORD ; 

        
        protected $conn;
        //using this->conn allows us to use it somewhere else;

        
        protected function connect(){

            $dsn = "mysql:host=$this->dbhost; dbname=$this->dbname";
            $option = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

            try{
                $this->conn= new PDO($dsn, $this->dbuser, $this->dbpassword, $option);
                return $this->conn;
            }catch(Exception $e){

                $e->getMessage();
                return false;

            }


        }

    }

?>

