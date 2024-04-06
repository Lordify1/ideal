

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
        Pending Payment
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table table-striped table-warning border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Type</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>olajide@gmail.com</td>
            <td>Business</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
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
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Payment History
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table table-striped table-dark border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Type</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>olajide@gmail.com</td>
            <td>Business</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
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
        Approved Payments
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <table class="table table-striped table-success border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Type</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>olajide@gmail.com</td>
            <td>Business</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
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
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Disapproved Payments
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table table-striped table-danger border-white">
    <thead>
        <th><input type="checkbox" name="" id="checkall" class="form-input-type">S/N</th>
        <th>Name</th>
        <th>Email Address</th>
        <th>Type</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Olaide Joshua</td>
            <td>olajide@gmail.com</td>
            <td>Business</td>
            <td>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="col-5 d-block">
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