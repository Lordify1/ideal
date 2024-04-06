<?php  
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/General.php");


    if($_POST && isset($_POST["business_search"]))
    {

      //$industryid, $stateid, $lgaid

        // $industryid = $_POST["industry"];
        // $stateid = $_POST["state"];
        // $lgaid = $_POST["lgas"];
        $searchbyname = $_POST["searchbyname"];

        $ind_search = $general->search_business($searchbyname);

        if(is_array($ind_search))
        {
          $_SESSION["success_search"] = $ind_search;
          header("location:../all_business.php");
          die();
        }else
        {
          header("location:../all_business.php");
          die();
        }
    }

    if($_POST && isset($_POST["marketer_search"]))
    {

        // $experience_id = $_POST["experience"];
        // // $category_id = $_POST["category"];
        // // $state_id = $_POST["state"];
        // // $lga_id = $_POST["lgas"];
        $name = $_POST["searchbyname"];

        $marketer_search = $general->search_marketer($name);

        
        if(is_array($marketer_search))
        {
          $_SESSION["marketer_search"] = $marketer_search;
          header("location:../all_marketers.php");
          die();
        }else
        {
          header("location:../all_marketers.php");
          die();
        }
    }



    if($_POST && isset($_POST["project_search"]))
    {

        // $industry_id = $_POST["industry"];
        // $state_id = $_POST["state"];
        // $lga_id = $_POST["lgas"];
        $title = $_POST["searchbyname"];
        // $business_id = $_POST["business"];
        // $experience_id = $_POST["experience"];

        $ind_search = $general->search_project($title);

        if(is_array($ind_search))
        {
          $_SESSION["project_search"] = $ind_search;
          header("location:../all_projects.php");
          die();
        }else
        {
          header("location:../all_projects.php");
          die();
        }
    }

?>