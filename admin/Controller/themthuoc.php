<?php
include '../../db/connect.php';
$s=new data();
if(isset($_POST['submit4'])){
	if (isset($_POST['tenthuoc'])) {
		$tenthuoc = $_POST['tenthuoc'];	
	}
	if (isset($_POST['loaithuoc'])) {
		$loaithuoc = $_POST['loaithuoc'];
	}
	if (isset($_POST['thongtinthuoc'])) {
		$thongtinthuoc = $_POST['thongtinthuoc'];
	}
	if (isset($_POST['handung'])) {
		$handung = $_POST['handung'];
	}
		$sql="INSERT INTO thuoc (Tenthuoc, 
		Loaithuoc,Thongtinthuoc,Handung)
		VALUES ('$tenthuoc','$loaithuoc', '$thongtinthuoc', '$handung')";
		$s->execute($sql);
		header('location:../index.php?page=thuoc');
}



