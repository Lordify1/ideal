<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="iDEAL">
    <title>Login to iDEAL</title>


<link href="css/bootstrap.css" rel="stylesheet">

    <style>


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
        .bd-placeholder-img-lg {
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

      
      @media (min-width:200px) and (max-width:800px) {
        #donthaveanaccount{
          display:none;
        }
      }
      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center bg-dark text-white py-4 bg-body-tertiary" style="flex-direction:column">


  <!-- Navigation section start -->
  <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->

    
<main class="form-signin w-100 m-auto">
  <form>
    <img class="mb-4" src="images/ideal logo-shadow.png" alt="" width="100" height="67">
    <h1 class="h5 mb-3 fw-normal">Sign in to continue</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput" id="emailtext" class="text-dark">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword" class="text-dark">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2 my-1" id="signin" type="button" disabled>Sign in</button>
    <p class="mt-2 mb-3 text-body-secondary">&copy; iDEAL 2023</p>
  </form>
</main>

<footer class="container">
  <div class="row loginfooter p-3">
  <div class="col">
  <span id="donthaveanaccount">Don't have an account? </span><a href="#" id="registerhere" style="text-decoration: none;"><span>Register here</span></a>
    
  </div>

  <div class="col">
  <a href="" class="forgotpassword"><span class="text-end d-block">Forgot password</a></span>
  </div>
  </div>
</footer>





      <script src="js/bootstrap.bundle.js"></script>

      <script src="../assets/js/color-modes.js"></script>

      <script src="script/jqueryfile.js"></script>


      <script>



      </script>


    </body>
</html>
