<main id="businessformcontainer">
<?php
    error_reporting(E_ALL);
    require_once("classes/Business.php");
    session_start();
    $states = $business->fetch_states();


?>

    <title>BUSINESS REGISTER</title>


<style>
       
   div{
       border:0px solid red;
       
       
   }

   .error {
            color: red;
            display: none;
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
<body >

<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>

    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
  
    <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        
    <div class="container-fluid businessformcontainer">
        <div class="row businessformrow">
            <div class="col-md-5"> 
                
         <form class="form-control formee" id="businessform" method="POST" action="process/business_reg_process.php">
            
         <p><?php

if(isset($_SESSION["error_message"])){
  echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
  unset($_SESSION["error_message"]);
}

?></p>
         <h2 class="text-white text-center py-2">Business Sign Up</h2> 

            <label class="form-label" for="compname">Company name</label> 
            <input type="text" class="form-control" name="compname" id="compname" required>
            <p id="compnameerror" class="error text-warning">Name is too short</p>
            
            
            <label class="form-label" for="compemail">Company Email</label> 
            <input type="email" class="form-control" name="compemail" id="compemail" required>
            <p id="compemailerror" class="error text-warning">Email is too short</p>


            <label class="form-label">Company State</label> 
            <select name="state" id="state" class="form-control">
                <?php foreach($states as $state){ ?>
            <option value="<?php echo $state["state_id"] ?>"><?php echo $state["state_name"] ?></option>
                <?php } ?>
            </select>


            <label class="form-label">Company LGA</label> 
            <select name="lgas" id="lgas" class="form-control">
                
            </select>

            <label class="form-label" for="comppassword">Password</label> 
            <input type="password" class="form-control" name="comppassword" id="comppassword" required>
            <p id="comppassworderror" class="error text-warning">Password is too short</p>
        
            <label class="form-label" for="confirmpwd">ConfirmPassword</label> 
            <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" required>
            <p id="comfirmpassworderror" class="error text-warning">Passwords do not match</p>

            <input type="checkbox" name="" id="agreement" class="form-input-checkbox" required> I agree to iDEAL <a href="#" class="text-decoration-none">terms</a> and <a href="#" class="text-decoration-none ">conditions</a>
            
            
            <input type="submit" id="business_reg" name="business_reg" value="Register" class="btn mx-1 my-4 d-block" style="background-color: #0066cc; color: white;">
             
             
         </form> 
            </div>
        </div>
    </div>


        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    


    <script type="text/javascript">        
            
    $(document).ready(function () {
        // Handle change event of the state select
        $('#state').change(function () {
            var selectedStateId = $(this).val(); // Get the selected state id

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


        $('#compname').on('input', function () {
                // Get the value of the input
                var compname = $(this).val();

                // Check the length and show/hide the error message
                if (compname.length <= 1) {
                    $('#compnameerror').show();   
                } else {
                    $('#compnameerror').hide();
                }
            });
            $('#compemail').on('input', function () {
                // Get the value of the input
                var compemail = $(this).val();

                // Check the length and show/hide the error message
                if (compemail.length <= 1) {
                    $('#compemailerror').show();
                } else {
                    $('#compemailerror').hide();
                }
            });
            $('#comppassword').on('input', function () {
                // Get the value of the input
                var comppassword = $(this).val();

                // Check the length and show/hide the error message
                if (comppassword.length < 8) {
                    $('#comppassworderror').show();
                } else {
                    $('#comppassworderror').hide();
                }
            });
            $('#confirmpwd').on('input', function () {
                // Get the value of the input
                var comfirmpassworderror = $(this).val();
                var comppassword = $("#comppassword").val();
                // Check the length and show/hide the error message
                if (comppassword != null && comfirmpassworderror != comppassword) {
                    $('#comfirmpassworderror').show();
                } else{
                    var comppassword = $("#comppassword").val();
                    $('#comfirmpassworderror').hide();
                }
            });
    });
</script>

</body>
</html>
</main>








 

