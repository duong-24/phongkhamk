<div class="container-fluid">
    <div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh phòng khám</h1>
    </div>
    <div class="panel-body card">
        <div>
            <button class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#myModal" style="width:150px;margin:5px;float:left;" 
            type="button" id="new_appointment">
            Thêm phòng khám
            </button>
            <form method="post" style="width:150px;margin:5px;float:right;">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="s"
                        style="width:200px; float:right;">
                        </div>
            </form>
        </div>
    <div>
    <table class="card-body table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:5%">STT</th>
                    <th style="width:15%">Tên phòng</th>
                    <th style="width:15%">Chuyên khoa</th>
                    <th style="width:15%">Ngày Thành lập</th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //timkiem
                $s='';
                    if(isset($_POST['s'])){
                        $s=$_POST['s'];
                    }
                    $additional='';
                    if(!empty($s)){
                        $additional=' and Tenphongkham like"%'.$s.'%" or Tenkhoa like"%'.$s.'%"
                        or NgayThanhLap like"%'.$s.'%" ';
                    }
                ////lay danh sach
                $s = new data();
                $dem=1;
                $sql = 'SELECT * from phongkham p join khoa k on p.ID_Khoa=k.ID_Khoa where 1 '.$additional.' Order by ID_Phongkham DESC';
                $caterogyList = $s->executeLesult($sql);
                foreach ($caterogyList as $item) {
                    echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td>' . $item['Tenphongkham'] . '</td>
                                <td>' . $item['Tenkhoa'] . '</td>
                                <td>' . date("d-m-Y",strtotime($item['NgayThanhLap'])) . '</td>
                                <td>
                                <a href="index.php?page=phongkham&idsua='.$item['ID_Phongkham'].'" >
                                <button class="btn btn-primary btn btn-sm" type="submit" name="Sửa" 
                              >Sửa</button></a>
                                </td>
                                ';
                    $dem++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Them doctor -->
<!-- Table Panel -->
</div>

<!--  ---------------Modal Them-->
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thêm Phòng khám</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	
        <!-- Modal body -->
        <div class="modal-body">
        <form action="././Controller/themphongkham.php" id="manage-appointment" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Tên phòng:</label>
                        <input type="text" class="form-control" name="hoten" placeholder="Enter tên phòng" required>
                    </div>
                    <div class="form-group">
                        <label>Tên chuyên khoa:</label>
                        <select class="form-control" name="tenchuyenkhoa">
                            <?php
                            $sql1 = 'select * from khoa ';
                            $caterogyList1 = $s->executeLesult($sql1);
                            foreach ($caterogyList1 as $item1) {
                                echo '<option value="' . $item1['ID_Khoa'] . '" >' . $item1['Tenkhoa'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ngày thành lập:</label>
                        <input type="date" class="form-control" name="ngaysinh" required>
                        
                    </div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="submit">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>





