<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/category.php");
    require_once("../classes/industry.php");

    if($_POST && isset($_POST["addcategory"])){

        $categoryid = $_POST["categoryid"];
        $categoryname = $_POST["categoryname"];

       $categoried = $category->add_category($categoryid, $categoryname);
       
  
       if($categoried){
            echo $_SESSION["ideal_admin_success_feedback"] = "Category added Successfully";
            header("location:../category.php");
            die();
        }else{
            echo $_SESSION["ideal_admin_error_feedback"] = "Operation wasn't successful";
        }
     

    }


    if($_POST && isset($_POST["d_category"])){

        $delete_id = $_POST["d_category"];

        $delete = $category->delete_category($delete_id);


        if($delete){
            echo $_SESSION["ideal_admin_success_feedback"] = "Category deleted Successfully";
            header("location:../category.php");
            die();
        }else{
            echo $_SESSION["ideal_admin_error_feedback"] = "Operation wasn't successful";
        }

    }



    if($_POST && isset($_POST["addindustry"])){

        $industryid = $_POST["industryid"];
        $industryname = $_POST["industryname"];

       $industried = $industry->add_industry($industryid, $industryname);
       
  
       if($industried){
            echo $_SESSION["ideal_admin_success_feedback"] = "industry added Successfully";
            header("location:../industry.php");
            die();
        }else{
            echo $_SESSION["ideal_admin_error_feedback"] = "Operation wasn't successful";
        }
     

    }


    if($_POST && isset($_POST["d_industry"])){

        $delete_id = $_POST["d_industry"];

        $delete_ind = $industry->delete_industry($delete_id);


        if($delete_ind){
            echo $_SESSION["ideal_admin_success_feedback"] = "industry deleted Successfully";
            header("location:../industry.php");
            die();
        }else{
            echo $_SESSION["ideal_admin_error_feedback"] = "Operation wasn't successful";
        }

    }



?>