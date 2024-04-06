<body class='all_marketers_bg h-100'>

    <title>All Marketers</title>


<?php 
    error_reporting(E_ALL);
    session_start();
    require_once("partials/header.php");
    require_once("classes/General.php");
    require_once("classes/Marketer.php");
    $marketers = $general->fetch_marketers();
    $states = $general->state();
    $lgas = $general->lga();
    $experiences = $general->experience();
    $categories = $general->category();


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

        <!-- <div class="col input-group">
        <select name="experience"  id="experience" class="form-control">
        <option value="">By Experience</option>
        <option value=""></option>
          <?php foreach($experiences as $experience){ ?>
            <option value="<?php echo $experience["experience_id"] ?>"><?php echo $experience['experience_name'] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="col input-group">
        <select name="category"  id="category" class="form-control">
        <option value="">By Category</option>
        <option value=""></option>
          <?php foreach($categories as $category){ ?>
            <option value="<?php echo $category["category_id"] ?>"><?php echo $category['category_name'] ?></option>
            <?php } ?>
        </select>
        </div>

        
        <div class="col input-group">
        <select name="state" id="state" class="form-control">
        <option value="">By State</option>
        <option value=""></option>
          <?php foreach($states as $state){ ?>
            <option value="<?php echo $state["state_id"] ?>"><?php echo $state["state_name"] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="col input-group">
        <select name="lgas" id="lgas" class="form-control">
          
          </select>
        </div>
        </button> -->
        <input class="form-control animate__animated animate__fadeIn ms-2" type="text" placeholder="Search Marketer" name="searchbyname" aria-label="Name" aria-describedby="btnNavbarSearch"/>
          <button type="submit" class='btn btn-success animate__animated animate__fadeInLeft text-decoration-none' name="marketer_search">
          <i class="fa fa-filter text-white text-decoration-none "></i>
          </button>
         </div>
        </header>
    </header>
</form>
        
    </header>
    <div class='text-center ideal-marketers'>
                  <h1 class='display-5 text-white'>iDEAL MARKETERS (<?php $total = count($marketers); echo $total; ?>)</h1>
                </div>
  
                
<?php if(!isset($_SESSION["marketer_search"])){ ?>
    <div class="container-fluid">

        <div class="row p-1">
        <?php foreach($marketers as $marketer){ ?>

              <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInLeft">
                <div class="card">
                  <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
                  <?php

                    if(!$marketer["marketer_picture"] == null)
                    { ?>
                    
                    src = "images/marketer_dp/<?php echo $marketer["marketer_picture"] ?>"
                    
                    <?php }else{  ?>
                    src="images/bgimg.jpg"
                    <?php  }  ?> 
                  >
                  <div class="card-body">
                    <h5 class="card-title p-2 m-0 ideal-bg">Marketer </h5>
          <p class="card-text mb-0"><b>NAME</b> : <?php echo $marketer["marketer_fname"] . "  " . $marketer["marketer_lname"] ?></p>
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>BIO</b> : <?php echo $marketer["marketer_bio"] ?></p>                
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>EXPERIENCE</b> : 
                    <?php 
                      $marketer_exp = $marketer["experience_id"];
                      $exp = $market->experience_by_id($marketer_exp);
                      if(!$exp == null)
                      {
                        echo $exp["experience_name"];
                      }
                    ?>
                    </p>
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>CATEGORY</b> : 
                    <?php 
                      $marketer_cat = $marketer["category_id"];
                      $cat = $market->category_by_id($marketer_cat);
                      if(!$cat == null)
                      {
                        echo $cat["category_name"];
                      }
                    ?></p>                    
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>SKILLS</b> : <?php 
                    $skills = $general->marketer_skills($marketer["marketer_id"]);
                     if(!$skills == null)
                     {
                        foreach($skills as $skill)
                        {
                          echo ' | ' . $skill["skill_name"] . ' | ';
                        }
                     }
                     ?></p>
                    <hr class="mb-2 mt-1 m-0">
                    <p class="card-text mb-0"><b>AVAILABILITY</b> : <?php echo $marketer["marketer_availability"]; ?></p>
                    <hr class="mb-2 mt-1 m-0">
                    <a href='marketer_view.php?id=<?php echo $marketer["marketer_id"] ?>' name='marketer_view' id='marketer_view' class="btn btn-primary marketer_view" value="<?php echo $marketer['marketer_email'] ?>">Go to Profile</a>              
                  </div>

          <input type="hidden" id="marketer_recog" name="marketer_recog" value="<?php echo $data["marketer_id"] ?>">
              </div>  
            </div>
            <?php } ?>
            </div>  
    </div>
  <?php }else{ ?>
    <div class="container-fluid">

      <?php $datas = $_SESSION["marketer_search"];
         unset($_SESSION["marketer_search"]);

        if(!$datas == null){
        ?>

        <div class="row p-1">
        <?php foreach($datas as $data){ ?>

              <div class="col-md-4 col-lg-3 col-sm-6 py-3 animate__animated animate__fadeInLeft">
                <div class="card">
                  <img class="bd-placeholder-img card-img-top" width="100%" height="100%" 
                  <?php

                    if(!$data["marketer_picture"] == null)
                    { ?>
                    
                    src = "images/marketer_dp/<?php echo $data["marketer_picture"] ?>"
                    
                    <?php }else{  ?>
                    src="images/bgimg.jpg"
                    <?php  }  ?> 
                  >
                  <div class="card-body">
                    <h5 class="card-title p-2 m-0 ideal-bg">Marketer </h5>
          <p class="card-text mb-0"><b>NAME</b> : <?php echo $data["marketer_fname"] . "  " . $data["marketer_lname"] ?></p>
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>BIO</b> : <?php echo $data["marketer_bio"] ?></p>                
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>EXPERIENCE</b> : 
                    <?php 
                      $marketer_exp = $data["experience_id"];
                      $exp = $market->experience_by_id($marketer_exp);
                      if(!$exp == null)
                      {
                        echo $exp["experience_name"];
                      }
                    ?>
                    </p>
                    <hr class="mb-1 mt-1 m-0">
                    <p class="card-text mb-0"><b>CATEGORY</b> : 
                    <?php 
                      $marketer_cat = $data["category_id"];
                      $cat = $market->category_by_id($marketer_cat);
                      if(!$cat == null)
                      {
                        echo $cat["category_name"];
                      }
                    ?></p>  
                    <hr class="mb-2 mt-1 m-0">
                    <p class="card-text mb-0"><b>SKILLS</b> : <?php 
                    $skills = $general->marketer_skills($data["marketer_id"]);
                     if(!$skills == null)
                     {
                        foreach($skills as $skill)
                        {
                          echo '|' . $skill["skill_name"] . '|';
                        }
                     }
                     ?></p>
                     <hr>
                    <p class="card-text mb-0"><b>AVAILABILITY</b> : <?php echo $data["marketer_availability"]; ?></p>
                    <hr class="mb-2 mt-1 m-0">
                    <a href='marketer_view.php?id=<?php echo $data["marketer_id"] ?>' name='marketer_view' id='marketer_view' class="btn btn-primary marketer_view" value="<?php echo $data['marketer_email'] ?>">Go to Profile</a>              
          <input type="hidden" id="marketer_recog" name="marketer_recog" value="<?php echo $data["marketer_id"] ?>">
          </div>
          </div> 
          </div> 
          <?php } ?> 
            </div>
    <?php }else{  ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h1 class="rowarrange animate__animated animate__shakeX">No Marketer Match Your Search</h1>
          </div>
        </div>
      </div>
            
  <?php 
    }

    }?>
</div>
    
<script src="script/jqueryfile.js"></script>


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

      })

</script>

<!-- footer section -->
    </body>
 <?php require_once("partials/footer.php") ?>

<!-- footer section -->