<?php 

if (empty($_POST['id'])) {
	echo "ไม่มี Q&A นี้";
}else{
	include '../system.php';
	$class = new heehub;
	$delete = $class->deleteqa($_POST['id']);
	echo $delete;
}

 ?>