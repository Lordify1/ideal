<?php  
  session_start();
  require_once("classes/General.php");
  require_once "classes/Business.php";
  require_once "classes/Marketer.php";
  $messages = $general->message_type();

  
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="iDEAL">
    <link rel="icon" type="image/x-icon" href="images/ideal_logo.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>
    <link href="css/sign-in.css" rel="stylesheet">

    <style>


      *{
        box-sizing: border-box;
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

            /* *{
        border:1px solid red;
      } */

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }


      .loginfooter{
        display:flex;
        flex-direction:row;
        justify-content:space-between !important;
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.1) );
        border-radius: 20px;
        font-size:1em;
      }

      .forgotpassword{
        text-decoration:none !important;
      }

      @media (min-width: 768px) {
        
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



      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      
      @media (min-width:200px) and (max-width:800px) {
        #donthaveanaccount{
          display:none;
        }

        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body class="d-flex align-items-center bg-dark text-white py-4 bg-body-tertiary" style="flex-direction:column">
    
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
          <a class="nav-link active h6" href="#">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


  





<main class="form-signin w-100 m-auto josh" height="100vh">
<?php

if(isset($_SESSION["success_message"])){
  echo "<div class='alert alert-info'>" . $_SESSION["success_message"] . "</div>";
  unset($_SESSION["success_message"]);
}

if(isset($_SESSION["error_message"])){
  echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
  unset($_SESSION["error_message"]);
}

?>
  <form action="process/message.php" method="post">
    <h1 class="h5 mb-3 fw-normal">Tell iDEAL</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
      value="
      <?php if(isset($_SESSION["marketer_is_online"])){
        $marketer = $market->get_userbyid($_SESSION["marketer_is_online"]); echo $marketer["marketer_email"];
      } ?>

<?php if(isset($_SESSION["business_is_online"])){
        $business = $business->get_userbyid($_SESSION["business_is_online"]); echo $business["business_email"];
      } ?>
      "
      >
      <label for="email" id="emailtext" class="text-dark">Email address</label>
    </div>
        <input type="hidden" name="business_id" value="
        <?php if(isset($_SESSION["business_is_online"])){
          $business_id = $_SESSION["business_is_online"];
          echo $business_id;
        } ?>">

<input type="hidden" name="marketer_id" value="
        <?php if(isset($_SESSION["marketer_is_online"])){
          $marketer_id = $_SESSION['marketer_is_online'];
          echo $marketer_id;
        } ?>">
      <textarea type="message" class="form-control" rows="5" col="20" name="message" id="message" placeholder="Message"></textarea>
      <label for="message" class="text-dark">Message</label>
      <select name="message_type" id="message_type" class="form-control">
        <?php foreach($messages as $message){ ?>
          <option value="<?php echo $message["message_type_name"] ?>"><?php echo $message["message_type_name"] ?></option>
        <?php } ?>
      </select>
    <input type="submit" name="message_ideal" value="SEND" class="btn btn-primary w-100 py-2 my-1" id="message_ideal">
    </div>

  </form>
</main>



      <script src="js/bootstrap.bundle.js"></script>

      <script src="../assets/js/color-modes.js"></script>

      <script src="script/jqueryfile.js"></script>


      <script>



      </script>


    </body>
</html>
