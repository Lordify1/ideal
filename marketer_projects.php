<body id="profilebody" class="contaniner h-100">
<?php
    require_once("marketer_guard.php");
    require_once("partials/header.php");
    require_once("classes/Marketer.php");


    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

    $active_projects = $market->active_projects($data["marketer_id"]);

    $completed_projects = $market->completed_projects($data["marketer_id"]);



  

    

  

?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php echo $data["marketer_lname"] ?> Projects</title>
    

   <style>
        *{
            border:0px solid red;
            min-height:20px;
        }

        
        @media screen and (min-width:200px) and (max-width:700px){
            table{
            font-size:0.5em;
        }
        }
        
   </style>

        <!-- Navigation section start -->
        
    <!-- Navigation section end -->


    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-4"></span></a>
        </div>
    <div style="height:3vh"></div>
       
    
    
    <?php require_once("partials/menu.php"); ?>

  <div class="container-fluid " >
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="active_project"><h6>ACTIVE</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="completed_project" ><h6>COMPLETED</h6></a>
              
            </div>
          </div>
  </div>

  <?php if(!$active_projects == null){ ?>
      <div id="active">
        <table class="table table-striped p-2 table-warning">
        <thead>
            <th>S/N</th>
            <th>Project Name</th>
            <th>Descr.</th>
            <th>Offer amt.</th>
            <th>Timeline</th>
            <th>Business Name</th>
            </thead>
          
            <tbody>
            <?php 
             $sn = 1;
            foreach($active_projects as $active_project){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $active_project["project_title"]  ?></td>
                    <td><?php echo $active_project["project_description"] ?></td>
                    <td><?php echo $active_project["offer_amount_range"] ?></td>
                    <td><?php echo $active_project["deadline"] ?></td>
                    <td><?php 
                    $business_name = $market->business_name($active_project["business_id"]);
                    
                    foreach($business_name as $bus_name)
                    {
                        echo $bus_name["business_name"];
                    }
                    ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
      <?php }else{ ?>
        <div class="col"  id="active">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX" style="z-index:2">There are no active projects</p>
      </div>
  <?php } ?>



  <?php if(!$completed_projects == null){ ?>  
      <div id="completed">
        <table class="table table-striped p-2 table-success">
            <thead>
            <th>S/N</th>
            <th>Project Name</th>
            <th>Descr.</th>
            <th>Offer amt.</th>
            <th>Timeline</th>
            <th>Business Name</th>
            </thead>
            <tbody>
            <?php 
             $sn = 1;
            foreach($completed_projects as $completed_project){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $completed_project["project_title"]  ?></td>
                    <td><?php echo $completed_project["project_description"] ?></td>
                    <td><?php echo $completed_project["offer_amount_range"] ?></td>
                    <td><?php echo $completed_project["deadline"] ?></td>
                    <td><?php 
                    $business_name = $market->business_name($completed_project["business_id"]);
                    
                    foreach($business_name as $bus_name)
                    {
                        echo $bus_name["business_name"];
                    }
                    ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
      <?php }else{ ?>
        <div class="col" id="completed">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX" style="z-index:2">There are no completed projects</p>
      </div>
  <?php } ?>


      
</body>
        <?php require_once("partials/footer.php")  ?>
        

 <script>

        $(document).ready(function(){
          $("#completed").hide();

          $("#active_project").click(function(){
            $("#active").show();
            $("#completed").hide();
          })

          $("#completed_project").click(function(){
            $("#completed").show();
            $("#active").hide();
          })
        })

 </script>

