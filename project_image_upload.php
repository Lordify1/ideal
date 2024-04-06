
<?php
  session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Project Image Upload</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>
    

    <style>
       
   /* div{
       border:2px solid red;
   }
     */
    
    .navbar{
        list-style-type:none;
    }

    
    
    input[type=text], input[type=password]{
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .formee{
        margin-top:80px;
    }
    
    </style>

</head>

<body class="business_project_bg">
                


          
            
          
        


<?php 
if(isset($_SESSION["protitle"]))
{   

 $title = $_SESSION["protitle"];

}

?>


<div class="container-fluid">
 <div class="row">
     <div class="col">
     <form action="process/project_process.php" method="post" class="form-control formee" id="businessprojects" enctype="multipart/form-data"> 
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

           
 <p>
        <?php
            
        if(isset($_SESSION["error_message"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>"; 
                unset( $_SESSION["error_message"]);
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
     <button name='project_pic' id='project_pic' value='project_pic' class="btn btn-success my-2">Upload</button>
     <a href="project_payment.php?t=<?php echo $title ?>" name="project_image_skip" class="btn btn-danger btn-sm">Skip</a>
    
   </form>
     </div>
 </div>
</div>


        </body>
 <script src="script/jqueryfile.js"></script>
 <script>
     $(document).ready(function()
   {
     $("#proimage").click(function()
     {
       alert("File type must be image | We only accept jpeg, jpg and png | File size must not be greater than 2mb");
     })
   })
 </script>
