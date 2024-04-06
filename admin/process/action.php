
<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/utilities.php");
    require_once("../classes/actions.php");
    require_once("../classes/Project.php");
    require_once "../classes/Message.php";


    if($_POST && isset($_POST["block_marketer"])){

        $block_marketer = $_POST["block_marketer"];

        $req = $action->block_m($block_marketer);

            header("location:../marketers.php");
            die();
    }
    


    if($_POST && isset($_POST["unblock_marketer"])){

        $unblock_marketer = $_POST["unblock_marketer"];

        $reco = $action->unblock_m($unblock_marketer);

    
    header("location:../marketers.php");
        die();
    }


    if($_POST && isset($_POST["activate_marketer"])){

        $activate_marketer = $_POST["activate_marketer"];

        $reco = $action->activate_m($activate_marketer);

    
    header("location:../marketers.php");
        die();
    }


    if($_POST && isset($_POST["block_business"])){

        $block_business = $_POST["block_business"];

        $reco = $action->block_b($block_business);

    
    header("location:../businesses.php");
        die();
    }


    if($_POST && isset($_POST["unblock_business"])){

        $unblock_business = $_POST["unblock_business"];

        $reco = $action->unblock_b($unblock_business);

    
        header("location:../businesses.php");
        die();
    }


    if($_POST && isset($_POST["activate_business"]) ){

        $activate_business = $_POST["activate_business"];

        $reco = $action->activate_b($activate_business);

    
        header("location:../businesses.php");
        die();
    }


    
    if($_POST && isset($_POST["activate_project"])){

        $activate_project = $_POST["activate_project"];

        $activate_p = $project->activate_project($activate_project);

    
     header("location:../projects.php");
        die();
    }



    if($_POST && isset($_POST["cancel_project"])){

        $cancel_project = $_POST["cancel_project"];

        $cancel_p = $project->cancel_project($cancel_project);

    
        header("location:../projects.php");
        die();
    }


    if($_POST && isset($_POST["forgive_project"])){

        $forgive_project = $_POST["forgive_project"];

        $reput_p = $project->activate_project($forgive_project);

    
        header("location:../projects.php");
        die();
    }
    


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activate_marketer'])) {
        $marketer_id = $_POST['activate_marketer'];
    

        $a_m = $action->activate_m($marketer_id);
    
        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($a_m);
        exit;
    }



    if($_POST && isset($_POST["ignored"]))
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


    if($_POST && isset($_POST["replied"]))
    {
        $date = date("Y-m-d H-i-s");
        $id = $_POST["replied"];

        $ignore = $message->reply($date, $id);

        if($ignore)
        {
            $_SESSION["success_message"] = "Message replied";
            header("location:../customer_care.php");
            die();
        }
    }
?>