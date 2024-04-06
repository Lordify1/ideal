

<?php
    error_reporting(E_ALL);
    session_start();
    
    require_once("admin_guard.php");
    require_once("classes/Business.php");
 
    $active_businesses = $business->active_businesses();
 
    $blocked_businesses = $business->blocked_businesses();

    $pending_businesses = $business->pending_businesses();

    $all_business = $business->all_businesses();
    

    require_once("partials/header.php");
?>
        <div id="layoutSidenav">
            
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main class="addmain">


  <div class="container-fluid px-4">
                      <div class="row">
                          <div class="col">
                          <h3>Businesses</h3>    


<form action="process/action.php" method="post">

<div class="accordion mt-3" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Active Businesses
        &nbsp;
      <?php $data = $business->active_businesses();

        $businesses = count($data);

        if(!$businesses == null){
        ?>
        <span class="badge bg-success mb-1">
          <?php echo $businesses ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">

  <?php if(!$active_businesses == null){ ?>
      <table class="table table-striped table-success border-white">
    <thead>
        <th><input type="checkbox" name="" id="all_active_business" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($active_businesses as $active){  ?>
        <tr>
            <td><input type="checkbox" name="" class="active_business" id=""><?php echo $sn++ ?></td>
            <td><?php echo $active["business_name"] ?></td>
            <td><?php echo $active["business_email"] ?></td>
            <td><?php echo $active["business_phone_no"] ?></td>
            <td>
                    <button class="btn btn-sm btn-danger fa fa-stop blocks" name="block_business" id="block" value='<?php echo $active["business_id"];  ?>'></button>
      </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?php }else{ ?>
   <p class="text-center">There are no active businesses at the moment</p>
  <?php } ?>


      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Blocked Businesses
        &nbsp;
      <?php $data = $business->blocked_businesses();

        $businesses = count($data);

        if(!$businesses == null){
        ?>
        <span class="badge bg-danger mb-1">
          <?php echo $businesses ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">

  <?php if(!$blocked_businesses == null){ ?>
      <table class="table table-striped table-danger border-white">
      <thead>
        <th><input type="checkbox" name="" id="all_blocked_business" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($blocked_businesses as $blocked){  ?>
        <tr>
            <td><input type="checkbox" name="" class="blocked_business"><?php echo $sn++ ?></td>
            <td><?php echo $blocked["business_name"] ?></td>
            <td><?php echo $blocked["business_email"] ?></td>
            <td><?php echo $blocked["business_phone_no"] ?></td>
            <td>
                    <button class="btn btn-sm btn-success fa fa-play blocks" name="unblock_business" id="unblock" value='<?php echo $blocked["business_id"];  ?>'></button>
      </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?php }else{ ?>
   <p class="text-center">There are no blocked businesses at the moment</p>
  <?php } ?>


      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Pending Businesses
        &nbsp;
      <?php $data = $business->pending_businesses();

        $businesses = count($data);

        if(!$businesses == null){
        ?>
        <span class="badge bg-warning mb-1">
          <?php echo $businesses ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">

      <div class='col-12 d-flex p-3 '>
      <input type="search" name="b_search" id="b_search" class="form-control"><button class='btn btn-sm btn-success' id="buttt" name="butt">search</button>
      </div>

  
  <?php if(!$pending_businesses == null){ ?>
      <table class="table table-striped table-secondary border-white">
      <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($pending_businesses as $pending){  ?>
        <tr>
            <td><?php echo "<input type='checkbox' class='me-1'>" . $sn++ ?></td>
            <td><?php echo $pending ["business_name"] ?></td>
            <td><?php echo $pending ["business_email"] ?></td>
            <td><?php echo $pending ["business_phone_no"] ?></td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a href="" class="btn btn-sm btn-primary">Message</a>
                    <button class="btn btn-sm btn-danger blocks" name="activate_business" id="activate" value='<?php echo $pending["business_id"];  ?>'>activate</button>
                    </ul>
                    </div>
      </div>
                </li>
            </ul>
        </tr>
        <?php } ?>
    </tbody>
    </table>
     <?php }else{ ?>
       <p class='text-center'>There are no pending businesses at the moment</p>
  <?php } ?>
      </div>
    </div>
</div>
</div>

</form>
                          </div>
                      </div>
                        
                    </div>
                    <hr>
<form action="process/search.php" method="post">
<div class="mt-5 input-group">
            <input type="search"  class="form-control" name="search_business" placeholder="Search by Email" id="search_business"><button class="btn btn-success" name="business_search">search</button>
          </div>
     <?php if(isset($_SESSION["error_search_business"])){ ?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <p>There are no businesses with such email</p>
    </div>
  </div>
</div>
<?php 
   }else if(!isset($_SESSION["search_business"])){
   $headingone = 1;
   $headingtwo = 1;
   $collapseone = 1;
   $collapsetwo = 1;
   $collapsethree = 1;
   $businessone = 1;
   $businesstwo = 1;
   if(!$all_business == null){ 
   foreach($all_business as $all_business){
?>
<div class="accordion mt-3" id="business<?php echo $businessone++ ?>">
 <div class="accordion-item">
    
    <h2 class="accordion-header" id="heading<?php echo $headingone++ ?>">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $collapseone++ ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapsetwo++ ?>">
  <?php echo $all_business["business_email"] ?>
      </button>
    </h2>
    <div id="collapse<?php echo $collapsethree++ ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $headingtwo++ ?>" data-bs-parent="#business<?php echo $businesstwo++ ?>">
      <div class="accordion-body">
       <p><b>Name : </b><span><?php echo $all_business["business_name"] ?></span></p>
       <p><b>About : </b><span><?php echo $all_business["about_business"] ?></span></p>
       <p><b>Address : </b><span><?php echo $all_business["business_address"] ?></span></p>
       <p><b>Regdate : </b><span><?php echo $all_business["business_regdate"] ?></span></p>
       <p><b>Website : </b><span><?php echo $all_business["business_website"] ?></span></p>
       <p><b>Phone : </b><span><?php echo $all_business["business_phone_no"] ?></span></p>
       <p><b>Contact Person : </b><span><?php echo $all_business["contact_person_name"] ?></span></p>
       <p><b>Status : </b><span><?php echo $all_business["business_status"] ?></span></p>
       <p><b>Pay method : </b><span><?php echo $all_business["pay_method"] ?></span></p>
       <p><b>Account_details : </b><span><?php  echo $all_business["account_detail"] ?></span></p>
       <p><b>State : </b><span><?php $state=$business->state($all_business["state_id"]); 
      if(!$state == null){ echo $state["state_name"];}
      ?></span></p>
       <p><b>Lga : </b><span><?php $lga=$business->lga($all_business["lga_id"]);
      if(!$lga == null){ echo $lga["lga_name"];}
      ?></span></p>
       <p><b>Ibdustry : </b><span><?php $industry=$business->industry($all_business["industry_id"]);
      if(!$industry == null){ echo $industry["industry_name"];}
      ?></span></p>
       <p><b>Last login : </b><span><?php echo $all_business["last_login"] ?></span></p>

      </div>
     </div>
     </div>
  <?php  } }
     }else{ 
  ?>

<?php 
   $datas = $_SESSION["search_business"];
   unset($_SESSION["search_business"]);
   $headingone = 1;
   $headingtwo = 1;
   $collapseone = 1;
   $collapsetwo = 1;
   $collapsethree = 1;
   $businessone = 1;
   $businesstwo = 1;
   if(!$datas == null){ 
   foreach($datas as $data){
?>
<div class="accordion mt-3" id="business<?php echo $businessone++ ?>">
 <div class="accordion-item">
    
    <h2 class="accordion-header" id="heading<?php echo $headingone++ ?>">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $collapseone++ ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapsetwo++ ?>">
  <?php echo $data["business_email"] ?>
      </button>
    </h2>
    <div id="collapse<?php echo $collapsethree++ ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $headingtwo++ ?>" data-bs-parent="#business<?php echo $businesstwo++ ?>">
      <div class="accordion-body">
       <p><b>Name : </b><span><?php echo $data["business_name"] ?></span></p>
       <p><b>About : </b><span><?php echo $data["about_business"] ?></span></p>
       <p><b>Address : </b><span><?php echo $data["business_address"] ?></span></p>
       <p><b>Regdate : </b><span><?php echo $data["business_regdate"] ?></span></p>
       <p><b>Website : </b><span><?php echo $data["business_website"] ?></span></p>
       <p><b>Phone : </b><span><?php echo $data["business_phone_no"] ?></span></p>
       <p><b>Contact Person : </b><span><?php echo $data["contact_person_name"] ?></span></p>
       <p><b>Status : </b><span><?php echo $data["business_status"] ?></span></p>
       <p><b>Pay method : </b><span><?php echo $data["pay_method"] ?></span></p>
       <p><b>Account_details : </b><span><?php  echo $data["account_detail"] ?></span></p>
       <p><b>State : </b><span><?php $state=$business->state($data["state_id"]); 
      if(!$state == null){ echo $state["state_name"];}
      ?></span></p>
       <p><b>Lga : </b><span><?php $lga=$business->lga($data["lga_id"]);
      if(!$lga == null){ echo $lga["lga_name"];}
      ?></span></p>
       <p><b>Ibdustry : </b><span><?php $industry=$business->industry($data["industry_id"]);
      if(!$industry == null){ echo $industry["industry_name"];}
      ?></span></p>
       <p><b>Last login : </b><span><?php echo $data["last_login"] ?></span></p>

      </div>
     </div>
     </div>
  <?php  } }
     }
  ?>




   </form>    

                </main>

<?php

    require_once("partials/footer.php");

?>

