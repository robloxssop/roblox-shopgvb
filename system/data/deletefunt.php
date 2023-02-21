<?php 

if (empty($_POST['id'])) {
	echo "ไม่มี ฟังก์ชั่น นี้";
}else{
	include '../system.php';
	$class = new heehub;
	$delete = $class->deletefunt($_POST['id']);
	echo $delete;
}

 ?>