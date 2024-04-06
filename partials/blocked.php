<?php
    
    if(isset($_SESSION["marketer_is_online"]))
    {

        $data = $market->get_userbyid($_SESSION["marketer_is_online"]);

        $check = $data["marketer_status"];
        if($check == 'blocked')
        {
            unset($_SESSION["marketer_is_online"]);
            $_SESSION["blocked"] = "Your accout has been Blocked by the Admin. Check your email for more information";
            header("location:../index.php");
        }

    }

?>




<?php
    
    if(isset($_SESSION["business_is_online"]))
    {

        $data = $business->get_userbyid($_SESSION["business_is_online"]);

        $check = $data["business_status"];
        if($check == 'blocked')
        {
            unset($_SESSION["business_is_online"]);
            $_SESSION["blocked"] = "Your accout has been Blocked by the Admin. Check your email for more information";
            header("location:../index.php");
        }

    }

?>






