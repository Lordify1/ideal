
<?php

    error_reporting(E_ALL);
    require_once("business_guard.php");
    require_once("classes/Business.php");
    require_once "classes/General.php";
    require_once "classes/Payment.php";


    $business = $business->get_userbyid($_SESSION["business_is_online"]);

    $title = $_GET["t"];

    $data = $general->project_by_title($title);

    $project = $payment->get_payment($title);

   
    

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
                
      
            <div class="form-control formee" id="payment">

          
          <h2 class="text-end py-2">Payment for Project <?php echo $title ?></h2>
          
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
            
        if(isset($_SESSION["payment_input_success"])){
                echo "<div class='alert alert-success'>" . $_SESSION["payment_input_success"] . "</div>"; 
                unset( $_SESSION["payment_input_success"]);
            }
        
        ?>
    </p>
        
    <p>
        <?php
            
        if(isset($_SESSION["error_paying"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_paying"] . "</div>"; 
                unset( $_SESSION["error_paying"]);
            }
        
        ?>
    </p>
            

        

          <div class=' my-1'>
            
          <div class="container-fluid" style="border:2px solid black; padding:20px">
            <div class="row">
                <div class="col">
                    <h1>Confirm Payment</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Email address : <b> <?php echo $business["business_email"]; ?></b></p>
                    <p>Project name : <b><?php echo $title; ?></b></p>
                    <p>Amount to Pay : <b>&#8358;<?php echo number_format($project["pp_amt"]);?>.00</b></p>
                    <a href="process/confirm_payment.php?t=<?php echo $title ?>" class="btn btn-success" name="payconfirm">Pay Now</a>
                </div>
            </div>
          </div>
        </body>
        <!-- footer section starts here -->


        </div>
        </div>

        <?php// include("partials/footer.php")  ?>
    
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







 

