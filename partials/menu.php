<?php

  if(isset($_SESSION["marketer_is_online"])){ 


  ?>
        <header class="dashboardnav p-2 ideal-shadow col-12 " >
            <section class="col-md-11">
            <h4 style="font-size:1vm" class="ms-3 text-white"><?php echo $data["marketer_lname"]; ?></h4>
            </section>
            <section class="col-md-1">
            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img 
                <?php
              $dp = $market->get_dp($data["marketer_id"]);

              if(!$dp["marketer_picture"] == null)
              { ?>
               
               src = "images/marketer_dp/<?php echo $dp["marketer_picture"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?>alt="mdo" width="50" height="50" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small ">
                <li><a class="dropdown-item" href="marketer_profile.php">Profile</a></li>
                <!-- <li><a class="dropdown-item" href="profile.php">Change Theme</a></li> -->
                <li><a class="dropdown-item" href="marketer_dp_upload.php">Update Profile picture</a></li>
                <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
              </ul>
            </div>
            </section>
        </header>


<?php }?>







<?php

  if(isset($_SESSION["business_is_online"])){ 


  ?>
       <header class="dashboardnav p-2 ideal-shadow">
            <section class="col-md-11">
            <h4 style="font-size:1vm" class="ms-3 text-white"><?php echo $data["business_name"]; ?>  </h4>
            </section>
            <section class="col-md-1">
            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img
                <?php
              $logo = $business->get_logo($data["business_id"]);

              if(!$logo["business_logo"] == null)
              { ?>
               
               src = "images/business_logo/<?php echo $logo["business_logo"] ?>"
               
              <?php }else{  ?>
                src="images/bgimg.jpg"
            <?php  }  ?> 
                alt="mdo" width="50" height="50" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small ">
                <li><a class="dropdown-item" href="business_profile.php">Profile</a></li>
                <!-- <li><a class="dropdown-item" href="profile.php">Change Theme</a></li> -->
                <li><a class="dropdown-item" href="business_image_upload.php">Update Logo</a></li>
                <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
              </ul>
            </div>
            </section>
        </header>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Are you Sure?</h5>
        </div>
        <div>
        <a href="logout.php"><button class="btn btn-danger btn-sm" id="logoutModal">Logout</button></a>
        </div>
        <div>
        <button type="button" class="btn-close btn-sm animate__animated animate__pulse animate__infinite" data-bs-dismiss="modal" id="logoutModal" aria-label="Close"></button>
        </div>
      </div>
      </div>
    </div>
</div>

<?php }?>
