<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Business.php");

    if(isset($_POST["project_update"])){

    $protitle = sanitizer($_POST["protitle"]) ;    
    $prodesc = sanitizer($_POST["prodesc"]) ;  
    $progoals = sanitizer($_POST["progoals"]) ;         
    $proaudience = sanitizer($_POST["proaudience"]);
    $prooffer = sanitizer($_POST["prooffer"]) ;         
    $prodeadline = $_POST["prodeadline"];
    $state = $_POST["state"];   
    $no_of_marketers = $_POST["no_of_marketers"];   
    $experience = $_POST["experience"];   
    $proindustry = $_POST["proindustry"];       
    $procomm = $_POST["procomm"] ;      
    $proefforts = sanitizer($_POST["proefforts"]) ;  
    $skills = $_POST["skills"];       
    $procomments = sanitizer($_POST["procomment"]) ;        
    $lga = $_POST["lgas"];
    $business_id = $_POST["business_id"];
    $project_id = $_POST["proid"];


    if(!$prodesc == null &&  !$state == null &&  !$proaudience == null &&  !$proindustry == null &&  !$prodeadline == null &&  !$progoals == null &&  !$experience == null &&  !$prooffer == null &&  !$procomm == null &&  !$procomments == null &&  !$proefforts == null && !$lga == null &&  !$skills == null && !$no_of_marketers == null &&  !$business_id == null)
    {

    $protitled = strtoupper($protitle);
    $project = $business->update_project($prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $skills, $no_of_marketers, $business_id, $project_id);


    if($project){
        $_SESSION["success_message"] = "Project Updated Successfully." . " Upload project Picture ";
        $_SESSION["protitle"] = $protitled;
        header("location:../project_image_update.php");
        die();
    }else{
        $_SESSION["error_message"] = "An error occured while updating your Project";
        header("location:../edit_project.php");
        die();
    }
    }else
    {
    $_SESSION["error_message"] = "All fields must be Filled";
    header("location:../edit_project.php");
    die();
    }

    }





    //project image uodate


    if($_POST && isset($_POST["project_img_update"])){

        $title = $_POST["title"];
        if(isset($_FILES["proimage"]) && $_FILES["proimage"]["error"] == 0){
            //start processing the image
  
            //retriee all the details about the file: name, type, tmp_size, size
  
             $file_name = $_FILES["proimage"]["name"];
             $file_type = $_FILES["proimage"]["type"]; //for validation of type;
             $file_tmp_name = $_FILES["proimage"]["tmp_name"];
             $file_size = $_FILES["proimage"]["size"];
  
             //check if the file size is not above what you accept
  
             if($file_size > 2097152){ // the direct number or this - (1 * 1024 * 1024)
              $_SESSION["error_message_image"] = "File must not exceed 2mb";
              header("location:../project_image_update.php");
              exit();
             }
  
  
        //check if they upload the right file type
  
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
  
        if(!in_array($file_type, $allowed)){
           $_SESSION["error_message_image"] = "File type not allowed! We accept only png, jpeg and jpg only";
           header("location:../project_image_update.php");
           exit();
            
        }
  
        }
  
        // generate a unique name for generated files
        //time() unique()
  
  
  
        $unique_filename = "ideal" . time() . uniqid() . $file_name; 
  
        // JOKEEEE
        // when you tell user all the list of files you allow and they start looking for a file that has all these extensions at once
  
        //final destination creation
        $destination = "project_images/" . $unique_filename;
  
        //upload the file to server. that is move it from the temporary place to the folder you want
  
        if(move_uploaded_file($file_tmp_name, $destination)){
             //adding to database should be here and nowhere else
            
            $result = $business->update_file_name($unique_filename, $title);
            
        $_SESSION["success_message"] = "Project Updated successfully.";
       header("location:../business_projects.php");
       exit();
   }else{
       $_SESSION["error_message_image"] = "Couldn't upload image";
       header("location:../project_image_update.php");
       exit();
   }
  
  }