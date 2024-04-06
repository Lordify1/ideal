<main class="body">
<?php
    error_reporting(E_ALL);
    require_once("classes/Marketer.php");
    require_once("marketer_guard.php");

    $states = $market->fetch_states();
    $levels = $market->fetch_level();
    $skills = $market->fetch_skills();
    $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

$my_id = $data["marketer_id"];

$state = $data["state_id"];

$experience_level = $market->get_experience_details($my_id);

$state_name = $market->get_state($state);

$category_name = $market->get_category($my_id);

$categories = $market->fetch_category();



//for project type area

// $pro_type_id = $data[""];

// $ptyped = $pro_type_id - 1;


// unset($categories[$ptyped]);


// array_splice($categories,-1,$data["category_id"]);   

//for project type area

//for category area

$cid = $data["category_id"];

$categoried = $cid - 1;


unset($categories[$categoried]);


array_splice($categories,-1,$data["category_id"]);

//for category area

$m_skills = $market->my_skills($my_id);

$ids_in_order = [];
foreach($m_skills as $m_skill){
array_push($ids_in_order, $m_skill["skill_id"]);
}     
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <title>PROFILE UPDATE</title>
    <link rel="icon" type="image/x-icon" href="images/ideal_logo.ico">

    

    <style>
       
   div{
       border:0px solid red;
       
       
   }

   form{
    margin-top:10px;
   }
    
  
   .body{
    background-image: url("images/marketingformbg.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
   }


   .form-push{
    margin-top: 40px;
    }

    .navbar{
        list-style-type:none;
    }
    
    input, textarea{
        margin-bottom: 20px;
    }
    

    .form-header-sm{
        display: none;
    }

    


    @media screen and (min-width:200px) and (max-width:1130px){
    .form-header-sm{
        display: block;
    }

    .form-push{
        display:none;
    }

    .formee{
        margin-top:10px;
    }

    }
    
    </style>

</head>
<body >
    
    <!-- Navigation section start -->
    <?php  include("partials/header.php")  ?>
    <!-- Navigation section end -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-5 me-3 bd-mode-toggle">
          <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-danger btn-sm animate__animated animate__fadeIn"><span class="fa fa-arrow-left fs-4"></span></a>
        </div>
        <div class="col m-2"></div>
        <?php require_once("partials/menu.php") ?>
    <div class="container-fluid">
        <div class="row marketerformrow">
            <div class="col-md-6">
                 
               <h2 class="text-white text-end form-push">Marketer Profile Update</h2>
            
<form id="marketingform" action="process/marketer_pro_process.php" method="post" class="form-control mx-1 border-dark formee">

<p id="pinfo_update"></p>
        <h4 class="text-white text-start my-3 form-header">Personal Information</h4>

    <p id="first_info_update"></p>

                    <label class="form-label " for="fname">First name</label>
                    <input class="form-control" type="name" value='<?php echo $data["marketer_fname"] ?>' name="fname" id="fname">

                    <label class="form-label" for="lname">Last Name</label>
                    <input class="form-control" type="name" value='<?php echo $data["marketer_lname"] ?>' name="lname" id="lname">
                    
                    
                    <!-- <label class="form-label  " for="email">Email Address</label>
                    <input type="email" value='<?php echo $data["marketer_email"] ?>' class="form-control" name="email" id="email"> -->

                    <label class="form-label  " for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" value='<?php echo $data["marketer_phone"] ?>' id="phone">


                    <label class="form-label" for="dob">Date Of Birth</label>
                    <input type="date" class="form-control  mb-2" name="dob" id="dob" value="<?php echo $data["marketer_dob"] ?>">

                    <button class="btn text-black d-block mt-4" name="Update_one" value="Update_one" id="Update_one" style="background-color: #00ff00; font-weight: bold;">Update</button>  

</form>

                    <!-- <hr>
                    
                    <label class="form-label  " for="pwd">Password</label>
                    <input type="password" class="form-control" placeholder="If you'd like to change your password" name="pwd" id="pwd">

                    <hr class="mt-3"> -->

    
                    <form id="marketingform" action="process/marketer_pro_process.php" method="post" class="form-control mx-1 border-dark formee">
<p id="second_info_update"></p>
                    <h4 class="text-white text-start my-3 form-header">Additional Information</h4>

                    <label class="form-label" for="BIO">BIO</label>
                    <textarea name="bio" id="bio" cols="30" placeholder="20 words minimum" class="form-control mb-2" rows="10"><?php echo $data["marketer_bio"] ?></textarea>

                    <button class="btn text-black d-block mt-4" name="Update_two" value="Update_two" id="Update_two" style="background-color: #00ff00; font-weight: bold;">Update</button>  
                    

</form>


<form id="marketingform" action="process/marketer_pro_process.php" method="post" name="thirdform" class="form-control mx-1 border-dark formee thirdform">
<p id="third_info_update"></p>

                    <h4 class="text-white text-start my-3 form-header">Professional Information</h4>

                    <label class="form-label  d-block" for="experience">Level of experience in Marketing</label> <br>
                    <select name="experience" class="form-control my-2" id="experience">
                        <?php if(!$experience_level == null){ ?>
                            <option value="<?php echo $data["experience_id"] ?>">
                            <?php
                            echo $experience_level["experience_name"];    
                            ?></option>
                            <option value=""></option>
                            <?php } ?>
                        <?php 
                    foreach ($levels as $level){
                        ?>
                        <option value="<?php echo $level["experience_id"] ?>"><?php echo $level["experience_name"] ?></option>
                        <?php } ?>
                    </select><br>
                    
                        <hr>
                    
                       
                    <label class="form-label">Areas of Expertise/Skills</label> <br>
                    <?php foreach($skills as $skill){ ?>
                    <?php if(in_array($skill["skill_id"], $ids_in_order)){ ?>
                        <input type="checkbox" class=" mx-1" name="expertise[]" id="expertise"  value='<?php echo $skill["skill_id"]; ?>' checked><?php echo $skill["skill_name"] ?><br>
                    <?php }else{ ?>
                    <input type="checkbox" class=" mx-1" name="expertise[]" id="expertise"  value='<?php echo $skill["skill_id"]; ?>'><?php echo $skill["skill_name"] ?><br>
                    <?php }
                    } ?>


            <hr>

            <div class="btn btn-border-red col-12 text-white">
           
           <label class="form-label">Link to Portfolio</label>
           <input type="text" class="form-control" name="portfoliolink" id="portfoliolink" value='<?php echo $data["portfolio"] ?>'>
           <details>if you do not have a portfolio, include information of projects you've worked on on a cloud space and share the link here</details>

           <button class="btn text-black d-block mt-4" name="Update_three" value="Update_three" id="Update_three" style="background-color: #00ff00; font-weight: bold;">Update</button>  
           
</div>

                    </form>



                    <form id="marketingform" action="process/marketer_pro_process.php" method="post" name="fourthform" class="form-control mx-1 border-dark formee fourthform">
<p id="fourth_info_update"></p>
<h4 class=" text-start my-3 form-header">Contact/Payment Information</h4>

                    <label class="form-label" for="state">State</label>
                    <select id="state" name="state" class="form-control">
                    <?php if(!$state_name == null){ ?>
                     <option value="<?php echo $data["state_id"] ?>">
                        <?php
                        echo $state_name["state_name"];
                        ?></option>
                        <option value=""></option>
                        <?php } ?>
                        <?php foreach($states as $state){ ?>

                            <option value="<?php echo $state["state_id"] ?>"><?php echo $state["state_name"]; ?></option>

                        <?php } ?>
                    </select><br>
                    
            <label for="lgas" class="form-label"></label>
            <select name="lgas" id="lgas" class="form-control">

            </select>

           <label class="form-label" for='pay'>Pay Bank</label>
           <select name="pay" id="pay" class="form-control mb-2">
           <?php $banks = $market->banks(); foreach($banks as $bank){ ?>
            <option value="<?php echo $bank["id"] ?>" <?php if($data["pay_method"] == $bank["id"]) echo 'selected'; ?>><?php echo $bank["name"] ?></option>
            <?php } ?>
           </select>

           <label class="form-label" for="a_info">Paypal Email/Account number</label>
           <input type="text" name="a_info" value='<?php echo $data["account_detail"] ?>' id="a_info" class="form-control">


           <button class="btn text-black d-block mt-4" name="Update_four" value="Update_four" id="Update_four" style="background-color: #00ff00; font-weight: bold;">Update</button>  


                        </form>




                        <form id="marketingform" class="form-control mx-auto border-dark formee fifthform" method="post" action="process/marketer_pro_process.php">
                        <p id="fifth_info_update"></p>


           <h4 class="text-white text-start my-3 form-header">Project Preferrence</h4>
          
            <label class="form-label mb-0">Category</label><br>
            <?php if(!$category_name == null){ ?>
                <input type="radio" class=" me-2" name="category" value='<?php echo $data["category_id"]; ?>' id="category" checked><span><?php echo $category_name["category_name"];
                 
            }
                ?></span><br><hr class="mt-1 mb-1">
            <?php foreach($categories as $category){  ?>
                
         <input type="radio" class=" me-2" name="category" value='<?php echo $category["category_id"]; ?>' id="category"><span><?php echo $category["category_name"]; ?></span><br>

            <?php } ?>

            <hr>

          <label class="form-label">Preferred project type</label> <br>


        <?php 
           if($data["project_type"] == "Short Term")
           { ?>
            <input type="radio"  name="project_type" value="Short Term" id="shortterm" checked></input> <span>Short-term</span> <br> 

            <?php }else{ ?>
            <input type="radio"  name="project_type" value="Short Term" id="shortterm"></input> <span>Short-term</span> <br> 
        <?php } ?>
           
        <?php if($data["project_type"] == "Long Term"){ ?>
            <input type="radio"  name="project_type" value="Long Term" id="longterm" checked> <span>Long-term</span> <br><br>
            <?php }else{ ?>
                <input type="radio"  name="project_type" value="Long Term" id="longterm"> <span>Long-term</span> <br><br>
        <?php } ?>
           
           <hr>
           
           <label class="form-label">Availability</label> <br>
        <?php if($data["marketer_availability"] == "Part time"){ ?>
          <input type="radio"  name="availability" value="Part time" id="parttime" checked> <span>Part-time</span> <br>
          <?php }else{ ?>
            <input type="radio"  name="availability" value="Part time" id="parttime"> <span>Part-time</span> <br>
        <?php } ?>
          
        <?php if($data["marketer_availability"] == "Fulltime"){ ?>
          <input type="radio"  name="availability" value="Fulltime" id="fulltime" checked> <span>Full-time</span> <br>
          <?php }else{ ?>
            <input type="radio"  name="availability" value="Fulltime" id="fulltime"> <span>Full-time</span> <br>
        <?php } ?>
         
        <?php if($data["marketer_availability"] == "Freelance"){ ?>
         <input type="radio"  name="availability" value="Freelance" id="freelance" checked> <span>Freelance</span> <br><br>
            <?php }else{ ?>
            <input type="radio"  name="availability" value="Freelance" id="freelance"> <span>Freelance</span> <br><br>
        <?php } ?>
                    
         <button class="btn text-black d-block mt-4" name="Update_five" value="Update_five" id="Update_five" style="background-color: #00ff00; font-weight: bold;">Update</button>   
            </form> 
            </div>
        </div>
    </div>

        <!-- footer section starts here -->

        <?php include("partials/footer.php")  ?>
    
    <!-- footer section ends here -->
    
    
    

    <script>
    $(document).ready(function () {
        
        
            var selectedStateId = $("#state").val();

            
            $.ajax({
                url: 'process/general_process.php', 
                method: 'POST',
                data: { stateId: selectedStateId },
                dataType: 'json',
                success: function (data) {
                    // Clear existing options
                    $('#lgas').empty();

                    // Populate options for LGAs
                    $.each(data, function (index, item) {
                        $('#lgas').append('<option value="' + item.lga_id + '">' + item.lga_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });


            $("#state").change(function()
            {
                 
        
            var selectedStateId = $("#state").val();


$.ajax({
    url: 'process/general_process.php', 
    method: 'POST',
    data: { stateId: selectedStateId },
    dataType: 'json',
    success: function (data) {
        // Clear existing options
        $('#lgas').empty();

        // Populate options for LGAs
        $.each(data, function (index, item) {
            $('#lgas').append('<option value="' + item.lga_id + '">' + item.lga_name + '</option>');
        });
    },
    error: function (xhr, status, error) {
        console.error(error);
    }
});
            })




        });
</script>
</body>
</html>

            </main>