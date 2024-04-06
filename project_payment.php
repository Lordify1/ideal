
<?php

    error_reporting(E_ALL);
    require_once("business_guard.php");
    require_once("classes/Business.php");
    require_once "classes/General.php";


    $business = $business->get_userbyid($_SESSION["business_is_online"]);

    $title = $_GET["t"];

    $data = $general->project_by_title($title);

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Project Payment</title>
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

    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->

    <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="business_dashboard.php" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        
        <div class="col m-2"></div>
    <div class="container-fluid">
        <div class="row businessprojectsrow">
            <div class="col-md-5">
                
      
            <form action="process/input_payment.php" method="post" class="form-control formee" id="payment">

          
          <h2 class="text-end py-2 px-2" style="border:2px solid black">Payment for Project <?php echo $title ?></h2>
          
          <p>
        <?php
            
        if(isset($_SESSION["payment_input_error"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["payment_input_error"] . "</div>"; 
                unset( $_SESSION["payment_input_error"]);
            }
        
        ?>
    </p>

    <p>
        <?php
            
        if(isset($_SESSION["success_image_uploaded"])){
                echo "<div class='alert alert-success'>" . $_SESSION["success_image_uploaded"] . "</div>"; 
                unset( $_SESSION["success_image_uploaded"]);
            }
        
        ?>
    </p>

    <p>
        <?php
            
        if(isset($_SESSION["payment_input_success"])){
                echo "<div class='alert alert-success'>" . $_SESSION["payment_input_success"] . "</div>"; 
                unset( $_SESSION["payment_input_success"]);
            }
        
        ?>
    </p>
          
            
        

          <div class=' my-1'>
            
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <p class="mt-3 mb-3 ">Your project is on it's way to to being live on iDEAL and ready for professional marketers to pick up for greatness</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4 style="border: 2px solid black" class="m-1 p-3 text-danger">IN accordance to our <a href="about_us.php">Terms and Conditions</a> you'll be making a 30% payment of the total amount of the Monetary value of this Project</h4>
                        <p class="mb-2">Below is a total of the amount you'll be paying for this project and the <b class="text-danger">30%</b> you will be paying now</p>
                        <p class="text-danger">NOTE: You'll be refunded if your project isn't approved</p>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="title" value="<?php echo $title ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $business["business_email"] ?>">
                    <input type="hidden" name="proid" id="proid" value="<?php echo $data["project_id"] ?>">
                    <input type="hidden" name="percent" id="percent" value="30%">
                    <input type="hidden" name="ref" id="ref" value="<?php echo uniqid() ?>">
                    <div class="col p-3" style="border:2px solid black">
                        <p>Amount Per Marketer : <b>&#8358;<?php echo number_format($data["offer_amount_range"]) ?>.00</b></p>
                        <p>Number of Marketers Needed : <b><?php echo $data["req_no_of_marketers"] ?></b></p>
                        <p>Total : <b> &#8358;<?php echo number_format($data["offer_amount_range"]) ?>.00 x <?php echo $data["req_no_of_marketers"] ?> = &#8358;<?php $total = $data["offer_amount_range"] * $data["req_no_of_marketers"]; echo number_format($total); ?>.00</b></p>
                        <hr>
                        <p>30% of the Total amount : <b><?php $percentage = pow(0.3,1); $now = $total *= $percentage; ?>&#8358;<?php echo number_format($now) ?>.00</b></p>
                        <p>Amount to be paid on Project Completion : 
                            <b>
                            &#8358;<?php 
                            $total = $data["offer_amount_range"] * $data["req_no_of_marketers"];
                            $sum = $total - $now; echo number_format($sum); 
                            ?>.00
                            </b></p>
                            <input type="hidden" name="amt_left" value="<?php echo $sum ?>">
                        <input type="hidden" name="amt" value="<?php echo $now ?>">
                    </div>
                </div>
            </div>
            </form>
            <!--Login Modal -->

          
          <button type="submit" id="pay" name="pay" class="btn col-12 btn-success my-2">Pay</button>
        
          </form>
           
            </div>
        </div>
    </div>

        </body>
        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    

    <script src="js/bootstrap.bundle.js"></script>

    <script>

        // $(document).ready(function () {
        //     thirty = $("#thirtypercent").html();
        //     email = $("#email").val();
        //     ref = $("#ref").val();
        //     percent = $("#percent").val();
        //     proid = $("#proid").val();
        //     $("#pay").click(function (e) { 
        //         e.preventDefault();
        //         $.ajax({
        //             type: "post",
        //             url: "process/input_payment.php",
        //             data: {thirty : thirty, email : email, ref : ref, percent : percent, proid : proid},
        //             dataType: "html",
        //             success: function (response) {
        //                 alert("Done");
        //             }
        //         });
                
        //     });
        // });

    </script>







 

