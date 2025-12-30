<?php

function formatName($name) {
    return trim($name);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validateAge($age){
    return $age > 0; 
}
?>
