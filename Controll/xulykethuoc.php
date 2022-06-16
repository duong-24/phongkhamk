<?php 
  session_start();
  include '../db/connect.php';
  $s=new data();
  if(isset($_POST['submit'])){
    if(isset($_POST['submit'])){
      $idthuoc=$_POST['submit'];
    }
    if(isset($_SESSION['idlich'])){
      $idlich=$_SESSION['idlich'];
    }
                  
    $sql='Insert into xemthuoc (ID_Thuoc,id_Lichhen)
    VALUES ("'.$idthuoc.'","'.$idlich.'")';
    $s->execute($sql);
    echo '<script> alert("Thêm thuốc thành công");
    window.location.href="../thongtinbacsi.php?page=1";
    </script>';  
    
}
?>