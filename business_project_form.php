
<?php

    error_reporting(E_ALL);
    require_once("business_guard.php");
    require_once("classes/Business.php");

    $industries = $business->fetch_industry();
    $skills = $business->fetch_skills();
    $levels = $business->fetch_level();
    $states = $business->fetch_states();
    $data = $business->get_userbyid($_SESSION["business_is_online"]);

    // if(isset($_SESSION["previous_inputs"]))
    // {
    //   $data = 
    // }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>BUSINESS PROECT FORM</title>
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

<main class="business_project_bg">

    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->

    <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="business_dashboard.php" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        
        <div class="col m-2"></div>
    <div class="container-fluid">
        <div class="row businessprojectsrow">
            <div class="col-lg-5">
                
      
      <form action="process/project_process.php" method="post" class="form-control formee" id="businessprojects">
          
          <h2 class="text-end py-2">Project Information</h2>
          
          <p>
        <?php
            
        if(isset($_SESSION["error_message"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>"; 
                unset( $_SESSION["error_message"]);
            }
        
        ?>
    </p>
    <p id="loadered"></p>
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
            
        if(isset($_SESSION["could_not_create_project"])){
                echo "<div class='alert alert-success'>" . $_SESSION["could_not_create_project"] . "</div>"; 
                unset( $_SESSION["could_not_create_project"]);
            }
        
        ?>
    </p>
          
            
          
        

          <div class=' my-1'>
            
            <details>
            <p>ALERT: You'll be required to make a 30% payment of the total amount for this project. The sum of this is a multiplication of the offer amount by total marketers needed</p>
            </details>
           <label class="form-label" for="protitle">Project Name (Must be unique)</label>
          <input type="text" class="form-control" name="protitle" id="protitle" placeholder="Input a new name for this project">
              <button type="submit" name="check_availability" id="check_availability" class="btn btn-primary">Check Title</button>
          </div>
          
          <div class='my-1'>
          <label class="form-label" for="prodesc">Project Description</label>
          <textarea class="form-control" name='prodesc' style="height: 100px;" id="prodesc"></textarea>
          </div>
          
          <input type="hidden" name="business_id" value="<?php echo $data["business_id"] ?>">
          
          <div class='my-1'>
          <label class="form-label" for="progoals">Project Goals and Objective</label>
          <textarea class="form-control" name='progoals' style="height: 100px;" id="progoals"></textarea>
          </div>

          
          <div class='my-1'>
          <label class="form-label" for="proaudience">Target Audience</label>
          <textarea class="form-control" style="height: 100px;" id="proaudience" name='proaudience'></textarea>
          </div>

          
          <div>
          <label class="form-label d-block" for="prooffer">Project Monetary Offer</label>
          </div>
          <div class='input-group my-1'>
          <span class="input-group-text">&#8358;</span>
          <input type="tel" class="form-control" name="prooffer" placeholder="Per marketer" id="prooffer" aria-label="Amount (to the nearest naira)">
          <span class="input-group-text">.00</span>
          </div>


          <div class='my-3'>
          <label class="form-label" for="prodeadline">Deadline</label>
          <input type="date" class='form-control' name="prodeadline" id="prodeadline">
          </div>

            <hr>

          <div class='my-2'>
          <label class="form-label" for="state">State</label>
          <select name="state" id="state" class='form-control'>
            <option value="">Please select</option>
            <?php foreach($states as $state){ ?>
            <option value='<?php echo $state["state_id"] ?>'><?php echo $state["state_name"] ?></option>
            <?php } ?>
          </select>
          </div>

          <div class='my-2'>
            <label for="lgas">LGA</label>
            <select name="lgas" class='form-control' id="lgas">
            
            </select>
          </div>


          <hr>


          <div class='my-3'>
            <label for="proindustry" class='p-1'>Project Industry</label>
          <select name="proindustry" class="form-control" id="proindustry">
          <option value="">Please select</option>
            <?php foreach($industries as $industry){ ?>
            <option value='<?php echo $industry["industry_id"] ?>'><?php echo $industry["industry_name"] ?></option>
            <?php } ?>
          </select>
          </div>


          
          <div class='my-3'>
          <label class="form-label" for="skills">Specific Skills or Expertise Needed</label><br>
          <?php foreach($skills as $skill){ ?>
          <input type="checkbox" value='<?php echo $skill["skill_id"] ?>' name="skills[]" id="skills" class="form-input-checkbox"><?php echo $skill["skill_name"] ?><br>
          <?php } ?>
          </div>


          <div class='my-2'>
            <label for="">Experience level</label>
            <select name="experience" id="experience" class='form-control'>
            <option value="">Please select</option>
                <?php foreach($levels as $level){ ?>
                <option value='<?php echo $level["experience_id"] ?>'><?php echo $level["experience_name"] ?></option>
                <?php } ?>
            </select>
          </div>

          <hr>

          
          <div class="my-2">
            <label class="form-label">Preferred Communication Methods</label> <br>
          <input type="radio" name="procomm" id="procomm" class="form-check-input" value='Phone'> <span class="form-check-label">Phone</span>

          <input type="radio" name="procomm" id="procomm" class="form-check-input" value='Email'> <span class="form-check-label">Email</span> <br>
          </div>


          <div class="my-2">
          <label class="form-label" for="no_of_marketers">Number Of Marketers Needed</label>
          <input type="number" class="form-control" id="no_of_marketers" name='no_of_marketers'>
          </div>

          <div class="my-2">
          <label class="form-label" for="proefforts">Previous Marketing Efforts (if applicable)</label>
          <textarea class="form-control" style="height: 60px;" id="proefforts" name='proefforts'></textarea>
          </div>
          
          
          <div class="my-2">
          <label class="form-label" for="procomment">Additional Comments or Requirements</label>
          <textarea class="form-control" style="height: 100px;" id="procomment" name='procomment'></textarea>   
          </div>
          
          <button name='project_submit' id='project_submit' value='project_submit' class="btn col-12 btn-success my-2">Submit</button>
          </form>
      
              
            </div>
        </div>
    </div>

                </main>
        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    

    <script src="js/bootstrap.bundle.js"></script>

    <script>
      $(document).ready(function()
      {
        $("#proimage").click(function()
        {
          alert("File type must be image | We only accept jpeg, jpg and png | File size must not be greater than 2mb");
        })
      })

      $(document).ready(function () {
        // Handle change event of the state select
        $("#state").change(function(){
            var selectedStateId = $("#state").val(); // Get the selected state id

            // Make AJAX request to fetch LGAs
            $.ajax({
                url: 'process/general_process.php', // Change this to the actual processing page
                method: 'POST',
                data: { stateId: selectedStateId }, // Send the selected state id to the server
                dataType: 'json',
                success: function (data) {
                    // Clear existing options
                    $('#lgas').empty();

                    // Populate options for LGAs
                    $.each(data, function (index, item) {
                        $('#lgas').append('<option value="' + item.lga_id + '">' + item.lga_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

          });
      }); 

      $(document).ready(function () {
        
      });
      
    </script>









 

