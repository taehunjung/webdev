<?php
    session_start();
    
    session_unset();
   /* $_SESSION["loggedin"]=false;
    unset($_SESSION["id"]);
    unset($_SESSION["user"]);
    */
    echo 'session ended';
    header('location:index.php');
?>