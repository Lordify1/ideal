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
       
       /* *{
        border: 2px solid red;
        box-sizing: border-box;
       } */

       ::-webkit-scrollbar{
            width:9px;
        }

        ::-webkit-scrollbar-thumb{
            background: linear-gradient(transparent, black);
            border-radius: 20px;
        }


   </style>
</head>



<body id="mainbody">



<div id="businessdiv">


    <!-- SECTION FOR BUSINESSES -->
    
    <!-- Navigation section start -->
        <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
 


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SELECT YOUR MODEL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body signupmodalbody">
        <div class="col">
        <a href="marketer_registration.php"><img src="images/marketer.jpg" class="img-fluid popupimgchoose1" alt="">
        <button class="btn btn-sm">MARKETER</button></a>
        </div>


        <div class="col">
        <a href="business_register.php"><img src="images/business.jpg" class="img-fluid popupimgchoose2" alt="" >
        <button class="btn btn-sm">BUSINESS</button></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->


    <!-- hero section starts here -->

    <div class="container-fluid herocontainer">
        <div class="row">
            <div class="col herotexts">
                
            <h1 >MARKETER <span style="color: #0066cc">MEET</span> BUSINESS</h1>
            <h1>BUSINESS <span style="color: #666633">MEET</span> MARKETER</h1>
            </div>
        </div>
        <div class="row">
            <p class="text-white" style="font-weight:bold">Looking for a capable marketer for your business? <br>
            Or are you a marketer looking to explore your marketing skills the more?<br>
            This is the <a href="aboutus.php" id="ideallink" >iDEAL</a> place for you. <br>
            Sign Up or Login to continue.</p>
        </div>
        <div class="row">
            <div class="col">
            <a href="" class="herolinks1 btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">SIGN UP</a>
            <a href="login.php" class="herolinks2 btn text-white" style="background-color: #0066cc !important;">LOGIN</a>
            </div>
        </div>
    </div>

    <!-- hero section ends here -->

     

    <!-- whyideal section starts here -->

    <div class="container-fluid whyidealmain">
        <div class="row">
            <div class="col-2 whyimgbackground">
                <img src="./images/ideal logo-shadow.png" class="img-fluid" width="150" height="150" alt="" >
            </div>
            <div class="col whyideal">
            <a href="footer.php" class="btn whyidealtext text-white text-lg"><h1>WHY iDEAL?</span></h1></a>
            </div>
        </div>
    </div>
    
    <!-- whyideal section ends here -->

    <div class="container-fluid">
        <h1 class="text-end text-white">PROJECTS</h1>
    </div>


    <!-- projects section starts here -->


    <div class="container-fluid">
       <div class="row selectedprojectsmain my-2 py-2">

    
    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h4>Project Name: <span>iDEAL</span></h4>
        <hr>
        <h4 class="d-inline">Project Details: </h4><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad cum perferendis, veniam ea incidunt, maxime repellat exercitationem soluta iusto harum accusantium quos a in inventore ut sint, error ipsum officiis.</span><br>
        <hr>
        <h4 class="d-inline">Project Offer: </h4><span>50,000</span><br>
        <hr>
        <h4 class="d-inline">Project Status: </h4><span>Active</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Project</a>
    </div>
    </div>

    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h4>Project Name: <span>iDEAL</span></h4>
        <hr>
        <h4 class="d-inline">Project Details: </h4><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad cum perferendis, veniam ea incidunt, maxime repellat exercitationem soluta iusto harum accusantium quos a in inventore ut sint, error ipsum officiis.</span><br>
        <hr>
        <h4 class="d-inline">Project Offer: </h4><span>50,000</span><br>
        <hr>
        <h4 class="d-inline">Project Status: </h4><span>Active</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Project</a>
    </div>
    </div>

    <div class="col-md-3 col-10  my-1">
        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h4>Project Name: <span>iDEAL</span></h4>
        <hr>
        <h4 class="d-inline">Project Details: </h4><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad cum perferendis, veniam ea incidunt, maxime repellat exercitationem soluta iusto harum accusantium quos a in inventore ut sint, error ipsum officiis.</span><br>
        <hr>
        <h4 class="d-inline">Project Offer: </h4><span>50,000</span><br>
        <hr>
        <h4 class="d-inline">Project Status: </h4><span>Active</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Project</a>
    </div>
    </div>

    <div class="col-md-3 col-10  my-1">
        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h4>Project Name: <span>iDEAL</span></h4><hr>
        <h4 class="d-inline">Project Details: </h4><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad cum perferendis, veniam ea incidunt, maxime repellat exercitationem soluta iusto harum accusantium quos a in inventore ut sint, error ipsum officiis.</span><br>
        <hr>
        <h4 class="d-inline">Project Offer: </h4><span>50,000</span><br>
        <hr>
        <h4 class="d-inline">Project Status: </h4><span>Active</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Project</a>
    </div>    
    </div>
    </div>
