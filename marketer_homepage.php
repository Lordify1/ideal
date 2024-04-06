<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="iDEAL">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>WorkSpace</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel='stylesheet' href='fa/css/all.css'>

   <style>

        *{
            box-sizing: border-box;
        }

        .searchproject{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
           
        }

        /* section, article, div{
            border: 1px solid red;
        } */


        @media (min-width: 300px) and (max-width:700px;){

          .searchproject{
            display:none;
          }

        }
       
   </style>
</head>



<body>

        <!-- Navigation section start -->
        <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->

    <header class="container-fluid">
        <header class="row mt-1 bg-danger p-2">
            <section class="col-sm-1 searchproject">
                <a href=""><img src="images/mylogo.png" class="img-fluid border-success btn btn-sm" style="border: 2px solid red;" width="50" height="50" alt=""></a>
            </section>
            <section class="col--md-10 searchproject">
                <input type="search" name="marketer_home_searchbar" placeholder="search for a project" id="" class="form-control bg-white border-success">
            </section>
            <section class="col-1 searchproject">
                <input type="submit" value="Search" class="btn border-success">
            </section>
        </header>
    </header>

    <h1 class="text-center py-2">Projects</h1>

    <div class="col m-2">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-3 shadow-sm" style="border-radius: 2%;">
              <img src="images/bgimg.jpg" width="100%" style="border-radius: 2%;" height="100%">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                <h5 class="card-title">Project Name : IDEAL THING</h5>
                <p class="card-text">Project description : loremloremloremloremloremloremloremloremloremlorem loremloremloremloremloremloremloremloremloremlorem loremloremloremloremloremloremloremloremloremlorem loremloremloremloremloremloremloremloremloremlorem loremloremloremloremloremloremloremloremloremlorem</p> <!--projet description shouldnt be more than 250 words-->
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> <!--time project was added-->
                <button class="btn btn-primary">View project</button>
                    <p class="text-end card-text">Company name: iDEAL</p>
              </div>
            </div>
          </div>
        </div>
      </div>



    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

    


    </script>
</body>
</html>