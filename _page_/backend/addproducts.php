
<div class="container mt-5 text-light">
	<div class="card my-3 bg-white text-dark" style="font-family: 'Kanit', sans-serif;">
		<div class="card-header">
			<h2 class="m-0" align="center" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-cart-plus"></i> เพิ่มสินค้า</h2>
		</div>
		<div class="card-body container" style="overflow-x: auto;">
			<div class="d-grid-2-rs">
				<div class="my-auto" align="center">
					<img class="img-rs " id="img-addpd" style="border-radius: 20px;height: 300px;width: 300px;">			
				</div>
				<div class="mx-3">
					<div class="text-left my-2">					
						<label>ชื่อสินค้า</label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">ชื่อสินค้า</div>
							</div>
							<input type="text" class="form-control" id="name" placeholder="Name">
						</div>
						<label>รายละเอียด</label>
						<textarea type="text" class="form-control" placeholder="Detail" rows="5" required="" id="myTextarea"></textarea>
						<label class="w-100">ราคา</label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">ราคา</div>
							</div>
							<input type="number" min="1" class="form-control" id="price" placeholder="Price">
						</div>							
						<div class="input-group mb-2">
							<label class="w-100">รูปแบบสินค้า</label>
							<select class="form-control" id="pattern" required="">
								<option selected="">เลือกรูปแบบที่ต้องการส่ง</option>
								<option value="normaltext">· ข้อความธรรมดา · (เหมาะสำหรับการส่ง URL หรือข้อความต่างๆ)</option>
								<option value="code">· Gift Code / Redeem Code · (เหมาะสำหรับคีย์เกมทั่วๆไป)</option>
								<option value="eml:psw">· Email:Password · (เหมาะสำหรับ Account บนเว็บส่วนใหญ่)</option>
								<option value="usr:psw">· Username:Password · (เหมาะสำหรับ Platform เกมต่างๆเช่น Steam, Garena)</option>
								<option value="usr:eml:psw">· Username:Email:Password · (เหมาะสำหรับ ID Minecraft Migrate)</option>
								<option value="eml:psw:prf:pin">· Email:Password:Profile:Pin · (เหมาะสำหรับ Netflix)</option>
							</select>
						</div>
						<div class="input-group mb-2">
							<label class="w-100">รูปสินค้า</label>
							<div class="d-flex w-100">
								<input type="text" placeholder="Image" class="form-control w-75" id="pdimg" style="border-radius: 4px 0px 0px 4px;">
								<button class="btn btn-light m-0" style="border-radius: 0px;" onclick="checkimgpd()">เช็ครูปภาพ</button>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<hr>
			<div align="center">
				<button type="button" class="btn btn-success w-50" onclick="addproduct()"><i class="fad fa-plus-circle"></i> เพิ่มสินค้า</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function checkimgpd() {
		var img = $('#pdimg').val();

		document.getElementById('img-addpd').src = img;

	}
</script>