<?php 
session_start();
    include '../db/connect.php';
    $s=new data();
            if(isset($_POST['change_image'])){
                $fname = strtotime(date("Y-m-d H:i"))."_".$_FILES['image']['name'];
                $move = move_uploaded_file($_FILES['image']['tmp_name'], '../images/bacsi/'.$fname);
            //Luu vao database
                $sql = 'update taikhoan t join bacsi b on t.id=b.id SET 
                image="'.$fname.'" WHERE Tendangnhap="'.$_SESSION['username'].'"';
                $s->execute($sql);
                header('location:../thongtinbacsi.php?pagetrang=thongtin');
            }
            
?>
