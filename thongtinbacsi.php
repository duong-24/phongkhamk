<?php
	include ('./pages/header.php');
  if(!isset($_SESSION['username']))
	{
		echo '<script>
            alert("Bạn phải đăng nhập");
            window.location.href="login.php";
            </script>';
	}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">

  <title>Thông tin bác sĩ</title>
  <link href="./css/simple-sidebar.css" rel="stylesheet">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="top">

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">THÔNG TIN CHUNG</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>
<style>
    .section{
      padding:0px;
    }
    #wrapper #sidebar-wrapper h5{
      padding-top:10px;
      margin-top:10px;
    }
    .footer{
      margin-top:0px; 
    }
    .container-fluid{
      padding-right:0px;
    }
</style>
<section class="section service-2">
	<div class="container-fluid">
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush ml-3">
          <style type="text/css">
              #wrapper #sidebar-wrapper h5{
                  border-bottom: solid 1px #e5e5e5;
                  line-height:30px;  
              }
          </style>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbacsi.php?pagetrang=thongtin"
          >THÔNG TIN CÁ NHÂN</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbacsi.php?pagetrang=xemlich"
          >LỊCH KHÁM</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="thongtinbacsi.php?pagetrang=lichsu"
          >LỊCH SỬ ĐÃ KHÁM</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbacsi.php?pagetrang=capnhattk"
          >ĐỐI MẬT KHẨU</a></h5>
          <!-- <a href="#" class="list-group-item list-group-item-action " data-toggle="list">Events</a>
          <a href="#" class="list-group-item list-group-item-action " data-toggle="list">Profile</a>
          <a href="#" class="list-group-item list-group-item-action " data-toggle="list">Status</a> -->
        </div>
      </div>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        </nav>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
      <div>
      <div>
              <?php
                if (isset($_GET['pagetrang'])) {
                  switch ($_GET['pagetrang']) {
                    case 'thongtin':
                        include 'View/doctor/info_Patientbacsi.php';
                      break;
                    case 'xemlich':
                      include ('View/doctor/xemlich.php');
                      break;
                    case 'lichsu':
                        include ('View/doctor/lichsu.php');
                        break;
                    case 'capnhattk':
                      include ('View/doctor/doimk.php');
                      break;
                  }
                 } elseif(isset($_GET['page'])||isset($_GET['timkethuoc'])){
                   if(isset($_POST['idlich1']))
                     $_SESSION['idlich']=$_POST['idlich1'];
                   include ('View/doctor/Kethuoc.php');
                 }elseif(isset($_GET['page1'])||isset($_GET['timlichsu'])){
                  include ('View/doctor/lichsu.php');}
                else{
                  include 'View/doctor/info_Patientbacsi.php';  
                }
              ?>
      </div>
	</div>
</section>
<?php
	include 'pages/footer.php';
?>

  </body>
  </html>