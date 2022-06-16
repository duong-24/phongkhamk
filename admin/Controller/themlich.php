<?php
include '../../db/connect.php';
$s=new data();
if(isset($_POST['load'])){
	if (isset($_POST['tenbacsi'])) {
		$tenbacsi = $_POST['tenbacsi'];
		$tenbacsi = str_replace('"', '\\"', $tenbacsi);	
	}
	if (isset($_POST['tenphong'])) {
		$tenphong = $_POST['tenphong'];
		$tenphong = str_replace('"', '\\"', $tenphong);
	}
	if (isset($_POST['Ngay'])) {
		$Ngay = $_POST['Ngay'];
		$Ngay = str_replace('"', '\\"',$Ngay);
	}
	if (isset($_POST['time1'])) {
		$time1 = $_POST['time1'];
		$time1 = str_replace('"', '\\"', $time1);
	}
	if (isset($_POST['time'])) {
		$time = $_POST['time'];
		$time = str_replace('"', '\\"', $time);
	}
	$resu='';
	$status='Xác nhận';
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
	if($Ngay>=date("Y-m-d")){
		if($giobatdau<$gioketthuc){
			
			//$slq3 = 'SELECT * FROM bacsi where ID_Bacsi in (SELECT ID_Bacsi from lichlamviec WHERE ID_Bacsi=112)';
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
					//if($kiemtratenbacsi>0){
						//echo 123;
						//echo $tenbacsi.'<br>';
						if($kiemtratenbacsi==0){
							if($tenphong==$item['ID_Phongkham']){
								if(($tenphong==$item['ID_Phongkham']&& $giobatdau<$gioketthuc1)&&($tenphong==$item['ID_Phongkham']&& $gioketthuc>$giobatdau1)){
										echo '<script>
										alert("Hiện tại giờ này không còn trống ");
										window.location.href="../index.php?page=appointments";
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
								window.location.href="../index.php?page=appointments";
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
			echo '<script>
					alert("Giờ bắt đầu phải nhỏ hơn giờ kết thúc");
					window.location.href="../index.php?page=appointments";
					</script>';
		}
	}
	else{
		echo '<script>
				alert("Phải lớn hơn ngày hiện hành");
				window.location.href="../index.php?page=appointments";
				</script>';
	}
	if($resu==1 ){
		$sql="INSERT INTO lichlamviec (ID_Phongkham, 
		ID_Bacsi, Ngay, Giobatdau, Gioketthuc, Tinhtrang)
		VALUES ('$tenphong','$tenbacsi', '$Ngay', '$time1', '$time', '$status')";
		$s->execute($sql);
		echo '<script>
		alert("Thêm thành công ");
		window.location.href="../index.php?page=appointments";
		</script>';
	}
}
?>