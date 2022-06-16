<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="assets/jquery-1.11.3.min.js"></script>
        <script>
        var curDate = new Date();
        
        // Ngày hiện tại
        var curDay = curDate.getDate();
    
        // Tháng hiện tại
        var curMonth = curDate.getMonth() + 1;
        
        // Năm hiện tại
        var curYear = curDate.getFullYear();
    
        // Gán vào thẻ HTML
        
</script>
    </head>

    <body>
        <?php require_once("./config.php"); 
        include('../db/connect.php')?>             
        <div class="container">
            <div class="header clearfix">
                <a class="navbar-brand" href="../index.php">
                    <img src="../images/logo.png" alt="" class="img-fluid">
                </a>
            </div>
            <h3>Thanh toán đặt lịch khám</h3>
            <div class="table-responsive">
                <form action="vnpay_create_payment.php" id="create_form" method="post">       

                    <div class="form-group">
                        <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            
                            <option value="billpayment">Thanh toán hóa đơn</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">Mã hóa đơn</label>
                        <input class="form-control" id="order_id" name="order_id" type="text" readonly value="<?php echo date("YmdHis") ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" id="amount"
                               name="amount" type="number" value="200000" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Noi dung thanh toan</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            
                            <option value="NCB"> Ngan hang NCB</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Thời hạn thanh toán</label>
                        <input class="form-control" id="txtexpire"
                               name="txtexpire" type="text" value="<?php echo $expire; ?>"/>
                    </div>
                    <div class="form-group">
                        <h3>Thông tin hóa đơn (Billing)</h3>
                    </div>
                    <?php 


                        if(isset($_GET['id'])){
                            //$id=$_GET['id'];
                            $_SESSION['id_pay']=$_GET['id'];
                        }else{
                            $_SESSION['id_pay']='';
                            //$id='';
                        }
                        //echo $_SESSION['id_pay'];
                        $sql="SELECT * from lichhen l join benhnhan bn on l.ID_Benhnhan=bn.ID_Benhnhan join
                         taikhoan t on bn.id = t.id where id_Lichhen=".$_SESSION['id_pay'];
                         $p=new data();
                        $item=$p->executeSingLesult($sql);
   
                    ?>
                    <div class="form-group">
                        <label >Họ tên (*)</label>
                        <input class="form-control" id="txt_billing_fullname"
                               name="txt_billing_fullname" type="text" value="<?php echo $item['Hotenbn'] ?>"/>             
                    </div>
                    <div class="form-group">
                        <label >Email (*)</label>
                        <input class="form-control" id="txt_billing_email"
                               name="txt_billing_email" type="text" value="<?php echo $item['Email'] ?>"/>   
                    </div>
                    <div class="form-group">
                        <label >Ngày hẹn (*)</label>
                        <input class="form-control" id="txt_billing_mobile"
                               name="txt_billing_day" type="text" value="<?php echo date("d-m-Y",strtotime($item['Ngayhen'])) ?>"/>   
                    </div>
                    <div class="form-group">
                        <label >Giờ hẹn (*)</label>
                        <input class="form-control" id="txt_billing_mobile"
                               name="txt_billing_time" type="text" value="<?php echo date("h:i A",strtotime($item['Giobatdau'])).' - '.date("h:i A",strtotime($item['Gioketthuc'])) ?>"/>   
                    </div>
                    

                    <button type="submit" name="redirect" id="redirect" class="btn btn-primary">Thanh toán Redirect</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY <?php echo date('Y')?></p>
            </footer>
        </div>  
       
         


</body>
</html>


