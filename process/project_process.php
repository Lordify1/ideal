<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/sanitizer.php");
    require_once("../classes/Business.php");
    

    

    if($_POST && isset($_POST["title"])){
         $check = sanitizer($_POST["title"]);

         if($check == null){
            echo "<div class='alert alert-danger'>" . "Project name cannot be empty" . "</div>";
            exit;
          }

         $checked = strtoupper($check);

         $check_title = $business->if_project($checked);

         if($check_title != null){
        
         echo "<div class='alert alert-danger'>" . "Project name already in Use" . "</div>";
         exit();
         
      }else
      {
         echo "<div class='alert alert-success'>" . "Project name " . $checked .  " is available" . "</div>";
         exit(); 
      }

      }



    if($_POST && isset($_POST["project_submit"])){

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

        $hold = array ($protitled, $prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $skills, $no_of_marketers, $business_id);


        if(!$protitle == null &&  !$prodesc == null &&  !$state == null &&  !$proaudience == null &&  !$proindustry == null &&  !$prodeadline == null &&  !$progoals == null &&  !$experience == null &&  !$prooffer == null &&  !$procomm == null &&  !$procomments == null &&  !$proefforts == null && !$lga == null &&  !$skills == null && !$no_of_marketers == null &&  !$business_id == null)
        {

         $protitled = strtoupper($protitle);
         $project = $business->create_project($protitled, $prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $skills, $no_of_marketers, $business_id);

        
         if($project){
            $_SESSION["success_message"] = "Project Created Successfully." . " Upload project Picture ";
            $_SESSION["protitle"] = $protitled;
            header("location:../project_image_upload.php");
            die();
         }else{
            $_SESSION["could_not_create_project"] = "An error occured while creating your Project";
            $_SESSION["previous_inputs"] = array ($protitled, $prodesc, $state, $proaudience, $proindustry, $prodeadline, $progoals, $experience, $prooffer, $procomm, $procomments, $proefforts,$lga, $skills, $no_of_marketers, $business_id);
            header("location:../business_project_form.php");
            die();
         }
        }else
        {
         $_SESSION["error_message"] = "All fields must be Filled";
         header("location:../business_project_form.php");
         die();
        }

    }
    
    


    if($_POST && isset($_POST["project_pic"])){

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
            header("location:../business_project_form.php");
            exit();
           }


      //check if they upload the right file type

      $allowed = ["image/jpeg", "image/jpg", "image/png"];

      if(!in_array($file_type, $allowed)){
         $_SESSION["error_message_image"] = "File type not allowed! We accept only png, jpeg and jpg only";
         header("location:../business_project_form.php");
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
          
          $result = $business->insert_file_name($unique_filename, $title);
          
      $_SESSION["success_image_uploaded"] = "Image Uploaded successfully.";
     header("location:../project_payment.php?t=$title");
     exit();
 }else{
     $_SESSION["error_message_image"] = "Couldn't upload image";
     header("location:../project_image_upload.php");
     exit();
 }

}









?>