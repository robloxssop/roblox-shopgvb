<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>

	<?php
	include 'header.php'; 
	include 'system/config.php'; 
	$class = new heehub;
	$web_config = $class->web_fontend();
	$web = $web_config->fetch();
	$ses_user = $class->session_user();
	$session_user = $ses_user->fetch();
	if ($session_user['status'] == 'gnr') {
		$session_user['status'] = "ผู้ใช้ทั่วไป";
	}else{
		$session_user['status'] = "ผู้ดูแลระบบ";
	}
	?>
	<link href="<?=$web['icon']?>" rel="icon">
	<!-- icon -->
	<style type="text/css">
		body { padding-right: 0 !important }
	</style>
</head>
<body background="/assets/img/background.gif">
	<div>
		<?php include 'nav.php'; ?>
