<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Quản Lý Admin</title>


  <?php
  include '../db/dbhelp.php';
  include '../db/connect.php';
  include('../db/validation.php');
  if (!isset($_SESSION['login_id']))
    header('location:login.php');

  include('./header.php');

  // include('./auth.php'); 
  ?>
</head>
<style>
  *{
    box-sizing: border-box;
  }
  main#view-panel{
    margin-left: 400px;
  }
  .card{
    width: 90%;
  }
  body {
    background: #80808045;
  }

  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }

  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
</style>

<body>
  <?php include 'topbar.php' ?>
  <?php include 'navbar.php'?>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <main id="view-panel">
    <?php
    if (isset($_GET['page'])) {
      switch ($_GET['page']) {
        case 'home':
          include 'home.php';
          break;
        case 'lichhen':
          include 'View/lichkham.php';
          break;
        case 'doctors':
              if(isset($_GET['idsua'])){
                if(isset($_POST['Cancel'])){
                  include 'View/bacsi.php';
                }
                else{
                  include 'Controller/suabacsi.php';
                }
              }
              else {
                include 'View/bacsi.php';
              }
            break;
        case 'appointments':
          if(isset($_GET['idsua'])){
            if(isset($_POST['thoat'])){
              include 'View/lich.php';
            
            }
            else{
              include 'Controller/sualich.php';
            }
          }
          else {
            include 'View/lich.php';
          }
          break;
        case 'categories':
          if(isset($_GET['idsua'])){
            if(isset($_POST['Cancel3'])){
              include 'View/khoa.php';
            }
            else{
              include 'Controller/suakhoa.php';
            }
          }
          else {
            include 'View/khoa.php';
          }
          break;
          case 'users':
            if(isset($_GET['idsua'])){
              if(isset($_POST['Cancel4'])){
                include 'View/nguoidung.php';
              }
              else{
                include 'Controller/suataikhoan.php';
              }
            }
            else {
              include 'View/nguoidung.php';
            }
            break;
              case 'thuoc':
                if(isset($_GET['idsua'])){
                  if(isset($_POST['Cancel5'])){
                    include 'View/thuoc.php';
                  }
                  else{
                    include 'Controller/suathuoc.php';
                  }
                }
                else {
                  include 'View/thuoc.php';
                }
                break;

              case 'phongkham':
                if(isset($_GET['idsua'])){
                  if(isset($_POST['Cancel7'])){
                    include 'View/phongkham.php';
                  }
                  else{
                    include 'Controller/suaphongkham.php';
                  }
                }
                else {
                  include 'View/phongkham.php';
                }
                break;
              
      }
    } else {
      echo 'lỗi';
    };
    ?>

  </main>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  window.start_load = function() {
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function() {
    $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
    })
  }

  window.uni_modal = function($title = '', $url = '', $size = "") {
    start_load()
    $.ajax({
      url: $url,
      error: err => {
        console.log()
        alert("An error occured")
      },
      success: function(resp) {
        if (resp) {
          $('#uni_modal .modal-title').html($title)
          $('#uni_modal .modal-body').html(resp)
          if ($size != '') {
            $('#uni_modal .modal-dialog').addClass($size)
          } else {
            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
          }
          $('#uni_modal').modal('show')
          end_load()
        }
      }
    })
  }


  window._conf = function($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
  }
  window.alert_toast = function($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')
    if ($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
      delay: 3000
    }).toast('show');
  }
  $(document).ready(function() {
    $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
  })
</script>

</html>