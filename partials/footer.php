
<style>
    footer, div{
        border:0px solid green;
        
    }

   h3{
    color: white;
   }

    .footerrow{
        display:flex;
        flex-direction: row;
        text-align:center;
        align-items:center;
        justify-content:center;
    }

    

    .footerlinks{
        text-decoration:none;
        display: block;
        color: #00ff00;
        font-size: 0.5rem;
    }

   

</style>

    


<footer class="container-fluid bg-dark pt-3 pb-3">
    <div class="row footerrow">
        <div class="col">
            <h3>Marketer</h3>
            <a href="marketer_registration.php" class="footerlinks">Sign Up</a>
            <a href="marketer_login.php" class="footerlinks">Login</a>
            <a href="all_projects.php" class="footerlinks">Active Projects</a>
            <a href="all_businesses.php" class="footerlinks">Businesses</a>
        </div>



        <div class="col">
            <h3>Business</h3>
            <a href="business_register.php" class="footerlinks">Sign Up</a>
            <a href="business_login" class="footerlinks">Login</a>
            <a href="all_marketers.php" class="footerlinks">Marketers</a>
        </div>
        <div class="col">
            <h3>iDEAL</h3>
            <a href="about_us.php" class="footerlinks">About</a>
            <a href="blog.php" class="footerlinks">Blog</a>
            <a href="" class="footerlinks">Partners</a>
        </div>
        <hr style="color:white;  margin-top:5px;">
        <div class="col-12" style="color:white;">
            <p>&copy; iDEAL <?php echo date("Y") ?></p>
        </div>
    </div>
</footer>

</main>

<script src="script/jqueryfile.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/marketer.js"></script>
<script src="script/preloader.js"></script>


 
<script type="text/javascript">


    $(document).ready(function () {
        $("#check_availability").click(function (e) { 
            e.preventDefault();
        var title = $("#protitle").val();
        
        $.ajax({
            type: "post",
            url: "process/project_process.php",
            data: {title : title},
            success: function (response) {
              $("#loadered").html(response)
            }
        });
        });
    });

    

</script>
</body>
</html>
