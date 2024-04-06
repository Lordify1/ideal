<?php  
    error_reporting(E_ALL);
    session_start();

    // && $_SERVER["HTTP_REFERER"] !== "http://localhost/iDEAL/project_view.php?project_view"

    if($_GET && isset($_GET["identifier"])){
        
        $proid = $_GET["identifier"];

    }else{
        header("location:all_projects.php");
    }


    

    if(isset($_SESSION["business_is_online"])){
        $_SESSION["userfeedback"] = "Business can't take on projects";
        header("location:business_dashboard.php");
    }

    if(!(isset($_SESSION["marketer_is_online"]))){
        $_SESSION["userfeedback"] = "You must be logged in as a Marketer";
        header("location:marketer_login.php");
        exit();
    }
   
    require_once("partials/header.php");
    require_once("classes/Marketer.php");
    
    
    $marketer_for_project = $market->get_userbyid($_SESSION["marketer_is_online"]);
    
    
    ?>
    <title>Application Edit</title>

    

    <style>
       
   div{
       border:2px solid red;
   }
    
    
    .navbar{
        list-style-type:none;
    }
    
    input[type=text], input[type=password]{
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    </style>

</head>
<body>

<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        <!-- Navigation section start -->

    <!-- Navigation section end -->
    
    <div class="container-fluid">
        <div class="row marketerprojectsrow">
            <div class="col-md-5">
                
      
      <form action="process/general_process.php" method="post" class="form-control" id="marketerprojects">
        
      <h1 id="me" class="text-white"></h1>
        <h2 class="my-4">Request to take on Project</h2>
        

        <?php
        
        if(isset($_SESSION["error_message"])){
            echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
            unset($_SESSION["error_message"]);
        }
        
        ?>

        <label for="marketerrelevant" class="form-label">1. Relevant Experience</label>
        <textarea id="marketerrelevant" name="marketerrelevant" class="form-control" height="100px" placeholder="What experience do you have that makes you a good fit for this project?"></textarea>

        <input type="hidden" name="unique" value="<?php echo $proid ?>" id="unique">

        <label for="marketerapproach" class="form-label">2. Approach</label>
        <textarea id="marketerapproach" class="form-control" name="marketerapproach" height="100px" placeholder="How do you plan to tackle this project and achieve the desired results?"></textarea>


        <label for="strategy" class="form-label">3. Strategy</label>
        <textarea id="strategy"  name="strategy" class="form-control" height="100px" placeholder="What strategies do you propose to implement for this project?"></textarea>

        <label for="specific_skills" class="form-label">4. Specific Skills</label>
        <textarea id="specific_skills" name="specific_skills" class="form-control" height="100px" placeholder="What specific skills or expertise do you possess that will be valuable for this project?"></textarea>


        <label for="portfolio" class="form-label">5. Portfolio</label>
        <textarea id="portfolio" name="portfolio" class="form-control" height="100px" placeholder="Can you provide examples of similar projects you have worked on in the past?"></textarea>


        <label for="timeline" class="form-label">6. Timeline</label>
        <textarea id="timeline" name="timeline" class="form-control" height="100px" placeholder="What is your expected timeline for completing the project?"></textarea> 


        <label for="communication" class="form-label">7. Communication</label>
        <textarea id="communication" name="communication" class="form-control" height="200px" placeholder="How do you prefer to communicate and collaborate throughout the project?"></textarea>


        <!-- <label for="amount" class="form-label">8. Payment</label>
        <div class='input-group my-1'>
          <span class="input-group-text">&#8358;</span>
          <input type="tel" class="form-control" id="amount" name="amount" aria-label="Amount (to the nearest naira)" placeholder="How much are you charging for your service?" required>
          <span class="input-group-text">.00</span>
        </div> -->
        

        <label for="references" class="form-label">8. References</label>
        <textarea id="references" name="references" class="form-control" height="100px" placeholder="Can you provide references or testimonials from previous clients?"></textarea>


        <label for="additional_information" class="form-label">9. Additional Information</label>
        <textarea id="additional_information" name="additional_information" class="form-control" height="100px" placeholder="Is there anything else you think we should know about your approach to this project?"></textarea>

        <input type="hidden" name="project_id" value='<?php echo $proid ?>'>

        <input type="submit" class="btn text-black d-block mt-4" name="application_submit_btn" id="application_submit_btn" value="Apply" style="background-color: #00ff00; font-weight: bold;">

      </form>
      
      
            </div>
        </div>
    </div>
    

        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    
    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.js"></script>

    <script type="text/javascript">        
            
       $(document).ready(function(){
        
       })
   
    </script>
</body>
</html>








 

