
<div class="container-fluid">
	<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách Lịch làm việc Bác sĩ</h1>
    </div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<button class="btn-primary btn btn-sm" type="button" data-toggle="modal" data-target="#myModal" id="new_appointment"><i class="fa fa-plus"></i> Thêm lịch</button>
				<form method="post" style="width:150px;margin:5px;float:right;">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm tên và ngày.." id="s" name="ssss"
                        style="width:200px; float:right;">
                        </div>
            </form>
				<table class="table table-bordered">
					<thead>
						<tr>
						<th style="width:20%">Lịch</th>
						<th style="width:20%">Thời gian</th>
						<th style="width:25%">Bác sĩ</th>
						<th style="width:20%">Tên phòng khám</th>
						<th style="width:10%">Tình trạng</th>
						<th style="width:5%"></th>
                        <!-- <th style="width:5%"></th> -->
					</tr>
					</thead>
					<?php 
                    
					$s='';
                    if(isset($_POST['ssss'])){
                        $s=$_POST['ssss'];
                    }
                    $additional='';
                    if(!empty($s)){
                        $additional=' and b.Hoten like"%'.$s.'%" or
                       Ngay like"%'.$s.'%" ';
                    }
					$s = new data();
                    $sql = 'SELECT l.ID_Lich,b.Hoten,tinhtrang,Ngay,l.Giobatdau,l.Gioketthuc FROM bacsi b join lichlamviec l on b.ID_Bacsi=l.ID_Bacsi
					where 1 '.$additional.' and Tinhtrangbacsi!="Nghỉ việc" order by l.ID_Lich DESC';
                    $Lich = $s->executeLesult($sql);
                    foreach ($Lich as $item) {
						if(date("Y-m-d",strtotime($item['Ngay']))>=date("Y-m-d")){
					?>
					<!-- Phải lớn hơn ngày hiện taik -->
					<tr>
						<td><?php echo date("l M d Y",strtotime($item['Ngay'])) ?></td>
						<td><?php echo date("h:i A",strtotime($item['Giobatdau'])).' - '.date("h:i A",strtotime($item['Gioketthuc'])) ?></td>
						<td><?php echo $item['Hoten']?></td>
						<td><?php 
							$sql1="SELECT * from lichlamviec l join phongkham pk on l.ID_Phongkham=pk.ID_Phongkham
							where ID_Lich=".$item['ID_Lich'];
							$phongkham=$s->executeSingLesult($sql1);
							echo $phongkham['Tenphongkham'];
						
						?></td>

						<td><?php echo $item['tinhtrang'] ?></td>
						<td class="text-center">
						<a href="index.php?page=appointments&idsua=<?php echo $item['ID_Lich'] ?>">
							<button  class="btn btn-primary btn-sm update_app" type="button" data-id="<?php echo $item['ID_Lich'] ?>"data-toggle="modal" data-target="#myModal1">Sửa</button>
						<a>
						</td>
                        <!-- <td class="text-center">
							<button  class="btn btn-danger btn-sm delete_app" type="button" data-id="<?php echo $item['ID_Lich'] ?>">Xóa</button>
						</td> -->
					</tr>
                <?php } }?>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$('.delete_app').click(function(){
		_conf("Bạn có chắc là muốn xóa lịch này ko?","delete_app",[$(this).attr('data-id')])
	})
	function delete_app($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_appointment',
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
</script>



<!--  ---------------Modal Them-->
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thêm lịch</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
		<form action="././Controller/themlich.php" id="manage-appointment" method="POST">
			<div class="form-group">
				<label for="" class="control-label">Bác sĩ</label>
				<select class="browser-default custom-select select2" name="tenbacsi" required >
					<option value=""></option>
					<?php 
					$s = new data();
					$sql = 'SELECT * FROM bacsi where Tinhtrangbacsi!="Nghỉ việc"';
					$Hotenbacsi = $s->executeLesult($sql);
					foreach ($Hotenbacsi as $value1){
					?>
						<option value="<?php echo $value1['ID_Bacsi']?>"><?php echo $value1['Hoten'] ?></option>
					<?php 
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Phòng khám</label>
				<select class="browser-default custom-select select2" name="tenphong" required>
					<option value=""></option>
					<?php 
					$sql = 'SELECT * FROM phongkham ';
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
				<input type="date"  name="Ngay" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Giờ bắt đầu</label>
				<input type="time"  name="time1" class="form-control" required>
			</div> 
			<div class="form-group">
				<label for="" class="control-label">Giờ kết thúc</label>
				<input type="time"  name="time" class="form-control" required>
			</div> 
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="load">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>

