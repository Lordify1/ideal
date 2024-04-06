<?php
    error_reporting(E_ALL);
    require_once("Db.php");

    class Admin extends Db{

        private $dbcon;

        public function __construct(){
            $this->dbcon = $this->connect();
        }

        public function logout(){
            session_unset();
            session_destroy();

        }

        public function login_admin($email, $password){
            //check if the user email exist in db
            $sql = "SELECT * FROM admin WHERE admin_email = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$email]);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
           //if there is no record 
           if(!$record){
            $_SESSION["error_message"] = "Invalid login Credentials";
            return false;
           }else{
            //compare password passed by user with hashed password
            $record_password = $record["admin_password"]; //from bd

            

            $checked = password_verify($password, $record_password); //user passed
            if($checked){
                return $record["admin_id"];
            }else{
                $_SESSION["error_message"] ="Invalid Login Credentials";
                return false;
            }

            


           }
           
            // #--invalid credentialls
            //fetch the details
            //compare the password they gave with the hashed password in db
            //if not same #-- if not the same tell them i nvalid credentials
            // if same return the details to the process page
            

        }   
     }
?>