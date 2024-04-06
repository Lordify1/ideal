

<?php
    error_reporting(E_ALL);
    session_start();
    require_once("classes/Project.php");


    $active_projects = $project->active_project();
 
    $completed_projects = $project->completed_project();

    $cancelled_projects = $project->cancelled_project();
    
    $pending_projects = $project->pending_project();

    $all_projects = $project->all_projects();
    

    require_once("partials/header.php");
?>

<style>
          @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5em;
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
                          <h3>Projects</h3>   
            <?php   
            
              if(isset($_SESSION["error_message"])){
                echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
                unset ($_SESSION["error_message"]);
              }
            
            ?>

<?php   
            
            if(isset($_SESSION["project_good_report"])){
              echo "<div class='alert alert-danger'>" . $_SESSION["project_good_report"] . "</div>";
              unset ($_SESSION["project_good_report"]);
            }
          
          ?>

<?php   
            
            if(isset($_SESSION["project_bad_report"])){
              echo "<div class='alert alert-danger'>" . $_SESSION["project_bad_report"] . "</div>";
              unset ($_SESSION["project_bad_report"]);
            }
          
          ?>

<?php   
            
            if(isset($_SESSION["success_message"])){
              echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
              unset ($_SESSION["success_message"]);
            }
          
          ?>

 
<form action="process/action.php" method="post">

