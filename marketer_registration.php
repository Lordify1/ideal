<main>
<?php
    error_reporting(E_ALL);
    require_once("classes/Marketer.php");
    $states = $market->fetch_states();
    session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MARKETER REGISTRATION</title>
    

    <style>
       
   div{
       border:0px solid red;
       
       
   }
    
    
   main{
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

    .error {
            color: red;
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
   

<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
    <div class="container-fluid">
        <div class="row marketerformrow">
            <div class="col-md-6">
               
               <h2 class="text-white text-end form-push">Marketer Sign Up</h2>
                
                <form method="post" action="process/marketer_reg_process.php"  id="marketingform" class="form-control mx-auto border-dark formee">
                <p><?php

if(isset($_SESSION["error_message"])){
  echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
  unset($_SESSION["error_message"]);
}

?></p>

                <h2 class="text-white text-start my-3 form-header-sm">Marketer Sign Up</h2>
                
                 <!-- <p id="message"></p> -->

                    <label class="form-label  " for="fname">First name</label>
                    <input class="form-control" type="name" name="fname" id="fname" required>
                    <p id="fnamerror" class="error text-warning">Name is too short</p>
                    <label class="form-label  " for="lname">Last Name</label>
                    <input class="form-control" type="name" name="lname" id="lname" required>
                    <p id="lnameerror" class="error text-warning">Name is too short</p>
                    <label class="form-label  " for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" required>

                    <label class="form-label  " for="email">Gender</label><br>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Please select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <label class="form-label" for="location">State</label>
                    <select id="state" name="state" class="form-control" >
                        <?php foreach($states as $state){ ?>

                            <option value="<?php echo $state["state_id"] ?>"><?php echo $state["state_name"]; ?></option>

                        <?php } ?>
                    </select><br>
                    
                    <label class="form-label" for="lgas">Local Government Area</label>
                    <select id="lgas" name="lgas" class="form-control" >
                        
                    </select><br>

                    <label class="form-label " for="pwd">Password</label>
                    <input type="password" class="form-control mb-3 " name="pwd" id="pwd" placeholder="" required>
                    <p id="pwderror" class="error text-warning">Password is too short</p>

                    <label class="form-label " for="confpwd">Confirm Password</label>
                    <input type="password" class="form-control mb-3 " name="confpwd" id="confpwd" required>
                    <p id="confpwderror" class="error text-warning">Passwords does not match</p>
                    <p id="confpwderror_two" class="error text-warning">Passwords fields should be filled</p>

         <input type="checkbox" name="agreement" value="agreed" id="agreement" class="form-input-checkbox" required> I agree to iDEAL <a href="tandc.php" class="text-decoration-none">terms and conditions</a>
                   

         <input type="submit" class="btn text-black d-block mt-4" name="submit_btn" id="submit_btn" value="Register"  style="background-color: #00ff00; font-weight: bold; ">       
                </form>
            </div>
        </div>
    </div>

        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    
    


    <script>

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

        
        $('#fname').on('input', function () {
                // Get the value of the input
                var fname = $(this).val();

                // Check the length and show/hide the error message
                if (fname.length <= 1) {
                    $('#fnamerror').show();   
                } else {
                    $('#fnamerror').hide();
                }
            });
            $('#lname').on('input', function () {
                // Get the value of the input
                var lname = $(this).val();

                // Check the length and show/hide the error message
                if (lname.length <= 1) {
                    $('#lnameerror').show();
                } else {
                    $('#lnameerror').hide();
                }
            });
            $('#pwd').on('input', function () {
                // Get the value of the input
                var pwd = $(this).val();

                // Check the length and show/hide the error message
                if (pwd.length < 8) {
                    $('#pwderror').show();
                } else {
                    $('#pwderror').hide();
                }
            });
            $('#confpwd').on('input', function () {
                // Get the value of the input
                var confpwd = $(this).val();
                var pwd = $("#pwd").val();
                // Check the length and show/hide the error message
                if (pwd != null && confpwd != pwd) {
                    $('#confpwderror').show();
                } else{
                    var pwd = $("#pwd").val();
                    $('#confpwderror').hide();
                }
            });
    });
</script>
</main>