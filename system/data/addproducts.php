<?php 
include '../system.php';
$name = $_POST['name'];
$price = $_POST['price'];
$detail = $_POST['detail'];
$img = $_POST['img'];
$pattern = $_POST['pattern'];

if (empty($name) || empty($price) || empty($detail) || empty($img)) {
	echo "กรุณากรอกให้ครบ";
} elseif ($_SESSION['status'] !== "admin") {
	echo "WTFF!!";
} elseif ($pattern == "เลือกรูปแบบที่ต้องการส่ง") {
	echo "กรุณาเลือกรูปแบบสินค้า";
} else {
	$class = new heehub;
	$add = $class->addproduct($name,$price,$detail,$img,$pattern);
	echo $add;
}

 ?>