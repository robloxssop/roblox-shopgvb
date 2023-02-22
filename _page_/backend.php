<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>

	<?php
	include 'body/header.php'; 
	
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
	<style type="text/css">
		body { padding-right: 0 !important }
	</style>
</head>
<body>
	<nav class="navbar navbar-expand navbar-dark fixed-top" style="background-color: white; font-family: 'Kanit', sans-serif;">
		<div class="container mx-auto">
			<ul class="navbar-nav d-none d-md-flex">
				<li class="nav-item">
					<a class="c-nav px-2" href="/backend/dashboard"><i class="fad fa-tachometer-slow"></i>  แดรชบอร์ด</a>
				</li>
				<li class="nav-item">
					<a class="c-nav px-2" href="/backend/editfontend"><i class="fad fa-edit"></i> แก้ไข UI</a>
				</li>
				<li class="nav-item">
					<a class="c-nav px-2" href="/backend/users"><i class="fad fa-user-edit"></i>  จัดการผู้ใช้</a>
				</li>
				<li class="nav-item">
					<a class="c-nav px-2" href="/backend/products"><i class="fad fa-cart-arrow-down"></i> จัดการสินค้า</a>
				</li>
			</ul>
			<ul class="d-block d-md-none mb-0 bg-white">
				<a href="javascript:void(0);" class="icon-res text-dark" onclick="navRes()">
					<i class="text-dark fa fa-bars res-i"></i>
				</a>
			</ul>
			<div class="float-right">
				<a class="btn btn-danger btn-round m-0 px-2 py-1" href="../home" style="border-radius: 15px;font-size: 12px;">ออกจากหลังบ้าน <i class="fad fa-sign-out-alt"></i></a>
			</div>
		</div>
	</div>
</nav>
<div class="fixed-top bg-white" id="manu-nav" style="list-style-type: none; font-family: 'Kanit', sans-serif;" >
	<li class="nav-item py-3">
		<a class="c-nav px-2" href="/backend/dashboard"><i class="fad fa-tachometer-slow"></i> แดรชบอร์ด</a>
	</li>
	<li class="nav-item py-3">
		<a class="c-nav px-2"href="/backend/editfontend"><i class="fad fa-edit"></i> แก้ไข UI</a>
	</li>
	<li class="nav-item py-3">
		<a class="c-nav px-2"  href="/backend/users"><i class="fad fa-user-edit"></i> จัดการผู้ใช้</a>
	</li>
	<li class="nav-item py-3">
		<a class="c-nav px-2" href="/backend/products"><i class="fad fa-cart-arrow-down"></i> จัดการสินค้า</a>
	</li>
</div>
<div style="margin-top: 100px;">