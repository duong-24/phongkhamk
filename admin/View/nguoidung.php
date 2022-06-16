<div class="container-fluid">
    <div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách người dùng</h1>
    </div>
    <div class="panel-body card">
        <div>
            <button class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#myModal" style="width:150px;margin:5px;float:left;" 
            type="button" id="new_appointment">
            Thêm người dùng
            </button>
            <form method="post" style="width:150px;margin:5px;float:right;">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="sss"
                        style="width:200px; float:right;">
                        </div>
            </form>
        </div>
    <div>
    <table class="card-body table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:5%">STT</th>
                    <th style="width:15%">Tên đăng nhập</th>
                    <th style="width:15%">Password</th>
                    <th style="width:15%">Email</th>
                    <th style="width:15%">Phân quyền</th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //timkiem
                $s='';
                    if(isset($_POST['sss'])){
                        $s=$_POST['sss'];
                    }
                    $additional='';
                    if(!empty($s)){
                        $additional=' and Tendangnhap like"%'.$s.'%"
                        or Email like"%'.$s.'%" or Phanquyen like"%'.$s.'%"';
                    }
                ////lay danh sach
                $s = new data();
                $dem=1;
                $sql = 'SELECT * FROM taikhoan where 1 '.$additional.' Order by id DESC';
                $caterogyList = $s->executeLesult($sql);
                foreach ($caterogyList as $item) {
                    echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td>' . $item['Tendangnhap'] . '</td>
                                <td>
                                <button class="btn btn-sm btn-danger Khoiphuc" type="button" data-id="'.$item['id'].'">Khôi phục</button>
                                </a>
                                <td>' . $item['Email'] . '</td>
                                <td>' . $item['Phanquyen'] . '</td>
                                <td>
                                <a href="index.php?page=users&idsua='.$item['id'].'" >
                                <button class="btn btn-primary btn btn-sm" type="submit" name="Edit" 
                              >Sửa</button></a>
                                </td>
                                ';
                             $dem++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$('.Khoiphuc').click(function(){
		_conf("Bạn có chắc là muốn reset mật khẩu ko?","Khoiphuc",[$(this).attr('data-id')])
	})
	function Khoiphuc($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=Khoiphuc',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Khôi phục thành công",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
<!-- Them doctor -->
<!-- Table Panel -->
</div>
<!--  ---------------Modal Them-->
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thêm tài khoản</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
        <form action="././Controller/themtaikhoan.php" id="manage-appointment" method="POST">
                    <div class="form-group">
                        <label>Tên đăng nhập:</label>
                        <input type="text" class="form-control" name="tendangnhap" placeholder="Nhập tên tài khoản" required
                        oninvalid="this.setCustomValidity('Tên đăng nhập không được để trống')"
                         oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" required
                        oninvalid="this.setCustomValidity('Email không hợp lệ')"
                         oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Phân quyền:</label>
                        <select class="form-control" name="phanquyen">
                           <option value="Doctor">Doctor</option>        
                           <option value="Admin">Admin</option>           
                        </select>
            </div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="submit3">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>





