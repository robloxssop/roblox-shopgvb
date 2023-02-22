<?php 
$class = new heehub;
$user = $class->countuser();
$users = $user->fetchColumn();
$useradd = $users + 1;
?>
<div class="container text-dark mt-5" id="addusers" style="font-family: 'Kanit', sans-serif;">
	<div class="card bg-white w-75 mx-auto">	
		<div class="card-header" >	
			<h4 class="mb-0" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-user-plus"></i> เพิ่มผู้ใช้ที่ : <?=$useradd?></h4>
		</div>
		<div class="card-body">
			<div class="container text-left mx-auto">
				<label class="mt-2"><i class="fad fa-user-tag"></i> ชื่อผู้ใช้</label>
				<input type="text" id="txt_username" placeholder="Username ..." class="form-control">
				<label class="mt-2"><i class="fad fa-at"></i> อีเมล</label>
				<input type="text" id="txt_email" placeholder="Email ..." class="form-control">
				<label class="mt-2"><i class="fad fa-unlock-alt"></i> รหัสผ่าน</label>
				<input type="password" id="txt_password" placeholder="Password ..." class="form-control">
				<div class="px-lg-4" align="center">
					<button class="btn btn-success w-100 m-0 mt-4 p-2" id="register" onclick="addusers()">เพิ่มผู้ใช้ <i class="fad fa-user-plus"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="card bg-white w-75 mx-auto mt-5" id="users">
		<div class="card-header">
			<h4 style="font-family: 'Kanit', sans-serif;"><i class="fad fa-users"></i> ผู้ใช้ทั้งหมด : <?=$users?></h4>
		</div>
		<div class="card-body">
			<div style="overflow-x: auto;">
				<table id="stock" class="table display text-dark" style="width: 100%;">
					<thead style="border-top: 2px solid #fff;">
						<tr align="center" >
							<th scope="col">#</th>
							<th scope="col">ชื่อผู้ใช้</th>
							<th scope="col">อีเมล</th>
							<th scope="col">พ้อย</th>
							<th scope="col">สถานะ</th>
							<th scope="col">แก้ไข</th>
						</tr>
					</thead>
					<tbody>					
						<?php 
						$dsd = $class->selectuser();
						$result = $dsd->fetchAll();
						foreach($result as $row){
							if($row['status'] == "admin"){
								$rank = "แอดมิน";
							}elseif($row['status'] == "gnr"){
								$rank = "ผู้ใช้ธรรมดา";
							}
							?>
							<tr class="text-center"><th scope="row"><?=$row['id']?></th><td><?=$row['username']?></td><td><?=$row['email']?></td><td><?=$row['point']?></td><td><?=$rank?></td><td class="p-0 pt-2"><a class="btn btn-sm btn-block btn-danger" href="/backend/users/edit/<?=$row['id']?>">Edit/Delete</a></td></tr> 
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>