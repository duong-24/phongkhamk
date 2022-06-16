<?php 
          //ession_start();  
          include './db/connect.php';
          $p=new data();
            $sql='select * from taikhoan t join benhnhan b on t.id=b.id WHERE Tendangnhap="'.$_SESSION['username'].'"';
            $dsbenhnhan=$p->executeSingLesult($sql);
        ?>
        <div class="row" style="padding-top: 80px;">
          <div class="col-2"></div>
          <div class="col-3 text-center">
            <?php 
                if(substr($dsbenhnhan['image'],0,5)=="https"){
                  echo '<img src="'.$dsbenhnhan['image'].'" style="border:1px solid black;radius:5px;" width="150px" height="150px">';
                }else{
                  echo '<img src="./images/benhnhan/'.$dsbenhnhan['image'].'" style="border:1px solid black;radius:5px;" width="150px" height="150px">';
                }
            ?>
            
            
            <p><a href ="#" data-toggle="modal" data-target="#change_image">Thay đổi ảnh</a></p>
            <div class="modal fade" id="change_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">

                  <!-- -------------------------------------------------------- -->
                    <form action="thaydoianhbenhnhan.php" method="POST" enctype="multipart/form-data">
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
            <p><?php echo $dsbenhnhan['Hotenbn']; ?></p>
            <p><?php echo $dsbenhnhan['Gioitinh'];?></p>
            <p><?php
              echo  date("d m Y",strtotime($dsbenhnhan['Ngaysinh']));?>
            </p>
            <p><?php echo $dsbenhnhan['Email']?></p>
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
                      <input type="text" class="form-control" name="fullname" value="<?php echo $dsbenhnhan['Hotenbn']; ?>" required
                      oninvalid="this.setCustomValidity('Họ và tên không được để trống')"
                      oninput="setCustomValidity('')">
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
                      <input type="date" class="form-control" name="age" value="<?php echo $dsbenhnhan['Ngaysinh']; ?>">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bolder">Email: </label>
                      <input type="text" class="form-control" name="sdt" required value="<?php echo $dsbenhnhan['Email']; ?>" required
                      oninvalid="this.setCustomValidity('Email không được để trống')"
                      oninput="setCustomValidity('')">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="updatebenhnhan">Lưu</button>
                  <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
