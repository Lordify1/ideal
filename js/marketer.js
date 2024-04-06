$(document).ready(function () {
    //for profile activation check
    $("#profile_activator").click(function (e) { 
        e.preventDefault();
        account_activation_id = $(this).val();
        
        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: {account_activation_id: account_activation_id},
            dataType: "json",
            success: function (response) {
                $("#pinfo_update").html(response);
            }
        });
    });
    //for profile activation check


    //for marketer profile  check
    $("#Update_one").click(function (e) { 
        e.preventDefault();
        fname = $("#fname").val();
        lname = $("#lname").val();
        phone = $("#phone").val();
        dob = $("#dob").val();

        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: {fname : fname, lname: lname, phone: phone, dob: dob},
            dataType: "json",
            success: function (response) {
                $("#first_info_update").html(response);
            }
        });
    });

    $("#Update_two").click(function (e) { 
        e.preventDefault();
        bio = $("#bio").val();

        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: {bio : bio},
            dataType: "json",
            success: function (response) {
                $("#second_info_update").html(response);
            }
        });
    });

    $("#Update_three").click(function (e) { 
        e.preventDefault();
        var data = $(".thirdform").serialize()
        
        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: data,
            dataType: "json",
            success: function (response) {
                $("#third_info_update").html(response);
            }
        });
    });

    $("#Update_four").click(function (e) { 
        e.preventDefault();
        var data = $(".fourthform").serialize()
        
        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: data,
            dataType: "json",
            success: function (response) {
                $("#fourth_info_update").html(response);
            }
        });
    });

    $("#Update_five").click(function (e) { 
        e.preventDefault();
        var data = $(".fifthform").serialize()
        
        $.ajax({
            type: "post",
            url: "process/marketer_pro_process.php",
            data: data,
            dataType: "json",
            success: function (response) {
                $("#fifth_info_update").html(response);
            }
        });
    });
    //for marketer profile check




    $("#business_profile_activate").click(function (e) { 
        e.preventDefault();
        id = $(this).val();

        $.ajax({
            type: "post",
            url: "process/activator.php",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $("#business_activate").html(response);
            }
        });
    });

    $("#Bus_profile_one").click(function (e) { 
        e.preventDefault();
        var FormData = $(".business_profile_formone").serialize();

        $.ajax({
            type: "post",
            url: "process/business_pro_process.php",
            data: FormData,
            dataType: "json",
            success: function (response) {
                $("#business_profile_formone_info").html(response);
            }
        });
    });


    $("#Bus_profile_two").click(function (e) { 
        e.preventDefault();
        var FormData = $(".business_profile_formtwo").serialize();

        $.ajax({
            type: "post",
            url: "process/business_pro_process.php",
            data: FormData,
            dataType: "json",
            success: function (response) {
                $("#business_profile_formtwo_info").html(response);
            }
        });
    });

    $("#Bus_profile_three").click(function (e) { 
        e.preventDefault();
        var FormData = $(".business_profile_formthree").serialize();

        $.ajax({
            type: "post",
            url: "process/business_pro_process.php",
            data: FormData,
            dataType: "json",
            success: function (response) {
                $("#business_profile_formthree_info").html(response);
            }
        });
    });
});