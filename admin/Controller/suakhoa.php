
<?php
$s=new data();
    if (isset($_GET['idsua'])) {
        $mess='';
        $id = $_GET['idsua'];
        $sql = "select Tenkhoa,Ngaythanhlap_khoa,Hinhanh from khoa where ID_Khoa=".$id;
        $khoa = $s->executeSingLesult($sql);
            $tenkhoa1 = $khoa['Tenkhoa'];
            $Ngaythanhlap=$khoa['Ngaythanhlap_khoa'];
            $Hinhanh=$khoa['Hinhanh'];
            $mess='';
             $messxuly1=$messxuly2='';
            if(isset($_POST['submit2'])){
                $resu=0;
                if (isset($_POST['tenkhoa'])) {
                    $tenkhoa = $_POST['tenkhoa'];
                    $tenkhoa = str_replace('"', '\\"', $tenkhoa);
                    $tenkhoa=trim($tenkhoa);
                }
                if (isset($_POST['ngaythanhlap'])) {
                        $ngaythanhlap = $_POST['ngaythanhlap'];
                        $ngaythanhlap = str_replace('"', '\\"', $ngaythanhlap);
                }
                if($tenkhoa!=''){
                    if(!is_doctor($tenkhoa)){
                        $messxuly1='Vui lòng Nhập chữ cái và số';
                    }else{
                        if($tenkhoa!=$tenkhoa1){
                            if($_FILES['image']['name']==''){
                                $sql3 = 'SELECT * from khoa';
                                $phongkham1 = $s->executeLesult($sql3);
                                foreach ($phongkham1 as $item) {
                                    if($tenkhoa==$item['Tenkhoa']){
                                        echo '<script>
                                        alert("Khoa đã tồn tại");
                                        window.location.href="index.php?page=categories";
                                        </script>';
                                        exit();
                                    }else{
                                        $resu=2;
                                    }
                                }
                            }else {
                                $target_dir = "../images/khoa/";
                                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                                $type = strtolower(pathinfo( $target_file,PATHINFO_EXTENSION));
                                if($type=="jpg"||$type=="png"){
                                    $sql2 = 'SELECT * from khoa';
                                    $phongkham = $s->executeLesult($sql2);
                                    foreach ($phongkham as $item) {
                                        if($tenkhoa==$item['Tenkhoa']){
                                            $resu=1;
                                            echo '<script>
                                            alert("Khoa đã tồn tại");
                                            window.location.href="index.php?page=categories";
                                            </script>';
                                            exit();
                                        }else{
                                            $resu=3;
                                        }
                                    }
                                }
                                else{
                                    echo '<script>
                                    alert("Không đúng định dạng");
                                    window.location.href="index.php?page=categories";
                                    </script>';
                                }
                            
                            }
                        }else{
                            $resu=3;
                        }
                        
                    }

                }else{
                        $messxuly1="Vui lòng không để trống";
                }
                if($resu==2||$resu==3){
                    if($_FILES['image']['name']==''){
                        $sql = "UPDATE khoa set Tenkhoa='$tenkhoa',Ngaythanhlap_khoa='$ngaythanhlap'
                        where ID_Khoa=" . $id;
                        $s->execute($sql);
                        echo '<script>
                        alert("Sửa thành công");
                        window.location.href="index.php?page=categories";
                        </script>';
                    }else{
                        $fname = strtotime(date("Y-m-d H:i"))."_".$_FILES['image']['name'];
                        $move = move_uploaded_file($_FILES['image']['tmp_name'], '../images/khoa/'.$fname);
                        $sql = "UPDATE khoa set Tenkhoa='$tenkhoa',Hinhanh='$fname',Ngaythanhlap_khoa='$ngaythanhlap'
                        where ID_Khoa=" . $id;
                        $s->execute($sql);
                        echo '<script>
                        alert("Sửa thành công");
                        window.location.href="index.php?page=categories";
                        </script>';
                    }
                
                }

            } 
    }
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <center>
                <h4 class="modal-title">Sửa thông tin khoa</h4>
            </center>
            <h5 style="color:green"><?php echo $mess ?></h5>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên khoa:</label>
                    <input type="text" class="form-control" name="tenkhoa" value="<?php echo $tenkhoa1?> " >
                    <span style="color:red"><?php echo $messxuly1 ?></span>
                </div>
                <div class="form-group">
                    <label>Ngày thành lập:</label>
                    <input type="date" class="form-control" name="ngaythanhlap" value="<?php echo $Ngaythanhlap ?>">
                </div>
                <div class="form-group">
                        <label>Ảnh khoa: </label>
                        <input type="file" class="form-control-file" name="image">
                        <span style="color:red"><?php echo $mess ?></span>
                    </div>

                <button type="submit" class="btn btn-primary" name="submit2">Sửa</button>
                <a href="index.php?page=categories" class="btn btn-warning float-right" name="Cancel3">Thoát</a>
            </form>
        </div>
        <!-- Modal footer -->
    </div>
</div>