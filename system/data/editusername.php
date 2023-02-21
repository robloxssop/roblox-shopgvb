<?php 

$user = $_POST['user'];
$pass = $_POST['cfpass'];

if (preg_match('/[^A-Za-z0-9]/', $user)) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณาใช้ชื่อผู้ใช้ภาษาอังกฤษ'));
} elseif ($user == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกชื่อผู้ใช้'));
} elseif ($pass == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่าน'));
} else {
	include '../system.php';
	$class = new heehub;
	$edusername = $class->changeusername($pass,$user);
	echo json_encode($edusername);
}	

?>