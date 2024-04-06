

<?php
    error_reporting(E_ALL);
    session_start();
    //require_once("classes/Level.php");
    //require_once("admin_guard.php");

    // $le = new Level();
    // $levels = $le->fetch_level();
    
    

    require_once("partials/header.php");
?>
        <div id="layoutSidenav">
            
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main class="addmain">


  <div class="container-fluid px-4">
                      <div class="row">
                          <div class="col">
                          <h3>Blog</h3>
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

<div class="accordion mt-3 bg-dark" id="accordionExample">
    <div class="accordion-item bg-dark text-white">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Create a Blog Post
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <form action="process/process_blogpost.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
             
          </div>
          <div class="mb-3">
            <label for="level" class="form-label">Level</label>
           <select name="level" id="level"  class="form-control">
            <option value="">Select One</option>
            <?php
            
            foreach ($levels as $level) {
              ?>
              <option value=" <?php echo $level["level_id"]  ?>"><?php echo $level["level_name"] ?></option>

            <?php } ?>
           </select>
          </div>
           
          <fieldset class="mb-3">
            <legend>Status</legend>
            <div class="form-check">
              <input type="radio" value="1" name="status" class="form-check-input" id="exampleRadio1">
              <label class="form-check-label" for="exampleRadio1">Publish</label>
            </div>
            <div class="mb-3 form-check">
              <input type="radio" value="0" name="status" class="form-check-input" id="exampleRadio2">
              <label class="form-check-label" for="exampleRadio2">Do Not Publish</label>
            </div>
          </fieldset>
          <div class="mb-3">
            <label class="form-label" for="customFile">Upload Cover</label>
            <input type="file" class="form-control" name="topic_cover" id="customFile">
          </div>
          <div>
            <label for="">Blog_text</label>
            <textarea name="" id="" cols="30" rows="10" class="form-control my-2"></textarea>
          </div>
          <div>
          <label class="form-label" for="customFile">Blog URL</label>
            <input type="text" class="form-control mb-2" name="topic_url" id="customFile">
          </div>
          <div class="mb-3">
            <button type="submit" name="topic_btn" class="btn btn-primary">Add Topic!</button>
          </div>
          
         
          
        </form>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Published Blog Posts
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <table class="table table-striped table-warning border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a href="" class="btn btn-sm btn-primary">Message</a>
                    <a href="" class="btn btn-sm btn-success">Pay</a>
                    <a href="" class="btn btn-sm btn-danger">unBlock</a>
                    </ul>
                    </div>
                    
                </li>
            </ul>
        </tr>
    </tbody>
</table>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          unPublished Blog Posts
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <table class="table table-striped table-warning border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a href="" class="btn btn-sm btn-primary">Message</a>
                    <a href="" class="btn btn-sm btn-success">Pay</a>
                    <a href="" class="btn btn-sm btn-danger">unBlock</a>
                    </ul>
                    </div>
                    
                </li>
            </ul>
        </tr>
    </tbody>
</table>
        </div>
      </div>
  </div>
  </div>


                          </div>
                      </div>
                        
                    </div>


                </main>

<?php

    require_once("partials/footer.php");

?>