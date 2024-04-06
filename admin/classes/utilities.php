<?php
    error_reporting(E_ALL);

    function sanitizer($evil_string){
        $cleaned = strip_tags($evil_string);
        $cleaned = trim($cleaned);
        $cleaned = htmlspecialchars($cleaned);
        return $cleaned;
    }


?>