$(document).ready(function () {
    $("#all_active_marketers").change(function () {
        if ($(this).prop("checked")){
            $(".active_marketer").prop("checked", true);
        }else{
           $(".active_marketer").prop("checked", false); 
        }
    });

    $("#all_blocked_marketers").change(function () {
        if ($(this).prop("checked")){
            $(".blocked_marketer").prop("checked", true);
        }else{
           $(".blocked_marketer").prop("checked", false); 
        }
    });

    $("#all_pending_marketers").change(function () {
        if ($(this).prop("checked")){
            $(".pending_marketer").prop("checked", true);
        }else{
           $(".pending_marketer").prop("checked", false); 
        }
    });


    $("#all_active_business").change(function () {
        if ($(this).prop("checked")){
            $(".active_business ").prop("checked", true);
        }else{
           $(".active_business ").prop("checked", false); 
        }
    });

    $("#all_blocked_business").change(function () {
        if ($(this).prop("checked")){
            $(".blocked_business").prop("checked", true);
        }else{
           $(".blocked_business").prop("checked", false); 
        }
    });

    // $("#all_pending_marketers").change(function () {
    //     if ($(this).prop("checked")){
    //         $(".pending_marketer").prop("checked", true);
    //     }else{
    //        $(".pending_marketer").prop("checked", false); 
    //     }
    // });
});
