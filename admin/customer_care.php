

<?php
    error_reporting(E_ALL);
    session_start();
    require_once "classes/Message.php";


    $replied = $message->replied_messages();
    $ignored = $message->ignored_messages();
    $pending = $message->pending_messages();
    
    

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
                          <h3>Customer Care</h3>  

                          
                          <?php   
            
            if(isset($_SESSION["error_message"])){
              echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
              unset ($_SESSION["error_message"]);
            }
          
          ?>

<?php   
          
          if(isset($_SESSION["success_message"])){
            echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
            unset ($_SESSION["success_message"]);
          }
        
        ?>    

         

<div class="accordion mt-3" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Recent Messages
        &nbsp;
      <?php $data = $message->pending_messages();

        $recent = count($data);

        if(!$recent == null){
        ?>
        <span class="badge bg-warning mb-1">
          <?php echo $recent ?>
        </span>

      <?php } ?>
        </button>
      </h2>
     
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
      <?php if(!$pending == null){ ?>
        <table class="table table-striped table-warning border-white">
      <thead>
          <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
          <th>Email Address</th>
          <th>Message</th>
          <th>Type</th>
          <th>Sent on</th>
          <th>Action</th>
      </thead>

      <tbody>
        <?php $sn = 1; foreach($pending as $pend){ ?>
          <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $pend["email"] ?></td>
              <td><?php echo $pend["message"] ?></td>
              <td><?php echo $pend["message_type_name"] ?></td>
              <td><?php echo $pend["sent_on"] ?></td>
              <td>
              <form action="process/messages.php" method="post">
              <div class="btn-group">
              <input type="hidden"  id="replied" name="replied" value="<?php echo $pend["cs_id"] ?>">
              <button type="submit" class="btn btn-sm btn-success" name="reply_message" id="reply_message" ><i class="fa fa-message"></i></button>
              </form>
              <form action="process/messages.php" method="post">
              <input type="hidden" name="ignored"  value="<?php echo $pend["cs_id"] ?>">
              <button type="submit" class="btn btn-sm btn-danger" name="ignore"><i class="fa fa-trash"></i></button>
              </form>
              </div>
            </td>
          </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php  }else{ ?>

    <p class='text-center'>There are no pending messages</p>


  <?php  } ?>

      </div>
    </div>
</div>



<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Replied Messages
        &nbsp;
      <?php $data = $message->replied_messages();

        $recent = count($data);

        if(!$recent == null){
        ?>
        <span class="badge bg-success mb-1">
          <?php echo $recent ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <?php if(!$replied == null){ ?>  
      <table class="table table-striped table-success border-white">
      <thead>
          <th>S/N</th>
          <th>Email Address</th>
          <th>Message</th>
          <th>Type</th>
          <th>Replied on</th>
      </thead>

      <tbody>
        <?php 
        $sn = 1;
        foreach($replied as $reply){ ?>
          <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $reply["email"] ?></td>
              <td><?php echo $reply["message"] ?></td>
              <td><?php echo $reply["message_type_name"] ?></td>
              <td><?php echo $reply["acted_on"] ?></td>
          </tr>
        <?php } ?>
        </tbody>
  </table>
     <?php }else{  ?> 
      <p class='text-center'>There are no replied messages yet</p>
  <?php }  ?>
      </div>
    </div>
</div>



<div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Ignored Messages
        &nbsp;
      <?php $data = $message->ignored_messages();

        $igns = count($data);

        if(!$igns == null){
        ?>
        <span class="badge bg-danger mb-1">
          <?php echo $igns ?>
        </span>

      <?php } ?>
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       
      <?php if(!$ignored == null){ ?>
      <table class="table table-striped table-dark border-white">
      <thead>
          <th>S/N</th>
          <th>Email Address</th>
          <th>Message</th>
          <th>Type</th>
          <th>Ignored on</th>
      </thead>

      <tbody>
        <?php $sn = 1; foreach($ignored as $ign){ ?>
          <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $ign["email"] ?></td>
              <td><?php echo $ign["message"] ?></td>
              <td><?php echo $ign["message_type_name"] ?></td>
              <td><?php echo $ign["acted_on"] ?></td>
          </tr>
        <?php } ?>
          </tbody>
  </table>
  <?php }else{  ?>

    <p class='text-center'>There are no ignored messages yet</p>


    <?php } ?>


        </div>
    </div>
  </div>
</div>



<div class="container-fluid pt-3 border-radius-3">
  <div class="row">
    <div class="col">
      <iframe src="https://mail.google.com/mail/u/0/#inbox" width="100%" id="message" height="100%" frameborder="0">

      </iframe>
    </div>
  </div>
</div>


                          </div>
                      </div>
                        
                    </div>


                </main>


                <script src="script/jqueryfile.js"></script>
                <script>
            $(document).ready(function () {
                $("#reply_message").click(function (e) { 
                    e.preventDefault();
                    var id = $("#replied").val();
                    alert(id)
                    die();
                    $.ajax({
                        type: "post",
                        url: "process/messages.php",
                        data: id: id,
                        success: function (response) {
                            $("#message_action_report").load(response)
                        }
                    });
                });
            });
        </script>

<?php

    require_once("partials/footer.php");

?>