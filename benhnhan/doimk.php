<div class = "container">
<center><h2>Thông tin tài khoản.</h2></center>
<center><hr width="200"></center>
	<div class="row mt-2">
		<div class="col-2"></div>
		<div class="col-1.5">
			<p class="font-weight-bolder">Tên tài khoản<p>
			<p class="font-weight-bolder">Mật khẩu</p>
			<!-- <p class="font-weight-bolder">Email</p> -->
		</div>
		<div class="col-1">
			<p class="font-weight-bolder">:<p>
			<p class="font-weight-bolder">:</p>
			<!-- <p class="font-weight-bolder">:</p> -->
		</div>
		<div class="col-3">
        <?php
            
            include './db/connect.php';
            $s = new data();
            $sql='SELECT * from taikhoan
            where Tendangnhap="'.$_SESSION['username'].'"';
            $dsbenhnhan = $s->executeSingLesult($sql);

        ?>
			<p><?php echo $dsbenhnhan['Tendangnhap']?></p>	
			<p>********</p>
			<!-- <p><?php //echo $dsbenhnhan['Email'];?></p> -->
		</div>
		<div class="col-6.5">
			<p style="padding-bottom: 24px;"></p>
      <!-- <p><a href="#"  data-toggle="modal" data-target="#modalUpdate">Cập Nhật<img src="./images/edit.svg" width="20px" class="ml-1"></a></p> -->
			<p><a href="doimk_benhnhan.php" >Đổi mật khẩu<img src="./images/edit.svg" width="20px" class="ml-1"></a></p>
		</div>
	</div>
</div>


<!-- <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
            <!-- <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cập nhập tên tài khoảng</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="capnhatthongtin.php" method="POST">
                    <div class="form-group">
                      <label class="font-weight-bolder">Tên đăng nhập: </label>
                      <input type="text" class="form-control" name="email" required="required" value="<?php echo $dsbenhnhan['Tendangnhap']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="Edit1">Lưu</button>
                  <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                  </form>
                </div>
              </div>
            </div> -->
          <!-- </div>  -->