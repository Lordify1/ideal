<?php
  session_start();

if(!isset($_SESSION["marketer_is_online"]))
{
    $_SESSION["error_message"] = "Unauthorized action";
    header("location:index.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
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
<body style="background-color:black">

<?php 
   if(isset($_SESSION["marketer_is_online"]))
    {   
    
        $id = $_SESSION["marketer_is_online"];

    }

?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
        <form action="process/marketer_pro_process.php" method="post" class="form-control formee" id="businessprojects" enctype="multipart/form-data"> 
          <p>
        <?php
            
        if(isset($_SESSION["error_message_image_m"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message_image_m"] . "</div>"; 
                unset( $_SESSION["error_message_image_m"]);
            }
        
        ?>
    </p>

    <p>
        <?php
            
        if(isset($_SESSION["success_message_image_m"])){
                echo "<div class='alert alert-success'>" . $_SESSION["success_message_image_m"] . "</div>"; 
                unset( $_SESSION["success_message_image_m"]);
            }
        
        ?>
    </p>

          <div class='my-2'>
        <label for="mar_dp">Project image </label>
        <input type="file" name="mar_dp" id="mar_dp" class="form-control" required>
        </div>
        
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
        <button name='marketer_dp' id='marketer_dp' value='marketer_dp' class="btn col-12 btn-success my-2">Upload</button>
      </form>
        </div>
    </div>
</div>
</body>
</html>