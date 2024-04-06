<?php
    session_start();
    require_once("classes/Marketer.php");
    require_once("classes/Business.php");
    require_once("classes/General.php");

    $projects = $general->project_index();
    $marketers = $general->marketers_index();
    $businesses = $general->businesses_index();
    
    // $count = $general->count_project();
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>iDEAL</title>
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>

    <style>  
       /* *{
        border: 2px solid red;
        box-sizing: border-box;
       } */

       ::-webkit-scrollbar{
        width:9px;
        background: black;
        }

        ::-webkit-scrollbar-thumb{
            background: #0066cc;
        }


    </style>
</head>

<body id="mainbody">



<div id="businessdiv">



    <!-- SECTION FOR BUSINESSES -->
    
    <!-- Navigation section start -->
        <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
 
    <?php 

    if(isset($_SERVER["HTTP_REFERER"])){ ?>

      <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php 
          
          echo $_SERVER["HTTP_REFERER"]; ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>

      <?php  } ?>


    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="#" class="btn ideal-bg btn-sm animate__animated animate__pulse animate__infinite"><span class="fa fa-arrow-up"></span></a>
        </div> 




    <!-- hero section starts here -->
    <div class="container-fluid herocontainer">
        <div class="row">
            <div class="col herotexts">
            <?php

if(isset($_SESSION["userfeedback"])){
  echo "<div class='col-12 alert alert-info'>" . $_SESSION["userfeedback"] . "</div>";
  unset($_SESSION["userfeedback"]);
}

if(isset($_SESSION["blocked"])){
  echo "<div class='col-12 alert alert-info'>" . $_SESSION["blocked"] . "</div>";
  unset($_SESSION["blocked"]);
}


if(isset($_SESSION["success_message"])){
  echo "<div class='col-12 alert alert-info'>" . $_SESSION["success_message"] . "</div>";
  unset($_SESSION["success_message"]);
}

if(isset($_SESSION["error_message"])){
  echo "<div class='col-12 alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
  unset($_SESSION["error_message"]);
}

