<?php 

$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];



if (preg_match('/[^A-Za-z0-9]/', $user)) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณาใช้ภาษาอังกฤษ'));
}elseif ($user == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกชื่อผู้ใช้'));
}elseif ($email == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกอีเมล'));
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกอีเมลให้ถูกต้อง'));
}elseif ($pass == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่าน'));
}elseif (strlen($pass) < 6) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่าน 6 ตัว'));
} else{
	include '../system.php';
	$class = new heehub;
	$password_hash = password_hash($pass, PASSWORD_DEFAULT);
	echo json_encode($class->register($user,$email,$password_hash));
}

?>