<?php  
    error_reporting(E_ALL);
    require_once "../classes/Business.php";

    if($_POST["approve"])
    {

        $statuss = $_POST["approve"];
        $marketer_id = $_POST["id"];
        $appid = $_POST["appid"];
        $proid = $_POST["proid"];

        $status = $business->reply_application($statuss, $appid);
        $marketers = $business->update_marketers($proid, $marketer_id);


        if($status || $marketers){
           header("location:../business_applications.php");
           exit();
       }else{
           header("location:../business_applications.php");
           exit();
       }     
    };

    

    
?>