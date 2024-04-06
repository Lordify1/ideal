<main class="container-fluid h-100" id="profilebody">
<?php

    require_once("marketer_guard.php");
    require_once("partials/header.php");
    require_once("classes/Marketer.php");


    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

    $id = $data["marketer_id"];

    $good_remarks = $market->good_remark($id);

    $bad_remarks = $market->bad_remark($id);

?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php echo $data["marketer_lname"] . "'s"  ?> Remarks</title>

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

        <div class="container-fluid">
          <div class="row">
            <div class="col status d-flex text-danger">
              <a class="btn animate__animated animate__fadeInLeft" id="good_remark"><h6>GOOD REMARKS</h6></a>
              <a class="btn animate__animated animate__fadeInRight" id="bad_remark"><h6>BAD REMARKS</h6></a>
            </div>
          </div>
        </div>


    <?php if(!$good_remarks == null){ ?>

      <div id="good">
        <table class="table table-striped p-2 table-success">
            <thead>
            <th>S/N</th>
            <th>Remark</th>
            <th>Rating</th>
            <th>Business Name</th>
            </thead>
            <tbody>
              <?php 
              $sn = 1;
              foreach($good_remarks as $good){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $good["remark"] ?></td>
                    <td><?php echo $good["remark_rating"] ?></td>
                    <td><?php echo $good["business_name"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
      <?php }else{ ?>

        <div class="col" id="good">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?>



    <?php if(!$bad_remarks == null){ ?>

      <div id="bad">
        <table class="table table-striped p-2 table-danger">
            <thead>
            <th>S/N</th>
            <th>Remark</th>
            <th>Rater</th>
            <th>Business Name</th>
            </thead>
            <tbody>
            <?php 
              $sn = 1;
              foreach($bad_remarks as $bad){ ?>
                <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $bad["remark"] ?></td>
                    <td><?php echo $bad["remark_rating"] ?></td>
                    <td><?php echo $bad["business_name"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>

      <?php }else{ ?>

        <div class="col" id="bad">
     <p class="display-6 mx-auto text-center p-5 text-secondary animate__animated animate__shakeX">There is nothing to show here</p>
      </div>

    <?php } ?>

      </main>
        <?php require_once("partials/footer.php")  ?>
        

 <script>

        $(document).ready(function(){
          $("#bad").hide();


          $("#good_remark").click(function(){
            $("#good").show();
            $("#bad").hide();
          })

          $("#bad_remark").click(function(){
            $("#bad").show();
            $("#good").hide();
          })

        })

 </script>