<?php
    require('vendor/autoload.php');
    $clientID='565136117957-2eli3vrv3q691kcglvgp34i734srupo1.apps.googleusercontent.com';
    $ClientSecret='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';
    $redirectUrl= 'http://localhost:8080/quanlyphongkham/login.php';

    $client = new Google_Client();
    $client->setClientID($clientID);
    $client->setClientSecret($ClientSecret);
    $client->setRedirectUri($redirectUrl);

    $client->addScope('email');
    $client->addScope('profile');

    

    $service = new Google_Service_Oauth2($client);
    
    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
        exit;
    }
    
    

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
    } else {
        $authUrl = $client->createAuthUrl();
    }
    if ($client->isAccessTokenExpired()) {
        $authUrl = $client->createAuthUrl();
    //            header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    }

    
   
    if (!isset($authUrl)) {
        $googleUser = $service->userinfo->get(); //get user info 
        if(!empty($googleUser)){
            //var_dump($googleUser);
            $name = $googleUser['name'];
            $email = $googleUser['email'];
            $gender = $googleUser['gender']; 
    
            $picture = $googleUser["picture"];            
            // function loginFromSocialCallBack($googleUser){                 
                $result1 = mysqli_query($conn, "select * FROM taikhoan WHERE email ='$email'");
                $i = mysqli_num_rows($result1);
                 if ($i == 0) {
                     //$pa=md5(12345)
                    //echo '<img src="'.$picture.'">';
                     $sql = "insert into Taikhoan(Tendangnhap,Email,Phanquyen) values('$name','$email','Benhnhan')"; 
                     $res = mysqli_query($conn, $sql);
                     $last_id = mysqli_insert_id($conn);
                     $sq = "insert into benhnhan(id,
                     Hotenbn,Ngaysinh,Gioitinh,image) values('$last_id','$name','2021-11-09','Nam','$picture')";
                     mysqli_query($conn,$sq);  
                     //mysqli_query($conn,"INSERT INTO benhnhan(id,Hotenbn,Gioitinh,image) values('$lastid','$name','$gender','$picture')");                       
                     if($res) { 
                        //$last_id = mysqli_insert_id($conn);
                        // echo $last_id;  
                        
                        
                    
                        $query = mysqli_query($conn, "Select * FROM taikhoan WHERE email = '$email'");
                        $row = mysqli_fetch_array($query); 
                        session_start();
                        $_SESSION['username'] = $row['Tendangnhap'];
                        $_SESSION['phanquyen'] = $row['Phanquyen'];
                        // header('Location:index.php');
                        echo '<script>
                        alert("Đăng nhập thành công với tài khoản google");
                        window.location.href="index.php";
                        </script>';
                    }
                    else
                    {
                        echo mysqli_error($conn);
                        exit;
                    }                    
                } 
                else{
                    $query = mysqli_query($conn, "Select * FROM taikhoan WHERE email = '$email'");
                    $row = mysqli_fetch_array($query); 
                    session_start();
                    $_SESSION['username'] = $row['Tendangnhap'];
                    $_SESSION['phanquyen'] = $row['Phanquyen'];
                    // header('Location:index.php');
                    echo '<script>
                        alert("Đăng nhập thành công với gmail");
                        window.location.href="index.php";
                        </script>';
                }               
                // if ($result1->num_rows > 0) {
                //     $row = mysqli_fetch_array($result1);                    
                //     if (session_status() == PHP_SESSION_NONE) {
                //         session_start();
                //     }
                //     $_SESSION['username'] = $row['Tendangnhap'];
                //     // $_SESSION['username'] = $username;
                //     header('Location:index.php');
                // }
            // }
        }
    }
?>
