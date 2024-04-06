<main id="business_view_bg" class="text-center">
<?php
    error_reporting(E_ALL);

    require_once("general_guard.php");
    
    require_once("classes/General.php");
    require_once("classes/Marketer.php");
    require_once("classes/Business.php");

    if($_SERVER["HTTP_REFERER"] == "http://localhost/iDEAL/all_business.php"){

    $businesses = $_GET["id"];
    $allofbusiness = $business->get_userbyid($businesses);
    $states = $business->my_state($allofbusiness["state_id"]);
    $lgas = $business->my_lga($allofbusiness["lga_id"]);
    $levels = $business->fetch_level();
    $industries = $business->my_industry($allofbusiness["industry_id"]);
    $projects = $business->my_projects($allofbusiness["business_id"]);
    $skills = $business->my_skills_preference($allofbusiness["business_id"]);
    $categories = $business->fetch_category();
    $industry = $business->get_industry($businesses);

  }else{
    $_SESSION["error_message"] = "Unauthorized action";
    header("location:all_business.php");
}

require_once("partials/header.php");
    

    

?>

    <title>business <?php echo $allofbusiness["business_name"] ?> View </title>

    <style>
        .head_bg{
            background-color: rgba(255,255,255,0.5);
        }

        h1{
            padding:20px;
        }

        .h3, p{
            margin-bottom:50px;
            margin-top:50px;
        }
    </style>

<?php if(isset($_SESSION["marketer_is_online"])){ ?>
    <div class="position-fixed bottom-0 end-0 mb-5 me-3">
        <form action="application.php">
          <button class="btn btn-danger btn-sm animate__animated animate__bounce animate__delay-5s animate__repeat-2" value="<?php echo $allofbusiness["business_id"]; ?>" id="identifier" name="identifier">Message</button>
        </form>
        </div>
<?php } ?>

        <?php 

            if(isset($_SERVER["HTTP_REFERER"])){ ?>

            <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
                <a href="<?php 
            
            echo $_SERVER["HTTP_REFERER"]; ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
            </div>

        <?php  } ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-white p-2">
                <h1 class="display-1 mb-2 text-center"><?php echo $allofbusiness["business_name"] ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="colarrange" style="margin-top:-20px;">
                <img
                <?php

              if(!$allofbusiness["business_logo"] == null)
              { ?>
               
               src = "images/business_logo/<?php echo $allofbusiness["business_logo"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?> 
                class="rounded-circle ideal-shadow" width="150" alt="business_img">
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>About Business</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $allofbusiness["about_business"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Business Location</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $allofbusiness["business_address"] . " <span class='text-dark'>||</span> " .  $states["state_name"] ." <span class='text-dark'>||</span> " . $lgas["lga_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Business Industry</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $industries["industry_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Past Projects</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3">
                  <?php
                   if(!$projects == null)
                  { 
                      foreach($projects as $project)
                      { ?>

                      
                      <span class='text-dark'>|</span>
                       <a href="project_view.php?project_view=<?php echo $project['project_id'] ?>" class="text-decoration-none text-white" name="project_view">
                        <?php echo $project["project_title"] ?>
                      </a>
                       <span class='text-dark'>|</span>
                      

                     <?php }
                  }else{ ?>
                    <span class="text-secondary">This Business Hasn't created any Project yet</span>
                <?php  }
                   ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>SKills Preferrence</h1>
                </div>
                <div class="colarrange text-white p-2 ">
                <p class="h3">
                  <?php
                    foreach($skills as $skill)
                    {
                      echo "<span class='text-dark'>|</span> " . $skill["skill_name"] . " <span class='text-dark'>|</span>";
                    }
                  ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Contact Person's name</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $allofbusiness["contact_person_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Business Contact</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3 m-3">Email Address : <?php echo $allofbusiness["business_email"] ?></p>
                <p class="h3 m-3">Phone Number : <?php echo $allofbusiness["business_phone_no"] ?></p>
                <p class="h3 m-3">Website : <?php echo $allofbusiness["business_website"] ?></p>
            </div>
        </div>
    </div>
</main>


<script>

    $(document).ready(function(){
        $("#identifier").click(function(){
            var id = $(this).val();
            var data = "id="+id;
            $.ajax(data);
        })
    })

</script>




<?php  require_once("partials/footer.php") ?>
    
    