?>
            <h1 >MARKETER <span style="color: #0066cc">MEET</span> BUSINESS</h1>
            <h1>BUSINESS <span style="color: #666633">MEET</span> MARKETER</h1>
            </div>
        </div>
        <div class="row">
            <p class="text-white" style="font-weight:bold">Looking for a capable marketer for your business? <br>
            Or are you a marketer looking to explore your marketing skills the more?<br>
            This is the <a href="about_us.php" id="ideallink" >iDEAL</a> place for you. <br>
            Sign Up or Login to continue.</p>
        </div>
        <?php 
       
            if(!isset($_SESSION["marketer_is_online"]) && !isset($_SESSION["business_is_online"])){
        
        
        ?>
        <div class="row">
            <div class="col">
            <a href="" class="herolinks1 btn" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">REGISTER</a>
            <a href=""  class="herolinks2 btn text-white" style="background-color: #0066cc !important;" data-bs-toggle="modal" data-bs-target="#loginmodal">LOGIN</a>
            </div>
        </div>
        <?php 
        } ?>

        <?php  
        
        if(isset($_SESSION["marketer_is_online"])){
        ?>
        <div class="row">
            <div class="col">
            <a href="marketer_dashboard.php" class="herolinks1 btn">MY DASHBOARD</a>
            </div>
        </div>
        <?php

        }

        ?>

        <?php  
        
        if(isset($_SESSION["business_is_online"])){
        ?>
        <div class="row">
            <div class="col">
            <a href="business_dashboard.php" class="herolinks1 btn">MY DASHBOARD</a>
            </div>
        </div>
        <?php

        }

        ?>
    </div>

    <!-- hero section ends here -->

     

    <!-- whyideal section starts here -->

    <div class="container-fluid whyidealmain">
        <div class="row">
            <div class="col-2 whyimgbackground" id='whyideallogo'>
                <img src="images/ideal logo-shadow.png" class="img-fluid" width="150" height="150" alt="iDEAL Logo"  >
            </div>
            <div class="col whyideal">
            <a href="footer.php" class="btn whyidealtext text-white text-lg"><h1>WHY iDEAL?</span></h1></a>
            </div>


            
        </div>
    </div>
    
    <!-- whyideal section ends here -->

    <div class="container-fluid my-3">
        <h1 class="text-end text-white">PROJECTS</h1>
    </div>


    <!-- projects section starts here -->


 
    
           <?php foreach($projects as $project){ ?>
    <div class="col m-2">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4 shadow-sm" style="border-radius: 2%;">
              <img 
              <?php
              $images = $business->fetch_file_name($project["project_id"]);
              foreach($images as $img)
              { 

                
              if(!$img["project_image"] == null)
              { ?>
               src=
               "
               process/project_images/<?php echo $img["project_image"] ?>
               "
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }
            }
              ?>
              width="100%" style="border-radius: 2%;" height="100%">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5>Project Name : <?php echo $project["project_title"] ?></h5>
                <p class="card-text"><b>Project Description :</b><?php echo  $project["project_description"] ?></p> 

                <p><b>Project Industry :</b>
                 <?php
                 
                 $project_id = $project["project_id"];
                 $industries = $general->project_industry_index($project_id);
                
                 foreach($industries as $industry)
                 {
                    echo $industry["industry_name"];
                 }

                 ?>
                </p>
                 <p><b>Offer Amount : </b>
                <?php
                 echo $project["offer_amount_range"]
                 ?>
                 </p>
                <p><b>Skills Required :</b> 
                  <?php

                    $project_id = $project["project_id"];
                    $project_skills = $general->project_skills_index($project_id); 
                    
                    foreach($project_skills as $project_skill)
                    {
                        echo " | " . $project_skill["skill_name"] . " | ";
                    }
                   
                   
                   ?>
                </p>

                <p><?php 
                  $projecting = $project["project_creation_date"];

                 $hold = explode( " ", $projecting);

                  echo "Active since " . $hold[0];
                 ?>
                </p>

                <form action="project_view.php" method="get" target="blank">
                <button name='project_view' id='project_view' class="btn btn-primary project_view" value="<?php echo $project['project_id'] ?>">View Project</button> 
                </form>             
          
                    <p class="text-end card-text">Company name: <?php if($project["business_id"] != null){
                      echo $project["business_name"];
                    }
                      ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?> 
     


    <div class="container my-2">
        <div class="col">
            <a href="all_projects.php" class='btn col-12 btn-primary text-decoration-none text-white'>SEE MORE</a>
        </div>
    </div>

    <!-- projects section ends here -->

  
    
    

    <!-- testimonials start here -->



<!-- <div class="container-fluid">
        <div class="row testimonialarrange">
        <div class="col-md-3 testimonialimg">
            <img src="images/m1.jpeg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
         <h6 class="text-light h5">Cristiano Ronaldo</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m3.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Racheal Benson</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m2.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Rev. Akinboyewa</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m4.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Oke Jolajesu</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        </div>
</div> -->


    <!-- testimonials ends here -->



    <div class="container-fluid">
        <h1 class="text-start text-white">BUSINESSES</h1>
    </div>




    <!-- Business section start -->


<div class="container-fluid">
    <div class="row p-1">
    <?php foreach($businesses as $business){ ?>
      

          <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInRight">
            <div class="card">
              <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
                <?php

              if(!$business["business_logo"] == null)
              { ?>
               
               src = "images/business_logo/<?php echo $business["business_logo"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?> 
              >
              <div class="card-body">
                <h5 class="card-title bg-warning p-2 m-0 text-dark">Business </h5>
       <p class="card-text mb-0"><b>NAME</b> : <?php echo $business["business_name"]  ?></p>
                <hr class="mb-1 mt-1 m-0">
                <p class="card-text mb-0"><b>BIO</b> : <?php echo $business["about_business"] ?></p>
                <hr class="mb-1 mt-1 m-0">
                <?php if($business["business_website"] != null){ ?>
                  <p class="card-text mb-0"><b>WEBSITE</b> : <?php echo $business["business_website"]; ?></p>
                <hr class="mb-2 mt-1 m-0">
                <?php } ?>
                <p class="card-text mb-0"><b>ADDRESS</b> : <?php echo $business["business_address"]; ?></p>
                <hr class="mb-2 mt-1 m-0">
                <p class="card-text mb-0"><b>INDUSTRY</b> : <?php echo $business["business_address"]; ?></p>
                <hr class="mb-2 mt-1 m-0">
                <a href='business_view.php?id=<?php echo $business["business_id"] ?>' name='business_view' id='business_view' class="btn btn-primary business_view" value="<?php echo $business['business_email'] ?>">Go to Profile</a>            
              </div>
    
          </div>  
        </div>
        <?php } ?>
        </div>  
</div>


<div class="container">
        <div class="col-12 btn btn-primary btn-sm">
            <a href="all_business.php" class='text-decoration-none text-white'>SEE MORE</a>
        </div>
</div>

    <!-- Business section end -->

    <div class="container-fluid">
        <h1 class="text-start text-white">MARKETERS</h1>
    </div>



    <!-- marketers section starts here -->

   
<div class="container-fluid">
    <div class="row p-1">
    <?php foreach($marketers as $marketer){ ?>

          <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInLeft">
            <div class="card">
              <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
              <?php

                if(!$marketer["marketer_picture"] == null)
                { ?>
                
                src = "images/marketer_dp/<?php echo $marketer["marketer_picture"] ?>"
                
                <?php }else{  ?>
                src="images/bgimg.jpg"
                <?php  }  ?> 
                >
                            <div class="card-body">
                <h5 class="card-title p-2 m-0 ideal-bg">Marketer </h5>
       <p class="card-text mb-0"><b>NAME</b> : <?php echo $marketer["marketer_fname"] . "  " . $marketer["marketer_lname"] ?></p>
                <hr class="mb-1 mt-1 m-0">
                <p class="card-text mb-0"><b>BIO</b> : <?php echo $marketer["marketer_bio"] ?></p>                
                <hr class="mb-1 mt-1 m-0">
                <p class="card-text mb-0"><b>EXPERIENCE</b> : <?php echo $marketer["experience_id"] ?></p>
                <hr class="mb-1 mt-1 m-0">
                <p class="card-text mb-0"><b>CATEGORY</b> : <?php echo $marketer["category_id"]; ?></p>
                <hr class="mb-2 mt-1 m-0">
                <p class="card-text mb-0"><b>AVAILABILITY</b> : <?php echo $marketer["marketer_availability"]; ?></p>
                <hr class="mb-2 mt-1 m-0">
                <a href='marketer_view.php?id=<?php echo $marketer["marketer_id"] ?>' name='marketer_view' id='marketer_view' class="btn btn-primary marketer_view" value="<?php echo $marketer['marketer_email'] ?>">Go to Profile</a>              
              </div>
   
          </div>  
        </div>
        <?php } ?>
        </div>  
</div>  


<div class="container my-2">
        <div class="col-12">
            <a href="all_marketers.php" class='btn btn-primary btn-sm col-12 text-decoration-none text-white'><strong>SEE MORE</strong></a>
        </div>
        </div>


    <!-- Marketer section ends here -->



       <!--Blog section starts here-->




       <iframe src="blog.php" class="blogembed" frameborder="2"></iframe>




       <!--Blog section starts here-->








    <!-- marketers section ends here -->
    


    <!-- newsletter section starts here -->



<div class="container-fluid formmain p-4" id="newsletter">
        <div class="row newsletter">
            <div class="col-md-6 text-white">
                <h2 class="m-4 text-center">Subscribe to our Newsletter</h2>
                <form action="process/general_process.php"  method="post" class="form-control text-white px-3 mainformedit">
                    <div class="col" id="response">
                    
                    </div>
                    <label for="name" class="form-label m-2">Name</label>
                    <input id="name" name="name"  type="text" class="form-control m-2">

                    <label for="email" class="form-label m-2">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control m-2">

                    <button class="btn btn-success m-2" name="newsletter_btn" id="newsletter_btn" value="newsletter">Sign Up</button>
                </form>
            </div>
            
        </div>
 </div>



    <!-- newsletter section starts here -->


    <!-- footer section starts here -->

    <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->





     <!-- SECTION FOR BUSINESSES -->

</div>






      <!-- SECTION FOR MARKETERS -->







       <!-- SECTION FOR MARKETERS -->



    <script src="script/jqueryfile.js"></script>


    <script type="text/javascript">

    // $(document).ready(function(){
    //     $("#newsletter").click(function(){
    //     var name = $("#name").val();
    //     var email = $("#email").val();
    //     var data = "name="+name&"email"+email;
    //     var url = "processes/general_process.php";
    //     $("#loader").load(url,data);
    //     })
    // })


    </script>
</body>
</html>