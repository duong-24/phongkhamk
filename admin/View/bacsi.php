<div class="container-fluid">
    <div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách bác sĩ</h1>
    </div>
    <div class="panel-body card">
        <div>
            <button class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#myModal" style="width:150px;margin:5px;float:left;" 
            type="button" id="new_appointment">
            Thêm Bác sĩ
            </button>
            <form method="post" style="width:150px;margin:5px;float:right;">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="ss"
                        style="width:200px; float:right;">
                        </div>
            </form>
        </div>
    <div>
    <table class="card-body table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:5%">STT</th>
                    <th style="width:15%">Image</th>
                    <th style="width:15%">Họ và tên</th>
                    <th style="width:15%">Chuyên khoa</th>
                    <th style="width:15%">Tên tài khoản</th>
                    <th style="width:10%">Ngày sinh</th>
                    <th style="width:10%">Giới tính</th>
                    <th style="width:5%">Hoạt động</th>
                    <th style="width:10%">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //timkiem
                $s='';
                    if(isset($_POST['ss'])){
                        $s=$_POST['ss'];
                    }
                    $additional='';
                    if(!empty($s)){
                        $additional=' and b.Hoten like"%'.$s.'%" or
                       b.Ngaysinh like"%'.$s.'%"
                        or b.Gioitinh like"%'.$s.'%"';
                    }
                ////lay danh sach
                $s = new data();
                $dem=1;
                $sql = 'SELECT b.Hoten,b.ID_Khoa,ID_Bacsi,b.Gioitinh,t.Tendangnhap,b.image,Tinhtrangbacsi
                            ,Tenkhoa,b.Ngaysinh FROM bacsi b join khoa k on b.ID_Khoa=k.ID_Khoa join taikhoan t on t.id=b.id where 1 '.$additional.' 
                            Order by ID_Bacsi DESC';
                $caterogyList = $s->executeLesult($sql);
                foreach ($caterogyList as $item) {
                    if($item['Tinhtrangbacsi'] == "Đang làm"){
                        echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td class="text-center">
									<img  src="./../images/bacsi/'.$item['image'].'" width="150px"
                                    height="150px" alt="">
								</td>
                                <td>' . $item['Hoten'] . '</td>
                                <td>' . $item['Tenkhoa'] . '</td>
                                <td>' . $item['Tendangnhap'] . '</td>
                                <td>' . date("d-m-Y",strtotime($item['Ngaysinh'])) . '</td>
                                <td>' . $item['Gioitinh'] . '</td>
                                <td>
                                <a href="index.php?page=doctors&idsua='.$item['ID_Bacsi'].'" >
                                <button class="btn btn-primary btn btn-sm" type="submit" name="Sửa" 
                              >Sửa</button></a>
                                    </br> </br>
                              <button class="btn btn-sm btn-danger delete_doctor" type="button" data-id="'.$item['ID_Bacsi'].'">Xóa
                                </button>
                                </td>
                                <td>
                                        '. $item['Tinhtrangbacsi'] .'
                                </td>
                                ';
                    $dem++;
                    }else{
                        echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td class="text-center">
									<img  src="./../images/bacsi/'.$item['image'].'" width="150px"
                                    height="150px" alt="">
								</td>
                                <td>' . $item['Hoten'] . '</td>
                                <td>' . $item['Tenkhoa'] . '</td>
                                <td>' . $item['Tendangnhap'] . '</td>
                                <td>' . date("d-m-Y",strtotime($item['Ngaysinh'])) . '</td>
                                <td>' . $item['Gioitinh'] . '</td>
                                <td>
                                <a class="btn btn-primary btn btn-sm" href="index.php?page=doctors&khoiphuc='.$item['ID_Bacsi'].'" >Khôi phục</a>
                                    </br> </br>
                                </button>
                                </td>
                                <td>
                                        '. $item['Tinhtrangbacsi'] .'
                                </td>
                                ';
                    $dem++;
                    }
                    
                }
                if(isset($_GET['khoiphuc'])){
                    $idkhoiphuc=$_GET['khoiphuc'];
                    $sqlkhoiphuc='update bacsi set Tinhtrangbacsi="Đang làm" where ID_Bacsi='.$idkhoiphuc.'';
                    $s->execute($sqlkhoiphuc);
                        echo '<script>
                        alert("Khôi phục hoạt động thành công");
                        window.location.href="index.php?page=doctors";
                        </script>';
                    
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Them doctor -->
<!-- Table Panel -->
</div>
<script>
$('.delete_doctor').click(function(){
		_conf("Bạn có chắc là muốn xóa bác sĩ này ko?","delete_doctor",[$(this).attr('data-id')])
	})
	function delete_doctor($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_doctor',
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
          <h4 class="modal-title">Thêm Bác sĩ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
        <form action="././Controller/thembacsi.php" id="manage-appointment" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Họ tên:</label>
                        <input type="text" class="form-control" name="hoten" value="<?php $hoten?>" placeholder="Enter Họ tên" required>
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập:</label>
                        <select class="form-control" name="tendangnhap" required>
                            <?php
                            $sql1 = 'select * from taikhoan where Phanquyen="Doctor" AND id not in (
                                SELECT t.id from taikhoan t JOIN bacsi b on t.id=b.id)';
                            $caterogyList1 = $s->executeLesult($sql1);
                            foreach ($caterogyList1 as $item1) {
                                echo '<option value="' . $item1['id'] . '" >' . $item1['Tendangnhap'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên Khoa: </label>
                        <select class="form-control" name="tenkhoa" id="cars" placeholder="chon khoa">
                            <?php
                            $sql = 'SELECT ID_Khoa,Tenkhoa FROM khoa';
                            $caterogyList = $s->executeLesult($sql);
                            foreach ($caterogyList as $item) {
                                echo '<option value="' . $item['ID_Khoa'] . '" >' . $item['Tenkhoa'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh:</label>
                        <input type="date" class="form-control" name="ngaysinh" required>
                        
                    </div>
                    <div class="form-group" >
                        <label>Giới tính:</label>
                        <input type="radio" value="Nam" name="gioitinh"><label for="">Nam</label>
                        <input type="radio" value="Nữ" name="gioitinh" ><label for="">Nữ</label> <br>
                        <span style="color:red"><?php echo isset($messs3)?$messs3:''; ?></span>
                    </div>
                    <div class="form-group">
						<label for="" class="control-label">Image</label>
						<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))"  required>
					</div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="submit">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>





