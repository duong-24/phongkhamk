<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  session_start();
  if(isset($_SESSION['id_pay'])){
      $s=$_SESSION['id_pay'];
  }else{
    $_SESSION['id_pay']='';
  }
$vnp_TmnCode = "3OPG5QFM"; //Website ID in VNPAY System
$vnp_HashSecret = "KGVVFFHPKTCACDUUTBUMOCQSOCLOEBCM"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost:8080/quanlyphongkham/vnpay_php/vnpay_return.php?id=".$_SESSION['id_pay']."";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
