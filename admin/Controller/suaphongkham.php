<!-- The Modal -->

<?php
$s=new data();
    if (isset($_GET['idsua'])){
        $mess='';
        $id = $_GET['idsua'];
        $sql = 'select * from phongkham
         where ID_PhongKham=' . $id;
        $category = $s->executeSingLesult($sql);
            $hoten1 = $category['Tenphongkham'];
            $diachi=$category['ID_Khoa'];
            $messxuly1=$messxuly2='';
            $ngaythanhlap = $category['NgayThanhLap'];
             if(isset($_POST['submit1'])){
                if (isset($_POST['hoten'])) {
                    $hoten = $_POST['hoten'];
                    $hoten = str_replace('"', '\\"', $hoten);
                    $hoten=trim($hoten);
                }
               if (isset($_POST['tenchuyenkhoa'])) {
                  
                       $diachi = $_POST['tenchuyenkhoa'];
                       $diachi = str_replace('"', '\\"', $diachi);
                   
               }
               if (isset($_POST['ngaysinh'])) {
                   $ngaythanhlap = $_POST['ngaysinh'];
                   $ngaythanhlap = str_replace('"', '\\"', $ngaythanhlap);
               }
               $resu=0;
               if($hoten!=''){
                    if(!is_doctor($hoten)){
                         $messxuly1='Vui lòng Nhập chữ cái và số';
                    }else{
                           if($hoten!=$hoten1){
                                $sql2 = 'SELECT * from phongkham';
                                $phongkham = $s->executeLesult($sql2);
                                foreach ($phongkham as $item) {
                                    if($hoten==$item['Tenphongkham']){
                                        $resu=1;
                                        echo '<script>
                                            alert("Phòng đã tồn tại");
                                            window.location.href="index.php?page=phongkham";
                                            </script>';
                                            exit();
                                    }else{
                                        $resu=2;
                                    }
                                }
                           }else{
                             $resu=2;
                           }
                    }
                }else{
                    $messxuly1="Vui lòng không để trống";
                }
                if($resu==2){
                    $sql = "UPDATE phongkham set ID_Khoa='$diachi',Tenphongkham='$hoten',NgayThanhLap='$ngaythanhlap'
                        where ID_Phongkham=".$id;
                        $s->execute($sql);
                        //$mess= 'Cập nhật thành công';
                        echo '<script>
                        alert("Sửa thành công");
                        window.location.href="index.php?page=phongkham ";
                        </script>';
                }
            }
    }
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <center>
                <h4 class="modal-title">Sửa phòng khám</h4>
            </center>
            <h5 style="color:green"><?php echo $mess ?></h5>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Tên phòng khám:</label>
                    <input type="text" class="form-control" name="hoten" value="<?php echo $hoten1?>" placeholder="Enter Họ tên">
                    <span style="color:red"><?php echo $messxuly1 ?></span>
                </div>
                <div class="form-group">
                        <label>Tên chuyên khoa:</label>
                        <select class="form-control" name="tenchuyenkhoa">
                            <?php
                            $sql1 = 'select * from khoa ';
                            $caterogyList1 = $s->executeLesult($sql1);
                            foreach ($caterogyList1 as $item1) {
                                echo '<option value="' . $item1['ID_Khoa'] . '" >' . $item1['Tenkhoa'] . '</option>';
                            }
                            ?>
                        </select>
                </div>
                <div class="form-group">
                    <label>Ngày Thành lập:</label>
                    <input type="date" class="form-control" name="ngaysinh" value="<?php echo $ngaythanhlap?>">
                    <span style="color:red"><?php echo $messxuly2 ?></span>
                </div>
               
                <button type="submit" class="btn btn-primary" name="submit1">Sửa</button>
                <a href="index.php?page=phongkham" class="btn btn-warning float-right">Thoát</a>
            </form>
        </div>
        <!-- Modal footer -->
    </div>
</div>