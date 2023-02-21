<?php 

$id = $_POST['id'];
$name = $_POST['name'];
$img = $_POST['img'];
$detail = $_POST['detail'];
$price = $_POST['price'];
$pattern = $_POST['pattern'];

if ($price ==  NULL) {
	echo "กรุณาใส่ราคาสินค้า";
} elseif ($pattern == NULL) {
	echo "กรุณาใส่รูปแบบสินค้า";
} else {
	include '../system.php';
	$class = new heehub;
	$edit = $class->editproduct($id,$name,$img,$detail,$price,$pattern);
	echo $edit;
}

?>