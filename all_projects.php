<body class='all_projects_bg' style="min-height:100vh">


 <title>All Projects</title>


<?php
    error_reporting(E_ALL);
    session_start(); 
    require_once("classes/General.php");
    require_once("classes/Business.php");
    require_once("classes/Marketer.php");
    $projects = $general->fetch_projects();
    $states = $general->state();
    $experiences = $general->experience();
    $lgas = $general->lga();
    $businesses = $general->fetch_businesses();
    $industries = $general->industries();


    if(isset($_SESSION["marketer_is_online"]))
    {
        $marketer = $market->get_userbyid($_SESSION["marketer_is_online"]);

        if($marketer["marketer_status"] == "pending")
        {
          $_SESSION["error_message"] = "Complete your profile first";
          header("location:marketer_dashboard.php");
          die();
        }
    }

?>


   <style>

        *{
            box-sizing: border-box;
        }

        .searchproject{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
           
        }

        /* section, article, div{
            border: 1px solid red;
        } */


        @media (min-width: 300px) and (max-width:700px;){

          .searchproject{
            display:none;
          }

        }
       
   </style>
</head>




<p>
    <?php

  if(isset($_SESSION["error_message"])){
    echo  "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
    unset($_SESSION["error_message"]);
  }

  ?>
</p>

<?php if(isset($_SERVER["HTTP_REFERER"])){ ?>

 <div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
      <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
    </div>

<?php  } ?>
        <!-- Navigation section start -->
        <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
 
<form action="process/search.php" method="post">
  <header class="container-fluid mb-2">
        <header class="row bg-success p-3">
        <div class="input-group">

        <div class="col input-group">

    
        <input class="form-control animate__animated animate__fadeIn ms-2" type="text" placeholder="Search Project" name="searchbyname" aria-label="Name" aria-describedby="btnNavbarSearch"/>
          <button type="submit" class='btn btn-success animate__animated animate__fadeInLeft text-decoration-none' name="project_search">
          <i class="fa fa-filter text-white text-decoration-none "></i>
          </button>
         </div>
        </header>
    </header>
</form>


    <div class='text-center ideal-business'>
                  <h1 class='display-5 text-white'>iDEAL PROJECTS
                    (<?php $total = count($projects); echo $total; ?>)
                  </h1>
    </div>


    <div class="ms-2 me-2">
      <?php  
      
      if(isset($_SESSION["success_message"])){
          echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
          unset($_SESSION["success_message"]);
      }

      if(isset($_SESSION["error_message"])){
        echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
        unset($_SESSION["error_message"]);
      }
      ?>
    </div>


      

<?php 
 if(!isset($_SESSION["project_search"])){
  foreach($projects as $project){ ?>
    <div class="col m-2 h-20">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-3 shadow-sm" id="pro" style="border-radius: 2%;">
            <img 
            <?php
              $images = $business->fetch_file_name($project["project_id"]);
              foreach($images as $img)
              { 

                
              if(!$img["project_image"] == null)
              { ?>
               src=
               "
               process/project_images/<?php echo $img["project_image"] ?>
               "
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }
            }
              ?>
               style="border-radius: 2%;" id="proimg">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Project Name : <?php echo $project["project_title"]; ?></h5>
                <p class="card-text"><b>Project Description :</b><?php echo $project["project_description"] ?></p> 
                <p><b>Project Industry :</b>
                <?php

                  $project_id = $project["project_id"];
                  $industries = $general->project_industry_index($project_id);

                  foreach($industries as $industry)
                  {
                    echo $industry["industry_name"];
                  }

                ?>
                </p>
                <p><b>Offer Amount : </b>
                &#8358;<?php
                 echo number_format($project["offer_amount_range"]);
                 ?>.00
                 </p>
                 <p><b>Skills Required :</b> 
                  <?php

                    $project_id = $project["project_id"];
                    $project_skills = $general->project_skills_index($project_id); 
                    
                    foreach($project_skills as $project_skill)
                    {
                        echo " | " . $project_skill["skill_name"] . " | ";
                    }
                   
                   
                   ?>
                  </p>
                  <p><b>Marketers Required :</b>
                    <?php
                    echo $project["req_no_of_marketers"];
                    ?>
                  </p>
                <form action="project_view.php">
                <button value="<?php echo $project["project_id"] ?>" name='project_view' id='project_view' class="btn btn-primary project_view">View Project</button>  
                </form>            
        
                    <p class="text-end card-text">Business name: <b><?php if($project["business_id"] != null){
                      echo $project["business_name"];
                    }
                      ?></b></p>
              </div>
            </div>
          </div>
        </div>
    </div>
      <?php }
}else{

      $datas = $_SESSION["project_search"];
      unset($_SESSION["project_search"]);

      if(!$datas == null){

        foreach($datas as $data){
      ?>

 <div class="col m-2">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4 shadow-sm" style="border-radius: 2%;">
            <img 
            <?php
              $images = $business->fetch_file_name($data["project_id"]);
              foreach($images as $img)
              { 

                
              if(!$img["project_image"] == null)
              { ?>
               src=
               "
               process/project_images/<?php echo $img["project_image"] ?>
               "
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }
            }
              ?>
              width="100%" style="border-radius: 2%;" height="100%">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Project Name : <?php echo $data["project_title"]; ?></h5>
                <p class="card-text"><b>Project Description :</b><?php echo $data["project_description"] ?></p> 
                <p><b>Project Industry :</b>
                <?php

                  $project_id = $data["project_id"];
                  $industries = $general->project_industry_index($project_id);

                  foreach($industries as $industry)
                  {
                    echo $industry["industry_name"];
                  }

                ?>
                </p>
                <p><b>Offer Amount : </b>
                &#8358;<?php
                 echo number_format($data["offer_amount_range"]);
                 ?>
                 </p>
                 <p><b>Skills Required :</b> 
                  <?php

                    $project_id = $data["project_id"];
                    $project_skills = $general->project_skills_index($project_id); 
                    
                    foreach($project_skills as $project_skill)
                    {
                        echo " | " . $project_skill["skill_name"] . " | ";
                    }
                   
                   
                   ?>
                  </p>
                  <p><b>Marketers Required :</b>
                    <?php
                    echo $data["req_no_of_marketers"];
                    ?>
                  </p>
                <form action="project_view.php">
                <button value="<?php echo $data["project_id"] ?>" name='project_view' id='project_view' class="btn btn-primary project_view">View Project</button>  
                </form>            
        
                    <p class="text-end card-text">Business name: <b><?php 

                      $name = $general->view_project_business($data["project_id"]);
                    
                      echo $name["business_name"];
                      ?></b></p>
              </div>
            </div>
          </div>
        </div>
    </div>


  <?php }
      }else{ ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h1 class="rowarrange animate__animated animate__shakeX">No Project Match Your Search</h1>
          </div>
        </div>
      </div>

 <?php 
 }   
}  
?>

      


</body>

        <?php require_once("partials/footer.php") ?>

    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">

    $(document).ready(function(){
      $(".project_view").click(function(){
        var id = $(this).val();
        var name = "identifier="+id;
        $.ajax(name);
      })

      $("#state").change(function(){
            var selectedStateId = $("#state").val(); 

            $.ajax({
                url: 'process/general_process.php', 
                method: 'POST',
                data: { stateId: selectedStateId }, 
                dataType: 'json',
                success: function (data) {
                    $('#lgas').empty();
                    $("#lgas").removeAttr("disabled","");
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
</html>











