<?php 

$name = $_POST['name'];
$video = $_POST['video'];
$phone = $_POST['phone'];
$promote = $_POST['promote'];
$logo = $_POST['logo'];

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

$text = "https://www.youtube.com/watch?v=dew";


$video_link = multiexplode(array("https://www.youtube.com/watch?v=","https://youtu.be/"),$video);

if ( $name == NULL) {
	echo "กรุณากรอกชื่อเว็บ";
}elseif ($video == NULL) {
	echo "กรุณากรอกลิ้งสอนใช้เว็บ";
}elseif ($phone == NULL) {
	echo "กรุณากรอกเบอร์วอเล็ต";
}elseif (strlen($phone) < 10) {
	echo "กรุณากรอกเบอร์วอเล็ตให้ครบ 10 หลัก";
} elseif ($promote == NULL) {
	echo "กรุณากรอกข้อความโปรโมท";
}elseif ($logo == NULL) {
	echo "กรุณากรอกลิ้งไอคอนเว็บ";
}else{
	include '../system.php';
	$class = new heehub;
	$edit = $class->editfontend($name,$video_link[1],$phone,$promote,$logo);
	echo $edit;
}

 ?>