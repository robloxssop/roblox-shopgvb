<?php
$class = new heehub;
$cpd = $class->countstock();
$cs = $cpd->fetchColumn();
$q = $class->product();
$result = $q->fetchAll();
$showt = $class->countproduct();
$count = $showt->fetchColumn();

?>
<div class="container my-4">
	<div class="card bg-white text-dark pb-2" style="font-family: 'Kanit', sans-serif;">
		<div class="card-header">
			<h4 class="my-auto" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-shopping-cart"></i> จัดการสินค้า</h4>
		</div>
		<div class="m-2 d-flex border-bottom-2" style="font-family: 'Kanit', sans-serif;">
			<p class="pl-3 my-auto">จำนวนสินค้าทั้งหมด : <?php echo $count; ?> การ์ด</p>
			<div class="ml-auto mr-3">
				<a class="btn bg-dark" href="/backend/addproducts"><i class="fas fa-plus text-white text-white"></i></a>
			</div>
		</div>
		<div class="m-2 d-flex border-bottom-2">
			<p class="pl-3 my-auto">จำนวนสต๊อกทั้งหมด : <?php echo $cs; ?> ชิ้น</p>
			<div class="ml-auto mr-3">
				<a class="btn bg-dark" href="/backend/products/addstock"><i class="fad fa-cog text-white"></i></a>
			</div>
		</div>
	</div>
	<?php 

	foreach($result as $row){
		$product_img = $row['image'];
		if ($product_img == "") {
			$product_img = "/assete/img/noitem.jpg";
		} else {
			$product_img;
		}
		$st = $class->showstock($row['id']);
		$stock = $st->fetchColumn();
		?>
		<div class="card mt-4 bg-white text-dark">
			<div>
				<h4 class="float-right mr-3 mb-5"></h4>	
			</div>
			<div class="container" align="center">	
				<div class="d-grid-2">
					<div class="m-2 mt-4">
						<img src="<?=$product_img?>" class="img-rs" style="border-radius: 20px;height: 300px;width: 300px;">
					</div>
					<div class="mx-3" style="font-family: 'Kanit', sans-serif;">
						<h3 style="font-family: 'Kanit', sans-serif;">สินค้า ID : <?=$row['id']?></h3>
						<div class="text-left mt-5">
							<h3 style="font-family: 'Kanit', sans-serif;">ชื่อสินค้า : <?=$row['name']?></h3>
							<hr>
							<h5 style="font-family: 'Kanit', sans-serif;">รายละเอียด </h5>
							<p style="font-family: 'Kanit', sans-serif;" class="text-muted"><?=$row['detail']?></p>
							<hr>
							<h5 style="font-family: 'Kanit', sans-serif;">ราคา : <?=$row['price']?></h5>
							<h5 style="font-family: 'Kanit', sans-serif;">จำนวนสินค้า : <?=$stock?></h5>
							<hr>
							<h5 style="font-family: 'Kanit', sans-serif;">รูปแบบสินค้า : <?php if ($row['pattern'] == 'normaltext') {
								echo "· ข้อความธรรมดา · (เหมาะสำหรับการส่ง URL หรือข้อความต่างๆ)";
							} elseif ($row['pattern'] == 'code') {
								echo "· Gift Code / Redeem Code · (เหมาะสำหรับคีย์เกมทั่วๆไป)";
							} elseif ($row['pattern'] == 'eml:psw') {
								echo "· Email:Password · (เหมาะสำหรับ Account บนเว็บส่วนใหญ่)";
							} elseif ($row['pattern'] == 'usr:psw') {
								echo "· Username:Password · (เหมาะสำหรับ Platform เกมต่างๆเช่น Steam, Garena)";
							} elseif ($row['pattern'] == 'usr:eml:psw') {
								echo "· Username:Email:Password · (เหมาะสำหรับ ID Minecraft Migrate)";
							} elseif ($row['pattern'] == 'eml:psw:prf:pin') {
								echo "· Email:Password:Profile:Pin · (เหมาะสำหรับ Netflix)";
							} ?>
						</h5>
						<hr>
						<label style="font-family: 'Kanit', sans-serif;" class="text-danger m-0">* หากลบสินค้า สินค้าในสต๊อกจะถูกลบทั้งหมด</label>
					</div>
					<div class="btn-group w-100" role="group">
						<a href="/backend/products/edit/<?=$row['id']?>" type="button" class="btn btn-warning" onclick=""><i class="fad fa-cogs"></i></a>
						<button type="button" class="btn btn-danger" onclick="deleteproduct(<?=$row['id']?>)"><i class="fad fa-trash"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<button class="btn btn-success rounded-0 text-dark"><i class="fad fa-check-circle"></i> ดูสินค้าทั้งหมด...</button>	-->
	<?php 
}
?>
</div>