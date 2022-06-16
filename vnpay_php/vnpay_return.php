<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <link href="./assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="./assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="./assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <?php
        include('../db/connect.php');
        require_once("./config.php");
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
            <a class="navbar-brand" href="../index.php">
                    <img src="../images/logo.png" alt="" class="img-fluid">
                </a>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $_GET['vnp_Amount'] / 100 ?> VNĐ</label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi:</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                       
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                //session_start();
                                echo "<span style='color:blue'>GD Thanh cong</span>";
                                if(isset($_GET['id'])){
                                    $id_page=$_GET['id'];
                                }
                                
                                //Thành công chuyển sang đang khám
                               // echo $_SESSION['id_pay'];

                               //Phần update chuyển trạng thái
                                $s=new data();
                                $sql = "UPDATE lichhen set Trangthai='Xác nhận' where id_Lichhen=".$id_page;
                                $s->execute($sql);
                                unset($_SESSION['id_pay']);
                                

                            } else {
                                echo "<span style='color:red'>GD Khong thanh cong</span>";
                                unset($_SESSION['id_pay']);

                            }
                        } else {
                            echo "<span style='color:red'>Chu ky khong hop le</span>";
                            unset($_SESSION['id_pay']);
                        }
                        ?>

                    </label>
                </div>
                 
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <a class="btn btn-primary" href="../thongtinbenhnhan.php?pagetrang=xemlich">Quay về</a>
                   <p>&copy; VNPAY <?php echo date('Y')?></p>
                   
            </footer>
            <?php 
            // session_start();
            // foreach ($_SESSION['id_pay'] as $value) {
            //     print_r($value);
            // }
            // echo $_GET['id'];
            // var_dump($_SESSION['id_pay']);
            // print_r($_SESSION['id_pay']);
                //$_SESSION['id_pay']=4;
                //print_r($_SESSION['id_pay']);
            ?>
        </div>  
    </body>
</html>
