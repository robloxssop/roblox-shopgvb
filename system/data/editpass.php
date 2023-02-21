<?php 

if (preg_match('/[^A-Za-z0-9]/', $_POST['passwd'])) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณาใช้รหัสผ่านใหม่ภาษาอังกฤษ'));
} elseif (empty($_POST['passwd'])) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่านใหม่'));
}elseif (empty($_POST['cfpass'])) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่านยืนยัน'));
} elseif (strlen($_POST['cfpass']) < 6) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่านใหม่ 6 ตัว'));
} else {
	include '../system.php';
	$class = new heehub;
	$new_password = password_hash($_POST['cfpass'], PASSWORD_DEFAULT);
	$edp = $class->changepassword($_POST['passwd'],$new_password);
	echo json_encode($edp);
}

 ?>