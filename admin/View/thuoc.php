<?php
    $conn = mysqli_connect('localhost', 'root','') or die(mysqli_error()); //Data connection
    $db_select = mysqli_select_db($conn,'quanlyphongkham') or die(mysqli_error());   //Selecting Data
    mysqli_set_charset($conn,'utf8');
    
    include ('./../plugins/Classes/PHPExcel.php');
    require_once ('./../plugins/Classes/PHPExcel/IOFactory.php');  //Thư viện

    if(isset($_POST['submit']))
    {
        if(isset($_FILES['file']['name']))
        {
            if($_FILES['file']['name'] !== '')
            {
                $file_name = $_FILES['file']['name'];
                // echo $file_name;
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                if($ext == 'xlsx'){
                    
                    $file = $_FILES['file']['tmp_name'];

                    // echo $file;
                    $objExcel = PHPExcel_IOFactory::load($file);

                    foreach($objExcel->getWorksheetIterator() as $worksheet)
                    {
                        $highestrow = $worksheet->getHighestRow();
                        // echo '<pre>';
                        // print_r($highestrow);

                        for($row=10;$row<=$highestrow;$row++)               // Chạy từ hàng 10
                        {
                            $tenthuoc = $worksheet->getCellByColumnAndRow(3,$row)->getValue();      //Cột chạy từ 0
                            $loaithuoc = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
                            $thongtinthuoc = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
                            $handung = $worksheet->getCellByColumnAndRow(9,$row)->getValue();
                            // echo '<br>';

                                $ql = "insert into thuoc(Tenthuoc,Loaithuoc,Thongtinthuoc,Handung) values ('$tenthuoc','$loaithuoc','$thongtinthuoc','$handung')";
                                mysqli_query($conn,$ql);
                            
                        }
                        echo'<script>alert("Thêm thuốc thành công");</script>';
                    }
                }
                else
                {
                    echo '<script>
                      alert("Chỉ được phép tải lên file excel");
                    </script>';
                }
            }
            else
            {
                echo '<script>
                      alert("Bạn chưa chọn file");
                    </script>';
            }     
        }
    }

?>
<div class="container-fluid">
<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách Thuốc</h1>
    </div>
    <div class="panel-body card">
        <!-- <div> -->
            <!-- <button class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#myModal" style="width:150px;margin:5px;float:left;" 
            type="button" id="new_appointment">
            Thêm Thuốc
            </button> -->
            <!-- <form method="post" enctype="multipart/form-data">
                
            </form> -->
            <style>
                .s2,.s3{
                    display:inline-block;
                }
            </style>
                <div>
                    <form class="s2" method="post" style="width:50%;margin:5px;float:left;" enctype="multipart/form-data">
                        <input type="file" name="file" style="margin: 7px;">
                        <input type="submit" name="submit" value="Upload">
                    </form>
                    <form class="s3 " method="post"  style="float:right;margin:5px;text-align:right;" >
                        <input type="text" class="form-control timkiem" id="timkiem"placeholder="Tìm kiếm..."  id="s" name="s"
                                style="width:200px;float:right ; margin-right:10px;">
                                
                                
                    </form>
                </div>

        <!-- </div> -->
    <div>
        <table class="card-body table table-bordered table-hover" id="load_data">
            
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        view_data();
        function view_data(){
            $.ajax({
                url:"ajax/ajax_thuoc.php",
                method:"POST",
                success:function(data){
                    $('#load_data').html(data);
                    
                }
            })
        }
        //function goitimkiem(){
            $(document).on('blur','.timkiem',function(){
                var s=$(this).val();
                $.post("ajax/ajax_thuoc.php",{s:s},function(data){
                     $('#load_data').html(data);
                 })
            });
        

        
        //Xóa
        $(document).on('click','.delete_thuoc',function(){
            var id=$(this).val();
            var check=confirm("Bạn có chắc chắn muốn xóa không");
            if(check==true){
                $.post("ajax/xoathuoc.php",{id:id},function(data){
                    alert(data);
                    view_data();

                })
            }else{
                return;
            }
            
        });
     })
</script>
<!-- Them thuóc -->
<!-- Table Panel -->
</div>
<!--  ---------------Modal Them-->
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thêm Thuốc</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
        <form action="././Controller/themthuoc.php" id="manage-appointment" method="POST">
                    <div class="form-group">
                        <label>Tên Thuốc:</label>
                        <input type="text" class="form-control" name="tenthuoc" placeholder="Nhập tên thuốc" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Loại thuốc</label><br>
                        <input type="text" class="form-control" name="loaithuoc" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Thông tin thuốc</label>
                        <textarea rows="10" name="thongtinthuoc"  cols="48"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Hạn dùng</label>
                        <input type="date" class="form-control" name="handung" required>
                    </div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="submit4">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>





