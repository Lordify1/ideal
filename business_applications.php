<main class="container-fluid" id="profilebody" style="min-height:100vh">
<?php

    require_once("business_guard.php");
    require_once("partials/header.php");
    require_once("classes/Business.php");
    
    $data = $business->get_userbyid($_SESSION["business_is_online"]);

    $applicationpend = $business->get_applications_pending($_SESSION["business_is_online"]);

    $applicationapp = $business->get_applications_approved($_SESSION["business_is_online"]);

    $applicationrej = $business->get_applications_rejected($_SESSION["business_is_online"]);

    $link = $_SERVER["HTTP_REFERER"];


    

?>


    <title>Applications received</title>


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
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>
    <div style="height:3vh"></div>
        <?php require_once("partials/menu.php"); ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="pending_project"><h6>PENDING</h6></a>
              <a class="btn animate__animated animate__fadeIn" id="approved_project"><h6>APPROVED</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="rejected_project"><h6>REJECTED</h6></a>
            </div>
          </div>
        </div>


       <div id="loader">

       </div>

      
    
    <?php if($applicationpend != null){  ?>

      <div id="pending">
        <table class="table table-striped p-2 table-warning">
            <thead>
            <th>S/N</th>
            <th>Marketer Email</th>
            <th>Ex.Level</th>
            <th>Skills</th>
            <th>Actions</th>
            </thead>
            <tbody>
              <?php 
              
              $sn = 1;
              foreach($applicationpend as $application){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $application["marketer_email"] ?></td>
                    <td><?php $exp = $business->get_experience($application["experience_id"]); echo $exp["experience_name"] ?></td>
                    <td><?php $skills = $business->marketer_skills($application["marketer_id"]); foreach($skills as $skil){echo $skil["skill_name"] . " | "; } ?></td>
                    <td>
                    <div class="btn-group" role="group">
                    <form action="process/app_process_1.php" method="post">
            <input type="hidden" name="id" value="<?php echo $application["marketer_id"] ?>">
            <input type="hidden" name="proid" value="<?php echo $application["project_id"] ?>">
            <input type="hidden" name="appid" value="<?php echo $application["application_id"] ?>" id="appid">

            <div class="btn-group">
            <button type="submit" class="btn btn-success fa fa-thumbs-up btn-sm" name="approve" value="APPROVED" id="approve"></button>
            <button type="submit" name="reject" id="reject" class="btn btn-danger fa fa-trash btn-sm" value="REJECTED"></button>
            <a href="marketer_view.php?id=<?php echo $application['marketer_id'] ?>" type="submit" name="view_mar" id="view_mar" class="btn btn-primary fa fa-eye btn-sm"></a>
            </div>
            </form>
                    </div>
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


    <?php if(!$applicationapp == null){ ?>

       <div id="approved">
      <table class="table table-striped p-2 table-success">
      <thead>
      <th>S/N</th>
      <th>Marketer Email</th>
      <th>Ex.Level</th>
      <th>Skills</th>
      <th>Actions</th>
      </thead>
      <tbody>
        <?php 
        
        $sn = 1;
        foreach($applicationapp as $applicationtwo){ ?>
          <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $applicationtwo["marketer_email"] ?></td>
              <td><?php $exp = $business->get_experience($applicationtwo["experience_id"]); echo $exp["experience_name"] ?></td>
              <td><?php $skills = $business->marketer_skills($applicationtwo["marketer_id"]); foreach($skills as $skil){echo $skil["skill_name"] . " | "; } ?></td>
              <td>
                 <form action="process/app_process_2.php" method="post">
            <div class="btn-group" role="group">
            <input type="hidden" name="id" value="<?php echo $applicationtwo["marketer_id"] ?>">
            <input type="hidden" name="proid" value="<?php echo $applicationtwo["project_id"] ?>">
            <input type="hidden" name="appid" value="<?php echo $applicationtwo["application_id"] ?>" id="appid">
          <button type="submit" name="reject" id="reject" class="fa fa-trash btn btn-danger btn-sm" value="REJECTED"></button>
          <a href="marketer_view.php?id=<?php echo $applicationtwo['marketer_id'] ?>" type="submit" class="btn btn-primary btn-sm fa fa-eye" ></a>
            </div>
        </form>
        </div>
        </td>
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



    <?php if(!$applicationrej == null){ ?>

        <div id="rejected">
        <table class="table table-striped p-2 table-danger">
        <thead>
        <th>S/N</th>
        <th>Marketer Email</th>
        <th>Ex.Level</th>
        <th>Skills</th>
        </thead>
        <tbody>
        <?php 
        
        $sn = 1;
        foreach($applicationrej as $applicationthree){ ?>
          <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $applicationthree["marketer_email"] ?></td>
              <td><?php $exp = $business->get_experience($applicationthree["experience_id"]); echo $exp["experience_name"] ?></td>
              <td><?php $skills = $business->marketer_skills($applicationthree["marketer_id"]); foreach($skills as $skil){echo $skil["skill_name"] . " || "; } ?></td>
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

      
        </main>
        <?php require_once("partials/footer.php")  ?>
        

 <script>

        $(document).ready(function(){
          $("#approved").hide();
          $("#rejected").hide();

          $("#pending_project").click(function(){
            $("#pending").show();
            $("#approved").hide();
            $("#rejected").hide();
          })

          $("#approved_project").click(function(){
            $("#approved").show();
            $("#rejected").hide();
            $("#pending").hide();
          })

          $("#rejected_project").click(function(){
            $("#rejected").show();
            $("#approved").hide();
            $("#pending").hide();
          })
      
        })

 </script>   