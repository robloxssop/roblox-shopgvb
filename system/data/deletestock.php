<?php 

include '../system.php';
$class = new heehub;
$dl = $class->deletestock($_POST['id']);
echo $dl;
?>