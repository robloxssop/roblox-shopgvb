<?php

if (empty($_POST['id'])) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'ไม่มีสินค้านี้'));;
}else{
	include '../system.php';
	$class = new heehub;
	$buy = $class->buyproduct($_POST['id']);
	echo json_encode($buy);
}

?>