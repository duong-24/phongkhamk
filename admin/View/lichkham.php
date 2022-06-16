<div class="container-fluid">
    <div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Xem danh sách lịch hẹn khách hàng</h1>
    </div>
    <div class="panel-body card">
        <div>
            <form method="post" style="width:150px;margin:5px;float:right;">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." id="s" name="ss"
                        style="width:200px; float:right;">
                        </div>
            </form>
        </div>
    <div>
    <table class="card-body table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:5%">STT</th>
                    <th style="width:20%">Tên bác sĩ</th>
                    <th style="width:20%">Tên bệnh nhân</th>
                    <th style="width:15%">Giờ hẹn</th>
                    <th style="width:20%">Ngày hẹn</th>
                    <th style="width:10%">Ngày tạo</th>
                    <th style="width:10%">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //timkiem
                $s='';
                    if(isset($_POST['ss'])){
                        $s=$_POST['ss'];
                    }
                    $additional='';
                    if(!empty($s)){
                        $additional=' and Hoten like"%'.$s.'%" or
                        Ngayhen like"%'.$s.'%"';
                    }
                ////lay danh sach
                $s = new data();
                $dem=1;
                $sql = 'SELECT * FROM bacsi b join lichhen l on b.ID_Bacsi=l.ID_Bacsi where 1 '.$additional.'
                Order by id_Lichhen DESC';
                $caterogyList = $s->executeLesult($sql);
                foreach ($caterogyList as $item) {
                    $sql1='select * from benhnhan where '.$item['ID_Benhnhan'].'';
                    $benhnhan=$s->executeSingLesult($sql1);
                    if(isset($item['NgayTao'])){
                        $Ngaytao=$item['NgayTao'];
                    }else{
                        $Ngaytao='';
                    }
                        echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td>' . $item['Hoten'] . '</td>
                                <td>' . $benhnhan['Hotenbn'] . '</td>
                                <td>' .date("h:i A",strtotime($item['Giobatdau'])).' - '.date("h:i A",strtotime($item['Gioketthuc'])) . '</td>
                                <td>' . date("d-m-Y",strtotime($item['Ngaysinh'])) . '</td>
                                <td>' . date("d-m-Y",strtotime($Ngaytao)) . '</td>
                                <td>
                                '.$item['Trangthai'].'
                                </td>
                            </tr>
                                ';
                    $dem++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>






