<?php
	include 'pages/header.php';
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">

  <title>Phòng Khám</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico?v2" />

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

<!--- Header -->
	
<!-- Slider Start -->
<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-xl-7">
				<div class="block">
					<div class="divider mb-3"></div>
					<span class="text-uppercase text-sm letter-spacing ">giải pháp chăm sóc sức khỏe</span>
					<h1 class="mb-3 mt-3">ĐỐI TÁC ĐÁNG TIN CẬY CỦA BẠN</h1>
					
					<p class="mb-4 pr-5">Tận tâm, tận tụy hết lòng vì sức khỏe người bệnh.</p>
					<div class="btn-container ">
						<?php 
							
								include './db/connect.php';
								$s=new data();
								// $hiendl['Phanquyen']='Benhnhan';
								// $sql='Select * from benhnhan b join taikhoan t on
								// b.id=t.id Where Tendangnhap="'.$_SESSION['username'].'" and Phanquyen="Benhnhan"';
								if(isset($_SESSION['username'])){
									$sql='Select * from bacsi b join taikhoan t on
									b.id=t.id Where Tendangnhap="'.$_SESSION['username'].'" and Phanquyen="Doctor"';
									$hiendl=$s->executeSingLesult($sql);
									if($hiendl==null){
										echo '<a href="doctor.php" class="btn btn-main btn-round-full">Đặt Lịch <i class="icofont-simple-right ml-2  "></i></a>';
									}
								}
								else{
									echo '<a href="doctor.php" class="btn btn-main btn-round-full">Đặt Lịch <i class="icofont-simple-right ml-2  "></i></a>';
								}
								
								// if($hiendl['Phanquyen']!='Doctor'){
								// echo '<a href="doctor.php" target="_blank" class="btn btn-main-2 btn-icon btn-round-full">Đặt Lịch <i class="icofont-simple-right ml-2  "></i></a>';
								// }
						
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="feature-block d-lg-flex">
					<div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-surgeon-alt"></i>
						</div>
						<span>Dịch vụ 24/24</span>
						<h4 class="mb-3">Đặt lịch</h4>
						<p class="mb-4">Vì sức khỏe bệnh nhân, chúng tôi luôn sẵn sàng.</p>
						<?php 
						if(isset($_SESSION['username'])){
							if($hiendl==null){
								echo '<a href="doctor.php" class="btn btn-main btn-round-full">Đặt Lịch</a>';
							}
						}else{
							echo '<a href="doctor.php" class="btn btn-main btn-round-full">Đặt Lịch</a>';
						}

						
						?>
						
					</div>
				
					<div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-ui-clock"></i>
						</div>
						<span>Thời gian biểu</span>
						<h4 class="mb-3">Giờ làm việc</h4>
						<ul class="w-hours list-unstyled">
		                    <li class="d-flex justify-content-between">Thứ 2 - Thứ 4 	: <span>8:00 - 17:00</span></li>
		                    <li class="d-flex justify-content-between">Thứ 5 - Thứ 6 	: <span>9:00 - 17:00</span></li>
		                    <li class="d-flex justify-content-between">Thứ 7 - Chủ nhật : <span>10:00 - 17:00</span></li>
		                </ul>
					</div>
				
					<div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-support"></i>
						</div>
						<span>Trường hợp cấp cứu</span>
						<h4 class="mb-3">1900886684</h4>
						<p>Nhận hỗ trợ các trường hợp khẩn cấp. Cấp cứu thật nhanh để giành sự sống</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section about">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-4 col-sm-6">
				<div class="about-img">
					<img src="images/about/img-1.jpg" alt="" class="img-fluid">
					<img src="images/about/img-2.jpg" alt="" class="img-fluid mt-4">
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<div class="about-img mt-4 mt-lg-0">
					<img src="images/about/img-3.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="about-content pl-4 mt-4 mt-lg-0">
					<h2 class="title-color">Chăm sóc sức khỏe <br>& Lối sống lành mạnh</h2>
					<p class="mt-4 mb-5">Chúng tôi cung cấp dịch vụ bác sĩ hàng đầu, tạo sự hài lòng tốt nhất đến bệnh nhân. Ngoài ra còn các loại thuốc chất lượng.</p>
									
					<!-- <a href="service.php" class="btn btn-main-2 btn-round-full btn-icon">Dịch vụ<i class="icofont-simple-right ml-3"></i></a> -->
				</div>
			</div>
		</div>
	</div>
</section>
<section class="cta-section ">
	<div class="container">
		<div class="cta position-relative">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-doctor"></i>
						<span class="h3">58</span>k
						<p>Người hạnh phúc</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-flag"></i>
						<span class="h3">700</span>+
						<p>Phẫu thuật thành công</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-badge"></i>
						<span class="h3">40</span>+
						<p>Bác sĩ chuyên môn</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-globe"></i>
						<span class="h3">20</span>
						<p>Chi nhánh thế giới</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- footer Start -->
<?php include 'pages/footer.php'; ?>
  </body>
  </html>
   