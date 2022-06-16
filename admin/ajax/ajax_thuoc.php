
        
            <thead>
                <tr>
                    <th style="width:5%">STT</th>
                    <th style="width:15%">Tên Thuốc</th>
                    <th style="width:5%">Loại thuốc</th>
                    <th style="width:60%">Thông tin thuốc</th>
                    <th style="width:10%">Hạn dùng</th>
                    <th style="width:5%"></th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody >
                <?php
            //timkiem
                    include('../../db/connect.php');
                    $s=$_POST['s'];
                    $additional='';
                    if(!empty($s)){
                        $additional=' and Tenthuoc like"%'.$s.'%"
                        or Loaithuoc like"%'.$s.'%" or Thongtinthuoc like"%'.$s.'%" 
                        or Handung like"%'.$s.'%"';
                    }
                ////lay danh sach
                $s = new data();
                $dem=1;
                $sql = 'SELECT * FROM thuoc where 1 '.$additional.'';
                $caterogyList = $s->executeLesult($sql);
                foreach ($caterogyList as $item) {
                    echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td>' . $item['Tenthuoc'] . '</td>
                                <td>' . $item['Loaithuoc'] . '</td>
                                <td>' . $item['Thongtinthuoc'] . '</td>
                                <td>' . $item['Handung'] . '</td>
                                <td>
                                <button class="btn btn-sm btn-danger delete_thuoc" type="button" value="'.$item['ID_Thuoc'].'" >Xóa</button>
                                </a>
                                </td>
                                <td>
                                <a href="index.php?page=thuoc&idsua='.$item['ID_Thuoc'].'" >
                                <button class="btn btn-primary btn btn-sm" type="submit" name="Edit" 
                              >Sửa</button></a>
                                </td>
                                ';
                             $dem++;
                }
            
?>
            </tbody>
