<?php 

if ($_POST['id'] == NULL) {
	echo "WTFFF";
} elseif ($_POST['icon'] == NULL) {
	echo "กรุณาใส่ไอคอน";
} elseif ($_POST['head'] == NULL) {
	echo "กรุณาใส่หัวข้อ";
} elseif ($_POST['detail'] == NULL) {
	echo "กรุณาใส่รายละเอียด";
} else {
	include '../system.php';
	$class = new heehub;
	$edit = $class->editfunt($_POST['id'],$_POST['icon'],$_POST['head'],$_POST['detail']);
	echo $edit;
}

?>