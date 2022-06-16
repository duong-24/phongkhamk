<style>
.style{
    border: 1px solid #E12454;
    width:100px;
    padding: 5px;
    text-align:center;
    border-radius: 5px;
    background-color: #E12454;
    color:white;
}
</style>
<div class="container-fluid">
	<div class="panel-heading mt-3 ml-3 mr-3">
        <h1 class="text-center">Danh sách thuốc</h1>
    </div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
                <a href="thongtinbacsi.php?pagetrang=xemlich" class="style" style="margin:5px;float:left;">Thoát</a>
                <form method="get" style="width:150px;margin:5px;float:right;">
                            <input type="text" class="form-control" placeholder="Searching..." id="s" name="timkethuoc"
                            style="width:200px; float:right;">
                            </div>
                </form>


				<table class="table table-bordered">
                    <!-- Phan trang -->
                    <?php 
                    include 'db/connect.php';
                    $p=new data();
                    $dem1=$p->dem();
                    $prodperpage=6;
                    $dem=0;
                    ?>
                    <!-- Phan trang -->
					<thead>
						<tr>
                         <th style="width:10%">STT</th>
                        <th style="width:20%">Tên Thuốc</th>
                        <th style="width:20%">Loại thuốc</th>
                        <th style="width:20%">Hạn dùng</th>
                        <th style="width:10%"></th>
					</tr>
					</thead>
					<tbody>
                <?php 
                    $s='';
                    if(isset($_GET['timkethuoc'])){
                        $timkethuoc=$_GET['timkethuoc'];
                    }
                    else{
                        $timkethuoc='';
                    }
                    
                    $additional='';
                    if(!empty($timkethuoc)){
                        $additional=' and Tenthuoc like"%'.$timkethuoc.'%"
                        or Loaithuoc like"%'.$timkethuoc.'%"  
                        or Handung like"%'.$timkethuoc.'%"';
                    }
                    $dem=0; 
                    $page=1;
                    if(isset($_REQUEST["page"])){
                        $page=$_REQUEST["page"];
                    }
                    // ID lịch -----------------------------------------

                    $page1=($page-1)*$prodperpage;
                    $sql="select * from thuoc  where 1 $additional and ID_Thuoc not in(Select ID_Thuoc from xemthuoc where 
                    id_Lichhen=".$_SESSION['idlich'].")
                    order by ID_Thuoc 
                    desc limit $page1,$prodperpage";
                    $dsthuoc=$p-> phantrang($sql);
                    foreach ($dsthuoc as $item) {
                        $dem++;
                        echo '<tr>
                                <td>' . ($dem) . '</td>
                                <td>' . $item['Tenthuoc'] . '</td>
                                <td>' . $item['Loaithuoc'] . '</td>
                                <td>' . $item['Handung'] . '</td>
                                <td>
                                <form action="Controll/xulykethuoc.php"  method="POST"> 
                                    <button class="btn-primary btn btn-sm" value="'.$item['ID_Thuoc'].'" name="submit">Thêm</button>
                                    </form> 
                                </td>
                                ';

                    }
                ?>
                <tr class="text-center" >
                    <th colspan="5" style="width:20%" >Tên thuốc đã kê</th>
                </tr>
                <tr>
                    <td colspan="5">
                        <?php
                            $sql1="select * from xemthuoc x join thuoc t on x.ID_Thuoc=t.ID_Thuoc where
                            x.id_Lichhen=".$_SESSION['idlich'];
                            $ds=$p->executeLesult($sql1);
                            foreach ($ds as $value) {
                                $s=$value['Tenthuoc'].' ,'.$s;
                            }
                            echo $result = rtrim($s, ",");
                        ?>
                        
                    </td>
                </tr>
                </tbody>
                    <tr>
                    <td colspan="5">    
                            <div class="giua">
                            <ul class="pagination pagination-lg">
                                <?php 
                                 if(isset($_GET['timkethuoc'])){
                                    $timkethuoc=$_GET['timkethuoc'];
                                }
                                else{
                                    $timkethuoc='';
                                }
                                
                                # code...
                                for ($i=0 ;$i<$dem1/9.0;$i++) {
                                ?>
                                <li class="pagination-item">
                                    <a class="pagination-item__link" 
                                    href="thongtinbacsi.php?page=<?php echo  $i+1 ?><?php
						echo "&timkethuoc=$timkethuoc"?>">
                                    <?php echo  $i+1 ?></a></li>
                                <?php
                                 }
                        
                            
                             ?>
                         </ul>
                        </div>
                    </td>
                    </tr>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
		.pagination {
			display: flex;
			align-items: center;
			justify-content: center;
			list-style: none;
		}
		.pagination-item {
			margin-left: 15px;
			margin-right: 15px;
		}

		.pagination-item__link{
			height: 30px;
			display: block;
			text-decoration: none;
			text-align: center;
			min-width: 40px;
			line-height: 30px;
			color: #939393;
			font-size: 1.2rem;
			border-radius: 2px;
		}
        .style{
            border: 1px solid #E12454;
            width:100px;
            padding: 5px;
            text-align:center;
            border-radius: 5px;
            background-color: #E12454;
            color:white;
        }
</style>
