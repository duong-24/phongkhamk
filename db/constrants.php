<?php
    // Start Session
    session_start();
    
    // Create Constants to Store Non Repeating Value
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD', '');
    define('DB_NAME','quanlyphongkham');

    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Data connection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());   //Selecting Data
    mysqli_set_charset($conn,'utf8');
?>