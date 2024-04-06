
<body id="profilebody">
<?php

require_once("marketer_guard.php");

    require_once("partials/header.php");
    require_once("classes/Marketer.php");
    

   
    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);


    
    $marketer_id = $data["marketer_id"];

    $status = $data["marketer_status"];
   
    
    

?>


<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="Looking for a capable marketer for your business? Or are you a marketer looking to explore your marketing skills the more? This is the iDEAL place for you. Sign Up or Login to continue.">
    <meta name="keywords" content="iDEAL, marketing, marketer, sales, business, company, SEO marketer, digital marketer">
    <title><?php  $data["marketer_lname"] . " dashboard" ?></title>

   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }
   </style>
        <!-- Navigation section start -->
        
    <!-- Navigation section end -->


<?php if(isset($_SERVER["HTTP_REFERER"])){ ?>

  <div>
    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-4"></span></a>
        </div> 

  <?php } ?>
        
<?php

if(isset($_SESSION["userfeedback"])){
echo  "<div class='alert alert-success'>" . $_SESSION["userfeedback"]. "</div>";
unset($_SESSION["userfeedback"]);
  }
?>

<?php

if(isset($_SESSION["success_message_image_m"])){
echo  "<div class='alert alert-success'>" . $_SESSION["success_message_image_m"]. "</div>";
unset($_SESSION["success_message_image_m"]);
  }
?>


<?php

if(isset($_SESSION["error_message"])){
echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"]. "</div>";
unset($_SESSION["error_message"]);
  }
?>
</div>
</div>
        
    
    <div style="height:3vh"></div>
    

      <header class="dashboardnav ideal-shadow">
            <section class="col-md-11">
            <h4 style="font-size:1vm" class="ms-3 p-2"><a href="marketer_dashboard.php" class="text-decoration-none text-white"><?php echo $data["marketer_lname"]; ?> dashboard</a></h4>
            </section>
            <section class="col-md-1">
            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img 
                <?php
              $dp = $market->get_dp($marketer_id);

              if(!$dp["marketer_picture"] == null)
              { ?>
               
               src = "images/marketer_dp/<?php echo $dp["marketer_picture"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?>
               alt="mdo" width="50" height="50" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small ">
                <li><a class="dropdown-item" href="marketer_profile.php">Profile</a></li>
                <!-- <li><a class="dropdown-item" href="profile.php">Change Theme</a></li> -->
                <li><a class="dropdown-item" href="marketer_dp_upload.php">Update Profile picture</a></li>
                <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
              </ul>
            </div>
            </section>
        </header>

        

        <div class="container">
            <div class="row dashsections text-center p-4">
                <div class='col-md-4 col-sm-12 col-lg-3  colarrange'>
                <a href="marketer_profile.php" title="View and Edit you profile" class=" buttons">
                 <span class="fa fa-user h2"></span>
                  <p >Edit Profile</p><span class="explainer_text">View and Edit you profile</span>
                </a>
                </div>
                
                <div class='col-md-4 col-sm-12 col-lg-3  colarrange'>
                <a href="marketer_projects.php" title="Your Past,recent and Active" class=" buttons">
                <?php 
                  
                  $data = $market->active_projects($marketer_id);

                  $projects = count($data);

                  if(!$projects == null){
                  ?>
                   <span class="badge bg-danger mb-1">
                    <?php echo $projects ?>
                  </span>

                <?php } ?>
                <span class="fa fa-bars-progress h2"></span>
                  <p>My Projects</p><span id="projects" class="explainer_text">Your Past,recent and Active</span></a>
                </div>


                <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
                <a href="marketer_applications.php" title="All Applications you've sent out" class="buttons">
                <?php 
                  
                  $data = $market->my_pending_applications($marketer_id);

                  $application = count($data);

                  if(!$application == null){
                  ?>
                   <span class="badge bg-danger mb-1">
                    <?php echo $application ?>
                  </span>

                <?php } ?>
                <span class="fa fa-envelope h2"></span>
                  <p>My Applications</p><span id="applications" class="explainer_text">All Applications you've sent out</span> 
</a>
                </div>

                
               <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
               <a href="all_marketers.php" title="See All Marketers on iDEAL" class=" buttons">
                <span class="fa fa-users h2"></span>
                  <p>Marketers</p><span id="marketers" class="explainer_text">See All Marketers on iDEAL</span>
</a>
               </div>


</a>
               <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
               <a href="marketer_payments.php" title="See All Your Payments" class=" buttons">
               <?php 
                  
                  $data = $market->pending_payments($marketer_id);

                  $payment = count($data);

                  if(!$payment == null){
                  ?>
                   <span class="badge bg-danger mb-1">
                    <?php echo $payment ?>
                  </span>

                <?php } ?>
                  <span class="fa fa-money-bill h2"></span>
                  <p>My Payments</p><span id="payment" class="explainer_text">See All Your Payments</span>
</a>
               </div>


               <?php if($status == "active")
               { ?>
                <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
               <a href="all_projects.php"  title="All Projects on iDEAL" class=" buttons">
                <span class="fa fa-briefcase h2"></span>
                  <p>iDEAL Projects</p><span id="applications" class="explainer_text">All Projects on iDEAL</span>
                </a>
               </div>
                <?php }else{ ?>
                <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
               <a title="Complete your profile please" class="text-secondary">
                <span class="fa fa-briefcase h2"></span>
                  <p>iDEAL Projects</p><span id="" class="explainer_text">Complete your profile please</span>
                </a>
               </div>
              <?php } ?>

                
        <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
        <a href="all_business.php" title="All Businesses on iDEAL" class=" buttons">
                <span class="fa fa-building h2"></span>
                  <p>Businesses</p><span id="applications" class="explainer_text">All Businesses on iDEAL</span>
</a>
        </div>


                <div id="previe">

                </div>
               
        <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
        <a href="blog.php" title="The iDEAL blog for you" class="buttons">
                <span class="fa fa-blog h2"></span>
                  <p>The iDEAL Blog</p><span id="applications" class="explainer_text">The iDEAL blog for you</span>
</a>
        </div>


        <div class="col-md-4 col-sm-12 col-lg-3  colarrange">
        <a href="message_ideal.php" title="Talk to iDEAL" class="buttons">
                <span class="fa fa-comments h2"></span>
                  <p>Chat iDEAL</p><span id="applications" class="explainer_text">Talk to iDEAL</span>
</a>
        </div>

<div class='col-md-4 col-sm-12 col-lg-3  colarrange'>
<a href="faq.php" title="Frequently Asked Questions" class="col-md-2 buttons">
                <span class="fa fa-question h2"></span>
                  <p>FAQs</p><span id="applications" class="explainer_text">Frequently Asked Questions</span>
</a>
</div>

            </div>
        </div>






                </body>
                
        <?php require_once("partials/footer.php")  ?>
     
        
