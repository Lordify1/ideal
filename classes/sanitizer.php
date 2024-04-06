<?php



function sanitizer($bad_input){

    $safe_input = trim($bad_input);
    $safe_input = htmlspecialchars($safe_input);
    $safe_input = strip_tags($safe_input);
    
    return $safe_input;

}







?>