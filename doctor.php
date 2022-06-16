<?php
	include 'pages/header.php';
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

  <title>Phòng Khám</title>


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
          <h1 class="text-capitalize mb-5 text-lg">Bác sĩ chuyên môn</h1>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- portfolio -->
<section class="section doctors">
  <div class="container">
  	<?php 
		if(!isset($_GET['id'])){
			echo '
  	  <div class="row justify-content-center">
             <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Bác sĩ</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p>Chúng tôi hân hạnh phục vụ, mang đến dịch vụ và trải nghiệm tốt nhất đến bạn</p>
                </div>
            </div>
        </div>

			<div class="col-12 text-center  mb-5">
	        <div class="btn-group btn-group-toggle " data-toggle="buttons">
	          <label class="btn active ">
	            <input type="radio" name="shuffle-filter" value="all" checked="checked" />Tất cả
	          </label>
	        </div>
      </div>';
		}
		else{
			echo '
  	  		<div class="row justify-content-center">
             <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Đặt lịch bác sĩ</h2>
                    <div class="divider mx-auto my-4"></div>
                   
                </div>
            </div>
        	</div>';
		}
	?>
	  <div class="row shuffle-wrapper portfolio-gallery ">
		<?php
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				include './db/connect.php';
				$s=new data();
				$sql='
				select * from bacsi b where 
				ID_Bacsi="'.$id.'"';
				$listbacsi=$s->executeSingLesult($sql);
		?>
				<div class=" shuffle-item" data-groups="[&quot;cat2&quot;]">
					<div class="position-relative doctor-inner-box">
						<div class="content mt-3" >
							<div style="display: flex; justify-content: space-between;">
								<h4 class="mb-0">Đặt lịch Bác sĩ: <?php echo $listbacsi['Hoten'] ?></h4><br>
								<h4 class="mb-0">Giá khám: 200.000 VNĐ </h4><br>
							</div>
							<table class="table table-bordered">
							<form action="Controll/xulydatlich.php" method="POST">
									<thead>
										<tr>
										<th style="width:20%">Ngày Bác sĩ hoạt động</th>
										<th style="width:15%">Giờ bắt đầu</th>
										<th style="width:15%">Giờ kết thúc</th>
										<th style="width:30%">Chuyên khoa</th>
										<th style="width:15%">Phòng khám</th>
										<th style="width:5%">Chọn lịch</th>
									</tr>
									</thead>
									<?php 
									$s = new data();
							
												//  $sql3='
												//  SELECT * FROM lichhen';
												//  $lich3=$s->executeSingLesult($sql3);
												//  if(isset($lich3['so'])){
												// 	$so=$lich3['so'];
												//  }
												//  else {
												// 	$so=0;
												//  }
												 
										
									$sql = 'SELECT * FROM bacsi b join lichlamviec l on b.ID_Bacsi=l.ID_Bacsi 
										WHERE  b.ID_Bacsi="'.$id.'" and l.ID_Lich not in (SELECT so from 
									lichhen)';
									// $sql = 'SELECT * FROM bacsi b join lichlamviec l on b.ID_Bacsi=l.ID_Bacsi 
									// WHERE  b.ID_Bacsi="'.$id.'" and l.ID_Lich not in (SELECT so from 
									// lichhen join benhnhan on lichhen.ID_Benhnhan=benhnhan.ID_Benhnhan join 
									// taikhoan t on t.id=benhnhan.id
									// where t.Tendangnhap="'.$_SESSION['username'].'")';
									$Lich = $s->executeLesult($sql);
									foreach ($Lich as $item) {
										if($item['Tinhtrang']=='Xác nhận'&&date("Y-m-d",strtotime($item['Ngay']))>=date("Y-m-d")){
									?>
									<tr>
										<td><input type="text" name="ngay" value="<?php echo date("l M d Y",strtotime($item['Ngay'])) ?>" disabled="true"></td>
										<td>									
											<input type="text" name="giobatdau" value="<?php echo date("h:i A",strtotime($item['Giobatdau'])) ?>" disabled="true">
										</td>
										<td>
											<input type="text" name="gioketthuc" value="<?php echo date("h:i A",strtotime($item['Gioketthuc'])) ?>" disabled="true">
										</td>
										<td>		
											<?php
												$sql2='
												select * from khoa k join bacsi b on k.ID_Khoa=b.ID_Khoa where 
												b.ID_Bacsi="'.$id.'"';
												$Chuyenkhoa=$s->executeSingLesult($sql2);
											?>
											<input type="text" name="chuyenkhoa" value="<?php echo $Chuyenkhoa['Tenkhoa'] ?>" disabled="true">
											
										</td>
										<td>
											<?php
												$sql1='
												select * from phongkham p join lichlamviec l on l.ID_Phongkham=p.ID_Phongkham where 
												l.ID_Bacsi="'.$id.'"';
												$phongkham=$s->executeSingLesult($sql1);
											?>
											<input type="text" name="phongkham" value="<?php echo $phongkham['Tenphongkham'] ?>" disabled="true">
										
										</td>
										<td class="text-center">
											
											<button type="submit" class="btn btn-warning" value="<?php echo $item['ID_Lich'] ?>"  name="datlich" >Chọn</button>
										</td>
									</tr>
								<?php } 
							}?>
								</form>	
								</table>
							<!-- XỬ lý thêm lịch -->

							<!--Xử lỹ thêm lich -->
							<a href="./doctor.php" class="text-center btn btn-warning">Thoát</a>
						</div> 
					</div>
				</div>

		<?php
	//danh sach bac si ////////////////////////////// 
		}
		else {			
		?>
			<?php 
				include './db/connect.php';
				$s=new data();
				$sql='
				select * from taikhoan t JOIN bacsi b on t.id=b.id join khoa k on k.ID_Khoa=b.ID_Khoa where Tinhtrangbacsi!="Nghỉ việc"';
				$listbacsi=$s->executeLesult($sql);
				foreach ($listbacsi as $item1) {
			?>
			<style>
				.a1,.a2{
					display:inline-block;
				}
			</style>
				<div class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item " data-groups="[&quot;cat2&quot;]">
					<div class="position-relative doctor-inner-box">
						<div class="doctor-profile" style="height:200px;">
							<div class="doctor-img">
							<img src="images/bacsi/<?php echo $item1['image']  ?> " alt="doctor-image" class="img-fluid w-100">
							</div>
						</div>
						<div class="content mt-3" >
							<h4 class="mb-0"><?php echo $item1['Hoten'] ?></a></h4>
							<p>Email: <?php echo $item1['Email'] ?> <b><?php  ?></b></p>
							<p><b>Chuyên khoa </b></p>
							<div>
							<span class="badge badge-light" style="padding: 15px">
							<large><b><?php echo $item1['Tenkhoa']  ?></b></large></span>
							</div>
						</div> 
						<div class="content mt-3 text-center">
						<p><a href="./doctor.php?id=<?php echo $item1['ID_Bacsi'] ?>" class="btn btn-danger" >Đặt lịch</a></p>
						</div>
					</div>
				</div>
			<?php
				}
			?>

		<?php
			}
		?>
</div>

















</section>
<!-- /portfolio -->
<section class="section cta-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="cta-content">
					<div class="divider mb-4"></div>
					<h2 class="mb-5 text-lg">Chúng tôi hân hạnh phục vụ, mang đến dịch vụ và trải nghiệm tốt nhất đến bạn</span></h2>
					<!-- <a href="appoinment.php" class="btn btn-main-2 btn-round-full">Đặt lịch<i class="icofont-simple-right  ml-2"></i></a> -->
				</div>
			</div>
		</div>
	</div>
</section>
<?php include 'pages/footer.php'; ?>

  </body>
  </html>