<div class="text-left">
	<h5><i class="fas fa-user-circle"></i> ข้อมูลผู้ใช้</h5>
	<hr>
	<div class="d-grid-2">
		<div class="w-100">
			<label>ชื่อผู้ใช้</label>
			<input type="text" name="" class="form-control w-75" placeholder="<?=$session_user['username']?>" disabled>
			<label>อีเมล</label>
			<input type="text" name="" class="form-control w-75" placeholder="<?=$session_user['email']?>" disabled><br>
		</div>
		<div class="w-100">
			<label>พ้อยผู้ใช้</label>
			<h5>จำนวนพ้อย : <?=$session_user['point']?> บาท</h5><br>
			<label>สถานะผู้ใช้</label>
			<h5>สถานะ : <?=$session_user['status']?></h5>
		</div>
	</div>
</div>