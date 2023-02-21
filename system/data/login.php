<?php 
$user_email = $_POST['user_email'];
$pass = $_POST['pass'];

if ($user_email == NULL) {
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอก ชื่อผู้ใช้ หรือ อีเมล'));
}elseif ($pass == NULL){
	echo json_encode(array('status' =>'error'/*สถานะ*/, 'info'/*ข้อความ*/ =>'กรุณากรอกรหัสผ่าน'));
}else{
	include '../system.php';
	$class = new heehub;
	$login = $class->login($user_email,$pass);
	echo json_encode($login);
}

 ?>