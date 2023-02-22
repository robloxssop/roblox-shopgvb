<div class="text-left">
	<h5><i class="fad fa-users-cog"></i> แก้ไขชื่อผู้ใช้</h5>
	<hr>
	<label>ชื่อผู้ใช้</label>
	<input type="text" name="" placeholder="ชื่อผู้ใช้ที่ต้องการเปลี่ยน" class="form-control" id="user" value="<?=$session_user['username']?>"><br>	
	<label>รหัสผ่านยืนยัน</label>
	<input type="password" name="" placeholder="กรอกรหัสเพื่อยืนยันการแก้ไข" class="form-control" id="cfpass"><br>
	<div align="center">
		<button class="btn btn-warning w-75" onclick="editusername()"><i class="fad fa-edit"></i> ยืนยันการแก้ไข</button>
	</div>
</div>