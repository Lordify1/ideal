<main id="marketer_view_bg" class="text-center">
<?php
    error_reporting(E_ALL);
    
    require_once("general_guard.php");
    require_once("classes/Marketer.php");
    require_once("classes/General.php"); 
   
    
    // When hosoting live please do well to change the location from localhost to something else
    if($_GET)
    {

        $marketer = $_GET["id"];

    $data = $market->get_userbyid($marketer);   
    
  
  
     
  

  $state_id = $data["state_id"];

  $lga_id = $data["lga_id"];

  $experience_id = $data["experience_id"];

  $category_id = $data["category_id"];

  $selected = $market->get_userbyid($marketer);
  $state = $market->get_state($state_id);
  $lga = $market->get_lga($lga_id);
  $experiences = $market->get_experience($experience_id);
  $category = $market->category_by_id($category_id);
  $projects = $market->get_projects($marketer);
  $skills = $market->get_skills($marketer);
    }else{
        $_SESSION["error_message"] = "Unauthorized action";
        header("location:all_marketers.php");
    }

  
    require_once("partials/header.php");
    

?>

    <title>Viewing <?php echo $selected["marketer_lname"] ?></title>

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
                <h1 class="display-1 mb-2 text-center"><?php echo $selected["marketer_fname"] . " " . $selected["marketer_lname"] ?>
              <?php if(!$selected["marketer_availability"] == null)
                  { ?>
                  <span class="fs-2">( Available on a <?php echo $selected["marketer_availability"] ?> Basis )</span>
              <?php } ?>
              </h1>
            </div>
        </div>

        <div class="row">
            <div class="colarrange" style="margin-top:-20px;">
                <img
                <?php

                if(!$selected["marketer_picture"] == null)
                { ?>
                
                src = "images/marketer_dp/<?php echo $selected["marketer_picture"] ?>"
                
                <?php }else{  ?>
                src="images/bgimg.jpg"
                <?php  }  ?> 
                class="rounded-circle ideal-shadow" width="150" alt="marketer_img">
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>BIO</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $selected["marketer_bio"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Location</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo " <span class='text-dark'>||</span> " .   $state["state_name"] ." <span class='text-dark'>||</span> " . $lga["lga_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Experience Level</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $experiences["experience_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Category</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $category["category_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Projects Handled on iDEAL</h1>
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
                    <span class="text-secondary"><?php echo $selected["marketer_fname"] ?> hasn't worked on any Project yet</span>
                <?php  }
                   ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>SKills</h1>
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
                <h1>Contact</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3 m-3">Email Address : <?php echo $selected["marketer_email"] ?></p>
                <p class="h3 m-3">Phone Number : <?php echo $selected["marketer_phone"] ?></p>
                <p class="h3 m-3">Portfolio : <?php echo $selected["portfolio"] ?></p>
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
    
    



