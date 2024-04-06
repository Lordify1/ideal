<main class="container-fluid h-100" id="profilebody">
<?php

    require_once("marketer_guard.php");
    require_once("partials/header.php");
    require_once("classes/Marketer.php");
    
    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);


    $pay = $data["marketer_id"];


    $pen_payments = $market->pending_payments($pay);

    $rec_payments = $market->received_payments($pay);

    $canc_payments = $market->cancelled_payments($pay);

    
 
?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>My Payments</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>

   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }


        @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5em;
        }
        }
        
   </style>

        <!-- Navigation section start -->
        
    <!-- Navigation section end -->

    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-4"></span></a>
        </div>
    <div style="height:2vh"></div>
    <?php require_once("partials/menu.php") ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="pending_project"><h6>PENDING</h6></a>
              <a class="btn animate__animated animate__fadeIn" id="completed_project"><h6>COMPLETED</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="cancelled_project"><h6>CANCELLED</h6></a>
            </div>
          </div>
        </div>

      
<?php if(!$pen_payments == null){ ?>

          <div id="pending">
        <table class="table table-striped p-2 table-warning">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Business Name</th>
            </thead>
            <tbody>
            <?php 
            $sn = 1;
            foreach($pen_payments as $pen_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $pen_payment["payment_amt"] ?></td>
                    <td><?php echo $pen_payment["payment_date"] ?></td>
                    <td><?php echo $pen_payment["payment_date"] ?></td>
                    <td><?php echo $pen_payment["business_name"] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>

              <?php }else{ ?>

                <div class="col" id="pending">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no pending payments</p>
      </div>

<?php } ?>


<?php if($rec_payments != null){ ?> 

      <div id="completed">
        <table class="table table-striped p-2 table-success">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Business Name</th>
            </thead>
            <tbody>
            <?php 
            $sn = 1;
            foreach($rec_payments as $rec_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $rec_payment["payment_amt"] ?></td>
                    <td><?php echo $rec_payment["payment_date"] ?></td>
                    <td><?php echo $rec_payment["payment_date"] ?></td>
                    <td><?php echo $rec_payment["business_name"] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
      <?php }else{ ?>

        <div class="col" id="completed">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There are no completed payments</p>
      </div>


<?php } ?>


<?php if($canc_payments != null){ ?>
      <div id="cancelled">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Business Name</th>
            </thead>
            <tbody>
            <?php 
            $sn = 1;
            foreach($canc_payments as $canc_payment){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $canc_payment["payment_amt"] ?></td>
                    <td><?php echo $canc_payment["payment_date"] ?></td>
                    <td><?php echo $canc_payment["payment_date"] ?></td>
                    <td><?php echo $canc_payment["business_name"] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>

      <?php }else{ ?>

        <div class="col" id="cancelled">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>


<?php } ?>


      </main>
        <?php require_once("partials/footer.php")  ?>
        
        <script>

$(document).ready(function(){
  $("#cancelled").hide();
  $("#completed").hide();

  $("#pending_project").click(function(){
    $("#pending").show();
    $("#cancelled").hide();
    $("#completed").hide();
  })

  $("#completed_project").click(function(){
    $("#completed").show();
    $("#cancelled").hide();
    $("#pending").hide();
  })

  $("#cancelled_project").click(function(){
    $("#cancelled").show();
    $("#completed").hide();
    $("#pending").hide();
  })
})

</script>
 