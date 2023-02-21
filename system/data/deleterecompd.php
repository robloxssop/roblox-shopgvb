<?php 

include '../system.php';
$class = new heehub;
$delete = $class->delete_pdrecom($_POST['id']);
if ($delete) {
	echo "success";
}

?>