<!-- The Modal -->

<?php
$s=new data();
    if (isset($_GET['idsua'])) {
        $mess= $resu='';
        $id = $_GET['idsua'];
        $sql = 'select * from taikhoan
         where id=' . $id;
         $messxuly1=$messxuly2='';
        $category = $s->executeSingLesult($sql);
            $Tendangnhap = $category['Tendangnhap'];
            $Email=$category['Email'];
            $Phanquyen=$category['Phanquyen'];
            //lỗi trưa sửa

            if(isset($_POST['submit3'])){
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    $email = str_replace('"', '\\"', $email);
                    $email=trim($email);
                }
                if (isset($_POST['tendangnhap'])) {
                    $tendangnhap = $_POST['tendangnhap'];
                    $tendangnhap= str_replace('"', '\\"', $tendangnhap);
                    $tendangnhap=trim($tendangnhap);
                }
                if($tendangnhap!=''){
                    if(!is_doctor($tendangnhap)){
                        $messxuly1='Vui lòng Nhập chữ cái và số';
                    }else{
                        if($Tendangnhap !=$tendangnhap){
                                if($email!=''){
                                    $sql2 = 'SELECT * from taikhoan';
                                    $phongkham = $s->executeLesult($sql2);
                                        foreach ($phongkham as $item) {
                                            if($tendangnhap==$item['Tendangnhap']){
                                                $resu=1;
                                                echo '<script>
                                                alert("Tên tài khoản đã tồn tại");
                                                window.location.href="index.php?page=users";
                                                </script>';
                                                exit();
                                                
                                            }else{
                                                $resu=2;
                                            }
                                        }
                                }else{
                                    $messxuly2="Vui lòng nhập trường này";
                                }
                        }else{
                            $resu=2;
                        }
                        
                    }
                    
                }
                else{
                    $messxuly1="Vui lòng nhập trường này";
                }

                if($resu==2){
                    $sql = "UPDATE taikhoan set Tendangnhap='$tendangnhap',Email='$email'
                    where id=" . $id;
                    $s->execute($sql);
                    echo '<script>
                        alert("Sửa thành công");
                        window.location.href="index.php?page=users";
                        </script>';
                } 
            }
        
    }
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <center>
                <h4 class="modal-title">Sửa Tài khoản</h4>
            </center>
            <h5 style="color:green"><?php echo $mess ?></h5>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="#" method="post">
            <div class="form-group">
                        <label>Tên đăng nhập:</label>
                        <input type="text" class="form-control" value="<?php echo $Tendangnhap ?>" name="tendangnhap" placeholder="Nhập tên tài khoản" required>
                        <span style="color:red"><?php echo $messxuly1 ?></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo $Email ?>" name="email" required>
                        <span style="color:red"><?php echo $messxuly2 ?></span>
                    </div>
                <button type="submit" class="btn btn-primary" name="submit3">Update</button>
                <a href="index.php?page=users" class="btn btn-warning float-right" name="Cancel4">Cancel</a>
            </form>
        </div>
        <!-- Modal footer -->
    </div>
</div>