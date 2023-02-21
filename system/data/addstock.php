<?php 
include '../system.php';



$stock = str_replace(array("\r\n", "\r", "\n"), "\n<batch>\n", $_POST['inputItemData']);


if (empty($_POST['id'])) {
	echo "ไม่พบสินค้านี้";
} elseif (empty($_POST['inputItemData'])) {
	echo "กรุณากรอกสินค้าที่จะลง";
} elseif($_SESSION['status'] !== "admin") {
	echo "พ่องตาย";
} else {
	$req = "<batch>\n" . $stock;
	$class = new heehub;
	$add = $class->addstock($_POST['id'],$req);
	echo $add;
}
?>