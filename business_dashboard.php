<body id="profilebody" class="contaier-fluid h-100">
<?php
   require_once("business_guard.php");

    require_once("partials/header.php");
    require_once("classes/Business.php");
   
    $data = $business->get_userbyid($_SESSION["business_is_online"]);

    

?>

<meta charset="UTF-8">
    <title><?php echo $data["business_name"] ?> Dashboard</title>

   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }
   </style>
        <!-- Navigation section start -->
        
    <!-- Navigation section end -->

    <?php 

if(isset($_SERVER["HTTP_REFERER"])){ ?>

  <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
      <a href="<?php 
      
      echo $_SERVER["HTTP_REFERER"]; ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
    </div>

  <?php  } ?>


<?php

if(isset($_SESSION["success_message"])){
  echo  "<div class='alert alert-success'>" . $_SESSION["success_message"]. "</div>";
  unset($_SESSION["success_message"]);
}
?>


<?php

if(isset($_SESSION["half_payment_completed"])){
  echo  "<div class='alert alert-success'>" . $_SESSION["half_payment_completed"]. "</div>";
  unset($_SESSION["half_payment_completed"]);
}
?>


<?php

if(isset($_SESSION["error_message"])){
  echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"]. "</div>";
  unset($_SESSION["error_message"]);
}
?>
    
    <div style="height:3vh"></div>
        <header class="dashboardnav">
            <section class="col-md-11">
            <h4 style="font-size:1vm" class='ms-3 text-white'><?php echo $data["business_name"] ?> dashboard</h4>
            
            </section>
            <section class="col-md-1">
            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img
                <?php
              $logo = $business->get_logo($data["business_id"]);

              if(!$logo["business_logo"] == null)
              { ?>
               
               src = "images/business_logo/<?php echo $logo["business_logo"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?> 
                alt="mdo" width="50" height="50" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small ">
                <li><a class="dropdown-item" href="business_profile.php">Profile</a></li>
                <!-- <li><a class="dropdown-item" href="profile.php">Change Theme</a></li> -->
                <li><a class="dropdown-item" href="business_image_upload.php">Update Logo</a></li>
                <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
              </ul>
            </div>
            </section>
        </header>

        
        


        <div class="container">
            <div class="row dashsections text-center p-4">
                
            <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
            <a href="business_profile.php" title="View and Edit you profile" class="buttons">
                 <span class="fa fa-user h2"></span>
                  <p>Edit Profile</p><span class="explainer_text">View and Edit you profile</span>
                </a>
            </div>

            <?php 
              if($data['business_status'] == 'active'){
              ?>
               <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="business_project_form.php" title="Initiate a Project for your business" class="buttons">
                  <span class="fa fa-pen-to-square h2"></span>
                    <p>Create Projects</p><span id="projects" class="explainer_text">Initiate a Project for your business</span></a>
               </div>


               <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="business_projects.php" title="Your business projects History" class="buttons">
                <?php
                    
                    $alert = $business->active_projects($_SESSION["business_is_online"]);

                    $project = count($alert);
                    if($project > 0)
                    { ?>

                    <span class="badge bg-danger mb-1">
                      <?php echo $project ?>
                    </span>
                    <?php
                    }

                  ?>
                  <span class="fa fa-business-time h2"></span>
                    <p>Recent Projects</p><span id="applications" class="explainer_text">Your business projects History</span> 
                </a>
               </div>
               
            <?php }else{ ?>

              <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                  <span title="Complete your profile" class="text-secondary">
                    <span class="fa fa-pen-to-square h2"></span>
                      <p>Create Projects</p><span id="projects" class="explainer_text">Initiate a Project for your business</span></span>
                </div>


                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                  <span title="Complete your profile" class="text-secondary">
                    <span class="fa fa-business-time h2"></span>
                      <p>Recent Projects</p><span id="applications" class="explainer_text">Your business projects History</span> 
                  </span>
               </div>

            <?php } ?>

                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="all_marketers.php" title="View Marketers on iDEAL" class="buttons">
                <span class="fa fa-users h2"></span>
                  <p>Marketers</p><span id="applications" class="explainer_text">View Marketers on iDEAL</span> 
</a>
                </div>

                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="business_applications.php" title="View applications " class="buttons">
                  <?php
                  
                    $alert = $business->get_applications_pending($_SESSION["business_is_online"]);

                    $application = count($alert);
                    if($application > 0)
                    { ?>

                    <span class="badge bg-danger mb-1">
                      <?php echo $application ?>
                    </span>
                    <?php
                    }

                  ?>
                <span class="fa fa-inbox h2"></span>
                  <p>Applications</p><span id="applications" class="explainer_text">View applications you received</span> 
</a>
                </div>


                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="all_business.php" title="View Other Businesses on iDEAL" class="buttons">
                <span class="fa fa-building h2"></span>
                  <p>Businesses</p><span id="applications" class="explainer_text">View Other Businesses on iDEAL</span> 
</a>
                </div>


                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                <a href="business_payments.php" title="View Payments history" class="buttons">
                <?php
                  
                  $alert = $business->pending_payments($_SESSION["business_is_online"]);

                  $payment = count($alert);
                  if($payment > 0)
                  { ?>

                  <span class="badge bg-danger mb-1">
                    <?php echo $payment ?>
                  </span>
                  <?php
                  }

                ?>
                  <span class="fa fa-money-bill h2"></span>
                  <p>Payments</p><span id="payments" class="explainer_text">View Payments history</span> 
</a>
                </div>


            <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
              <a href="all_projects.php" title="All Projects on iDEAL" class="buttons">
                <span class="fa fa-briefcase h2"></span>
                  <p>iDEAL Projects</p><span id="applications" class="explainer_text">All Projects on iDEAL</span> 
</a>
            </div>

                


                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                 <a href="blog.php" title="The iDEAL blog for you" class="buttons">
                <span class="fa fa-blog h2"></span>
                  <p>The iDEAL Blog</p><span id="applications" class="explainer_text">The iDEAL blog for you</span> 
</a> 
                </div>


                <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
                 <a href="message_ideal.php" title="Get in touch with iDEAL" class="buttons">
                <span class="fa fa-comments h2"></span>
                  <p>Chat iDEAL</p><span id="applications" class="explainer_text">Get in touch with iDEAL</span> 
</a> 
                </div>


            <div class="col-md-4 col-sm-12 col-lg-3 colarrange">
            <a href="faq.php" title="Frequently Asked Questions" class="buttons">
                <span class="fa fa-question h2"></span>
                  <p>FAQs</p><span id="applications" class="explainer_text">Frequently Asked Questions</span>  
</a>  
            </div>


            </div>
        </div>

                </body>
        <?php require_once("partials/footer.php")  ?>
        

 