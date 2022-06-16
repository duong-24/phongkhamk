<?php
	include('db/constrants.php');
?>

<header>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="index.php">
			  	<img src="images/logo.png" alt="" class="img-fluid">
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
				<!-- <li class="nav-item active">
					<a class="nav-link" href="index.php">TRANG CHỦ</a>
			  	</li> -->
			  <!-- Check Login-->
			  <?php 
			  		if(isset($_SESSION['username']))
					  {
						if($_SESSION['phanquyen']=="Benhnhan")
						{
							?>
							<li class="nav-item active">
								<a class="nav-link" href="index.php">TRANG CHỦ</a>
			  				</li>
							<li class="nav-item"><a class="nav-link" href="doctor.php">BÁC SĨ</a></li>
							<li class="nav-item"><a class="nav-link" href="blog-sidebar.php">TIN TỨC</a></li>
							<li class="nav-item"><a class="nav-link" href="about.php">LIÊN HỆ</a></li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									Xin chao <?php echo $_SESSION['username']; ?><i class="icofont-thin-down"></i></a>
								<ul class="dropdown-menu" aria-labelledby="dropdown02">
									<li><a class="dropdown-item" href="thongtinbenhnhan.php">Thông tin chung</a></li>
									<!-- <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li> -->
									<li><a class="dropdown-item" href="logout.php">Đăng Xuất</a></li>
								</ul>
							</li>
							<?php
						}
						else if($_SESSION['phanquyen']=="Doctor")
						{
							?>
							<li class="nav-item active">
								<a class="nav-link" href="index.php">TRANG CHỦ</a>
			  				</li>
							<li class="nav-item"><a class="nav-link" href="service.php?page=1&s=">THUỐC</a></li>
							<li class="nav-item"><a class="nav-link" href="blog-sidebar.php">TIN TỨC</a></li>
							<li class="nav-item"><a class="nav-link" href="about.php">LIÊN HỆ</a></li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									Xin chao <?php echo $_SESSION['username']; ?><i class="icofont-thin-down"></i></a>
								<ul class="dropdown-menu" aria-labelledby="dropdown02">
									<li><a class="dropdown-item" href="thongtinbacsi.php">Thông tin chung</a></li>
									<!-- <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li> -->
									<li><a class="dropdown-item" href="logout.php">Đăng Xuất</a></li>
								</ul>
							</li>
							<?php
						}
					  }
					else
					{
						?>
						<li class="nav-item active">
							<a class="nav-link" href="index.php">TRANG CHỦ</a>
			  			</li>
						<li class="nav-item"><a class="nav-link" href="blog-sidebar.php">TIN TỨC</a></li>
						<li class="nav-item"><a class="nav-link" href="about.php">LIÊN HỆ</a></li>
						<li class="nav-item"><a class="nav-link" href="login.php">ĐĂNG NHẬP</a></li>
						<?php
					}
				?>
			</ul>
		  </div>
		</div>
	</nav>
</header>