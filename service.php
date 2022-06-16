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
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
	<style>
		.pagination {
			display: flex;
			align-items: center;
			justify-content: center;
			list-style: none;
		}
		.pagination-item {
			margin-left: 15px;
			margin-right: 15px;
		}

		.pagination-item__link{
			height: 30px;
			display: block;
			text-decoration: none;
			text-align: center;
			min-width: 40px;
			line-height: 30px;
			color: #939393;
			font-size: 1.2rem;
			border-radius: 2px;
		}
	</style>
</head>

<body id="top">

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">Danh sách thuốc</h1>

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


<section class="section service-2">
	<div class="container">
	<div style="text-align:center;">
<form method="get" style="width:150px;margin:5px">		
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="s"
                        style="width:200px; float:right;">
                        </div>
						
            </form>
		</div>
		<div class="row">
			<?php 
				include './db/connect.php';
				//$s='';
			if(isset($_GET['s'])){
				$s=$_GET['s'];
			}
			else{
				$s='';
			}
			$additional='';
                    if(!empty($s)){
                        $additional=' and Tenthuoc like"%'.$s.'%" or Loaithuoc like"%'.$s.'%"
                        or Thongtinthuoc like"%'.$s.'%" or Handung like"%'.$s.'%"';
                    }
				$s=new data();
				$dem1=$s->dem();
				$page=1;
				$prodperpage=9;
				if(isset($_REQUEST["page"])){
					$page=$_REQUEST["page"];
					
				}
				$page1=($page-1)*$prodperpage;

					$sql="select * from thuoc where 1 $additional  limit $page1,$prodperpage";
					$dsthuoc=$s-> phantrang($sql);
				$dem=0;
				foreach($dsthuoc as $value){
					$dem++;
					
			?>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-block mb-5">
						
						<div class="content" style="height:150px;">
							<h4 class="mt-4 mb-2 title-color"><?php echo $value['Tenthuoc'] ?></h4>
							<p><b>Loại thuốc: <?php echo $value['Loaithuoc'] ?></b></p>
							<p class="mb-4"><?php echo $value['Thongtinthuoc'] ?></p>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			
		</div>
		<div class="giua">
			<ul class="pagination pagination-lg">
				<?php 
					if(isset($_GET['s'])){
						$timkiem=$_GET['s'];
					}else{
						$timkiem='';
					}
						# code...
					 for ($i=0 ;$i<$dem1/9.0;$i++) {
					?>
					
						 <li class="pagination-item"><a class="pagination-item__link" href="service.php?page=<?php echo  $i+1 ?><?php
						echo "&s=$timkiem"?>"><?php echo  $i+1 ?></a></li>
					<?php
					 }
				
					 
				?>
			</ul>
		</div>
	</div>

	
</section>
<section class="section cta-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="cta-content">
					<div class="divider mb-4"></div>
					<h2 class="mb-5 text-lg">Chúng tôi hân hạnh phục vụ, mang đến dịch vụ và trải nghiệm tốt nhất đến bạn</span></h2>
					<a href="doctor.php" class="btn btn-main-2 btn-round-full">Đặt lịch<i class="icofont-simple-right  ml-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	include 'pages/footer.php';
?>

  </body>
  </html>