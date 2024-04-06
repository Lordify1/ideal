<body class='all_business_bg h-100'>

<?php 
    error_reporting(E_ALL);
    session_start();
    require_once("partials/header.php");
    require_once("classes/General.php");
    $businesses = $general->fetch_businesses();
    $industries = $general->industries();
    $states = $general->state();
    $lgas = $general->lga();


?>

<!-- header section -->

<p><?php

if(isset($_SESSION["error_message"])){
  echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
  unset($_SESSION["error_message"]);
}

?></p>


<?php if(isset($_SERVER["HTTP_REFERER"])){ ?>

<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
      <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
    </div>

<?php  } ?>

<form action="process/search.php" method="post">
  <header class="container-fluid mb-2">
        <header class="row bg-success p-3">
        <div class="input-group">

       
        <input class="form-control animate__animated animate__fadeIn ms-2" type="text" placeholder="Search Business" name="searchbyname" aria-label="Name" aria-describedby="btnNavbarSearch"/>
          <button type="submit" class='btn btn-success animate__animated animate__fadeInLeft text-decoration-none' name="business_search">
          <i class="fa fa-filter text-white text-decoration-none "></i>
          </button>
         </div>
        </header>
    </header>
</form>



    <div class='text-center ideal-business'>
                  <h1 class='display-5 text-white'>iDEAL BUSINESSES ( <?php $total = count($businesses); echo $total ?> )</h1>
                </div>



<?php if(!isset($_SESSION["success_search"])){ ?>
  <div class="container-fluid">

    <div class="row p-1">
    <?php foreach($businesses as $business){ ?>
      

  <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInRight">
            <div class="card">
              <img class="bd-placeholder-img card-img-top" width="100%" height="50%" 
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


</body>
<!-- footer section -->

 <?php require_once("partials/footer.php") ?>

<!-- footer section -->

<script>
      $(document).ready(function () {
        // Handle change event of the state select
        $("#state").change(function(){
            var selectedStateId = $("#state").val(); 

            $.ajax({
                url: 'process/general_process.php', 
                method: 'POST',
                data: { stateId: selectedStateId }, 
                dataType: 'json',
                success: function (data) {
                    $('#lgas').empty();

                    $.each(data, function (index, item) {
                        $('#lgas').append('<option value="' + item.lga_id + '">' + item.lga_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

          });

        });  

</script>