<div class="accordion mt-3" id="accordionExample">

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Pending Projects
        &nbsp;
      <?php $data = $project->pending_project();

        $projects = count($data);

        if(!$projects == null){
        ?>
        <span class="badge bg-warning mb-1">
          <?php echo $projects ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">

<?php if(!$pending_projects == null){ ?>
      <table class="table table-striped table-warning border-white">
    <thead>
        <th>S/N</th>
        <th>Title</th>
        <th>Business name</th>
        <th>Project Description</th>
        <th>Offer</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($pending_projects as $pending){
        ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $pending ["project_title"] ?></td>
            <td><?php echo $pending ["business_name"] ?></td>
            <td><?php echo $pending ["project_description"] ?></td>
            <td>
            &#8358;<?php
            echo number_format($pending["offer_amount_range"]);
            ?>
            </td>
            <td>
                    <div class="btn-group">
                    <button class="btn btn-sm fa fa-play btn-success blocks" name="activate_project" id="activate_project" value='<?php echo $pending["project_id"];  ?>'></button>
                    <button class="btn btn-sm fa fa-delete-left btn-danger blocks" name="cancel_project" id="cancel_project" value='<?php echo $pending["project_id"];  ?>'></button>
                    </div>
        </tr>
        <?php } ?>
    </tbody>
    </table>
     <?php }else{ ?>
       <p class='text-center'>There are no pending projects at the moment</p>
  <?php } ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
        Active/Approved Projects
        &nbsp;
      <?php $data = $project->active_project();

        $projects = count($data);

        if(!$projects == null){
        ?>
        <span class="badge bg-primary mb-1">
          <?php echo $projects ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">

      <?php if(!$active_projects == null){ ?>
      <table class="table table-striped table-success border-white">
    <thead>
        <th>S/N</th>
        <th>Title</th>
        <th>Business name</th>
        <th>Project Description</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($active_projects as $active){  ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $active ["project_title"] ?></td>
            <td><?php echo $active ["business_name"] ?></td>
            <td><?php echo $active ["project_description"] ?></td>
            <td>
                    <div class="btn-group">
                    <button class="btn btn-sm fa fa-delete-left btn-danger blocks" name="cancel_project" id="cancel_project" value='<?php echo $active["project_id"];  ?>'></button>
                    </div>
        </tr>
        <?php } ?>
    </tbody>
    </table>
     <?php }else{ ?>
       <p class='text-center'>There are no active projects at the moment</p>
  <?php } ?>
</table>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Completed Projects
        &nbsp;
      <?php $data = $project->completed_project();

        $projects = count($data);

        if(!$projects == null){
        ?>
        <span class="badge bg-success mb-1">
          <?php echo $projects ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
    
      <?php if(!$completed_projects == null){ ?>
      <table class="table table-striped table-success border-white">
    <thead>
        <th>S/N</th>
        <th>Title</th>
        <th>Business name</th>
        <th>Project Description</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($completed_projects as $completed){  ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $completed ["project_title"] ?></td>
            <td><?php echo $completed ["business_name"] ?></td>
            <td><?php echo $completed ["project_description"] ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
     <?php }else{ ?>
       <p class='text-center'>There are no completed projects at the moment</p>
  <?php } ?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Cancelled Projects
        &nbsp;
      <?php $data = $project->cancelled_project();

        $projects = count($data);

        if(!$projects == null){
        ?>
        <span class="badge bg-secondary mb-1">
          <?php echo $projects ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">

<?php if(!$cancelled_projects == null){ ?>
        <table class="table table-striped table-danger border-white">
    <thead>
        <th>S/N</th>
        <th>Title</th>
        <th>Business name</th>
        <th>Project Description</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($cancelled_projects as $cancelled){  ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $cancelled ["project_title"] ?></td>
            <td><?php echo $cancelled ["business_name"] ?></td>
            <td><?php echo $cancelled ["project_description"] ?></td>
            <td>
              <div class="btn-group">
              <button class="btn btn-sm fa fa-play btn-success blocks" name="forgive_project" id="forgive_project" value='<?php echo $cancelled["project_id"];  ?>'></button>
              </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
     <?php }else{ ?>
       <p class='text-center'>There are no cancelled projects at the moment</p>
  <?php } ?>
      </div>
    </div>
  </div>

     </form>

                          </div>
                      </div>
                        
                    </div>



<?php
  
   
 
   $headingone = 1;
   $headingtwo = 1;
   $collapseone = 1;
   $collapsetwo = 1;
   $collapsethree = 1;
   $projectone = 1;
   $projecttwo = 1;
   if(!$all_projects == null){ 
   foreach($all_projects as $all_projects){
?>
<div class="accordion mt-3" id="business<?php echo $projectone++ ?>">
 <div class="accordion-item">
    <h2 class="accordion-header" id="heading<?php echo $headingone++ ?>">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $collapseone++ ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapsetwo++ ?>">
        <?php echo $all_projects["project_title"] ?>
      </button>
    </h2>
    <div id="collapse<?php echo $collapsethree++ ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $headingtwo++ ?>" data-bs-parent="#business<?php echo $projecttwo++ ?>">
    <div class="accordion-body">
       <p><b>Title : </b><span><?php echo $all_projects["project_title"] ?></span></p>

       <p><b>Description : </b><span><?php echo $all_projects["project_description"] ?></span></p>

       <p><b>Creation date : </b><span><?php echo $all_projects["project_creation_date"] ?></span></p>

       <p><b>Target audience : </b><span><?php echo $all_projects["target_audience"] ?></span></p>

       <p><b>Deadline : </b><span><?php echo $all_projects["deadline"] ?></span></p>

       <p><b>offer : </b><span>&#8358;<?php echo number_format($all_projects["offer_amount_range"]) ?>.00</span></p>

       <p><b>Total Offer : </b><span>
        &#8358;<?php 
         $sum = $all_projects["offer_amount_range"] * $all_projects["req_no_of_marketers"];
         echo number_format($sum); 
        ?>.00</span></p>

       <p><b>Status : </b><span><?php echo $all_projects["project_status"] ?></span></p>

       <p><b>NO of Marketers : </b><span><?php echo $all_projects["req_no_of_marketers"] ?></span></p>

       <p><b>Goals and Objectives : </b><span><?php echo $all_projects["project_goals_objectives"] ?></span></p>

       <p><b>Business name : </b><span><?php $business=$project->business($all_projects["business_id"]);
      if(!$business == null){ echo $business["business_name"];}
      ?></span></p>

       <p><b>Previous efforts : </b><span><?php  echo $all_projects["previous_efforts"] ?></span></p>

       <p><b>Previous efforts : </b><span><?php  echo $all_projects["previous_efforts"] ?></span></p>

       <p><b>Communication : </b><span><?php  echo $all_projects["communication"] ?></span></p>
       
       <p><b>Experience Level required : </b><span><?php $experience=$project->experience($all_projects["experience_id"]); 
      if(!$experience == null){ echo $experience["experience_name"];}
      ?></span></p>

       <p><b>State : </b><span><?php $state=$project->state($all_projects["state_id"]); 
      if(!$state == null){ echo $state["state_name"];}
      ?></span></p>
       <p><b>Lga : </b><span><?php $lga=$project->lga($all_projects["lga_id"]);
      if(!$lga == null){ echo $lga["lga_name"];}
      ?></span></p>
       <p><b>Industry : </b><span><?php $industry=$project->industry($all_projects["industry_id"]);
      if(!$industry == null){ echo $industry["industry_name"];}
      ?></span></p>
       <p><b>Previous Efforts : </b><span><?php echo $all_projects["previous_efforts"] ?></span></p>
       <p><b>Additional Comments : </b><span><?php echo $all_projects["additional_comments"] ?></span></p>
    </div>
     </div>
     </div>
  <?php  } } ?>
 
    <!-- the else part starts here -->



  
   
                </main>

<?php

    require_once("partials/footer.php");

?>