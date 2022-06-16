<?php
    if(!isset($_SESSION['username']))
	{
		echo '<script>
            alert("Bạn phải đăng nhập");
            window.location.href="login.php";
            </script>';
	}
?>
<div class="container-fluid">
	<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem Lịch</h1>
    </div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
                        <th style="width:5%">STT</th>
						<th style="width:12.5%">họ và tên bệnh nhân</th>
						<th style="width:12.5%">Ngày hẹn</th>
						<th style="width:12.5%">Giờ hẹn</th>
                        <th style="width:12.5%">Kê thuốc</th>
                        <th style="width:25%">Chuẩn đoán</th>
                        <th style="width:10%">Xử lý</th>
                        <th style="width:10%">Trạng thái</th>
					</tr>
					</thead>
					<?php 
                    include './db/connect.php';
                    $s = new data();
                    $sql='select * from taikhoan t JOIN bacsi b on t.id=b.id JOIN lichhen 
                    l on b.ID_Bacsi=l.ID_Bacsi join benhnhan n on n.ID_Benhnhan=l.ID_Benhnhan
                    where Tendangnhap="'.$_SESSION['username'].'" Order by l.id_Lichhen DESC';
                    $Lich = $s->executeLesult($sql);
                    $dem=1;
                    $sq1='Select * from benhan b join lichhen l
                    on b.id_Lichhen=l.id_Lichhen';
                    
                    foreach ($Lich as $item) {
                        if($item['Trangthai']!='Hoàn thành'&&$item['Trangthai']!='Hủy'&&$item['Trangthai']!='Đang chờ'){                  
					?>
                        <tr>
                        <td ><?php echo $dem++ ?></td>
						<td>
							<?php echo $item['Hotenbn'] ?>
						</td>
						<td><?php echo date("l M d Y",strtotime($item['Ngayhen'])) ?></td>
                        <td><?php echo date("h:i A",strtotime($item['Giobatdau'])).' - '.date("h:i A",strtotime($item['Gioketthuc'])) ?></td>
                        <!-- THuoc------------------- -->
                        <td>
                            <?php if($item['Trangthai']=='Đang khám') {?>
                                <h4>Tên thuốc: </h4>
                            <?php
                                $sql1="select * from xemthuoc x join thuoc t on x.ID_Thuoc=t.ID_Thuoc where
                                x.id_Lichhen=".$item['id_Lichhen'];
                                $s1='';
                                $ds=$s->executeLesult($sql1);
                                foreach ($ds as $value) {
                                    $s1=$value['Tenthuoc'].' , '.$s1;
                                }
                                echo $result = rtrim($s1, " , ");
                            ?>
                                <div style="width:100%">
                                    <form action="thongtinbacsi.php?page=1"  method="POST" style="width:50%"> 
                                        <br><button type="submit" value="<?php echo $item['id_Lichhen'] ?>" name="idlich1" class="btn btn-dark text-center">
                                            Kê thuốc
                                        </button>
                                    </form>
                                    <form action="thongtinbacsi.php?pagetrang=xemlich" style="width:50%"  method="POST"> 
                                        <button type="width:50%" type="submit" value="<?php echo $item['id_Lichhen'] ?>" name="xoathuoc" class="btn btn-dark text-center">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            <?php 
                                if(isset($_POST['xoathuoc'])){
                                    $sqlxoa="DELETE FROM xemthuoc WHERE id_Lichhen=".$_POST['xoathuoc'];
                                    $s->execute($sqlxoa);
                                        echo '<script>
                                        window.location.href="thongtinbacsi.php?pagetrang=xemlich";
                                        </script>';
                                    
                                }
                            // Cần sửa
                            //  if(isset($_POST['idlich1'])){
                            //     $_SESSION['idlich']=$_POST['idlich1'];
                            //  }
                                 }
                                
                            ?>
                        </td>
                        <!-- Chuẩn đoán -->
                        <form action="Controll/xulylich.php"  method="POST"> 
                        <td>   
                            <?php if($item['Trangthai']=='Đang khám') {
                                $sql2='Select * from benhan where id_Lichhen=
                                '.$item['id_Lichhen'];
                                $chuandoan=$s->executeSingLesult($sql2);?>
                                <div class="form-group">
                                    <!-- ko di hchuyen -->
<textarea rows="5" cols="58" name="noidung" class="form-control"  required 
oninvalid="this.setCustomValidity('Bạn chưa chuẩn đoán')"
                      oninput="setCustomValidity('')">
<?php 
    if($chuandoan!=null){
echo trim($chuandoan['Chuandoan']);
    }

?>
</textarea> 
    <!-- 2222222222222 Đang khám -->
                                </div>
                                
                            <?php 
                                }
                            ?>
                        </td>     
                            <!-- 0----- -->
                        <td >
                            
                                <div class="form-group">
                                    <select name="trangthai" class="form-control">
                                        <?php 
                                            if($item['Trangthai']=='Hủy'){
                                                echo '<option value="Hủy">Hủy</option>';
                                            }
                                            else{
                                                if($item['Trangthai']=='Đang khám'){

                                                 echo '
                                                 <option value="Hoàn thành">Hoàn thành</option>';
                                                }else{
                                                    ///xác nh
                                                    if($item['Trangthai']=='Xác nhận')
                                                    {
                                                       echo '
                                                        <option value="Đang khám">Khám</option>';
                                                    }
                                                    // else{
                                                    //     echo '<option value="Xác nhận">Xác nhận</option>
                                                    //     <option value="Hủy">Hủy</option>';
                                                        
                                                    // }
                                                }
                                 
                                                
                                                
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                                <button  class="btn-primary btn text-center" value="<?php echo $item['id_Lichhen']?>" style="width:135px;height:40px;font-size:12px;" name="xacnhan">Xác nhận</button>
                            
						</td>
                        </form>		
                        <td><?php echo $item['Trangthai'] ?></td>
					</tr>
                <?php }}
                     ?>
				</table>
			</div>
		</div>
	</div>
</div>


