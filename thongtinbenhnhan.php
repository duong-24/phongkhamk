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

  <title>THÔNG TIN CHUNG</title>
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
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbenhnhan.php?pagetrang=thongtin"
          >THÔNG TIN CÁ NHÂN</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbenhnhan.php?pagetrang=xemlich"
          >LỊCH KHÁM BỆNH</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="thongtinbenhnhan.php?pagetrang=lichsu"
          >LỊCH SỬ KHÁM BỆNH</a></h5>
          <h5 class="font-weight-bolder" style="padding-top:15px;"><a href="./thongtinbenhnhan.php?pagetrang=capnhattk"
          >ĐỔI MẬT KHẨU</a></h5>
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
                        include './benhnhan/info_patient.php';
                        
                      break;
                    case 'xemlich':
                      include ('./benhnhan/xemlich.php');
                      break;
                    case 'lichsu':
                        include ('./benhnhan/lichsu.php');
                        break;
                    case 'capnhattk':
                      include ('./benhnhan/doimk.php');
                      break;
                  }
                }elseif(isset($_GET['page2'])||isset($_GET['timkiembn'])){
                  include ('benhnhan/lichsu.php');}
                elseif(isset($_GET['xemthuoc'])){
                    include ('./benhnhan/xuatthuoc.php');
                }
                else{
                  include './benhnhan/info_patient.php';  
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