<?php
include '../../db/connect.php';
include('../../db/validation.php');
$s=new data();
    $gioitinh='';
    if (isset($_POST['submit'])) {
        if (isset($_POST['hoten'])) {
                $hoten = $_POST['hoten'];
                $hoten = str_replace('"', '\\"', $hoten);
                $hoten=trim($hoten);
        }
        if (isset($_POST['tendangnhap'])) {
            $tendangnhap = $_POST['tendangnhap'];
            $tendangnhap = str_replace('"', '\\"', $tendangnhap);
        }
        if (isset($_POST['tenkhoa'])) {
            $tenkhoa = $_POST['tenkhoa'];
            $tenkhoa = str_replace('"', '\\"', $tenkhoa);
        }
        if (isset($_POST['ngaysinh'])) {
                $ngaysinh = $_POST['ngaysinh'];
                $ngaysinh = str_replace('"', '\\"', $ngaysinh);
        }
        if (isset($_POST['gioitinh'])) {
            $gioitinh = $_POST['gioitinh'];
        }

        if($gioitinh==''){
            echo '<script>
            alert("Vui lòng chọn giới tính");
            window.location.href="../index.php?page=doctors";
            </script>';
        }elseif($hoten==''){
            echo '<script>
            alert("Vui lòng Không để trống");
            window.location.href="../index.php?page=doctors";
            </script>';
        }elseif(!is_doctor($hoten)) {
                echo '<script>
                alert("Vui lòng nhập số và chữ");
                window.location.href="../index.php?page=doctors";
                </script>';
              
        }else{
            if(!empty($_FILES['img']['tmp_name'])){
                            $target_dir = "../../images/bacsi/";
                            $target_file = $target_dir . basename($_FILES["img"]["name"]);
                            $type = strtolower(pathinfo( $target_file,PATHINFO_EXTENSION));
                            if($type=="jpg"||$type=="png"){
                                $fname = strtotime(date("Y-m-d H:i"))."_".$_FILES['img']['name'];
                                $move = move_uploaded_file($_FILES['img']['tmp_name'], '../../images/bacsi/'.$fname);
                                if($ngaysinh<date("Y-m-d")){
                                    //Luu vao database
                                    $sql = "INSERT INTO bacsi (id,ID_Khoa,Hoten,Ngaysinh,Gioitinh,image,Tinhtrangbacsi)
                                    values('$tendangnhap','$tenkhoa','$hoten','$ngaysinh','$gioitinh','$fname','Đang làm')";
                                    $s->execute($sql);
                                    echo '<script>
                                   alert("Thêm thành công");
                                   window.location.href="../index.php?page=doctors";
                                   </script>';
                                }else{
                                    echo '<script>
                                        alert("Phải nhỏ hơn ngày hiện hành");
                                        window.location.href="../index.php?page=doctors";
                                        </script>';
                                }
                            }else{
                                echo '<script>
                                alert("Không đúng định dạng");
                                window.location.href="../index.php?page=doctors";
                                </script>';
                            }
                        }else{
                            echo '<script>
                                alert("Ảnh bị sai");
                                window.location.href="../index.php?page=doctors";
                                </script>';
                        }
        }
    }
?>