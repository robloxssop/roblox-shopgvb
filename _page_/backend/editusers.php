<?php 	
$class = new heehub;
$dsd = $class->editselectuser($userid);
$row = $dsd->fetch();
if ($row['id'] == '') {
	header( "location: /backend" );
}else {
?>

<div class="container text-dark">
	<div class="card bg-white">
		<div class="container" style="font-family: 'Kanit', sans-serif;">
			<div class="p-5" align="center">
				<h3 style="font-family: 'Kanit', sans-serif;">แก้ไข ID : <?=$userid?></h3>
				<hr>
			</div>
			<div class="">
				<div style="font-family: 'Kanit', sans-serif;">
					<div class="form-group">
						<label>ชื่อ</label>
						<input type="text" value="<?=$row['username']?>" class="form-control" placeholder="กรอกชื่อผู้ใช้..." id="username" required="" autofocus="">
					</div>
					<div class="form-group">
						<label>อีเมล</label>
						<input type="text" value="<?=$row['email']?>" id="email" class="form-control" placeholder="กรอกอีเมล..." required="">
					</div>
					<div class="form-group">
						<label>พ้อย</label>
						<input type="number" min="1" value="<?=$row['point']?>" id="point" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>สถานะ</label>
						<select class="form-control" id="status" required="">
							<option value="none" disabled="">โปรดเลือกสถานะ</option>
							<option value="admin" <?php if ($row['status'] == "admin") {echo "selected";} ?> >แอดมิน</option>
							<option value="gnr" <?php if ($row['status'] == "gnr") {echo "selected";} ?> >ผู้ใช้ธรรมดา</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="d-flex w-100" style="font-family: 'Kanit', sans-serif;">
			<button type="button" class="btn btn-success w-100" onclick="saveedituser(<?=$row['id']?>)"><i class="fas fa-check-circle"></i> บันทึก</button>
			<button type="button" class="btn btn-danger w-100" onclick="deleteuser(<?=$row['id']?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
		</div>
	</div>
</div>
<?php } ?>
