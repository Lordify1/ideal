<main id="project_view_bg" class="text-center">
<?php
    error_reporting(E_ALL);
    session_start();

    // When hosoting live please do well to change the location from localhost to something else
    
        $identifier = $_GET["project_view"];
    

    require_once("partials/header.php");
    require_once("classes/General.php");
    require_once("classes/Marketer.php");
    require_once("classes/Business.php");


    

    if(isset($_SESSION["business_is_online"])){
        $data = $business->get_userbyid($_SESSION["business_is_online"]);
      }

      if(isset($_SESSION["marketer_is_online"])){
        $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

        $id = $data["marketer_id"];
        $proid = $identifier;
        
        $uniq = $proid . $proid . $id;
      }

     // $disable = $business->disable_application();

    
      
    
      $images = $business->fetch_img_for_project_view($identifier);

      
    $project = $general->view_project($identifier);

    $business = $general->view_project_business($identifier);

    $state = $general->view_project_state($identifier);

    $industry = $general->view_project_industry($identifier);

    $experience = $general->view_project_experience($identifier);

    $skills = $general->view_project_skill($identifier);

    $marketers = $general->view_project_marketers($identifier);


    

    

    




     
      

    

?>

    <title>Project <?php echo $project["project_title"] ?> View </title>

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

<?php if(isset($_SESSION["marketer_is_online"])){
     $check = $general->apply_button($uniq);
      
     if($check == null){

        if($project["receiving_application"] == 'YES'){

            if($project["project_status"] !== 'COMPLETED')
            {
        ?>
    <div class="position-fixed bottom-0 end-0 mb-5 me-3">
        <form action="application.php">
          <button class="btn btn-danger btn-sm animate__animated animate__bounce animate__delay-5s animate__repeat-2" value="<?php echo $project["project_id"]; ?>" id="identifier" name="identifier">Apply</button>
        </form>
        </div>
<?php }  }  }
}

?>

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
                <h1 class="display-1 text-center"><?php echo $business["business_name"] ?><span class='display-6'>(<?php echo $project["project_status"] ?>)</span></h1>
            </div>
        </div>

        <div class="row">
            <div class="colarrange" style="margin-top:-20px;">
                <img 
                <?php
              

              if(!$images["project_image"] == null)
              { ?>
               src=
               "
               process/project_images/<?php echo $images["project_image"] ?>
               "
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }
              ?> class="rounded-circle ideal-shadow" width="150" alt="project_img">
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Project Name</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["project_title"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Project Description</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["project_description"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Project Location</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $state["state_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Target Audience</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["target_audience"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Project Industry</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $industry["industry_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Targetted Deadline</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["deadline"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Experience Level</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $experience["experience_name"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Offer Amount</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3">&#8358;<?php echo number_format($project["offer_amount_range"]) ?>.00</p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Project Goals and Objectives</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["project_goals_objectives"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Preferred Skills for Project</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3 text-center"><?php 
                    foreach($skills as $skill)
                    {
                       echo $skill["skill_name"] . "</br>" ;
                    }
                ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Communication</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["communication"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Previous Effort</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["previous_efforts"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Additional Comments</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3"><?php echo $project["additional_comments"] ?></p>
            </div>

            <div class="colarrange head_bg mt-1 p-2">
                <h1>Marketers On this Project</h1>
            </div>
            <div class="colarrange text-white p-2 ">
                <p class="h3">
                    <?php 
                    
                    
                    if(!$marketers == null )
                    {
                        
                        foreach($marketers as $marketer)
                        {
                            echo "| " . $marketer["marketer_email"] . " |";
                        }

                    }else
                    {
                        echo "<p>" . "There are no marketers on this Project yet" . "</p>";
                    }

                    ?>
                </p>
            </div>
        </div>
    </div>



<script>

    $(document).ready(function(){
        $("#identifier").click(function(){
            var id = $(this).val();
            var data = "id="+id;
            $.ajax(data);
        })
    })

</script>



</main>
<?php  require_once("partials/footer.php") ?>
    
    



