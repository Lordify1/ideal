<body  id="profilebody">
<?php

    require_once("marketer_guard.php");
    require_once("partials/header.php");
    require_once("classes/Marketer.php");
    
    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

    $applicationpend = $market->my_pending_applications($_SESSION["marketer_is_online"]);

    $applicationapp = $market->my_approved_applications($_SESSION["marketer_is_online"]);

    $applicationrej = $market->my_rejected_applications($_SESSION["marketer_is_online"]);


    

    

    

?>

    <title>My Applications</title>


   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }

       

        @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5rem;
        }
        }
        
   </style>

        <!-- Navigation section start -->
        
    <!-- Navigation section end -->


<?php if(isset($_SERVER["HTTP_REFERER"])){ ?>
<div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-4"></span></a>
        </div>
<?php } ?>

    <div style="height:3vh"></div>
    <?php require_once("partials/menu.php") ?>

        <div class=" container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
            <a id="pending_application" class="btn animate__animated animate__fadeInLeft"><h6>PENDING</h6></a>
              <a id="approved_application" class="btn animate__animated animate__fadeIn"><h6>APPROVED</h6></a>
              <a id="rejected_application" class="btn animate__animated animate__fadeInRight"><h6>REJECTED</h6></a>
            </div>
          </div>
        </div>
        <?php
        
        if(isset($_SESSION["success_message"])){
            echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
            unset($_SESSION["success_message"]);
        }
        
        ?>

<?php
        
        if(isset($_SESSION["error_message"])){
            echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
            unset($_SESSION["error_message"]);
        }
        
        ?>

      <?php if($applicationpend != null){ ?>

        <div id="pending">
        <table class="table table-striped p-2 table-warning">
        <thead>
            <th>S/N</th>
            <th>Project Name</th>
            <th>Project Desc.</th>
            <th>Appl. Status</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php 
              $sn = 1;
            foreach($applicationpend as $app_pend){?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><p><?php echo $app_pend["project_title"] ?></p></td>
                <td><?php echo $app_pend["project_description"] ?></td>
                <td><?php echo $app_pend["application_status"] ?></td>
                <td>
                  
                  <div class="btn-group ideal-shadow" role="group">
            <button  name="delete" type="button" data-bs-toggle="modal" data-bs-target="#delete_appl" class="fa fa-trash btn btn-danger" ></button><a href="edit_application.php?ai=<?php echo $app_pend["application_id"] ?>" name="edit_application_btn" class="fa fa-edit btn btn-warning" ></a>
            
          </div>
                  </form>
               </td>
              </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>

      <?php }else{ ?>

<div class="col" id="pending">
  <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
</div>

<?php } ?>



<?php if($applicationapp != null){ ?>

        <div id="approved">
        <table class="table table-striped p-2 table-success">
            <thead>
            <th>S/N</th>
            <th>Project Name</th>
            <th>Project Desc.</th>
            <th>Appl. Status</th>
            </thead>
            <tbody>
            <?php 
              $sn = 1;
            foreach($applicationapp as $app_approved){?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $app_approved["project_title"] ?></td>
                <td><?php echo $app_approved["project_description"] ?></td>
                <td><?php echo $app_approved["application_status"] ?></td>
              </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>

      <?php }else{ ?>

<div class="col" id="approved">
  <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
</div>

<?php } ?>
          


<?php if($applicationrej != null){ ?>

      <div id="rejected">
        <table class="table table-striped p-2 table-danger">
        <thead>
            <th>S/N</th>
            <th>Project Name</th>
            <th>Project Desc.</th>
            <th>Appl. Status</th>
            </thead>
            <tbody>
            <?php 
              $sn = 1;
            foreach($applicationrej as $app_rej){?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $app_rej["project_title"] ?></td>
                <td><?php echo $app_rej["project_description"] ?></td>
                <td><?php echo $app_rej["application_status"] ?></td>
              </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>

      <?php }else{ ?>

<div class="col" id="rejected">
  <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
</div>

<?php } ?>

      </body>
        <?php require_once("partials/footer.php")  ?>
        
 
        
<!-- delete Modal -->
<form action="process/general_process.php" method="post">
<div class="modal fade" id="delete_appl" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Are you Sure?</h5>
        </div>
        <div>
        <button name="delete"  class="btn btn-danger btn-sm" id="delete_appl">Delete</button>
        <input type="hidden" name="deleted" value="<?php echo $app_pend["application_id"] ?>">
        </div>
        
        <div>
        <button type="button" class="btn-close btn-sm animate__animated animate__pulse animate__infinite" data-bs-dismiss="modal" id="delete_appl" aria-label="Close"></button>
        </div>
      </div>
      </div>
    </div>
</div>
</form>
<!-- delete modal-->
 <script>

        $(document).ready(function(){
          $("#approved").hide();
          $("#rejected").hide();

          $("#approved_application").click(function(){
            $("#approved").show();
            $("#pending").hide();
            $("#rejected").hide();
          })

          $("#rejected_application").click(function(){
            $("#rejected").show();
            $("#pending").hide();
            $("#approved").hide();
          })

          $("#pending_application").click(function(){
            $("#pending").show();
            $("#approved").hide();
            $("#rejected").hide();
          })
        })

 </script>