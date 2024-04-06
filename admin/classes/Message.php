<?php
    error_reporting(E_ALL);
    require_once "Db.php";

    class Message extends Db
    {
        private $dbconn;


        public function __construct()
        {
            $this->dbconn = $this->connect();
        }


        public function messages()
        {
            $sql = "SELECT * FROM customer_service";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messages;
        }

        public function replied_messages()
        {
            $sql = "SELECT * FROM customer_service WHERE customer_message_status = 'REPLIED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messages;
        }


        public function pending_messages()
        {
            $sql = "SELECT * FROM customer_service WHERE customer_message_status = 'PENDING'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messages;
        }

        public function ignored_messages()
        {
            $sql = "SELECT * FROM customer_service WHERE customer_message_status = 'IGNORED'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messages;
        }


        public function ignore($date, $id)
        {
            $sql = "UPDATE customer_service SET acted_on = ?, customer_message_status = 'IGNORED' WHERE cs_id = ? ";
            $stmt  = $this->dbconn->prepare($sql);
            $ignore = $stmt->execute([$date, $id]);
            return $ignore;
        }

        public function reply($date, $id)
        {
            $sql = "UPDATE customer_service SET acted_on = ?, customer_message_status = 'REPLIED' WHERE cs_id = ?";
            $stmt  = $this->dbconn->prepare($sql);
            $replied = $stmt->execute([$date, $id]);
            return $replied;
        }
    }


    $message = new Message();