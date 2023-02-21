<?php 

$q = $_POST['q'];
$a = $_POST['a'];

if ($q == NULL) {
	echo "กรุณาเพิ่มคำถาม";
} elseif ($a == NULL) {
	echo "กรุณาเพิ่มคำตอบ";
} else {
	include '../system.php';
	$class = new heehub;
	$add = $class->addqa($q,$a);
	echo $add;
}

?>