<?php 
	include 'plugins/phpqrcode/qrlib.php';
	if(!isset($_SESSION['username']))
	{
		echo '<script>
            alert("Bạn phải đăng nhập");
            window.location.href="../login.php";
            </script>';
	}
?>
<div class="container-fluid">
	<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem Lịch Khám</h1>
    </div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
                        <th>STT</th>
						<th style="width:20%">họ và tên Bác sĩ</th>
						<th style="width:20%">Ngày hẹn</th>
						<th style="width:20%">Giờ hẹn</th>
						<th style="width:15%">Tên phòng khám</th>
						<th style="width:5%">Trạng thái</th>
						<th style="width:15%">Mã QR</th>
						<th style="width:5%"></th>

					</tr>
					</thead>
					<?php 
                    include './db/connect.php';
                    $s = new data();
                    $sql='select * from bacsi b join lichhen l on b.ID_Bacsi=l.ID_Bacsi  join benhnhan n 
                    on n.ID_Benhnhan=l.ID_Benhnhan JOIN taikhoan t on t.id=n.id
                    where Tendangnhap="'.$_SESSION['username'].'" and l.Trangthai!="Hoàn thành" ORDER by id_Lichhen DESC';
                    $Lich = $s->executeLesult($sql);
                    $dem=1;
                    foreach ($Lich as $item) {
						if($item['Trangthai']!='Hủy'){
							?>
						<tr>
							<td ><?php echo $dem++ ?></td>
							<td>
								<?php echo $item['Hoten'] ?>
							</td>
							<td><?php echo date("l M d Y",strtotime($item['Ngayhen'])) ?></td>
							<td><?php echo date("h:i A",strtotime($item['Giobatdau'])).' - '.date("h:i A",strtotime($item['Gioketthuc'])) ?></td>
							<td><?php 
							$sql3="SELECT * from lichlamviec l join phongkham pk on l.ID_Phongkham=pk.ID_Phongkham
							where ID_Lich=".$item['so'];
							$phongkham=$s->executeSingLesult($sql3);
							echo $phongkham['Tenphongkham'];
						
							?></td>
							<td><?php echo $item['Trangthai'] ?></td>
							<?php 
								$last_id = $item['id_Lichhen'];
								$file="./images/qrcode/".$last_id.".png";
								$url = 'http://localhost:8080/quanlyphongkham/qrcode.php?idlich='.$last_id.'';
								// $img_file = "$last_id.png" ;
							?>
							<td><?php QRcode::png($url, $file, QR_ECLEVEL_L, 4);

								echo "<img src='".$file."'>"; 
								?>
								<a href="./images/qrcode/<?php echo $last_id?>.png" download class="btn"><i class="fa fa-download"></i>Download</a>
							</td>

							<!-- bỏ -->
							<!-- <td>
								<a href="./qrcode.php?idlich=<?//php echo $item['id_Lichhen']?>">Xem QRCode</a>
							</td> -->
						
							<td>
								<?php 
									if($item['Trangthai']=='Đang chờ'){
								?>
								<form action="Controll/xulydatlich.php" method="POST">
									<a href="vnpay_php/index.php?id=<?php echo $item['id_Lichhen'] ?>" name="payment" ><i class="icofont-pay"></i></a>
									<button  style="margin-top:10px;"class="btn btn-danger btn-sm delete_lichhen" 
									type="submit" onclick="return confirm('Bạn có thực sự muốn hủy');" value="<?php echo $item['id_Lichhen'] ?>" name="Xoa_lich">Hủy</button>
								</form>
								<?php
									}
								?>
							</td>
							
						</tr>
                		<?php }
					} 
					?>
					<?php
?>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- XÓa ko hiện được nút-->

<!-- <script>
$('.delete_lichhen').click(function(){
		_conf("Bạn có chắc là muốn xóa lịch hẹn này ko này ko?","delete_lichhen",[$(this).attr('data-id')])
	})
	function delete_lichhen($id){
		start_load()
		$.ajax({
			url:'../admin/ajax.php?action=delete_lichhen',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Xóa thành công",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script> -->
<link rel="stylesheet" href="plugins/icofont/icofont.min.css">
<style>
	/* .btn-payment {
		border-radius: 8px;
		margin-bottom: 10px;
		height: 48px;
		width: 96px;
	}*/
	.icofont-pay:before {
    	font-size: 3rem;
		padding-left: 20px;
    	padding-right: 20px;
		border: 1px solid black;
		border-radius: 5px;
	}
</style>
