

<?php
    error_reporting(E_ALL);
    session_start();
    require_once("admin_guard.php");
    require_once("classes/payment.php");

    
    $pending_payments = $payment->pending_payments_complete(); 
    $completed_payments = $payment->completed_payments_complete(); 
    


    //$pays = $payment->payment_by_title();


    require_once("partials/header.php");
?>

<style>
          @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5em;
        }

        .accordion{
          margin:0px;
        }
      }

</style>
        <div id="layoutSidenav">
            
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main class="addmain">

  <div class="container-fluid px-4">
                      <div class="row">
                          <div class="col">
                      <h3>Payments</h3>   
            <?php   
            
              if(isset($_SESSION["error_message"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
                unset ($_SESSION["error_message"]);
              }
            
            ?>

<?php   
            
            if(isset($_SESSION["success_message"])){
              echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
              unset ($_SESSION["success_message"]);
            }
          
          ?>

<?php   
            
            if(isset($_SESSION["payment_has_been_completed"])){
              echo "<div class='alert alert-success'>" . $_SESSION["payment_has_been_completed"] . "</div>";
              unset ($_SESSION["payment_has_been_completed"]);
            }
          
          ?>


<?php   
            
            if(isset($_SESSION["payment_complete_error"])){
              echo "<div class='alert alert-success'>" . $_SESSION["payment_complete_error"] . "</div>";
              unset ($_SESSION["payment_complete_error"]);
            }
          
          ?>
  <!-- modal for payment_s -->

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="payment" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="paymentModalLabel">Pay Joshua</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body signupmodalbody">
        <div class="col">
        <a href="marketer_registration.php"><img src="images/marketer.jpg" class="img-fluid popupimgchoose1" alt="">
        <button class="btn btn-sm">MARKETER</button></a>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- modal for payment_s -->       

<div class="accordion mt-3" id="accordionExample">

<div class="accordion-item">
    <h2 class="accordion-header" id="marketerTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemarketerTwo" aria-expanded="false" aria-controls="collapsemarketerTwo">Pay Marketers
      </button>
    </h2>
    <div id="collapsemarketerTwo" class="accordion-collapse collapse" aria-labelledby="marketerTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
          
            <div class="col">
            <label for="target_payment_email">Marketer email</label>
          <input type="email" name="target_payment_email" id="target_payment_email" class="form-control">

          <label for="target_payment_method">Payment method</label>
          <input type="text" name="target_payment_method" id="target_payment_method" class="form-control">

          <label for="target_payment_details">Payment details</label>
          <input type="text" name="target_payment_details" id="target_payment_details" class="form-control">

          <button class='btn btn-success mt-2' >Pay</button>
            </div>

      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="pending">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsepending" aria-expanded="false" aria-controls="collapsepending">
          Pending Payments
          &nbsp;
      <?php $data = $payment->pending_payments_complete();

        $pending = count($data);

        if(!$pending == null){
        ?>
        <span class="badge bg-warning mb-1">
          <?php echo $pending ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapsepending" class="accordion-collapse collapse" aria-labelledby="pending" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table table-striped table-warning border-white">
    <thead>
        <th>S/N</th>
        <th>Amt</th>
        <th>Date</th>
        <th>Business</th>
        <th>Project</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php $sn = 1;
        foreach($pending_payments as $pending){     
      ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td>&#8358;<?php echo number_format($pending["pp_amt"]) ?>.00</td>
            <td><?php echo $pending["payment_date"] ?></td>
            <td><?php echo $pending["business_email"] ?></td>
            <td><?php echo $pending["project_title"] ?></td>
            <form action="process/payment_two.php" method="post">
            <td>
            <div class="btn-group">
              <input type="hidden" name="ref" value="<?php echo $pending["transaction_id"] ?>">
              <button class="fa fa-face-smile btn btn-success" name="complete"></button>
            </div>
            </td>
            </form>
        </tr>
        <?php } ?>
    </tbody>
    </table>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="completed">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecompleted" aria-expanded="false" aria-controls="collapsecompleted">
          Completed Payments
          &nbsp;
      <?php $data = $payment->completed_payments_complete();

        $pending = count($data);

        if(!$pending == null){
        ?>
        <span class="badge bg-success mb-1">
          <?php echo $pending ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapsecompleted" class="accordion-collapse collapse" aria-labelledby="completed" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table table-striped table-success border-white">
    <thead>
        <th>S/N</th>
        <th>Amt</th>
        <th>Date</th>
        <th>Business</th>
        <th>Project</th>
    </thead>

    <tbody>
      <?php $sn = 1;
        foreach($completed_payments as $complete){     
      ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td>&#8358;<?php echo number_format($complete["pp_amt"]) ?>.00</td>
            <td><?php echo $complete["payment_date"] ?></td>
            <td><?php echo $complete["business_email"] ?></td>
            <td><?php echo $complete["project_title"] ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
      </div>
    </div>
  </div>
    </div>
  </div>
  </div>
                      
                          </div>
                      </div>
                        
                    </div>


                </main>

<?php

    require_once("partials/footer.php");

?>


<script>

      $("document").ready(function(){
        $("#search_m").change(function(){
          var search = $("#search_m").val();
          var data = "payment_s="+search;
          var url = "process/action.php";
          $.get(url,data);
        })
      })


</script>