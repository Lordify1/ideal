<?php 
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/General.php");
    require_once("../classes/Marketer.php");
    require_once("../classes/Business.php");
    require_once("../classes/sanitizer.php");



    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stateId'])) {
        $stateId = $_POST['stateId'];
    

        $lgas = $general->getlga_bystate($stateId);
    
        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($lgas);
        exit;
    }

   



    // if($_POST && isset($_POST["delete_project"]))
    // {
    //     $delete_p = $_POST[""]
    // }
    

    if($_POST && isset($_POST["delete"]))
    {
        $delete = $_POST["deleted"];
       
        $del = $general->delete_application($delete);

        if($del)
        {
            $_SESSION["application_deleted"] = "You've successfully deleted the application";
            header("location:../marketer_applications.php");
            die();
        }
    }
   
    // application process start

    if($_POST && isset($_POST["application_submit_btn"]))
    {

        $relevant_experience = sanitizer($_POST["marketerrelevant"]);
        $approach = sanitizer($_POST["marketerapproach"]);
        $strategy = sanitizer($_POST["strategy"]);
        $specific_skills = sanitizer($_POST["specific_skills"]);
        $portfolio = sanitizer($_POST["portfolio"]);
        $timeline = sanitizer($_POST["timeline"]);
        $communication = sanitizer($_POST["communication"]);
        $testimonials = sanitizer($_POST["references"]);
        $additional_information = sanitizer($_POST["additional_information"]); 

        $marketer_id = $market->get_userbyid($_SESSION["marketer_is_online"]);

        $projectone = $general->get_projectbyid(sanitizer($_POST["project_id"]));

        $proj = sanitizer($_POST["project_id"]);

        

        $marketered = $marketer_id["marketer_id"];

        $project_id = sanitizer($_POST["project_id"]);
        //$application_amount = sanitizer($_POST["amount"]);


        $projected = $projectone["business_id"];

        $prounique = $proj . sanitizer($_POST["unique"] .$marketered);

        

        $application = $general->insert_application( $relevant_experience , $approach, $strategy , $specific_skills , $portfolio , $timeline , $communication , $testimonials, $additional_information , $marketered, $project_id, $projected, $prounique);



        if($application){
            $_SESSION["success_message"] = "Application sent successfully";
            header("location:../all_projects.php");
            die();
        }else{
            $_SESSION["error_message"] = "Please resubmit your application";
            header("location:../application.php?identifier=" . $project_id);
            die();
        }

        
    }



    // application process end


    if($_POST && isset($_POST["profile_view"])){

        $data = $_POST["profile_view"];

     

        // if($target_m){
        //     $_SESSION["target_m"] = $target_m;
        //    // header("location:../marketer_view.php");
        // }

    }else{
        header("../all_marketers.php");
    }


    if($_POST && isset($_POST["business_view"])){

        $data = $_POST["profile_view"];

        //$target_m = $general->view_marketer($data);


        // if($target_m){
        //     $_SESSION["target_m"] = $target_m;
        //    // header("location:../marketer_view.php");
        // }

    }else{
        header("../all_marketers.php");
        die();
        
    }



    if($_POST && isset($_POST["profile_view"])){

        $data = $_POST["profile_view"];

        //$target_m = $general->view_marketer($data);

        // if($target_m){
        //     $_SESSION["target_m"] = $target_m;
        //    // header("location:../marketer_view.php");
        // }

    }else{
        header("../all_marketers.php");
        die();
    }



    if($_POST && isset($_POST["project_status_start"]))
    {
        $change_status = $_POST["status"];
        $proid = $_POST["project_status_start"];
        $change = $business->project_status($change_status, $proid);
        
        if($change)
        {
            header("location:../business_projects.php");
            die();
        }
    }


    if($_POST && isset($_POST["newsletter_btn"]))
    {
        $name = $_POST["name"];
        $email = $_POST["email"];

        $newsletter = $general->insert_newsletter($name, $email);

        if($newsletter == 1)
        {
            $_SESSION["success_message"] = "You've subscribed to our Newsletter";
            header("location:../index.php");
            exit();
        }else
        {
            $_SESSION["error_message"] = "Couldn't add your Subscription";
            header("location:../index.php"); 
            exit();
        }
    }


    


    




    

    

    

?>