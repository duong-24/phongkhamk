<?php 
session_start();
    ob_start();
    $action=$_GET['action'];
    include '../db/dbhelp.php';
    $crud= new Action();
    if($action=='login'){
        $login=$crud->login();
        if($login)
            echo $login;
    }
    if($action=='logout'){
        $logout=$crud->logout();
        if($logout)
            echo $logout;
    }
    if($action == "delete_appointment"){
        $save = $crud->delete_appointment();
        if($save)
            echo $save;
    }
    if($action == "delete_doctor"){
        $save = $crud->delete_doctor();
        if($save)
            echo $save;
    }
    if($action == "set_appointment"){
        $save = $crud->set_appointment();
        if($save)
            echo $save;
    }
    if($action == "Khoiphuc"){
        $save = $crud->Khoiphuc();
        if($save)
            echo $save;
    }
    if($action == "delete_thuocc"){
        $save = $crud-> delete_thuoc();
        if($save)
            echo $save;
    }
    if($action == "delete_lichhen"){
        $save = $crud->delete_lichhen();
        if($save)
            echo $save;
    }

?>