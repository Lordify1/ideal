<?php
    session_start();

// if(!isset($_SESSION["protitle"]))
// {
//     $_SESSION["error_message"] = "Unauthorized action";
//     header("location:index.php");
//     die();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project image Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="iDEAL">
    <link rel="icon" type="image/x-icon" href="images/ideal_logo.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>
    <link rel="stylesheet" href="css/sign-in.css">
    <style>

    .row{
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:center;
        height:100vh;
    }

    </style>
</head>
<body style="background-color:#0066cc" class="business_project_bg">

   <?php 
   if(isset($_SESSION["protitle"]) && !$_SESSION["protitle"] == null)
{   
   
    $title = $_SESSION["protitle"];


}

?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
        <form action="process/update_project.php" method="post" class="form-control formee" id="businessprojects" enctype="multipart/form-data"> 
          <p>
        <?php
            
        if(isset($_SESSION["error_message_image"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message_image"] . "</div>"; 
                unset( $_SESSION["error_message_image"]);
            }
        
        ?>
    </p>

    <p>
        <?php
            
        if(isset($_SESSION["success_message_image"])){
                echo "<div class='alert alert-success'>" . $_SESSION["success_message_image"] . "</div>"; 
                unset( $_SESSION["success_message_image"]);
            }
        
        ?>
    </p>

    <p>
        <?php
            
        if(isset($_SESSION["success_message"])){
                echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>"; 
                unset( $_SESSION["success_message"]);
            }
        
        ?>
    </p>

          <div class='my-2'>
        <label for="proimage">Project image </label>
        <input type="file" name="proimage" id="proimage" class="form-control">
        </div>
        
    
        <input type="hidden" name="title" id="title" value="<?php echo $title ?>">
        <button name='project_img_update' id='project_img_update' value='project_img_update' class="btn btn-success my-2">Upload</button>
        <a href="business_projects.php" name="project_image_skip" class="btn btn-danger btn-sm">Skip</a>
        
      </form>
        </div>
    </div>
</div>
</body>
</html>