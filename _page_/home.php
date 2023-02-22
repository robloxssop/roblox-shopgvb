<?php $class = new heehub; ?>
<div class="container-fluid" style="font-family: 'Kanit', sans-serif;">
	<div class="container">
		<span class="bg-top-home "></span>
		<div class="container" style="margin-top: 200px;">
			<div class="text-dark" data-aos="fade-right">
				<i class="fad fa-acorn" style="font-size: 60px;" data-aos="flip-right" data-aos-delay="500" data-aos-duration="900"></i>
				<span class="text-grey" data-aos="fade-up" data-aos-delay="900" data-aos-duration="900" style="font-size: 50px;font-weight: 700;"> &nbsp;<?= $web['name'] ?></span>
				<div class="progress-wrapper" style="width: 50%;">
					<div class="progress-info">
						<div class="progress-label">
							<span>Task completed</span>
						</div>
						<div class="progress-percentage">
							<span>60%</span>
						</div>
					</div>
					<div class="progress">
						<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
					</div>
				</div>
				<p class="w-40-rp"><?= $web['promote'] ?></p>
			</div>
		</div>
	</div>
</div>
<div class="support mt-5 text-dark text-center bg-white">
	<div class="container text-dark bg-white text-center p-5" style="margin-top: 30%; font-family: 'Kanit', sans-serif;">
		<h1 style="	font-family: 'Kanit', sans-serif; font-weight:900;">FEATURES</h1>
		<p>ฟังก์ชั่นของพวกเรา (เป็นแค่ส่วนนึง)</p>
		<div class="d-grid ">
			<?php
			$fun = $class->funt();
			$funct = $fun->fetchAll();

			foreach ($funct as $rowf) {
			?>
				<div class="card p-2" style="box-shadow: none; border:none;">
					<div style="font-size: 60px;"><?= $rowf['icon'] ?></div>
					<h5 style="font-weight: 500;"><?= $rowf['head'] ?></h5>
					<p><?= $rowf['detail'] ?></p>
				</div>
			<?php } ?>
		</div>
	</div>
	<hr>
	<div class="container py-5" style="	font-family: 'Kanit', sans-serif;">
		<h1 style="	font-family: 'Kanit', sans-serif; font-weight:900;">RECOMMENDED PRODUCTS <span class="text-success" style="font-size: 15px;">(5 ที่ดีที่สุด)</span></h1>
		<?php

		$pdref = $class->pdrecom();
		$recof = $pdref->fetch();
		$pdre = $class->pdrecom();
		$reco = $pdre->fetchAll();
		if (empty($recof['id'])) { ?>
			<h1 class="text-center mt-5">ไม่มีสินค้าแนะนำ</h1>
		<?php } ?>

		<div class="d-grid-5 mt-5">

			<?php
			foreach ($reco  as $rowF) {

				$sp = $class->selectproduct($rowF['no_product']);
				$seproduct = $sp->fetchAll();
				foreach ($seproduct as $rowse) {
			?>
					<style type="text/css">
						.hov:hover {
							transform: scale(1.04);
						}
					</style>
					<a class="mx-auto hov" align="center" data-toggle="modal" data-target="#modal-shop-<?= $rowse['id'] ?>" style="">
						<div align="center">
							<img src="<?= $rowse['image'] ?>" style="height: 200px;width: 200px;border-radius: 10px;">
							<h5 class="text-center text-grey mt-2"><?= $rowse['name'] ?></h5>
						</div>
					</a>
			<?php
				}
			}
			?>
		</div>
	</div>
	<hr>
	<div class="m-5 text-center text-dark bg-white">

		<h1 style="	font-family: 'Kanit', sans-serif; font-weight:900;">FAQ ?</h1>
		<?php
		$q_a = $class->qa();
		$qa = $q_a->fetchAll();

		?>
		<div class="d-grid text-left mt-4">
			<?php foreach ($qa as $rowqa) { ?>
				<div align="center">
					<h4>Q : <?= $rowqa['q'] ?></h4>
					<p style="font-family: 'Prompt', sans-serif;font-weight: 400px;padding-left: 10px;">A : <?= $rowqa['a'] ?></p>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<br><br>


<?php
$class = new heehub;
$q = $class->product();
$result = $q->fetchAll();

foreach ($result as $row) {
	$product_id = $row['id'];
	$product_name = $row['name'];
	$product_img = $row['image'];
	$product_price = $row['price'];
	$product_detail = $row['detail'];
	$stock_price = $product_price . " ฿";
	$showt = $class->showstock($product_id);
	$result = $showt->fetchColumn();
	if ($result > 0) {
		$stock_text = "<p class='ml-auto'>" . $result . " ชิ้น</p>";
	} else {
		$stock_text = "<p class='ml-auto text-danger'>ไม่มีสินค้าในสต็อค</p>";
	}
	if ($product_img == "") {
		$product_img = "/assete/img/noitem.jpg";
	} else {
		$product_img;
	}

?>

	<!-- modal shop -->
	<div class="modal fade" id="modal-shop-<?= $product_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-white text-dark">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-shopping-basket"></i> ชื่อสินค้า | • <?= $product_name ?> •</h5>
					<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-danger text-center">
						**โปรดอ่านและถ้าซื้อคือยอมรับข้อตกลง**
					</p>
					<p style="font-weight: 700;">ราคา <?= $stock_price ?></p>
					<div class="img-shop" align="center"><img src="<?= $product_img ?>" height="250" style="width:60%;border-radius: 10px;"></div>
					<p class="mt-4">รายละเอียด <br>
						<span class="pl-4">
							<?= $product_detail ?>
						</span>
					</p>
					<p><?= $stock_text ?></p>
				</div>
				<hr class="mt-0">
				<div align="center">
					<button type="button" class="btn btn-success" onclick="buyproduct(<?= $product_id ?>)"><i class="fas fa-arrow-right"></i> สั่งซื้อสินค้า</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end modalshop -->



<?php } ?>