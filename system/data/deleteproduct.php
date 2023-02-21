<?php 

$id = $_POST['id'];

if ($id == NULL) {
	echo "ไม่พบสินค้า";
} else {
	include '../system.php';
	$class = new heehub;
	$delete = $class->deleteproduct($id);
	if ($delete) {
		$class->deletestockid($id);
		$class->delete_pdrecom($id);
	}
	echo $delete;
}

?>