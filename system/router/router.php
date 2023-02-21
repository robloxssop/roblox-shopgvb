<?php 
include 'system/vendor/altorouter/altorouter/AltoRouter.php';

function loadpage($page,$title){
	include 'body/html.php';
	include '_page_/'.$page.'.php';
	include 'body/endhtml.php';
}

function backend($page,$title){
	include '_page_/backend.php';
	include '_page_/backend/'.$page.'.php';
	include 'body/endhtml.php';
}

$router = new AltoRouter();

if (empty($_SESSION['username'])) {
	$router->map( 'GET', '/', function() {
		loadpage("home","หน้าแรก");
	});
	$router->map( 'GET', '/home', function() {
		loadpage("home","หน้าแรก");
	});
	$router->map( 'GET', '/login', function() {
		loadpage("login","เข้าสู่ระบบ");
	});
	$router->map( 'GET', '/register', function() {
		loadpage("register","สมัครสมาชิก");
	});
}else{
	$router->map( 'GET', '/', function() {
		loadpage("home","หน้าแรก");
	});
	$router->map( 'GET', '/home', function() {
		loadpage("home","หน้าแรก");
	});
	$router->map( 'GET', '/history', function() {
		loadpage("history","ประวัติการทำรายการ");
	});
	$router->map( 'GET', '/profire', function() {
		loadpage("profire","แก้ไขข้อมูลส่วนตัว");
	});
	$router->map( 'GET', '/shop', function() {
		loadpage("shop","สินค้าที่ขาย");
	});
	$router->map( 'GET', '/topup', function() {
		loadpage("topup","รายการเติมเงิน");
	});
	$router->map( 'GET', '/backend', function() {
		if ($_SESSION['status'] == "admin") {
			backend("main","แดรชบอร์ด");
		}
	});
	$router->map( 'GET', '/backend/dashboard', function() {
		if ($_SESSION['status'] == "admin") {
			backend("main","แดรชบอร์ด");
		}
	});
	$router->map( 'GET', '/backend/users', function() {
		if ($_SESSION['status'] == "admin") {
			backend("users","ผู้ใช้ทั้งหมด");
		}
	});
	$router->map( 'GET', '/backend/users/edit/[i:id]', function($id) {
		if ($_SESSION['status'] == "admin") {
			$title = "แก้ไขผู้ใช้ที่ : $id";
			include '_page_/backend.php';
			$userid = $id;
			include '_page_/backend/editusers.php';
			include 'body/endhtml.php';
		}
	});
	$router->map( 'GET', '/backend/products', function() {
		if ($_SESSION['status'] == "admin") {
			backend("products","สินค้าทั้งหมด");
		}
	});
	$router->map( 'GET', '/backend/addproducts', function() {
		if ($_SESSION['status'] == "admin") {	
			backend("addproducts","สินค้าทั้งหมด");
		}
	});
	$router->map( 'GET', '/backend/products/edit/[i:id]', function($id) {
		if ($_SESSION['status'] == "admin") {
			$title = "แก้ไขสินค้าที่ : $id";
			include '_page_/backend.php';
			$prodid = $id;
			include '_page_/backend/editproducts.php';
			include 'body/endhtml.php';
		}
	});
	$router->map( 'GET', '/backend/products/addstock', function() {
		if ($_SESSION['status'] == "admin") {
			backend("addstock","เพิ่มสต๊อกที่ : *");
		}
	});
	$router->map( 'GET', '/backend/products/addstock/[i:id]', function($id) {
		if ($_SESSION['status'] == "admin") {
			$title = "เพิ่มสต๊อกที่ : $id";
			include '_page_/backend.php';
			$stockid = $id;
			include '_page_/backend/addstock.php';
			include 'body/endhtml.php';
		}
	});

	$router->map( 'GET', '/backend/products/editstock/[i:id]', function($id) {
		if ($_SESSION['status'] == "admin") {
			$title = "แก้ไขสต๊อกที่ : $id";
			include '_page_/backend.php';
			$stockid = $id;
			include '_page_/backend/editstock.php';
			include 'body/endhtml.php';
		}
	});
	$router->map( 'GET', '/backend/editfontend', function() {
		if ($_SESSION['status'] == "admin") {
			backend("editfontend","แก้ไขหน้าบ้าน");
		}
	});
}


$match = $router->match();
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	header( "location: /" );
}
?>