</div>




    <!-- projects section ends here -->

     
    <div class="container-fluid">
        <h1 class="text-center text-white">TESTIMONIALS</h1>
    </div>
    
    

    <!--testimonials start here-->



    <div class="container-fluid">
        <div class="row testimonialarrange">
        <div class="col-md-3 testimonialimg">
            <img src="images/m1.jpeg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
         <h6 class="text-light h5">Cristiano Ronaldo</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m3.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Racheal Benson</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m2.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Rev. Akinboyewa</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        <div class="col-md-3 testimonialimg">
            <img src="images/m4.jpg" class="img-fluid" width="100%" alt="">
        <div class="col testimonialoverlaytext">
        <h6 class="text-light h5">Oke Jolajesu</h6>
         <h5 class="text-center text-white p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt iusto accusantium sequi assumenda, aut ipsam similique officiis commodi cupiditate vero fugiat in magni adipisci impedit placeat voluptate laudantium eligendi debitis?</h5>
        </div>
        </div>

        </div>
    </div>


    <!-- testimonials ends here-->






    <div class="container-fluid">
        <h1 class="text-start text-white">MARKETERS</h1>
    </div>



    <!-- marketers section starts here -->

   
       
    <div class="container-fluid">
       <div class="row selectedprojectsmain my-2 py-2">

    
    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h5 class="d-inline">Name:</h5><span>Owoeye Joshua</span>
        <hr>
        <h5 class="d-inline">Level: </h5><span>Expert</span><br>
        <hr>
        <h5 class="d-inline">Projects handled: </h5><span>6</span><br>
        <hr>
        <h5 class="d-inline">Active projects: </h5><span>4</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Marketer</a>
    </div>
    </div>

    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h5 class="d-inline">Name:</h5><span>Owoeye Joshua</span>
        <hr>
        <h5 class="d-inline">Level: </h5><span>Expert</span><br>
        <hr>
        <h5 class="d-inline">Projects handled: </h5><span>6</span><br>
        <hr>
        <h5 class="d-inline">Active projects: </h5><span>4</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Marketer</a>
    </div>
    </div>

    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h5 class="d-inline">Name:</h5><span>Owoeye Joshua</span>
        <hr>
        <h5 class="d-inline">Level: </h5><span>Expert</span><br>
        <hr>
        <h5 class="d-inline">Projects handled: </h5><span>6</span><br>
        <hr>
        <h5 class="d-inline">Active projects: </h5><span>4</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Marketer</a>
    </div>
    </div>

    <div class="col-md-3 col-10 my-1">

        <img src="images/mylogo.png" class="img-fluid bg-dark selectedprojectsimg" alt="">
        <div class="col bg-white p-2 selectedprojectstextbar">
        <h5 class="d-inline">Name:</h5><span>Owoeye Joshua</span>
        <hr>
        <h5 class="d-inline">Level: </h5><span>Expert</span><br>
        <hr>
        <h5 class="d-inline">Projects handled: </h5><span>6</span><br>
        <hr>
        <h5 class="d-inline">Active projects: </h5><span>4</span>
        <hr>
        <a href="" class="text-end text-decoration-none btn btn-sm btn-primary">View Marketer</a>
    </div>
    </div>
    </div>
</div>


       <!--Blog section starts here-->




       <iframe src="blog.php" class="blogembed" frameborder="2"></iframe>




       <!--Blog section starts here-->








    <!-- marketers section ends here -->
    


    <!-- newsletter section starts here -->



    <div class="container-fluid formmain p-4">
        <div class="row newsletter">
            <div class="col-md-6 text-white">
                <h2 class="m-4 text-center">Subscribe to our Newsletter</h2>
                <form action="#" class="form-control text-white px-3 mainformedit">
                    <label for="name" class="form-label m-2">Name</label>
                    <input id="name" type="text" class="form-control m-2">

                    <label for="email" class="form-label m-2">Email Address</label>
                    <input id="email" type="email" class="form-control m-2">

                    <button class="btn btn-success m-2">Sign Up</button>
                </form>
            </div>
            
        </div>
    </div>



    <!-- newsletter section starts here -->


    <!-- footer section starts here -->

    <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->





     <!-- SECTION FOR BUSINESSES -->

</div>






      <!-- SECTION FOR MARKETERS -->







       <!-- SECTION FOR MARKETERS -->



    <script src="script/jqueryfile.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

    


    </script>
</body>
</html>