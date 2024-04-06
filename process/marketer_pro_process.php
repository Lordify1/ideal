<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Marketer.php");

    if($_POST && isset($_POST["fname"]))
    {

    

        $fname        = sanitizer($_POST["fname"]);
        $lname        = sanitizer($_POST["lname"]);
        $phone        = sanitizer($_POST["phone"]);
        $dob          = $_POST["dob"];
     
        $marketer_id = $_SESSION["marketer_is_online"];


        $response = $market->marketer_prof_update_one($fname, $lname, $phone,$dob, $marketer_id);

        

        if($response){
             $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
             echo json_encode($reply);
            exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "ouldn't update profile" . "</div>";
             echo json_encode($reply);
            exit();
        }


        
    }


    if($_POST && isset($_POST["bio"]))
    {

    

        $bio  = sanitizer($_POST["bio"]);
        
     
        $marketer_id = $_SESSION["marketer_is_online"];


        $response = $market->marketer_prof_update_two($bio, $marketer_id);

        

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

    if($_POST && isset($_POST["experience"]))
    {

    

       $experience = $_POST["experience"];
       $portfolio = $_POST["portfoliolink"];
       $marketer_id = $_SESSION["marketer_is_online"];
       $skills = $_POST["expertise"];
    
       $response = $market->marketer_prof_update_three($experience, $portfolio, $marketer_id);

        $skilled= $market->marketer_prof_update_three_second($skills, $marketer_id);


             if($response){
                $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
                echo json_encode($reply);
               exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "COuldn't update profile" . "</div>";
             echo json_encode($reply);
            exit();
        }
    }


    
    if($_POST && isset($_POST["state"]))
    {

    

        $pay_method = $_POST["pay"];
        $account_detail = $_POST["a_info"];
        $state = $_POST["state"];
        $lga = $_POST["lgas"];
        $marketer_id = $_SESSION["marketer_is_online"];

        
        $response = $market->marketer_prof_update_four($pay_method, $account_detail, $state, $lga, $marketer_id);

        

        if($response){
            $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
            echo json_encode($reply);
           exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "COuldn't update profile" . "</div>";
            echo json_encode($reply);
            exit();
        }

        
    }


    if($_POST && isset($_POST["availability"]))
    {

    

        $category = $_POST["category"];
         $project_type =  $_POST["project_type"];
        $availability = $_POST["availability"];
        
     
        $marketer_id = $_SESSION["marketer_is_online"];


        $response = $market->marketer_prof_update_five($category, $project_type ,$availability, $marketer_id);

        

        if($response){
            $reply = "<div class='alert alert-success'>" . "Profile updated successfully" . "</div>";
            echo json_encode($reply);
           exit();
        }else{
            $reply = "<div class='alert alert-danger'>" . "COuldn't update profile" . "</div>";
            echo json_encode($reply);
            exit();
        }


        
    }


if($_POST && isset($_POST["marketer_dp"])){

        $id = $_POST["id"];
        if(isset($_FILES["mar_dp"]) && $_FILES["mar_dp"]["error"] == 0){
            //start processing the image
  
            //retriee all the details about the file: name, type, tmp_size, size
  
             $file_name = $_FILES["mar_dp"]["name"];
             $file_type = $_FILES["mar_dp"]["type"]; //for validation of type;
             $file_tmp_name = $_FILES["mar_dp"]["tmp_name"];
             $file_size = $_FILES["mar_dp"]["size"];
  
             //check if the file size is not above what you accept
  
             if($file_size > 2097152){ // the direct number or this - (1 * 1024 * 1024)
              $_SESSION["error_message_image_m"] = "File must not exceed 2mb";
              header("location:../marketer_dp_upload.php");
              exit();
             }
  
  
        //check if they upload the right file type
  
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
  
        if(!in_array($file_type, $allowed)){
           $_SESSION["error_message_image_m"] = "File type not allowed! We accept only png, jpeg and jpg only";
           header("location:../marketer_dp_upload.php");
           exit();
            
        }
  
       
  
        // generate a unique name for generated files
        //time() unique()
  
  
  
        $diff_filename = "mdp" . time() . uniqid() . $file_name; 
  
        // JOKEEEE
        // when you tell user all the list of files you allow and they start looking for a file that has all these extensions at once
  
  
        //final destination creation
        $destination = "../images/marketer_dp/" . $diff_filename;
  
        //upload the file to server. that is move it from the temporary place to the folder you want
  
        if(move_uploaded_file($file_tmp_name, $destination)){
             //adding to database should be here and nowhere else
            
            $result = $market->insert_dp($diff_filename, $id);
            
        $_SESSION["success_message_image_m"] = "Profile picture has been updated successfully";
       header("location:../marketer_dashboard.php");
       exit();
   }else{
       $_SESSION["error_message_image_m"] = "Couldn't upload image";
       header("location:../marketer_dp_upload.php");
       exit();
   }
  
  }else
  {
  $_SESSION["error_message"] = "Something went wrong";
  header("location:../marketer_dashboard.php");
  exit();
  }

}


 if($_POST && isset($_POST["account_activation_id"]))
 {
    $id = $_POST["account_activation_id"];

    

    $marketer = $market->get_userbyid($id);

    

    $fname  =$marketer["marketer_fname"];
    $lname  =$marketer["marketer_lname"];
    $email  =$marketer["marketer_email"];
    $phone  =$marketer["marketer_phone"];
    $dob  =$marketer["marketer_dob"];
    $availability =$marketer["marketer_availability"];
    $experience  =$marketer["experience_id"];
    $bio =$marketer["marketer_bio"];
    $gender =$marketer["marketer_gender"];
    $state  =$marketer["state_id"];
    $category =$marketer["category_id"];
    $project =$marketer["project_type"];
    $pay =$marketer["pay_method"];
    $account =$marketer["state_id"];
    $lga =$marketer["lga_id"];
    $portfolio =$marketer["portfolio"];

    if($fname !== "" && $lname !== "" && $email !== "" && $phone !== "" && $dob !== "" && $availability !== "" && $experience !== "" && $bio !== "" &&$gender !== "" && $state  !== "" && $category !== "" && $project !== "" && $pay !== "" && $account !== "" && $lga !== "" && $portfolio !== "" && $id !== "")
    {
        $activation = $market->activate($id);
        $reply = "<div class='alert alert-success'>" . "Your account has been activated." . "</div>";
        echo json_encode($reply);
        die();
    }
    
    if($fname == "" || $lname == "" || $email == "" || $phone == "" || $dob == "" || $availability == "" || $experience == "" || $bio == "" ||$gender == "" || $state  == "" || $category == "" || $project == "" || $pay == "" || $account == "" || $lga == "" || $portfolio == "")
    {
        $deactivation = $market->deactivate($id);
        $reply = "<div class='alert alert-danger'>" . "Please complete your profile." . "</div>";
        echo json_encode($reply);
        die();
    }

   
 }

?>