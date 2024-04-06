<main class="h-100" id="profilebody">
<?php


    require_once("business_guard.php");
    require_once("partials/header.php");
    require_once("classes/Business.php");
    require_once "classes/Payment.php";
    
    $data = $business->get_userbyid($_SESSION["business_is_online"]);



    $active_projects = $business->active_projects($data["business_id"]);


    $pending_projects = $business->pending_projects($data["business_id"]);


    $completed_projects = $business->completed_projects($data["business_id"]);

    $declined_projects = $business->declined_projects($data["business_id"]);



?>

    <title><?php echo $data["business_name"]?> Projects</title>

   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }

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


    <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="business_dashboard.php" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
        
    
    <div style="height:3vh"></div>
        <?php require_once("partials/menu.php"); ?>
        

<div class="container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="active_project"><h6>ACTIVE</h6></a>
              <a class="btn animate__animated animate__fadeInLeft" id="completed_project"><h6>COMPLETED</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="pending_project"><h6>PENDING</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="declined_project"><h6>DECLINED</h6></a>
            </div>
          </div>
        </div>

        <?php
            
            if(isset($_SESSION["error_message"])){
                    echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>"; 
                    unset( $_SESSION["error_message"]);
                }
            
          ?>

        <?php
            
            if(isset($_SESSION["success_message"])){
                    echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>"; 
                    unset( $_SESSION["success_message"]);
                }
            
        ?>

<?php
            
            if(isset($_SESSION["stop_application"])){
                    echo "<div class='alert alert-success'>" . $_SESSION["stop_application"] . "</div>"; 
                    unset( $_SESSION["stop_application"]);
                }
            
          ?>

