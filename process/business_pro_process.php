<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Business.php");

    if($_POST && isset($_POST["compemail"]))
    {

        $compname        = sanitizer($_POST["compname"]); 
        $name        = strtoupper($compname);
        $email        = sanitizer($_POST["compemail"]); 
        $phone        = sanitizer($_POST["comphone"]); 
        $web        = sanitizer($_POST["compweb"]); 
        $about          = sanitizer($_POST["compbio"]); 
        $address    = sanitizer($_POST["compaddress"]); 
        $state        = $_POST["state"];
        $lga            = $_POST["lgas"]; 
        $business_id    = $_SESSION["business_is_online"];


        $response = $business->bprofile_update_one( $name,$email, $phone, $web ,$about ,$address,$state, $lga, $business_id);
        
        if($response){
            $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
            echo json_encode($reply);
           exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "Couldn't update profile" . "</div>";
            echo json_encode($reply);
            exit();
        }
    }


    if($_POST && isset($_POST["pay"]))
    {
        $paymethod = $_POST["pay"];
        $detail = $_POST["a_info"];
        $business_id = $_SESSION["business_is_online"];
        
        $response = $business->bprofile_update_two($paymethod, $detail ,$business_id);

        if($response){
            $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
            echo json_encode($reply);
           exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "Couldn't update profile" . "</div>";
            echo json_encode($reply);
            exit();
        }
    }


    if($_POST && isset($_POST["cpname"]))
    {
        $industry = $_POST["industry"];
        $contact_person = $_POST["cpname"];
        $desired_skills = $_POST["skill"];
        $business_id = $_SESSION["business_is_online"];

        $response = $business->bprofile_update_three($industry, $contact_person, $business_id);

        $skills = $business->bprofile_update_three_second($business_id, $desired_skills);

        if($skills){
            $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
            echo json_encode($reply);
           die();
        }else{
            $reply = "<div class='alert alert-danger'>" . "Couldn't update profile" . "</div>";
            echo json_encode($reply);
            die();
        }
    }


    if($_POST && isset($_POST["business_logo_btn"])){

        $id = $_POST["id"];
        if(isset($_FILES["bus_logo"]) && $_FILES["bus_logo"]["error"] == 0){
            //start processing the image
  
            //retriee all the details about the file: name, type, tmp_size, size
  
             $file_name = $_FILES["bus_logo"]["name"];
             $file_type = $_FILES["bus_logo"]["type"]; //for validation of type;
             $file_tmp_name = $_FILES["bus_logo"]["tmp_name"];
             $file_size = $_FILES["bus_logo"]["size"];
  
             //check if the file size is not above what you accept
  
             if($file_size > 2097152){ // the direct number or this - (1 * 1024 * 1024)
              $_SESSION["error_message_image_b"] = "File must not exceed 2mb";
              header("location:../business_image_upload.php");
              exit();
             }
  
  
        //check if they upload the right file type
  
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
  
        if(!in_array($file_type, $allowed)){
           $_SESSION["error_message_image_b"] = "File type not allowed! We accept only png, jpeg and jpg only";
           header("location:../business_image_upload.php");
           exit();
            
        }
  
       
  
        // generate a unique name for generated files
        //time() unique()
  
  
  
        $diff_filename = "bus_logo" . time() . uniqid() . $file_name; 
  
        // JOKEEEE
        // when you tell user all the list of files you allow and they start looking for a file that has all these extensions at once
  
  
        //final destination creation
        $destination = "../images/business_logo/" . $diff_filename;
  
        //upload the file to server. that is move it from the temporary place to the folder you want
  
        if(move_uploaded_file($file_tmp_name, $destination)){
             //adding to database should be here and nowhere else
            
            $result = $business->insert_logo($diff_filename, $id);
            
        $_SESSION["success_message"] = "Profile picture has been updated successfully";
       header("location:../business_dashboard.php");
       exit();
   }else{
       $_SESSION["error_message_image_b"] = "Couldn't upload image";
       header("location:../business_image_upload.php");
       exit();
   }
  
  }else
  {
  $_SESSION["error_message"] = "Something went wrong";
  header("location:../business_dashboard.php");
  exit();
  }





}


    
?>