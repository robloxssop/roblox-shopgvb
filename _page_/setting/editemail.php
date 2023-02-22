<div class="text-left">
	<h5><i class="fad fa-at"></i> แก้ไขอีเมล</h5>
	<hr>
	<label>อีเมล</label>
	<input type="text" name="" placeholder="อีเมลที่ต้องการเปลี่ยน" class="form-control" id="email" value="<?=$session_user['email']?>"><br>	
	<label>รหัสผ่านยืนยัน</label>
	<input type="password" name="" placeholder="กรอกรหัสเพื่อยืนยันการแก้ไข" class="form-control" id="pass"><br>
	<div align="center">
		<button class="btn btn-warning w-75" onclick="editemail()"><i class="fad fa-edit"></i> ยืนยันการแก้ไข</button>
	</div>
</div>