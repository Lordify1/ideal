<?php
    error_reporting(E_ALL);
    require_once("Db.php");

    class Topic extends Db{

    private $dbcon;

    public function __construct(){
        $this->dbcon = $this->connect();
    }


        public function fetch_all_topics(){

            $sql = "SELECT * FROM breakout_topics LEFT JOIN level ON breakout_topics.topic_level = level.level_id WHERE topic_status = 1";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $topics;
        }

    
    

    }


    //a method to fetch all topics
   

?>