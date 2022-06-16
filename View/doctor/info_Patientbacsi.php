
        <!-- info -->
        <?php 
          //ession_start();  
          include './db/connect.php';
          $p=new data();
            $sql='select * from taikhoan t join bacsi b on t.id=b.id WHERE Tendangnhap="'.$_SESSION['username'].'"';
            $dsbacsi=$p->executeSingLesult($sql);
        ?>
        <div class="row" style="padding-top: 80px;">
          <div class="col-2">  </div>
          <div class="col-3 text-center">
            <img src="./images/bacsi/<?php echo $dsbacsi['image']?>" style="border:1px solid black;radius:5px;" width="150px" height="150px">

            <p><a href ="#" data-toggle="modal" data-target="#change_image">Thay đổi ảnh</a></p>
          
            <div class="modal fade" id="change_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">

                  <!-- -------------------------------------------------------- -->
                    <form action="Controll/thaydoianhbacsi.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="file" class="form-control-file" name="image">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="change_image">Lưu</button>
                      <a href='#' class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-2">

            <p class="font-weight-bolder">Họ và Tên:</p>
            <p class="font-weight-bolder">Giới tính:</p>
            <p class="font-weight-bolder">Ngày sinh:</p>
            <p class="font-weight-bolder">Email:</p>  
          </div>
          <div class="col-3">
            <p><?php echo $dsbacsi['Hoten']; ?></p>
            <p><?php echo $dsbacsi['Gioitinh'];?></p>
            <p><?php
              echo  date("d m Y",strtotime($dsbacsi['Ngaysinh']));?>
            </p>
            <p><?php echo $dsbacsi['Email']?></p>
          </div>
          <div class="col-2"></div> 
        </div>






        
        <div class="row m-4">
          <div class="col text-center">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate">Cập nhập</button>
          </div>

          <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cập nhập thông tin</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <form action="capnhatthongtin.php" method="POST">
                    <div class="form-group">
                      <label class="font-weight-bolder">Họ và tên: </label>
                      <input type="text" class="form-control" name="fullname" value="<?php echo $dsbacsi['Hoten']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bolder">Giới tính: </label>
                      <select class="form-control" name="gioitinh">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bolder">Ngày sinh: </label>
                      <input type="date" class="form-control" name="age" value="<?php echo $dsbacsi['Ngaysinh']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bolder">Email: </label>
                      <input type="gmail" class="form-control" name="sdt" value="<?php echo $dsbacsi['Email']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="update">Lưu</button>
                  <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
