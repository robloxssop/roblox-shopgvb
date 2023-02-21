<?php 

$id = $_POST['id'];


if (empty($_POST['content'])) { 
	echo "กรุณากรอกสินค้าที่จะลง";
} else {
	include '../system.php';
	$class = new heehub;
	$edit = $class->editstock($id,$_POST['content']);
	echo $edit;
}

 ?>