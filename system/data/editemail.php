<?php 

$email = $_POST['email'];
$pass = $_POST['pass'];

if ($email == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกอีเมล'));
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกอีเมลให้ถูกต้อง'));
} elseif ($pass == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่าน'));
} else {
	include '../system.php';
	$class = new heehub;
	$edemail = $class->changeemail($pass,$email);
	echo json_encode($edemail);
}	

?>