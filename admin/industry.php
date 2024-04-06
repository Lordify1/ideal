

<?php
    error_reporting(E_ALL);
    session_start();
    require_once("classes/industry.php");
    //require_once("classes/Level.php");
    //require_once("admin_guard.php");

    // $le = new Level();
    // $levels = $le->fetch_level();
    
    
    $industry = $industry->get_industry();
    

    require_once("partials/header.php");
?>
        <div id="layoutSidenav">
            
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main class="addmain">


  <div class="container-fluid px-4">
                      <div class="row">
                          <div class="col">
                          <h3>Industries</h3>
                          <?php   
            
            if(isset($_SESSION["ideal_admin_success_feedback"])){
              echo  "<div class='alert alert-success'>" . $_SESSION["ideal_admin_success_feedback"]. "</div>";
              unset($_SESSION["ideal_admin_success_feedback"]);
            }
            
            ?>

<?php   
            
            if(isset($_SESSION["ideal_admin_error_feedback"])){
              echo  "<div class='alert alert-danger'>" . $_SESSION["ideal_admin_error_feedback"] . "</div>";
              unset ($_SESSION["ideal_admin_error_feedback"]);
            }
          
          ?>

<form action="process/max_process.php" method="post">        

<div class="accordion mt-3" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Available Industries
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">


      <table class="table table-success table-striped border-round">
        <thead>
          <th>S/N</th>
          <th>Name</th>
          <th>Delete</th>
        </thead>

        <tbody>
          <?php 
          $sn = 1;
          foreach($industry as $indus){ ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $indus["industry_name"]; ?></td>
            <td><button class='btn btn-sm text-danger' value='<?php echo $indus["industry_id"]?>' name='d_industry' >X</button></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
       Add Industry
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
            <label for="industryname" class="my-2">Industry name</label>
            <input type="text" name="industryname" id="industryname" class="form-control">
            <input type="submit" name="addindustry" id="addindustry" class="btn btn-primary btn-sm my-2 p-2" value="Add">
      </div>
    </div>
  </div>


                          </div>
                      </div>
                        
                    </div>


                </main>


          </form>

<?php

    require_once("partials/footer.php");

?>

<script>

      // $(document).ready(function(){
      //   $("#addcategory").click(function(){
      //     var  = 
      //     $.post("process/max_process.php");
      //   })
      // })

</script>