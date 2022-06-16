<?php 
    session_start();
        include '../db/connect.php';
        $s=new data();
                if(isset($_POST['xacnhan'])){
                    if(isset($_POST['trangthai'])){
                        $trangthai=$_POST['trangthai'];
                        
                    }
                    if(isset($_POST['xacnhan'])){
                        $xacnhan=$_POST['xacnhan'];
                    }
                    if(isset($_POST['noidung'])){
                        $noidung=$_POST['noidung'];
                        $noidung = str_replace('"', '\\"', $noidung);
                        $noidung=trim($noidung);
                    }
                            $sql1='Select * from lichhen where id_Lichhen='.$xacnhan;
                            $kiemtra=$s->executeSingLesult($sql1);
                            if($kiemtra['Trangthai']=='Đang khám'){
                                $sqlkiemtratontai='Select * from lichhen where id_Lichhen in (SELECT id_Lichhen FROM benhan where id_Lichhen="'.$xacnhan.'")';
                                if($s->executeSingLesult($sqlkiemtratontai)==null){

                                    //nội dung
                                    $sql2='Insert into benhan (id_Lichhen,Chuandoan,Ngaytao)
                                    values ("'.$xacnhan.'","'.$noidung.'","'.date("Y-m-d").'")';
                                    $s->execute($sql2);
                                
                                    ////
                                    $sql = 'update taikhoan t join bacsi b on t.id=b.id join lichhen l on
                                     b.ID_Bacsi=l.ID_Bacsi SET 
                                     Trangthai="'.$trangthai.'" WHERE Tendangnhap="'.$_SESSION['username'].'" and id_Lichhen=
                                     "'.$xacnhan.'"';
                                     $s->execute($sql);
                                     echo '<script>
                                     alert("Thêm thành công");
                                     window.location.href="../thongtinbacsi.php?pagetrang=xemlich";
                                     </script>';
                                }else{
                                    $ngay=date("Y-m-d");
                                    $sql5="Update benhan
                                    set id_Lichhen='$xacnhan',Chuandoan='$noidung',Ngaytao='$ngay' where id_Lichhen=".$xacnhan;
                                    $s->execute($sql5);
                                    $sql = 'update taikhoan t join bacsi b on t.id=b.id join lichhen l on
                                    b.ID_Bacsi=l.ID_Bacsi SET 
                                    Trangthai="'.$trangthai.'" WHERE Tendangnhap="'.$_SESSION['username'].'" and id_Lichhen=
                                    "'.$xacnhan.'"';
                                    $s->execute($sql);
                                    echo '<script>
                                    window.location.href="../thongtinbacsi.php?pagetrang=xemlich";
                                    </script>';
                                    
                                }
                                //     echo '<script>
                                // alert("2,'.$kiemtra['Trangthai'].','.$noidung.'");
                                // </script>';

                            }else{
                                // echo '<script>
                                // alert("3");
                                // </script>';
                                $sql = 'update taikhoan t join bacsi b on t.id=b.id join lichhen l on
                                b.ID_Bacsi=l.ID_Bacsi SET 
                                Trangthai="'.$trangthai.'" WHERE Tendangnhap="'.$_SESSION['username'].'" and id_Lichhen=
                                "'.$xacnhan.'"';
                                $s->execute($sql);
                                echo '<script>
                                window.location.href="../thongtinbacsi.php?pagetrang=xemlich";
                                </script>';
                            }
                    

                }
                
      
?>