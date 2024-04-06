<?php
    error_reporting(E_ALL);
    session_start();

    require_once("../classes/Topic.php");

    if($_POST && isset($_POST["topic_btn"]) && $_FILES["topic_cover"]["error"]== 0 ){

        $title = $_POST["title"];
        $level = $_POST["level"];
        $status = $_POST["status"];
        
        $topic_cover = $_FILES["topic_cover"];

        $tp = new Topic();
        $topic1 = $tp->add_topic( $title, $level, $status, $topic_cover);

        if($topic1){
            $_SESSION["success_message"] = "Topic Uploaded Successfully";
            header("location:../addtopic.php");
        }else{
            echo "Unable to upload file";
        }









    }else{
        $_SESSION["error_message"] = "Please fill the form completely";
        header("location:../addtopic.php");
        exit();
    }


?>