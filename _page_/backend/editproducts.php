<?php 

$class = new heehub;
$se = $class->selectproduct($prodid);
$row = $se->fetch();

if ($row['id'] == '') {
	header( "location: /backend");
} else {

$st = $class->showstock($row['id']);
$stock = $st->fetchColumn();

$product_img = $row['image'];

if ($product_img == "") {
	$product_img = "/assete/img/noitem.jpg";
} else {
	$product_img;
}

function select($value,$prodid){
	$class1 = new heehub;
	$se = $class1->selectproduct($prodid);
	$row = $se->fetch();

	if ($row['pattern'] == $value) {
		echo "selected";
	} else {
		echo "";
	}
}

?>
<div class="container">
	<div class="card my-3 bg-white text-dark" style="font-family: 'Kanit', sans-serif;">
		<div class="card-header" >
			<h2 style="font-family: 'Kanit', sans-serif;" class="m-0" align="center">แก้ไขสินค้า ID : <?=$row['id']?></h2>
		</div>
		<div class="card-body container" style="overflow-x: auto;">
			<div class="d-grid-2-rs">
				<div class="my-auto" align="center">
					<img src="<?=$product_img?>" class="img-rs" style="border-radius: 20px;height: 300px;width: 300px;">				
				</div>
				<div class="mx-3">
					<div class="text-left my-2">					
						<label>ชื่อสินค้า</label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">ชื่อสินค้า</div>
							</div>
							<input type="text" class="form-control" value="<?=$row['name']?>" id="name" placeholder="Name">
						</div>
						<label>รายละเอียด</label>
						<textarea type="text" class="form-control" placeholder="" rows="5" required="" id="myTextarea"><?=$row['detail']?></textarea>
						<div class="d-grid-575 mt-4">
							<div class="input-group mb-2 pr-0 pr-sm-2">
								<label class="w-100">ราคา</label>
								<div class="input-group-prepend">
									<div class="input-group-text">ราคา</div>
								</div>
								<input type="number" min="1" class="form-control" value="<?=$row['price']?>" id="price">
							</div>
							<div class="input-group mb-2">
								<label class="w-100">จำนวนสินค้าา</label>
								<div class="input-group-prepend">
									<div class="input-group-text">จำนวนสินค้า</div>
								</div>
								<input type="number" class="form-control p-2 rounded-0 pr-0" value="<?=$stock?>" disabled>
								<a class="btn btn-dark w-25 m-0 rounded-0" href="/backend/products/addstock/<?=$prodid?>"><i class="fad fa-cogs text-white"></i></a>
							</div>
						</div>
						<div class="input-group mb-2">
							<label class="w-100">รูปแบบสินค้า</label>
							<select class="form-control" id="pattern" required="">
								<option value="normaltext" <?php select('normaltext',$prodid) ?>>· ข้อความธรรมดา · (เหมาะสำหรับการส่ง URL หรือข้อความต่างๆ)</option>
								<option value="code" <?php select('code',$prodid) ?>>· Gift Code / Redeem Code · (เหมาะสำหรับคีย์เกมทั่วๆไป)</option>
								<option value="eml:psw" <?php select('eml:psw',$prodid) ?>>· Email:Password · (เหมาะสำหรับ Account บนเว็บส่วนใหญ่)</option>
								<option value="usr:psw" <?php select('usr:psw',$prodid) ?>>· Username:Password · (เหมาะสำหรับ Platform เกมต่างๆเช่น Steam, Garena)</option>
								<option value="usr:eml:psw" <?php select('usr:eml:psw',$prodid) ?>>· Username:Email:Password · (เหมาะสำหรับ ID Minecraft Migrate)</option>
								<option value="eml:psw:prf:pin" <?php select('eml:psw:prf:pin',$prodid) ?>>· Email:Password:Profile:Pin · (เหมาะสำหรับ Netflix)</option>
							</select>
						</div>
						<div class="input-group mb-2">
							<label class="w-100">รูปสินค้า</label>
							<input type="text" name="" placeholder="" value="<?=$product_img?>" class="form-control" id="pdimg">
						</div>
					</div>	
				</div>
			</div>
			<hr>
			<div align="center">
				<button type="button" class="btn btn-success w-50" onclick="con_editpd(<?=$row['id']?>)">ยืนยันการเปลี่ยนแปลง</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>