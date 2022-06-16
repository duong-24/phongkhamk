<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../plugins/PHPMailer/src/Exception.php';
    require '../plugins/PHPMailer/src/PHPMailer.php';
    require '../plugins/PHPMailer/src/SMTP.php';

    
    session_start();
   
    if(isset($_POST['datlich'])){
        $id=$_POST['datlich'];
        include '../db/connect.php';
         $s=new data();
        $sql1='
        SELECT * from lichlamviec l join bacsi b on l.ID_Bacsi=b.ID_Bacsi
        Where ID_Lich="'.$id.'"';
        $lich=$s->executeSingLesult($sql1);
        $bs=$lich['ID_Bacsi'];
        $ngay=$lich['Ngay'];                     //appointment
        $bd=$lich['Giobatdau'];                 //StartTime
        $kt=$lich['Gioketthuc'];                //EndTime
        
        $sql2='
        SELECT * FROM benhnhan b JOIN taikhoan t on b.id=t.id
        Where Tendangnhap="'.$_SESSION['username'].'"';
        $lich1=$s->executeSingLesult($sql2);
        $bn=$lich1['ID_Benhnhan'];
        $email = $lich1['Email'];              //Email
        $name_bn = $lich1['Hotenbn'];

        $date=date("Y-m-d");
        $sql="INSERT INTO lichhen (ID_Benhnhan,ID_Bacsi,Ngayhen,Giobatdau,Gioketthuc,Ngaytao,so) 
        VALUES ('$bn','$bs','$ngay','$bd','$kt','$date','$id')";
        $s->execute($sql);
        
        ///code lấy gmail
        $sql1="Select max(id_Lichhen) as lich from lichhen";
        $max_lich=$s->executeSingLesult($sql1);
        $sql2="Select * from taikhoan t join bacsi b on t.id=b.id join lichhen l on b.ID_Bacsi=l.ID_Bacsi
        where id_Lichhen=".$max_lich['lich'];
        $gmail_bacsi=$s->executeSingLesult($sql2);

         $mail_doctor = $gmail_bacsi['Email'];
         $name_doctor = $gmail_bacsi['Hoten'];

        $mail = new PHPMailer(true);

        //Server settings
                        
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'cancaiten2012@gmail.com';                     //SMTP username
        $mail->Password   = 'Ha01639915979';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('cancaiten2012@gmail.com', 'Administrator');
        $mail->addAddress($mail_doctor);     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'THÔNG BÁO LỊCH KHÁM CHỮA BỆNH';
        $email_template = "
            <h4>Xin chào <span style='color:#e74c3c'>$name_doctor</span>
            <br>
            Bạn có 1 lịch hẹn khám bệnh mới với <span style='color:#e74c3c'>$name_bn</span>.Vui lòng kiểm tra và xác nhận
            <a href='http://localhost:8080/quanlyphongkham/thongtinbacsi.php?pagetrang=xemlich' 
            style='font-weight:bold; color:#2980b9'>Tại Đây</a>
            <br>
            Xin cảm ơn và chúc bạn có một ngày tốt lành!
            <br><br>
            Trân trọng
            <br>
            Minh Hà
            <br>
            Administrator - Phòng Khám K </h4>
        
        ";

        $mail->Body    = $email_template;
        
        $mail->send();
            
        
        echo '<script>
        alert("Đăng ký lịch thành công");
        window.location.href="../doctor.php";
        </script>';

    }
    if(isset($_POST['Xoa_lich'])){
        include '../db/connect.php';
        $s=new data();
        $idlichhen=$_POST['Xoa_lich'];
        $sql="DELETE FROM lichhen WHERE
        id_Lichhen = ".$idlichhen;
        $s->execute($sql);
            echo '<script>
            alert("Hủy lịch thành công");
            window.location.href="../thongtinbenhnhan.php?pagetrang=xemlich";
            </script>';
        
    }
    

?>