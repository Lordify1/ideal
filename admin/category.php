

<?php
    error_reporting(E_ALL);
    session_start();
    require_once("admin_guard.php");

    require_once("classes/category.php");


    $category = $category->get_category();
    
    

    require_once("partials/header.php");
?>
        <div id="layoutSidenav">
            
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main class="addmain">

    
  <div class="container-fluid px-4">
                      <div class="row">
                          <div class="col">
                           <h3>Category</h3>
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
        Available Categories
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">

      <table class="table table-striped table-success ">
        <thead>
          <th>S/N</th>
          <th>Name</th>
          <th>Delete</th>
        </thead>

        <tbody>
          <?php $sn = 1;
              foreach($category as $caterg){
          ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $caterg["category_name"]; ?></td>
            <td><button class='btn btn-sm text-danger' value='<?php echo $caterg["category_id"]?>' name='d_category' >X</button></td>
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
       Add Category
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
            <label for="categoryname">Category name</label>
            <input type="text" name="categoryname" id="categoryname" class="form-control">
            <input type="submit" name="addcategory" id="addcategory" class="btn btn-primary btn-sm my-2 p-2" value="Add">
            
            <!-- <button name="addcategory" id="addcategory">Add</button> -->
            <div id="door"></div>
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
      //     // var category = $("categoryname").val();
      //     // $.post("process/max_process.php",{
      //     //   cat: category;
      //     // });
      //     $("#door").load("process/max_process.php");
      //   })
      // })

</script>