
<main class="h-100 all_testimonials_bg">
<!-- header section -->

<?php 
session_start();
require_once("partials/header.php") 
?>
<style>
  /* *{
    border:2px solid red;
  } */


  section{
    background-color:rgba(255,255,255,0.5);
    border:10px solid #0066cc;
  }

  section img{
    border:10px solid rgba(0,0,0,0.5)
  }

  h6{
    padding: 10px;
    background-color: black;
    border-radius:5px;
    border-top-left-radius: 20px;
    color: white;
  }
</style>
<!-- header section -->
<?php if(isset($_SESSION["marketer_is_online"])){ ?>
    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="marketer_dashboard.php" class="btn ideal-bg btn-sm ">My Dashboard</a>
        </div>
        <?php } ?>

        <?php if(isset($_SESSION["business_is_online"])){ ?>
    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="business_dashboard.php" class="btn ideal-bg btn-sm ">My Dashboard</a>
        </div>
<?php } ?>

<div class="dropdown position-fixed bottom-0 end-0 mb-2 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-6"></span></a>
        </div>

<div class="container-fluid">
  <div class="row  rowarrange">
        <h1 class="display-6 text-center text-white p-2">YOUR TESTMONIALS</h1>  
         <section class="col-md-4 col-sm-5 col-lg-3 colarrange p-1 m-1">
         <img src="images/profilebg.jpg" class="img-fluid m-2 testimonial_pro_img" width="200"  alt="">
         <div class=" p-1 text-center card-text">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, qui error cupiditate voluptas voluptates expedita numquam libero dolor? Neque quam eius, id velit nostrum odit autem?  impedit voluptatem at temporibus distinctio! Porro laboriosam, consequuntur commodi nesciunt libero aliquam?</p>
          <h6>Owoeye Joshua - CEO of Creativity Pro</h6>
         </div>
         
      </section>


      <section class="col-md-4 col-sm-5 col-lg-3 colarrange p-1 m-1">
            <img src="images/profilebg.jpg" class="img-fluid m-2 testimonial_pro_img" width="200"  alt="">
            <div class=" p-1 text-center card-text">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, qui error cupiditate voluptas voluptates expedita numquam libero dolor? Neque quam eius, id velit nostrum odit autem?  impedit voluptatem at temporibus distinctio! Porro laboriosam, consequuntur commodi nesciunt libero aliquam?</p>
          <h6>Owoeye Joshua - CEO of Creativity Pro</h6>
         </div>
      </section>


      <section class="col-md-4 col-sm-5 col-lg-3 colarrange p-1 m-1">
          <img src="images/profilebg.jpg" class="img-fluid m-2 testimonial_pro_img" width="200"  alt="">
          <div class=" p-1 text-center card-text">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, qui error cupiditate voluptas voluptates expedita numquam libero dolor? Neque quam eius, id velit nostrum odit autem?  impedit voluptatem at temporibus distinctio! Porro laboriosam, consequuntur commodi nesciunt libero aliquam?</p>
          <h6>Owoeye Joshua - CEO of Creativity Pro</h6>
         </div>
      </section>


      <section class="col-md-4 col-sm-5 col-lg-3 colarrange p-1 m-1">
          <img src="images/profilebg.jpg" class="img-fluid m-2 testimonial_pro_img" width="200"  alt="">
          <div class=" p-1 text-center card-text">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, qui error cupiditate voluptas voluptates expedita numquam libero dolor? Neque quam eius, id velit nostrum odit autem?  impedit voluptatem at temporibus distinctio! Porro laboriosam, consequuntur commodi nesciunt libero aliquam?</p>
          <h6>Owoeye Joshua - CEO of Creativity Pro</h6>
         </div>
      </section>
      </div>
     

</div>

        </main>
<!-- footer section -->

 <?php require_once("partials/footer.php") ?>

<!-- footer section -->
