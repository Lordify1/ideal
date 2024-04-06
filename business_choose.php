<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>iDEAL</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>

   <style>

    #bodie{
        background-color: rgba(0,0,0,0.2);
    }
      
      .allofit{
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.7)), url("images/ideal logo-shadow.png");
        background-repeat: no-repeat;
        background-position: left;
        background-size: contain;
      }

      .whereto{
        display: flex;
        flex-direction: column;
        align-items:center;
        justify-content: center;
      }

      .fa{
        color : rgba(0,102,152);
      }

      .selector1{
        border-top-left-radius:20px;
        display:flex;
        flex-direction: row;
        align-items:center;
        justify-content: space-between;
      }

      .selector2{
        border-bottom-right-radius:20px;
        display:flex;
        flex-direction: row;
        align-items:center;
        justify-content: space-between;
      }

      
   </style> 
</head>



<body id="bodie">



<div>


    <!-- SECTION FOR BUSINESSES -->
    
    <!-- Navigation section start -->
        <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
 

    <header class="container-fluid allofit">
        <section class=" whereto row me-1 ms-1" style="height: 100vh">
            <h2 class="text-center fw-bolder text-white pb-2">Where to Now? <span class="fa fa-paper-plane" ></span></h2>

            <article class=" selector1 bg-white col-md-6 col-sm-8 p-2 mb-1">
              <a href="" class="selector1 col-12 p-2 text-decoration-none bg-dark text-white">
              <section>
                <h2 clsss="marketer_dashboard.php">Go to Dashboard</h2>
              </section>
              <section>
              <h2><span class="fa fa-user"></span></h2>
              </section>
              </a>
            </article>

            <article class=" selector2 col-md-6 col-sm-8 mt-1 p-2 bg-dark">
              <a href="projects_home.php" class="selector2 bg-light col-12 p-2 text-decoration-none text-black">
              <section>
              <h2><span class="fa fa-briefcase"></span></h2>
              </section>
              <section>
                <h2 class="">See Marketers</h2>
              </section>
              </a>
            </article>

            <article class=" selector2 col-md-6 col-sm-8 mt-1 p-2 bg-dark">
              <a href="business_project_form.php" class="selector2 bg-light col-12 p-2 text-decoration-none text-black">
              <section>
              <h2><span class="fa fa-plus"></span></h2>
              </section>
              <section>
                <h2 class="">Create Project</h2>
              </section>
              </a>
            </article>
        </section>
    </header>
    


        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->

    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

    


    </script>
</body>
</html>