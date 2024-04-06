<?php
  error_reporting(E_ALL);


  if(isset($_SERVER["HTTP_REFERER"]))
  {
    $link = $_SERVER["HTTP_REFERER"];
  }


?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="iDEAL">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>
    <link rel="stylesheet" href="css/sign-in.css">
    <link rel="stylesheet" href="css/preloader.css">
    

    <style>


     
    *{
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
    }

    footer{

    padding: 20px;
    margin-top: auto;
    }


    body{
    min-height : 100%
    }

      

      .nav-item{
        font-size: 0.7rem !important;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }


      .navbar{
        background: linear-gradient(to bottom, rgba(0,0,0, 0.8), rgba(0,0,0,0.6), rgba(255,255,255, 0));
      }


      @media (min-width: 200px) and (max-width: 550px) {
        .bd-placeholder-img-sm {
          font-size: 3.5rem;
        }


      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }


      

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed.css" rel="stylesheet">
  </head>
  <body style="background-color:#0066cc">

  <div class="preloader" id="preloader">
        <div class="spinner"></div>
    </div>
  


<nav class="navbar majornav navbar-expand-sm navbar-dark fixed-top animate__animated animate__fadeIn">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="img-fluid" src="images/ideal logo.png" alt="" width="60" height="67"></a>
    <button class="navbar-toggler" id="btntoclick" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-align-right float-end" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active h6" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active h6" href="about_us.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active h6" aria-current="page" href="all_business.php">Businesses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active h6" href="all_marketers.php">Marketers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active h6" aria-current="page" href="all_projects.php">Projects</a>
        </li>

        <?php if(!isset($_SESSION["marketer_is_online"]) &&  !isset($_SESSION["business_is_online"])){ ?>
          <li class="nav-item">
          <a href=""  class="nav-link active h6" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</a>
         </li>
         <li class="nav-item">
          <a href="" class="nav-link active h6" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
         </li>
        <?php } ?>

        <?php if(isset($_SESSION["marketer_is_online"])){ ?>

          <li class="nav-item">
          <a class="nav-link  active h6" aria-current="page" href="marketer_dashboard.php">Dashboard</a>
        </li>

        <?php } ?>

        <?php if(isset($_SESSION["business_is_online"])){ ?>

        <li class="nav-item">
        <a class="nav-link  active h6" aria-current="page" href="business_dashboard.php">Dashboard</a>
        </li>

        <?php } ?>

        <?php if(isset($_SESSION["marketer_is_online"]) || isset($_SESSION["business_is_online"])){ ?>

        <li class="nav-item">
        <a href="" class="nav-link active h6" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
        </li>

        <?php } ?>

        
        <li class="nav-item">
          <a class="nav-link active h6" href="message_ideal.php">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="register" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">SELECT YOUR MODEL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body signupmodalbody">
        <div class="col">
        <a href="marketer_registration.php"><img src="images/marketer.jpg" class="img-fluid popupimgchoose1" alt="a marketer image">
        <button class="btn btn-sm">MARKETER</button></a>
        </div>


        <div class="col">
        <a href="business_register.php"><img src="images/business.jpg" class="img-fluid popupimgchoose2" alt="a business building image" >
        <button class="btn btn-sm">BUSINESS</button></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- register modal-->

<!--Login Modal -->

<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginmodalLabel">SELECT YOUR MODEL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body signupmodalbody">
        <div class="col">
        <a href="marketer_login.php"><img src="images/marketer.jpg" class="img-fluid popupimgchoose1" alt="a marketer image">
        <button class="btn btn-sm">MARKETER</button></a>
        </div>


        <div class="col">
        <a href="business_login.php"><img src="images/business.jpg" class="img-fluid popupimgchoose2" alt="a business building image" >
        <button class="btn btn-sm">BUSINESS</button></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Login Modal -->

<!-- logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Are you Sure?</h5>
        </div>
        <div>
        <a href="logout.php" class="btn btn-danger btn-sm" id="logoutModal" >Logout</a>
        </div>
        <div>
        <button type="button" class="btn-close btn-sm animate__animated animate__pulse animate__infinite" data-bs-dismiss="modal" id="logoutModal" aria-label="Close"></button>
        </div>
      </div>
      </div>
    </div>
</div>

<!-- logout modal-->