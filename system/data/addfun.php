<?php 

if ($_POST['icon'] == NULL) {
	echo "กรุณากรอกไอคอน";
} elseif ($_POST['head'] == NULL) {
	echo "กรุณากรอกหัวข้อ";
} elseif ($_POST['detail'] == NULL) {
	echo "กรุณากรอกรายละเอียด";
} else {
	include '../system.php';
	$class = new heehub;
	$add = $class->addfun($_POST['icon'],$_POST['head'],$_POST['detail']);
	echo $add;
}

 ?>