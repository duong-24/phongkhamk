<?php 
    include_once('../../db/connect.php');
    $s=new data();
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $delete = "DELETE from xemthuoc where ID_Thuoc=".$id;
		$delete1 = "DELETE FROM thuoc where ID_Thuoc = ".$id;
        $query=$s->execute($delete);
        $query1=$s->execute($delete1);
        if($query){
            if($query1)
                echo 'Xóa thành công';
        }else{
            echo 'Xóa thành công';
        }
    }

?>