
<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/utilities.php");
    require_once "../classes/Message.php";


    if($_POST && isset($_POST["ignore"]))
    {
        $id = $_POST["ignored"];
        $date = date("Y-m-d H-i-s");


        $ignore = $message->ignore($date, $id);

    

        if($ignore)
        {
            $_SESSION["success_message"] = "Message Ignored";
            header("location:../customer_care.php");
            die();
        }else
        {
            $_SESSION["error_message"] = "Couldn't ignore message";
            header("location:../customer_care.php");
            die();
        }
    }


    if($_POST && isset($_POST["reply_message"]))
    {
        $date = date("Y-m-d H-i-s");
        $id = $_POST["replied"];

        $reply = $message->reply($date, $id);

        if($reply)
        {
            $_SESSION["success_message"] = "Message replied";
            header("location:../customer_care.php");
            die();
        }else
        {
            $_SESSION["error_message"] = "Couldn't replied message";
            header("location:../customer_care.php");
            die();
        }

    }
?>