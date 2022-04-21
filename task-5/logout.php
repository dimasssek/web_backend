<?php
    session_start();    
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", 1);
    var_dump($_SESSION);    // (empty)
    header("Location: index.php");
    exit;
?>