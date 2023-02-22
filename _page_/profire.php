<?php 
$class = new heehub;
$ses_user = $class->session_user();
$session_user = $ses_user->fetch();
if ($session_user['status'] == 'gnr') {
	$session_user['status'] = "ผู้ใช้ทั่วไป";
}else{
	$session_user['status'] = "ผู้ดูแลระบบ";
}
?>
<div class="container text-dark" style="margin-top: 150px; font-family: 'Kanit', sans-serif;">
	<div class="card bg-white text-center w-75 mx-auto pb-5 px-3">
		<h2 class="mt-2">แก้ไขข้อมูลส่วนตัว <i class="fad fa-users-cog"></i></h2>
		<hr class="mt-0">
		<div class="d-grid-2">
			<div class="w-100">
				<div style="border-right: 2px solid #E9ECEF;border-left: 2px solid #E9ECEF;">
				<hr class="mt-0">
				<a class="text-dark" href="../profire">ข้อมูลผู้ใช้ <i class="fas fa-user-circle"></i></a>
				<hr>
			 	<a class="text-dark" href="?setting=editusername">แก้ไขชื่อผู้ใช้ <i class="fad fa-users-cog"></i></a>
				<hr>
				<a class="text-dark" href="?setting=editemail">แก้ไขอีเมล <i class="fad fa-at"></i></a>
				<hr>
				<a class="text-dark" href="?setting=editpassword">แก้ไขรหัสผ่าน <i class="fad fa-unlock"></i></a>
				<hr class="mb-0">
			</div>
			</div>
			<div class="container w-100 mt-4 mt-md-0">
				<?php

				if (empty($_GET['setting'])) { 
					include 'setting/main.php';
				}else{
					$set = $_GET['setting'];
					if ($set == 'main') {
						include 'setting/main.php';
					} elseif ($set == 'editusername') {
						include 'setting/editusername.php';
					} elseif ($set == 'editemail') {
						include 'setting/editemail.php';
					} elseif ($set == 'editpassword') {
						include 'setting/editpassword.php';
					} else{
						header( "location: ../profire" );
					}
				}

				?>
			</div>
		</div>
	</div>
</div>