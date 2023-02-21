<?php 

include '../system.php';
$class = new heehub;
$web_config = $class->web_fontend();
$web = $web_config->fetch();

$code = $_POST['link_gift'];
$phone = $web['phone'];

$voucher_h = explode("https://gift.truemoney.com/campaign/?v=", $code);


if (empty($_SESSION['username'])) {
	echo json_encode(array('status' =>'error', 'info' =>'กรุณาเข้าสู่ระบบก่อนดำเนินการ'));
} elseif (empty($voucher_h[1])) {
	echo json_encode(array('status' =>'error', 'info' =>'กรุณากรอกลิ้งอั่งเปาให้ถูกต้อง'));
} else {

	$topup = $class->redeem($phone,$voucher_h[1]);
	if ($topup['status'] == "success") {
		$class->add_history_topup($topup['amount_baht'],$topup['voucher_owner'],$phone);
		echo json_encode($topup);
	}else{
		echo json_encode($topup);
	}
}

?>