<?php
            
            if(isset($_SESSION["cant_stop_application"])){
                    echo "<div class='alert alert-danger'>" . $_SESSION["cant_stop_application"] . "</div>"; 
                    unset( $_SESSION["cant_stop_application"]);
                }
            
          ?>

    <?php if(!$active_projects == null){ ?>
      <div id="active">
        <table class="table table-striped p-2 table-warning">
            <thead>
            <th>S/N</th>
            <th>Name</th>
            <th>About</th>
            <th>Timeline</th>
            <th>Offer</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php $sn = 1;
                foreach($active_projects as $active_project){
                  $paid = $payment->get_payment_by_id($active_project["project_id"]); 
            ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $active_project["project_title"] ?></td>
                    <td><?php echo $active_project["project_description"] ?></td>
                    <td><?php echo $active_project["deadline"] ?></td>
                    <td>
                      &#8358;<?php
                       echo number_format($active_project["offer_amount_range"])
                      ?>.00
                      <?php } ?>
                    </td>
                    <td>
                    <button class="fa fa-stop-circle btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#complete_project"></button>
                    <button class="fa fa-stop btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#stop_applications"></button>
                    </td>
                </tr>
                <!-- delete Modal -->
                <form action="process/end_project.php" method="post">
                  <input type="hidden" name="id" value='<?php echo $active_project["project_id"]; ?>'>
                    <input type="hidden" name="status" value="COMPLETED">
<div class="modal fade" id="complete_project" tabindex="-1" aria-labelledby="complete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Is Project Completed?</h5>
        </div>
        <div>
        <button class="btn btn-danger btn-sm" id="complete_project" name="project_status_complete">Yes</button>
        
        </div>
        
        <div>
        <button type="button" class="btn-close btn-sm animate__animated animate__pulse animate__infinite" data-bs-dismiss="modal" id="complete_project" aria-label="Close"></button>
        </div>
      </div>
      </div>
    </div>
</div>
</form>
<!-- delete modal-->
                <!-- delete Modal -->
                <form action="process/stop_applications.php" method="post">
                  <input type="hidden" name="id" value='<?php echo $active_project["project_id"]; ?>'>
                    <input type="hidden" name="status" value="COMPLETED">
<div class="modal fade" id="stop_applications" tabindex="-1" aria-labelledby="complete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Stop receiving applications?</h5>
        </div>
        <div>
        <button class="btn btn-danger btn-sm" id="stop_applications" name="stop_applications">Yes</button>
        
        </div>
        
        <div>
        <button type="button" class="btn-close btn-sm animate__animated animate__pulse animate__infinite" data-bs-dismiss="modal" id="stop_applications" aria-label="Close"></button>
        </div>
      </div>
      </div>
    </div>
</div>
</form>
<!-- delete modal-->
            </tbody>
        </table>
      </div>

      <?php  }else{ ?>

      <div class="col" id="active">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?>    



    <?php if(!$completed_projects == null){ ?>
      <div id="completed">
        <table class="table table-striped p-2 table-success">
            <thead>
            <th>S/N</th>
            <th>Name</th>
            <th>About</th>
            <th>Timeline</th>
            <th>Pay Left</th>
            <!-- <th>Edit</th> -->
            </thead>
            <tbody>
            <?php $sn = 1;
                foreach($completed_projects as $completed_project){
                  $percent = $payment->payment_percentage($completed_project["project_id"]);
                  $paid = $payment->get_payment_by_id($completed_project["project_id"]); 
                  $paid_all = $payment->payment_balanced($completed_project["project_id"]);
            ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $completed_project["project_title"] ?></td>
                    <td><?php echo $completed_project["project_description"] ?></td>
                    <td><?php echo $completed_project["deadline"] ?></td>
                    <td>
                    <?php if(empty($paid_all)){ foreach($paid as $pay){ ?>
                        <a href="complete_project_payment.php?t=<?php echo  $completed_project["project_title"] ?>" class="btn btn-primary btn-sm" style="font-size:0.6rem"> &#8358;<?php
                       echo number_format($pay["amt_left"])
                      ?>.00</a>
                    <?php } }else if($paid_all["pp_status"] == 'PENDING'){ ?>
                       Pending
                    <?php }else if($paid_all["pp_status"] == 'COMPLETED'){ ?>
                      &#8358;0.00
                    <?php } ?>
                    </td>
                    <!-- <td><a href="edit_project.php?bpr=<?php echo $completed_project["project_id"] ?>" name="edit_project" class="fa fa-edit btn btn-primary btn-sm" ></a></td> -->
                </tr>
            <?php   } ?>
            </tbody>
        </table>
      </div>
      <?php  }else{ ?>

      <div class="col" id="completed">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?> 


    <?php if(!$pending_projects == null){ ?>
      <div id="pending">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Name</th>
            <th>About</th>
            <th>Timeline</th>
            <th>Paid</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php $sn = 1;
                foreach($pending_projects as $pending_project){
                $paid = $payment->get_payment_by_id_for_pending_projects($pending_project["project_id"]); 
            ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $pending_project["project_title"] ?></td>
                    <td><?php echo $pending_project["project_description"] ?></td>
                    <td><?php echo $pending_project["deadline"] ?></td>
                    <td>
                      <?php if(!empty($paid)){ foreach($paid as $pay){ ?>
                      &#8358;<?php
                      echo number_format($pay["pp_amt"]);?>.00
                      <?php } }else{ ?>
                        <a  href="project_payment.php?t=<?php echo $pending_project["project_title"] ?>" class="btn btn-danger btn-sm  m-0">Pay</a>
                      <?php } ?>
                    </td>
                    <td>
                  <form action="process/delete_project.php" method="post">
                  <div class="btn-group" role="group">
            <button  name="delete_project" id="deletee" class="fa fa-trash btn btn-danger" ></button>
            <a href="edit_project.php?bpr=<?php echo $pending_project["project_id"] ?>" name="edit_project" class="fa fa-edit btn btn-warning" ></a>
            <input type="hidden" name="deleted" value="<?php echo $pending_project["project_id"] ?>">
          </div>
                  </form>
               </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>
      </div>
      <?php  }else{ ?>

      <div class="col" id="pending">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?> 

    <?php if(!$declined_projects == null){ ?>
      <div id="declined">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Name</th>
            <th>About</th>
            <th>Timeline</th>
            <th>Offer</th>
            </thead>
            <tbody>
            <?php $sn = 1;
                foreach($declined_projects as $declined_project){
                  $paid = $payment->get_payment_by_id($declined_project["project_id"]); 
               
            ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $declined_project["project_title"] ?></td>
                    <td><?php echo $declined_project["project_description"] ?></td>
                    <td><?php echo $declined_project["deadline"] ?></td>
                    <td>&#8358;
                      <?php
                       foreach($paid as $pay){
                       echo number_format($pay["pp_amt"]);
                       ?></td>
                </tr>
            <?php } } ?>
            </tbody>
        </table>
      </div>
      <?php  }else{ ?>

        <div class="col" id="declined">
      <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?> 
</main>

        <?php require_once("partials/footer.php")  ?>
        

 <script>

        $(document).ready(function(){
          $("#pending").hide();
          $("#completed").hide();
          $("#declined").hide();

          $("#active_project").click(function(){
            $("#active").show();
            $("#pending").hide();
            $("#completed").hide();
            $("#declined").hide();
          })

          $("#completed_project").click(function(){
            $("#completed").show();
            $("#pending").hide();
            $("#declined").hide();
            $("#active").hide();
          })

          $("#pending_project").click(function(){
            $("#pending").show();
            $("#completed").hide();
            $("#declined").hide();
            $("#active").hide();
          })

          $("#declined_project").click(function(){
            $("#declined").show();
            $("#completed").hide();
            $("#pending").hide();
            $("#active").hide();
          })


        })

 </script>

 