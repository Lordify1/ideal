This is the function for search business

<?php

    public function search_business($name, $industry_id, $state_id, $lga_id)
{
    $sql = "SELECT * FROM businesses WHERE business_status = 'active' AND 
    business_name LIKE '%' ? '%'  OR industry_id = ? OR state_id = ? OR lga_id = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute([$name, $industry_id, $state_id, $lga_id]);
    $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $search;
}

?>

The major thing here is -- <?php " LIKE '%' ? '%' " ?>

This is the function for search business





This is the client side, where the function is been called




<?php if(!isset($_SESSION["success_search"])){ ?>



    <div class="container-fluid">
  
      <div class="row p-1">
      <?php foreach($businesses as $business){ ?>
        
  
    <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInRight">
              <div class="card">
                <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
                <?php
  
                  if(!$business["business_logo"] == null)
                  { ?>
                  
                  src = "images/business_logo/<?php echo $business["business_logo"] ?>"
                  
                  <?php }else{  ?>
                  src="images/bgimg.jpg"
                <?php  }  ?> 
                >
                <div class="card-body">
                  <h5 class="card-title bg-warning p-2 m-0 text-dark">Business </h5>
         <p class="card-text mb-0"><b>NAME</b> : <?php echo $business["business_name"]  ?></p>
                  <hr class="mb-1 mt-1 m-0">
                  <p class="card-text mb-0"><b>BIO</b> : <?php echo $business["about_business"] ?></p>
                  <hr class="mb-1 mt-1 m-0">
                  <?php if($business["business_website"] != null){ ?>
                    <p class="card-text mb-0"><b>WEBSITE</b> : <?php echo $business["business_website"]; ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <?php } ?>
                  <p class="card-text mb-0"><b>ADDRESS</b> : <?php echo $business["business_address"]; ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <p class="card-text mb-0"><b>INDUSTRY</b> : 
                  <?php 
                  $target_id = $business["industry_id"];
                  $industry = $general->business_industry($target_id);
  
                  foreach($industry as $ind)
                  {
                    echo $ind["industry_name"];
                  }
                  ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <a href='business_view.php?id=<?php echo $business["business_id"] ?>' name='business_view' id='business_view' class="btn btn-primary business_view" value="<?php echo $business['business_email'] ?>">Go to Profile</a>            
                </div>
      
            </div>  
          </div>
          <?php } ?>
          </div>  
          </div>



  <?php  }else{ ?>




  
  <div class="container-fluid">
  
   <?php $datas = $_SESSION["success_search"];
         unset($_SESSION["success_search"]);
  
    if(!$datas == null){
        ?>
      <div class="row p-1">
      <?php foreach($datas as $data){ ?>
        
  
  <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInRight">
              <div class="card">
                <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
                <?php
  
                if(!$data["business_logo"] == null)
                { ?>
                 
                 src = "images/business_logo/<?php echo $data["business_logo"] ?>"
                 
                <?php }else{  ?>
                  src="images/bgimg.jpg"
              <?php  }  ?> 
                >
                <div class="card-body">
                  <h5 class="card-title bg-warning p-2 m-0 text-dark">Business </h5>
         <p class="card-text mb-0"><b>NAME</b> : <?php echo $data["business_name"]  ?></p>
                  <hr class="mb-1 mt-1 m-0">
                  <p class="card-text mb-0"><b>BIO</b> : <?php echo $data["about_business"] ?></p>
                  <hr class="mb-1 mt-1 m-0">
                  <?php if($data["business_website"] != null){ ?>
                    <p class="card-text mb-0"><b>WEBSITE</b> : <?php echo $data["business_website"]; ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <?php } ?>
                  <p class="card-text mb-0"><b>ADDRESS</b> : <?php echo $data["business_address"]; ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <p class="card-text mb-0"><b>INDUSTRY</b> : 
                  <?php 
                  $target_id = $data["industry_id"];
                  $industry = $general->business_industry($target_id);
  
                  foreach($industry as $ind)
                  {
                    echo $ind["industry_name"];
                  }
                  ?></p>
                  <hr class="mb-2 mt-1 m-0">
                  <a href='business_view.php?id=<?php echo $data["business_id"] ?>' name='business_view' id='business_view' class="btn btn-primary business_view" value="<?php echo $data['business_email'] ?>">Go to Profile</a>            
                </div>
      
            </div>  
          </div>
          <?php } ?>
          </div> 
          
          


   <?php  }else{ ?>




    
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <h1 class="rowarrange animate__animated animate__shakeX">No Business Match Your Search</h1>
            </div>
          </div>
        </div>
          
        
    <?php
        }   
   
    }
     ?>
  </div>

    Take note of the IF ELSE  and the SESSIONS

This is the client side, where the function is been called





This is the process page

<?php

if($_POST && isset($_POST["business_search"]))
{

    $industryid = $_POST["industry"];
    $stateid = $_POST["state"];
    $lgaid = $_POST["lgas"];
    $searchbyname = $_POST["searchbyname"];

    $ind_search = $general->search_business($searchbyname, $industryid, $stateid, $lgaid);

    if(is_array($ind_search))
    {
      $_SESSION["success_search"] = $ind_search;
      header("location:../all_business.php");
      die();
    }else
    {
      header("location:../all_business.php");
      die();
    }
}


?>

This is the process page