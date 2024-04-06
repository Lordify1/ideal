

<?php
    error_reporting(E_ALL);
    session_start();
   require_once("admin_guard.php");
   require_once("classes/Marketer.php");
   require_once("classes/actions.php");

   $active_marketers = $market->active_marketers();

   $blocked_marketers = $market->blocked_marketers();
    
   $pending_marketers = $market->pending_marketers();

   $all_marketers = $market->all_marketers();

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
                          <h3>Marketers</h3>
         


<form action="process/action.php" method="post">


<div class="accordion mt-3" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Active Marketers
        &nbsp;
      <?php $data = $market->active_marketers();

        $marketers = count($data);

        if(!$marketers == null){
        ?>
        <span class="badge bg-success mb-1">
          <?php echo $marketers ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
          
  
  <?php if(!$active_marketers == null){ ?>
      <table class="table table-striped table-success border-white">
    <thead>
        <th><input type="checkbox" name="" id="all_active_marketers"> S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
  
    <?php 
      $sn = 1;
      foreach($active_marketers as $active){  ?>
        <tr>
            <td><?php echo "<input type='checkbox' class='me-1 check active_marketer'>" . $sn++ ?></td>
            <td><?php echo $active["marketer_fname"] . " " . $active["marketer_lname"]  ?></td>
            <td><?php echo $active["marketer_email"] ?></td>
            <td><?php echo $active["marketer_phone"] ?></td>
            <td>
                   <div class="btn-group">
                   <button class="fa fa-message btn btn-sm btn-primary" title="message"></button>
                    <button class="fa fa-money-bill btn btn-sm btn-success"  value='<?php echo $active["marketer_id"];  ?>' name="pay" id="pay" title="pay"></button>
                    <button class="btn btn-sm btn-danger fa fa-stop" title="block" name="block_marketer" id="block" value='<?php echo $active["marketer_id"];  ?>'></button>
                   </div>
            </td>
        </tr>
    <?php } ?>
   
    </tbody>
    </table>
    <?php }else{ ?>
   <p class='text-center'>There are no active marketers at the moment</p>
  <?php } ?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Blocked Marketers
        &nbsp;
      <?php $data = $market->blocked_marketers();

        $marketers = count($data);

        if(!$marketers == null){
        ?>
        <span class="badge bg-danger mb-1">
          <?php echo $marketers ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">



  <?php if(!$blocked_marketers == null){ ?>
      <table class="table table-striped table-danger border-white">
      <thead>
        <th><input type="checkbox" name="" id="all_blocked_marketers"> S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
    
      <?php 
      $sn = 1;
      foreach($blocked_marketers as $blocked){  ?>
        <tr>
          
            <td><input type="checkbox" name="" class="blocked_marketer" id=""><?php echo $sn++ ?></td>
            <td><?php echo $blocked["marketer_fname"] . " " . $blocked["marketer_lname"]  ?></td>
            <td><?php echo $blocked["marketer_email"] ?></td>
            <td><?php echo $blocked["marketer_phone"] ?></td>
            <td>
            <div class="btn-group">
                   <button class="fa fa-message btn btn-sm btn-primary" title="message"></button>
                   <button class="btn btn-sm btn-success fa fa-refresh blocks" title="unblock" name="unblock_marketer" id="<?php 
                    echo 'unblock' . $blocked["marketer_id"];?>" value='<?php echo $blocked["marketer_id"]; ?>'></button>
                   </div>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?php }else{ ?>
    <p class='text-center'>There are no blocked marketers at the moment</p>
  <?php } ?> 


      </div>
    </div>
  </div>

  </form>

  
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Pending Marketers
        &nbsp;
      <?php $data = $market->pending_marketers();

        $marketers = count($data);

        if(!$marketers == null){
        ?>
        <span class="badge bg-warning mb-1">
          <?php echo $marketers ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">

        
  <?php if(!$pending_marketers == null){ ?>
        <table class="table table-striped table-dark border-white">
      <thead>
        <th><input type="checkbox" name="" id="all_pending_marketers">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Phone No.</th>
        <th>Actions</th>
    </thead>

    <tbody>
      <?php 
      $sn = 1;
      foreach($pending_marketers as $pending){  ?>
        <tr>
           
            <td><input type="checkbox" name="" class="pending_marketer" id=""><?php echo $sn++ ?></td>
            <td><?php echo $pending["marketer_fname"] . " " . $pending["marketer_lname"]  ?></td>
            <td><?php echo $pending["marketer_email"] ?></td>
            <td><?php echo $pending["marketer_phone"] ?></td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a href="" class="btn btn-sm btn-primary">Message</a>
                    <input type='submit' class="btn btn-sm btn-success" value="Pay" name="pay" id="pay">
                    <button class="btn btn-sm btn-danger blocks" name="activate_marketer" id="activate_marketer" value='<?php echo $pending["marketer_id"];  ?>'>Activate</button>
                    </ul>
                    </div>
                    
                </li>
            </ul>
        </tr>
        <?php } ?>
    </tbody>

</table>
     <?php }else{ ?>

      <div class='col' height='10vh' style='display:flex; align-items:center; justify-content: center; flex-direction:center; opacity:0.5'>
        <p class='text-dark'>There's nothing to see here</p>
      </div>

      <?php } ?>


      </div>
    </div>
  </div>


                     </div>
                      </div>
                        
                    </div>

<form action="process/search.php" method="post">
<div class="mt-5 input-group">
            <input type="search"  class="form-control" name="search_marketers" placeholder="Search by Email" id="search_marketers"><button class="btn btn-success" name="marketer_search">search</button>
          </div>
  
     
<?php if(isset($_SESSION["error_search_marketer"])){ ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <p>There are no marketers with such email</p>
      </div>
    </div>
  </div>


  <?php 

}else if(!isset($_SESSION["search_marketer"])){
   $headingone = 1;
   $headingtwo = 1;
   $collapseone = 1;
   $collapsetwo = 1;
   $collapsethree = 1;
   $marketerone = 1;
   $marketertwo = 1;
   if(!$all_marketers == null){ 
   foreach($all_marketers as $all_marketer){
  ?>
  <div class="accordion mt-3" id="marketer<?php echo $marketerone++ ?>">
  <div class="accordion-item">
    <h2 class="accordion-header" id="heading<?php echo $headingone++; ?>">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $collapseone++ ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapsetwo++ ?>">
        <?php echo $all_marketer["marketer_email"] ?>
      </button>
      
    </h2>
    <div id="collapse<?php echo $collapsethree++ ?>" class="accordion-collapse" aria-labelledby="heading<?php echo $headingtwo++; ?>" data-bs-parent="#marketer<?php echo $marketertwo++ ?>">
    <div class="accordion-body">
      <p><b>Fullname : </b><span><?php echo $all_marketer["marketer_fname"] . " " . $all_marketer["marketer_lname"] ?></span></p>
      <p><b>Phone : </b><span><?php echo $all_marketer["marketer_phone"] ?></span></p>
      <p><b>About : </b><span><?php echo $all_marketer["marketer_bio"] ?></span></p>
      <p><b>Regdate : </b><span><?php echo $all_marketer["marketer_regdate"] ?></span></p>
      <p><b>Availability : </b><span><?php echo $all_marketer["marketer_availability"] ?></span></p>
      <p><b>Date Of Birth : </b><span><?php echo $all_marketer["marketer_dob"] ?></span></p>
      <p><b>Project Type : </b><span><?php echo $all_marketer["project_type"] ?></span></p>
      <p><b>Pay method : </b><span><?php echo $all_marketer["pay_method"] ?></span></p>
      <p><b>Account Detail : </b><span><?php echo $all_marketer["account_detail"] ?></span></p>
      <p><b>Portfolio : </b><span><?php echo $all_marketer["portfolio"] ?></span></p>
      <p><b>State : </b><span><?php $state=$market->state($all_marketer["state_id"]); 
      if(!$state == null){ echo $state["state_name"];}
      ?></span></p>
      <p><b>Lga : </b><span><?php $lga=$market->lga($all_marketer["lga_id"]);
      if(!$lga == null){ echo $lga["lga_name"];}
      ?></span></p>
      <p><b>Experience : </b><span><?php $experience=$market->experience($all_marketer["experience_id"]); 
      if(!$experience == null){ echo $experience["experience_name"];}
      ?></span></p>
      <p><b>Category : </b><span><?php $category=$market->category($all_marketer["category_id"]); 
      if(!$category == null){ echo $category["category_name"];}
      ?></span></p>
      <p><b>Status : </b><span><?php echo $all_marketer["marketer_status"] ?></span></p>
      <p><b>Lastlogin : </b><span><?php echo $all_marketer["last_login"] ?></span></p>
      </div>
    </div>
  </div>
   </div>
<?php  }   } 
   }else{
?>

<?php 

 $datas = $_SESSION["search_marketer"];
 unset($_SESSION["search_marketer"]);
$headingone = 1;
$headingtwo = 1;
$collapseone = 1;
$collapsetwo = 1;
$collapsethree = 1;
$marketerone = 1;
$marketertwo = 1;
if(!$datas == null){ 
foreach($datas as $data){
?>
<div class="accordion mt-3" id="marketer<?php echo $marketerone++ ?>">
<div class="accordion-item">
 <h2 class="accordion-header" id="heading<?php echo $headingone++; ?>">
   <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $collapseone++ ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapsetwo++ ?>">
     <?php echo $data["marketer_email"] ?>
   </button>
   
 </h2>
 <div id="collapse<?php echo $collapsethree++ ?>" class="accordion-collapse" aria-labelledby="heading<?php echo $headingtwo++; ?>" data-bs-parent="#marketer<?php echo $marketertwo++ ?>">
 <div class="accordion-body">
   <p><b>Fullname : </b><span><?php echo $data["marketer_fname"] . " " . $data["marketer_lname"] ?></span></p>
   <p><b>Phone : </b><span><?php echo $data["marketer_phone"] ?></span></p>
   <p><b>About : </b><span><?php echo $data["marketer_bio"] ?></span></p>
   <p><b>Regdate : </b><span><?php echo $data["marketer_regdate"] ?></span></p>
   <p><b>Availability : </b><span><?php echo $data["marketer_availability"] ?></span></p>
   <p><b>Date Of Birth : </b><span><?php echo $data["marketer_dob"] ?></span></p>
   <p><b>Project Type : </b><span><?php echo $data["project_type"] ?></span></p>
   <p><b>Pay method : </b><span><?php echo $data["pay_method"] ?></span></p>
   <p><b>Account Detail : </b><span><?php echo $data["account_detail"] ?></span></p>
   <p><b>Portfolio : </b><span><?php echo $data["portfolio"] ?></span></p>
   <p><b>State : </b><span><?php $state=$market->state($data["state_id"]); 
   if(!$state == null){ echo $state["state_name"];}
   ?></span></p>
   <p><b>Lga : </b><span><?php $lga=$market->lga($data["lga_id"]);
   if(!$lga == null){ echo $lga["lga_name"];}
   ?></span></p>
   <p><b>Experience : </b><span><?php $experience=$market->experience($data["experience_id"]); 
   if(!$experience == null){ echo $experience["experience_name"];}
   ?></span></p>
   <p><b>Category : </b><span><?php $category=$market->category($data["category_id"]); 
   if(!$category == null){ echo $category["category_name"];}
   ?></span></p>
   <p><b>Status : </b><span><?php echo $data["marketer_status"] ?></span></p>
   <p><b>Lastlogin : </b><span><?php echo $data["last_login"] ?></span></p>
   </div>
 </div>
</div>
</div>
<?php  }   } 
}

?>


</form>
                </main>




















                <script>    
    $(document).ready(function(){
        $("#checkall").click(function(){
            var data = $("#checkall").prop("checked");
           if(data == true){
            $(".check").attr("checked","checked");
           }else{
            $(".check").removeAttr("checked");
           }
        })

        // Handle change event of the state select
        $("#activate_marketer").change(function(){
            var selectedStateId = $("#activate_marketer").val(); 

            $.ajax({
                url: 'process/action.php', 
                method: 'POST',
                data: { activate_marketer: selectedStateId }, 
                dataType: 'json',
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

          });


    })
</script>
<?php

    require_once("partials/footer.php");

?>