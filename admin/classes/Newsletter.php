<?php
    error_reporting(E_ALL);
    require_once("Db.php");

    class Newsletter extends Db{

    private $dbcon;

    public function __construct(){
        $this->dbcon = $this->connect();
    }


    public function newsletter()
    {
        $sql = "SELECT * FROM newsletter";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $all;
    }
    

    }


    //a method to fetch all topics
   
$newsletter =  new Newsletter();
?>