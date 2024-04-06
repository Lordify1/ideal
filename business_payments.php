<body id="profilebody">
<?php

    require_once("business_guard.php");
    require_once("partials/header.php");
    require_once("classes/Business.php");
    
    $data = $business->get_userbyid($_SESSION["business_is_online"]);
    $id = $data["business_id"];
    $email = $data["business_email"];
    $pending_payments = $business->pending_payments($email);
    $completed_payments = $business->completed_payments($email);
    $cancelled_payments = $business->cancelled_payments($email);
    $refund = $business->refund($email);

?>

    <title>Payments</title>


   <style>
        

        @media screen {
          
        }

        @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5em;
        }
        }
        
   </style>

        <!-- Navigation section start -->
        
    <!-- Navigation section end -->


<?php  if(isset($_SERVER["HTTP_REFERER"])){ ?>


<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
        <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
      </div>

<?php } ?>
        
    <div style="height:3vh"></div>
    <?php require_once("partials/menu.php") ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="pending_payment"><h6>PENDING</h6></a>
              <a class="btn animate__animated animate__fadeIn" id="completed_payment"><h6>COMPLETED</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="cancelled_payment"><h6>CANCELLED</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="refund"><h6>REFUND</h6></a>
            </div>
          </div>
        </div>

<?php if(!$pending_payments == null){ ?>
      <div id="pending">
        <table class="table table-striped p-2 table-warning">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Project</th>
            <th>Payment percentage</th>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($pending_payments as $pending_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td>&#8358;<?php echo number_format($pending_payment["pp_amt"]) ?>.00</td>
                    <td><?php echo $pending_payment["payment_date"] ?></td>
                    <td><?php echo $pending_payment["project_title"]  ?></td>
                    <td><?php echo $pending_payment["pp_percentage"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
   <?php }else{ ?>

    <div class="col" id="pending">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no pending payments at the moment</p>
      </div>

<?php } ?>

<?php if(!$completed_payments == null){ ?>
      <div id="completed">
        <table class="table table-striped p-2 table-warning">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Project</th>
            <th>Payment percentage</th>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($completed_payments as $completed_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td>&#8358;<?php echo number_format($completed_payment["pp_amt"]) ?>.00</td>
                    <td><?php echo $completed_payment["payment_date"] ?></td>
                    <td><?php echo $completed_payment["project_title"]  ?></td>
                    <td><?php echo $completed_payment["pp_percentage"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
   <?php }else{ ?>

    <div class="col" id="completed">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no completed payments at the moment</p>
      </div>

<?php } ?>

<?php if(!$cancelled_payments == null){ ?>
      <div id="cancelled">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Project</th>
            <th>Payment percentage</th>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($cancelled_payments as $cancelled_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td>&#8358;<?php echo number_format($cancelled_payment["pp_amt"]) ?>.00</td>
                    <td><?php echo $cancelled_payment["payment_date"] ?></td>
                    <td><?php echo $cancelled_payment["project_title"]  ?></td>
                    <td><?php echo $cancelled_payment["pp_percentage"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
   <?php }else{ ?>

    <div class="col" id="cancelled">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no cancelled payments at the moment</p>
      </div>

<?php } ?>


<?php if(!$refund == null){ ?>
      <div id="ref">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Project</th>
            <th>Payment percentage</th>
            </thead>
            <tbody>
              <?php $sn = 1; foreach($refund as $ref){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td>&#8358;<?php echo number_format($ref["pp_amt"]) ?>.00</td>
                    <td><?php echo $ref["payment_date"] ?></td>
                    <td><?php echo $ref["project_title"]  ?></td>
                    <td><?php echo $ref["pp_percentage"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
   <?php }else{ ?>

    <div class="col" id="ref">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no refund at the moment</p>
      </div>

<?php } ?>

  
   </body>
        <?php require_once("partials/footer.php")  ?>
        
        <script>

$(document).ready(function(){
  $("#cancelled").hide();
  $("#completed").hide();
  $("#ref").hide();

  $("#pending_payment").click(function(){
    $("#pending").show();
    $("#cancelled").hide();
    $("#completed").hide();
    $("#ref").hide();

  })

  $("#completed_payment").click(function(){
    $("#completed").show();
    $("#cancelled").hide();
    $("#pending").hide();
    $("#ref").hide();
  })

  $("#cancelled_payment").click(function(){
    $("#cancelled").show();
    $("#completed").hide();
    $("#pending").hide();
    $("#ref").hide();
  })

  $("#refund").click(function(){
    $("#cancelled").hide();
    $("#completed").hide();
    $("#pending").hide();
    $("#ref").show();
  })
})

</script>
 