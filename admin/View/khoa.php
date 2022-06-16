
<div class="container-fluid">
	<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách Khoa</h1>
    </div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<button class="btn-primary btn btn-sm" type="button" data-toggle="modal" data-target="#myModal" id="new_appointment"><i class="fa fa-plus"></i> Thêm Khoa</button>
				<br>
                <br>
				<table class="table table-bordered">
					<thead>
						<tr>
                        <th>STT</th>
						<th style="width:30%;height:40%">Image</th>
						<th style="width:30%">Tên khoa</th>
						<th style="width:20%">Ngày thành lập
                        </th>
						<th style="width:10%"></th>
					</tr>
					</thead>
					<?php 
                    $s = new data();
                    $sql = 'SELECT * FROM khoa Order by ID_Khoa DESC';
                    $Lich = $s->executeLesult($sql);
                    $dem=1;
                    foreach ($Lich as $item) {
					?>
					<tr>
                        <td class="text-center"><?php echo $dem++ ?></td>
						<td class="text-center">
									<img  src="./../images/khoa/<?php echo $item['Hinhanh'] ?>" width="10px"
                                    height="5px" alt="">
								</td>
						<td><?php echo $item['Tenkhoa'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($item['Ngaythanhlap_khoa'])) ?></td>
						<td class="text-center">
						<a href="index.php?page=categories&idsua=<?php echo $item['ID_Khoa'] ?>">
							<button  class="btn btn-primary btn-sm edit_cat" type="button" data-id="<?php echo $item['ID_Khoa'] ?>">Sửa</button>
						<a>
						</td>		
					</tr>
                <?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>

<!--  ---------------Modal Them-->
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thêm Khoa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
		<form action="././Controller/themkhoa.php" id="manage-appointment" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="" class="control-label">Tên khoa</label><br>
				<input type="" class="form-control"  name="tenkhoa" value="" required>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Ngày thành lập</label>
				<input type="date"  name="Ngay" class="form-control" required>
			</div>
            <div class="form-group">
						<label for="" class="control-label">Image</label>
						<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))" required>
				</div>
			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4" name="load">Thêm</button>
				<button class="btn btn-secondary btn-sm col-md-4" data-dismiss="modal" type="button" data-dismiss="modal" id="">Thoát</button>
			</div>
		</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>
