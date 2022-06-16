<?php
  include('db/constrants.php');
  include('db/validation.php');
  $err = [];
  if(isset($_POST['username']))
  {
      $username = $_POST['username'];
      $password =$_POST['password'];
      $repass = $_POST['repass'];
      $email = $_POST['email'];
      $phanquyen = 'Benhnhan';

      // 
      

      

      //
        if(empty($username))
        {
          $err['username'] = '*Bạn chưa nhập tên đăng nhập';
        }
        else{
            // Kiểm tra định dạng username
            if (!is_username($username)) {
                $err['username'] = "*Tên đăng nhập phải từ 6 chữ số và không quá 32 chữ số";
            }
            else
            {
              $username = $_POST['username'];  
            }
        }

        if(isset($username))
        {
          $sql_check = "SELECT * FROM taikhoan where Tendangnhap = '$username'";
          $result_check = mysqli_query($conn,$sql_check);
          if(mysqli_num_rows($result_check) > 0)
          {
            $err['err_check'] = "*Tên đăng nhập đã được sử dụng";
          }
        }
        else
        {
          $username = $_POST['username']; 
        }

        //Kiểm tra lỗi password
        if(empty($password))
        {
           $err['password'] = '*Bạn chưa nhập mật khẩu';
         } else {
            // Kiểm tra định dạng password
            if (!is_password($_POST['password'])) {
                $err['password'] = "*Mật khẩu bắt đầu bằng chữ in hoa từ 5 chữ số";
            } else {
                $password = $_POST['password'];
            }
        }
        if(empty($repass)){
          $err['repass'] = '*Bạn chưa nhập lại mật khẩu';
        }
        else
        {
          if($password != $repass)
          {
            $err['repass'] = '*Mật khẩu nhập lại không đúng';
          }
        }
        

        if(empty($email))
        {
          $err['email'] = '*Bạn chưa nhập email';
        }else {
          // Kiểm tra định dạng password
          if (!is_email($_POST['email'])) {
              $err['email'] = "Email không đúng định dạng";
          } else {
              $email = $_POST['email'];
          }

        if(isset($email))
        {
          $sql_mail = "SELECT * FROM taikhoan where Email = '$email'";
          $result_mail = mysqli_query($conn,$sql_mail);
          if(mysqli_num_rows($result_mail) > 0)
          {
            $err['err_mail'] = "*Email đã được sử dụng";
          }
        }
        else
        {
          $email = $_POST['email']; 
        }
      }
      
      if(empty($err))
      {        
        include './db/connect.php';
        $s=new data();
        $pass = md5($password);
        $sql = "INSERT INTO taikhoan(Tendangnhap,Password,Email,Phanquyen) 
        values ('$username','$pass','$email','$phanquyen')";
        $query = mysqli_query($conn,$sql);
        
        if($query)
        {          
          $res = mysqli_query($conn, "SELECT * FROM taikhoan WHERE Tendangnhap='$username' and Password='$pass'");
          $count = mysqli_num_rows($res);
          if ($count > 0) {              
                $row = mysqli_fetch_array($res);                
                if($row['Phanquyen']=='Benhnhan')
                {
                  echo '<script>
                    alert("Đăng Ký Thành Công");
                    window.location.href="index.php";
                  </script>';
                  $_SESSION['username'] = $row['Tendangnhap'];
                  $_SESSION['phanquyen'] = $row['Phanquyen'];
                    // Them vào benh nhan
                  $sql1='Select id from taikhoan Where 
                  Tendangnhap="'.$_SESSION['username'].'" and Phanquyen="Benhnhan"';
                  $id_taikhoan=$s->executeSingLesult($sql1);
                  
                  // //rồi a insert vào bảng bệnh nhân
                  $sql2='INSERT INTO benhnhan (ID_Benhnhan, id, Hotenbn,Ngaysinh,Gioitinh,image)
                  VALUES (NULL, "'. $id_taikhoan['id'].'", "Nguyễn Văn A", "2021-10-13", "Nam", "anh1.jpg")';
                  $s->execute($sql2);

                  //insert benhnhan(id,Hoten,Ngaysinh,Gioitinh)
                  //values ('$id_taikhoan','Nguyen van A','0000-00-00','Nam')
                  //$query = mysqli_query($conn,$sql);               
                }                
            }
        }
        else{
          echo'<script>alert("Đăng Ký Thất Bại");</script>';
        }
      }
      
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/form_login.css">
    <style>
      .has-error{
        color:red;
        font-weight: 600;
      }
      .p-t-20 {
        border: 1px solid #34495e;
        border-radius: 5px;
        padding-bottom: 10px;
      }
    </style>
</head>
<body>
  <div class="container">
          <form action="" method="POST" enctype="multipart/form-data">
            <h2>ĐĂNG KÝ</h2>
            
              <!-- <label for="uname">Tên Đăng Nhập:</label> -->
              <input type="text" class="form-control" id="uname" placeholder="Nhập tên đăng nhập từ 6 chữ số" name="username" >
              <div class="has-error">
                <span> <?php echo (isset($err['username'])) ? $err['username']:'' ?> </span>
                <span> <?php echo (isset($err['err_check'])) ? $err['err_check']:'' ?> </span>
              </div>
            

            
              <!-- <label for="pwd">Mật Khẩu:</label> -->
              <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu bắt đầu chữ in hoa từ 5 chữ số" name="password" >
              <div class="has-error">
                <span> <?php echo (isset($err['password'])) ? $err['password']:'' ?> </span>
              </div>
            

           
              <!-- <label for="rpwd">Xác nhận mật khẩu:</label> -->
              <input type="password" class="form-control" id="rpwd" placeholder="Nhập lại mật khẩu" name="repass" >
              <div class="has-error">
                <span> <?php echo (isset($err['repass'])) ? $err['repass']:'' ?> </span>
              </div>
            

            
              <!-- <label for="txtemail">Email:</label> -->
              <input type="email" class="form-control" id="txtemail" placeholder="Nhập email của bạn" name="email">
              <div class="has-error">
                <span> <?php echo (isset($err['email'])) ? $err['email']:'' ?> </span>
                <span> <?php echo (isset($err['err_mail'])) ? $err['err_mail']:'' ?> </span>
              </div>
            

            <div class="btn-form">
              <input type="submit" class="btn-login" value="Đăng Ký" name="submit">
              <input type="button" class="btn-login" style="margin-top:10px;" value="Trở Lại" 
                  onClick="history.back()" />
                  <!-- Nút cancer-->
            </div>
          </form>

  </div>

</body>
</html>
