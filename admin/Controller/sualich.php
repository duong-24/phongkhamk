<!-- if( date("Y m d",strtotime($Ngay))<date('Y m d')){
			$messxuly1='Ngày nhập phải lớn hơn ngày hiện tại';
		}else{
			if($time1>=$time){
				$messxuly="Số giờ kết thúc phải lớn hơn giờ bắt đầu";
			}else{
				$sql="UPDATE lichlamviec SET ID_Phongkham='$tenphong',ID_Bacsi='$tenbacsi',
				Ngay='$Ngay',Giobatdau='$time1',Gioketthuc='$time',Tinhtrang='$status'
				WHERE lichlamviec.ID_Lich =".$id1;
				$s->execute($sql);
				$mess= 'Cập nhật thành công';
				header('location:index.php?page=appointments');
			
				
			}
		} -->
		<!--  ---------------Modal Sá»­a-->
<?php 

$s=new data();
if (isset($_GET['idsua'])) {
    $mess='';
	$messxuly='';
	$messxuly1='';
	$id1 = $_GET['idsua'];
	$sql = 'SELECT l.ID_Lich,l.Giobatdau, p.ID_Phongkham,b.ID_Bacsi,p.Tenphongkham,b.Hoten,l.Ngay,l.Gioketthuc,l.tinhtrang
	 from bacsi b join lichlamviec 
	l on l.ID_Bacsi=b.ID_Bacsi join phongkham p on l.ID_Phongkham=p.ID_Phongkham
	 where ID_Lich=' . $id1;
	$category = $s->executeSingLesult($sql);
	$idPhong=$category['ID_Phongkham'];
	$idBacsi=$category['ID_Bacsi'];
	$TenPhong = $category['Tenphongkham'];
	$Tenbasi=$category['Hoten'];
	$Ngay=$category['Ngay'];
	$Time123 = $category['Gioketthuc'];
	$Time12=$category['Giobatdau'];
	$status = $category['tinhtrang'];
    if(isset($_POST['sua'])){
        if (isset($_POST['tenbacsi1'])) {
            $tenbacsi = $_POST['tenbacsi1'];
			$tenbacsi = str_replace('"', '\\"', $tenbacsi);	
        }
        if (isset($_POST['tenphong1'])) {
            $tenphong = $_POST['tenphong1'];
			$tenphong = str_replace('"', '\\"', $tenphong);
        }
        if (isset($_POST['Ngay1'])) {
            $Ngay = $_POST['Ngay1'];
			$Ngay  = str_replace('"', '\\"', $Ngay );
        }
        if (isset($_POST['time2'])) {
            $time = $_POST['time2'];
			$time = str_replace('"', '\\"', $time);
        }
        if (isset($_POST['status1'])) {
            $status = $_POST['status1'];
			$status = str_replace('"', '\\"', $status);
        }
		if (isset($_POST['time1'])) {
			$time1 = $_POST['time1'];
			$time1 = str_replace('"', '\\"', $time1);
		}
		if(date("A",strtotime($time1))=="PM" ){
			$giobatdau=date("hi",strtotime($time1))+1200;
		}else{
			$giobatdau=date("hi",strtotime($time1));
		}
	
		if(date("A",strtotime($time))=="PM"){
			$gioketthuc=date("hi",strtotime($time))+1200;
		}else{
			$gioketthuc=date("hi",strtotime($time));
			
		}
		if(date("Y m d",strtotime($Ngay))<date('Y m d')){
			$messxuly1='Ngày nhập phải lớn hơn ngày hiện tại';
		}else{
			if(date("h:i A",strtotime($Time12))!=date("h:i A",strtotime($time1))
			||date("h:i A",strtotime($time))!=date("h:i A",strtotime($Time123))){
				$sql2 = 'SELECT * from lichlamviec l join phongkham pk on l.ID_Phongkham=pk.ID_Phongkham';
				$phongkham = $s->executeLesult($sql2);
				foreach ($phongkham as $item) {
					if($Ngay==$item['Ngay']){
						if($giobatdau<$gioketthuc){
							$sql2='SELECT * from bacsi b JOIN lichlamviec l on b.ID_Bacsi=l.ID_Bacsi join phongkham pk on l.ID_Phongkham=pk.ID_Phongkham ';
							$phongkham = $s->executeLesult($sql2);
							$kiemtratenbacsi=$s->demtenbacsi($tenbacsi);
							foreach ($phongkham as $item) {
								if($Ngay==$item['Ngay']){
									if(date("A",strtotime($item['Giobatdau']))=="PM" ){
										$giobatdau1=date("hi",strtotime($item['Giobatdau']))+1200;
									}else{
										$giobatdau1=date("hi",strtotime($item['Giobatdau']));
									}
									if(date("A",strtotime($item['Gioketthuc']))=="PM"){
										$gioketthuc1=date("hi",strtotime($item['Gioketthuc']))+1200;
									}else{
										$gioketthuc1=date("hi",strtotime($item['Gioketthuc']));
										
									}

										if($kiemtratenbacsi==0){
											if($tenphong==$item['ID_Phongkham']){
												if(($tenphong==$item['ID_Phongkham']&& $giobatdau<$gioketthuc1)&&($tenphong==$item['ID_Phongkham']&& $gioketthuc>$giobatdau1)){
														echo '<script>
														alert("Hiện tại giờ này không còn trống ");
														window.location.href="index.php?page=appointments";
														</script>';	
														exit();
													
												}else{
													$resu=1;
												}
											}else{
												 $resu=1;
											}
										
										}else{
											if(($tenphong==$item['ID_Phongkham']&& $giobatdau<$gioketthuc1)&&($tenphong==$item['ID_Phongkham']&& $gioketthuc>$giobatdau1)){
												echo '<script>
												alert("Hiện tại giờ này không còn trống ");
												window.location.href="index.php?page=appointments";
												</script>';	
												
												exit();
											
											}else{
													$resu=1;
												}
										}
								}else{
									$resu=1;
								}
							}
						}
						else{
							$messxuly="Số giờ kết thúc phải lớn hơn giờ bắt đầu";
						}
							
					}else{
						$resu=1;
					}
				
				}
			}else{
				echo '<script>
				alert("Sửa thành công");
				window.location.href="index.php?page=appointments";
				</script>';
			}
				
		} 

		if($resu==1){
			$sql="UPDATE lichlamviec SET ID_Phongkham='$tenphong',ID_Bacsi='$tenbacsi',
			Ngay='$Ngay',Giobatdau='$time1',Gioketthuc='$time',Tinhtrang='$status'
			WHERE lichlamviec.ID_Lich =".$id1;
			$s->execute($sql);
			echo '<script>
			alert("Sửa thành công");
			window.location.href="index.php?page=appointments";
			</script>';
		}
    }



}
?>

  <!-- The Modal -->
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sửa lịch</h4>
          <h5 style="color:green"><?php echo $mess ?></h5>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
		<form action="#" id="manage-appointment" method="POST">
			<div class="form-group">
				<label for="" class="control-label">Bác sĩ</label>
				<select class="browser-default custom-select select2" name="tenbacsi1">
					<option value="<?php echo $idBacsi ?>"><?php echo $Tenbasi ?></option>
                    <?php 
					$sql1 = 'SELECT * FROM bacsi where ID_Bacsi !='.$idBacsi;
					$Hotenbacsi = $s->executeLesult($sql1);
					foreach ($Hotenbacsi as $value1){
					?>
						<option value="<?php echo $value1['ID_Bacsi']?>"><?php echo $value1['Hoten'] ?></option>
					<?php 
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">phòng khám</label>
				<select class="browser-default custom-select select2" name="tenphong1">
				<option value="<?php echo $idPhong ?>"><?php echo $TenPhong ?></option>
                <?php 
					$sql = 'SELECT * FROM phongkham where ID_Phongkham!='.$idPhong;
					$TenPhong = $s->executeLesult($sql);
					foreach ($TenPhong as $value){
					?>
						<option value="<?php echo $value['ID_Phongkham'] ?>"><?php echo $value['Tenphongkham'] ?></option>
					<?php 
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Ngày</label>
				<input type="date"  name="Ngay1" class="form-control" value="<?php echo $Ngay ?>" required>
				<span style="color:red"><?php echo $messxuly1 ?></span>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Giờ bắt đầu</label>
				<input type="time"  name="time1" class="form-control" value="<?php echo $Time12 ?>" required>
			</div> 
			<div class="form-group">
				<label for="" class="control-label">Giờ kết thúc</label>
				<input type="time"  name="time2" class="form-control" value="<?php echo $Time123 ?>" required>
				<span style="color:red"><?php echo $messxuly ?></span>
			</div> 
			<div class="form-group">
				<label for="" class="control-label">Tình trạng</label>
				<select class="browser-default custom-select form-control" name="status1">
					<option value="Xác nhận">Xác nhận</option>		
					<option value="Bận">Bận</option>							
				</select>
			</div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="sua">Sửa</button>
				<a href="index.php?page=appointments" class="btn btn-warning float-right" name="thoat">Thoát</a>
			</div>
		</form>
        </div>
        <!-- Modal footer -->
      </div>
    </div>