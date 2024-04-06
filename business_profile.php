<main id="bodiee">
<?php
    error_reporting(E_ALL);
    require_once("classes/Business.php");
    require_once("business_guard.php");

    $states = $business->fetch_states();
    $lgas = $business->fetch_lga();
    $levels = $business->fetch_level();
    $industries = $business->fetch_industry();
    $skills = $business->fetch_skills();
    $data = $business->get_userbyid($_SESSION["business_is_online"]);
    $business_id = $data["business_id"];
    $categories = $business->fetch_category();
    $industry = $business->get_industry($business_id);


    $selected_skills = $business->desired_skills($business_id);

    $ids_in_order = [];
    foreach($selected_skills as $selected_skill){
    array_push($ids_in_order, $selected_skill["skill_id"]);
    } 


    
?>


    <title>Profile Edit</title>

<style>
       
   div{
       border:0px solid red;
       
       
   }
    
    
    .navbar{
        list-style-type:none;
    }
    
    input[type=text], input[type=password]{
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .formee{
        margin-top:70px;
    }
    
</style>

</head>
<body>

    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="business_dashboard.php" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        
        <div class="col m-2"></div>
    <div class="container-fluid">
        <div class="row businessformrow">
            <div class="col-md-5"> 


        <form action="process/activator.php" method="post">
            <p id="business_activate"></p>
            <h2 class="text-white text-center py-2">Business Profile Update

         
        </h2> 
        </form>    
        
    <form action="process/business_pro_process.php" method="post" id="businessform" class="form-control mx-1 border-dark formee business_profile_formone">
        <p id="business_profile_formone_info"></p>
            <label class="form-label" for="compname">Company name</label> 
            <input type="text" class="form-control" name="compname" id="compname" value="<?php echo $data["business_name"] ?>"> 
            
            <label class="form-label" for="compemail">Company email</label> 
            <input type="text" class="form-control" name="compemail" value="<?php echo $data["business_email"] ?>" id="compemail" readonly>
            
            <label class="form-label" for="compweb">Company Website (if applicable)</label> 
            <input type="text" class="form-control" name="compweb" id="compweb" value="<?php echo $data["business_website"] ?>">

            <label class="form-label" for="compbio">About</label> 
            <textarea class="form-control" name="compbio" id="compbio" rows="9" col="5"><?php echo $data["about_business"] ?></textarea>

            <label class="form-label" for="comphone">Company Phone</label> 
            <input type="tel" class="form-control" name="comphone" value="<?php echo $data["business_phone_no"] ?>" id="comphone" >
            
        <label class="form-label" for="">Company Address</label> 
            <input type="text" class="form-control" name="compaddress" id="compaddress" value="<?php echo $data["business_address"] ?>"> 

            <label class="form-label mt-2" for="state">State</label>
                    <select id="state" name="state" class="form-control">
                    <?php 
            if($data["state_id"] != null){
            ?>
            <option value="<?php echo $data["state_id"] ?>">
                <?php 
                $stated = $business->business_state($data["state_id"]);
                
                echo $stated["state_name"];
                ?>
            </option>
            <option value=""></option>
            <?php } ?>
            
                        <?php foreach($states as $state){ ?>
                            
                            <option value="<?php echo $state["state_id"] ?>"><?php echo $state["state_name"]; ?></option>

                        <?php } ?>
                    </select><br>
        <label class="form-label mt-2" for="lgas">LGA</label>   
                <select name="lgas" id="lgas" class="form-control">
                <?php echo $lgas["lga_name"] ?></option>
                </select>

                    <button class="btn mx-1 my-4 d-block" name="Bus_profile_one" value="Bus_profile_one" id="Bus_profile_one" style="background-color: #0066cc; color: white;">Update</button>
    </form>
            

    <form action="process/business_pro_process.php" method="post" id="businessform" class="form-control mx-1 border-dark formee business_profile_formtwo">
    <p id="business_profile_formtwo_info"></p>
            <label class="form-label" for='pay'>Payment Method</label>
           <select name="pay" id="pay" class="form-control  mb-2">
           <?php $banks = $business->banks(); foreach($banks as $bank){ ?>
            <option value="<?php echo $bank["id"] ?>" <?php if($data["pay_method"] == $bank["id"]) echo 'selected'; ?>><?php echo $bank["name"] ?></option>
            <?php } ?>
           </select>
           </select>

           <label class="form-label" for="a_info">Paypal Email/Account number</label>
           <input type="text" name="a_info" value='<?php echo $data["account_detail"] ?>' id="a_info" class="form-control">

           <button class="btn mx-1 my-4 d-block" name="Bus_profile_two" value="Bus_profile_two" id="Bus_profile_two" style="background-color: #0066cc; color: white;">Update</button>
    </form>   



    <form action="process/business_pro_process.php" method="post" id="businessform" class="form-control mx-1 border-dark formee business_profile_formthree">
    <p id="business_profile_formthree_info"></p>
         <label class="form-label" for="industry">Company industry/niche</label> 
            <select name="industry" id="industry" class="form-control" >
                <?php if($industry["industry_id"] == $data["industry_id"] && !$industry["industry_id"] == null){ ?>
                    <option value="<?php echo $data["industry_id"] ?>"><?php echo $industry["industry_name"] ?></option>
                    <option value=""></option>
                    <?php } ?>
                <?php foreach($industries as $industry){ ?>
                <option value="<?php echo $industry["industry_id"] ?>"><?php echo $industry["industry_name"] ?></option>
                <?php } ?>
            </select>

            <hr>
               
         <label class="form-label" >Desired Skills Needed from Marketers</label> <br>
                    <?php foreach($skills as $skill){ ?>
                    <?php if(in_array($skill["skill_id"], $ids_in_order)){ ?>
                        <input type="checkbox" class=" mx-1" name="skill[]" id="skill"  value='<?php echo $skill["skill_id"]; ?>' checked><?php echo $skill["skill_name"] ?><br>
                    <?php }else{ ?>
                    <input type="checkbox" class=" mx-1" name="skill[]" id="skill"  value='<?php echo $skill["skill_id"]; ?>'><?php echo $skill["skill_name"] ?><br>
                    <?php }
                    } ?>  <br> <br>
            
            <hr>
        
            <label class="form-label" for="cpname">Contact Person's Name</label> 
            <input type="text" class="form-control my-2" name="cpname" id="cpname" value="<?php echo $data["contact_person_name"] ?>">
            
            
            <button class="btn mx-1 my-4 d-block" name="Bus_profile_three" value="Bus_profile_three" id="Bus_profile_three" style="background-color: #0066cc; color: white;">Update</button>
             
             
     </form> 
            </div>
        </div>
    </div>

                </main>
        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    
    
    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.js"></script>

    <script>
    $(document).ready(function () {
        // Handle change event of the state select
        
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


            $("#state").change(function()
            {
                 // Handle change event of the state select
        
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
            })
        });
</script>
</body>
</html>








 

