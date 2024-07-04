<?php
//start session
session_start();

// function generateCSRFToken(){
//     if(empty($_SESSION['token'])) {
//         // GENERATE RANDOM TOKEN (STRING)
        $_SESSION["token"] = bin2hex(random_bytes(32));
        // print_r($_SESSION);
//     }
//     return $_SESSION['token'];
// }

?>