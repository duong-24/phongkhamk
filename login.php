<?php include('db/constrants.php'); 
      include('./google-source.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/form_login.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>ĐĂNG NHẬP</h2>
                  <!-- <label for="uname">Tên Đăng Nhập:</label> <br> -->
                  <input type="text" class="form-control" id="uname" placeholder="Nhập tên đăng nhập" name="username" >
                  <!-- <label for="pwd">Mật Khẩu:</label> <br> -->
                  <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password" >
          
                <div class="btn-form">
                  <input type="submit" class="btn-login" name="submit" value="Đăng Nhập" />
                  <span>Hoặc</span>
                  <button type="submit" class="btn-login btn-hidden">
                      <div class="btn-icon">
                        <img src="./images/login/icon-google.png">
                          <?php if(isset($authUrl)){ ?>
                              <a href="<?= $authUrl ?>" class='btn-icon_google'>Google</a>
                          <?php } ?>
                      </div>
                  </button>
                  <h4>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a> </h4>
        </form>
    </div>

  <?php
  // Start Session
  

  if(isset($_POST['submit']))
    {
        // Process for Login
        //1 . Get the Data from Login form
        $username= $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);           
        //$password = $_POST['password'];        
          
            $sql = "SELECT * FROM taikhoan WHERE Tendangnhap='$username' and Password='$password'";

            $res = mysqli_query($conn, $sql) ;

            $count = mysqli_num_rows($res);            
            if ($count > 0) {              
                $row = mysqli_fetch_array($res);                
                if($row['Phanquyen']=='Benhnhan')
                {
                  echo '<script>
                    alert("Đăng Nhập Thành Công");
                    window.location.href="index.php";
                  </script>';
                  $_SESSION['username'] = $row['Tendangnhap'];
                  $_SESSION['phanquyen'] = $row['Phanquyen'];                 
                }
                else if($row['Phanquyen']=='Doctor')
                {
                  $sql1="SELECT * from taikhoan WHERE id not in (SELECT id FROM bacsi) and id=".$row['id'];
                  $res1 = mysqli_query($conn, $sql1) ;
                  $count1 = mysqli_num_rows($res1);  

                  if($count1==0){
                      echo '<script>
                      alert("Đăng Nhập Thành Công với tài khoản Bác Sĩ");
                      window.location.href="index.php";
                    </script>';
                    $_SESSION['username'] = $row['Tendangnhap'];
                    $_SESSION['phanquyen'] = $row['Phanquyen'];
                  }else{
                      echo '<script>
                      alert("Tài khoản bác sĩ chưa hoạt động được");
                      window.location.href="login.php";
                    </script>';
                  }

                }
                else if($row['Phanquyen']=='Admin')
                {
                  echo '<script>
                    alert("Đăng nhập trang Admin");
                    window.location.href="admin/index.php";
                  </script>';
                }               
            }else{
                echo '<script>alert("Tài Khoản hoặc Mật Khẩu không chính xác");</script>';
                // echo 'Failed';
                // header('location:login.php');
              
            }

    }
?>

</body>
</html>






