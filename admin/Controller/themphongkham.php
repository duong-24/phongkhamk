<?php
include '../../db/connect.php';
include('../../db/validation.php');
$s=new data();
    if (isset($_POST['submit'])) {
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
                $ngaysinh = $_POST['ngaysinh'];
                $ngaysinh = str_replace('"', '\\"', $ngaysinh);
        }
        $resu=0;
        if($hoten==''){
            echo '<script>
                        alert("Vui lòng nhập đầy đủ thông tin");
                        window.location.href="../index.php?page=phongkham";
                        </script>';
        }elseif(!is_doctor($hoten)) {
            echo '<script>
            alert("Vui lòng nhập số và chữ cái");
            window.location.href="../index.php?page=phongkham";
            </script>';
          
        }else{
            if($ngaysinh<date("Y-m-d")){
                $sql2 = 'SELECT * from phongkham';
                $phongkham = $s->executeLesult($sql2);
                foreach ($phongkham as $item) {
                    if($hoten==$item['Tenphongkham']){
                        $resu=1;
                        echo '<script>
                        alert("Phòng đã tồn tại");
                        window.location.href="../index.php?page=phongkham";
                        </script>';
                        exit();
                    }else{
                        $resu=2;
                    }
                }
             }else{
                    echo '<script>
                    alert("Ngày lập phải nhỏ hơn ngày hiện tại");
                    window.location.href="../index.php?page=phongkham";
                    </script>';
                }
        }
        
        if($resu==2){
            $sql = "INSERT INTO Phongkham (ID_Khoa,Tenphongkham,NgayThanhLap)
            values('$diachi','$hoten','$ngaysinh')";
            $s->execute($sql);
            header('location:../index.php?page=phongkham');
        }
    }
?>