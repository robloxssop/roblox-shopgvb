<?php

if ($_POST['pdrecom'] == "0") {
	echo "คุณยังไม่ได้เลือกสินค้า";
}else{

include '../system.php';
$class = new heehub;
$add = $class->addpdrecom($_POST['pdrecom']);
echo $add;

}
?>