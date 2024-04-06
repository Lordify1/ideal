<?php
    error_reporting(E_ALL);
    require_once("classes/State.php");

    $st = new State();
    $states = $st->fetch_states();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>MARKETER REGISTRATION</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>
    

    <style>
       
   div{
       border:0px solid red;
       
       
   }
    
    
   body{
    background-image: url("images/marketingformbg.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
   }


   .form-push{
    margin-top: 40px;
    }

    .navbar{
        list-style-type:none;
    }
    
    input, textarea{
        margin-bottom: 20px;
    }
    

    .form-header-sm{
        display: none;
    }

    


    @media screen and (min-width:200px) and (max-width:1130px){
    .form-header-sm{
        display: block;
    }

    .form-push{
        display:none;
    }

    .formee{
        margin-top:100px;
    }

    }
    
    </style>

</head>
<body>
    
    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->

    <div class="container-fluid">
        <div class="row marketerformrow">
            <div class="col-md-6">
                 
               <h2 class="text-white text-end form-push">Profile Update</h2>
                
                <form action="process/marketer_reg_process.php" method="post"  id="marketingform" class="form-control mx-auto border-dark formee" enctype="multipart/form-data">

                <h2 class="text-white text-start my-3 form-header-sm">Marketer Profile Update</h2>
                    <label class="form-label  " for="fname">First name</label>
                    <input class="form-control" type="name" name="fname" id="fname">

                    <label class="form-label  " for="lname">Last Name</label>
                    <input class="form-control" type="name" name="lname" id="lname">
                    
                    <label class="form-label  " for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email">

                    
                    <label class="form-label  " for="pwd">Password</label>
                    <input type="password" class="form-control" name="pwd" id="pwd">

                    <label class="form-label" for="BIO">BIO (optional)</label>
                    <textarea name="bio" id="bio" cols="30" placeholder="20 words minimum" class="form-control" rows="10"></textarea>
                    
                    <label class="form-label" for="location">State</label>
                    <select id="state" name="state" class="form-control-sm">
                        <?php foreach($states as $state){ ?>

                            <option><?php echo $state["state_name"]; ?></option>

                        <?php } ?>
                    </select>
                    
        
                    <label class="form-label  " for="experience">Level of experience in Marketing</label> <br>
                    <select name="experience" class="form-control my-2" id="experience">
                        <option value="">Please select</option>
                        <option value="beginner">Junior</option>
                        <option value="intermidiate">Intermidiate</option>
                        <option value="expert">Senior</option>
                    </select><br>
                    
                        <hr>
                    
                        <!-- might change to radio button -->
                    <label class="form-label">Areas of Expertise</label> <br>
                    <input type="checkbox" class="form-check-input mx-1" name="expertise[]" id="expertise"  value="digital_marketing">Digital Marketing <br>
                     <input type="checkbox" class="form-check-input mx-1" name="expertise[]" id="expertise" value="conent marketing">Content Marketing <br>
                     <input type="checkbox" class="form-check-input mx-1" name="expertise[]" id="expertise" value="social_media_marketing">Social Media Marketing <br>


                     <label class="form-label  " for="text">Others</label>
                    <input type="email" class="form-control" name="expertise[]" id="expertise">

            <hr>

            <div class="btn btn-border-red col-12 text-white">
                     
            <h3>Previous projects worked on</h3>
                     
           <label class="form-label">Project name</label>
           <input type="text" class="form-control" name="projectname" id="projectname">
           <label class="form-label">Project duration</label>
           <input type="text" class="form-control" name="projectduration" id="projectduration">

           <button class="btn btn-primary btn-sm my-2 col-12">Add more projects</button><br>
           
           
          <!-- would still do something here -->
           
          <label>OR</label> <br><br>
           
           <label class="form-label">Link to Portfolio</label>
           <input type="text" class="form-control" name="portfoliolink" id="portfoliolink">
           
</div>

           
                    
           <hr>


          <label class="form-label">Preferred project type</label> <br>
           <input type="checkbox" class="form-check-input" name="project_type[]" value="Short Term" id="shortterm"> <span>Short-term</span> <br>
           
           <input type="checkbox" class="form-check-input" name="project_type[]" value="Long Term" id="longterm"> <span>Long-term</span> <br><br>
           
           <hr>
           
           <label class="form-label">Availability</label> <br>
          <input type="checkbox" class="form-check-input" name="availability[]" value="Part time" id="parttime"> <span>Part-time</span> <br>
          
          <input type="checkbox" class="form-check-input" name="availability[]" value="Fulltime" id="fulltime"> <span>Full-time</span> <br>
         
         <input type="checkbox" class="form-check-input" name="availability[]" value="Freelance" id="freelance"> <span>Freelance</span> <br><br>

         <input type="checkbox" name="" id="agreement" class="form-input-checkbox"> I agree to iDEAL <a href="#" class="text-decoration-none">terms</a> and <a href="#" class="text-decoration-none ">conditions</a>
                    
         <input type="submit" class="btn text-black d-block mt-4" name="submit_btn" id="market_btn" style="background-color: #00ff00; font-weight: bold;">       
                </form>
            </div>
        </div>
    </div>

        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    
    
    <script src="js/bootstrap.bundle.js"></script>

    <script src="script/jqueryfile.js"></script>


    <script type="text/javascript">        
            
    //    $(document).ready(function(){
        
    //     if(.for)


    //    })
           
   
    </script>
</body>
</html>