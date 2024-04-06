<?php  
    error_reporting(E_ALL);
    require_once "../classes/Business.php";


    if($_POST["reject"])
    {

        $r_statuss = $_POST["reject"];
        $r_marketer_id = $_POST["id"];
        $r_appid = $_POST["appid"];
        $r_proid = $_POST["proid"];
        $r_status = $business->reply_application($r_statuss, $r_appid);
        $r_marketers = $business->delete_marketers($r_proid, $r_marketer_id);
        
        if($r_status || $r_marketers){
            header("location:../business_applications.php");
            exit();
        }else{
            header("location:../business_applications.php");
            exit();
        }
    }

?>