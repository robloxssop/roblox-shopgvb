<?php 

if (empty($_POST['id'])) {
	echo "ไม่มี Q&A นี้";
 }elseif ($_POST['q'] == NULL) {
	echo "กรุณากรอกคำถาม";
} elseif ($_POST['a'] == NULL) {
	echo "กรุณากรอกคำตอบ";
} else{
	include '../system.php';
	$class = new heehub;
	$delete = $class->editqa($_POST['id'],$_POST['q'],$_POST['q']);
	echo $delete;
}

 ?>