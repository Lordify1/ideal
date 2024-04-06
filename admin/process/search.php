<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/Project.php");
    require_once("../classes/Marketer.php");
    require_once("../classes/Business.php");
    require_once "../classes/utilities.php";


  if($_POST && isset($_POST["project_search"]))
  {
    $title = $_POST["search_title"];

    $project_search = $project->search_project($title);

    

    if($project_search !== null)
    {
        $_SESSION["admin_search_projects"] = $project_search;
        header("location:../projects.php");
        die();
    }else 
    {
        $_SESSION["error_search_projects"];
        header("location:../projects.php");
        die();
    }
    
  }


  if($_POST && isset($_POST["business_search"]))
  {
     $email  = sanitizer($_POST["search_business"]);

     $search = $business->search_business($email);

     if(is_array($search))
     {
        $_SESSION["search_business"] = $search;
        header("location:../businesses.php");
     }else
     {
        $_SESSION["erorr_search_business"];
        header("location:../businesses.php");
     }
  }


  if($_POST && isset($_POST["marketer_search"]))
  {
     $email  = sanitizer($_POST["search_marketer"]);

     $search = $market->search_marketer($email);

     if(is_array($search))
     {
        $_SESSION["search_marketer"] = $search;
        header("location:../marketers.php");
     }else
     {
        $_SESSION["erorr_search_marketer"];
        header("location:../marketers.php");
     }
  }





?>