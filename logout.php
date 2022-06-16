<?php
    //Include constants.php for SITEURL
    include('db/constrants.php');
    //1. Destroy the Session
    session_destroy();  //Unset $_Session['user']
    unset($_SESSION['access_token']);
    //2. Redirect to Index Page
    header('location:index.php');
?>