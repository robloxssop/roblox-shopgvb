<div class="container text-dark" style="margin-top: 100px; font-family: 'Kanit', sans-serif;">
	<h1 class="text-right">สินค้า ที่ขายทั้งหมด</h1>
	<hr>
	<div class="row">
		<?php 
		$class = new heehub;
		$qi = $class->sum_product();
		$check_p = $qi->fetchColumn();
		if ($check_p == 0) { ?>
			<div class="mt-5" align="center">
				<h1>ตอนนี้ยังไม่มีสินค้าค่ะ</h1>
				<a  href="/home" class="w3-button w3-amber" >กลับสู่หน้าหลัก</a>
			</div>
		<?php } ?>
		<div class="d-grid">
			<?php 
			
			$q = $class->product();
			$result = $q->fetchAll();

			foreach($result as $row) {
				$product_id = $row['id'];
				$product_name = $row['name'];
				$product_img = $row['image'];
				$product_price = $row['price'];
				$product_detail = $row['detail'];
				$stock_price = $product_price ." ฿";
				$showt = $class->showstock($product_id);
				$result = $showt->fetchColumn();
				if ($result > 0) {
					$stock_text = "<p class='ml-auto'>".$result." ชิ้น</p>";
				}else{
					$stock_text ="<p class='ml-auto text-danger'>ไม่มีสินค้าในสต็อค</p>";
				}
				if ($product_img == "") {
					$product_img = "/assete/img/noitem.jpg";
				} else {
					$product_img;
				}

				echo <<<EOD

				<a class="mx-auto card-shop bg-white text-dark" align="center" data-toggle="modal" data-target="#modal-shop-$product_id">
				<div class="img-shop">
				<img src="$product_img" height="250" style="border-radius: 5px 5px 0px 0px;">
				</div>
				<div class="">
				<h4 class="mt-2">$product_name</h4>
				<hr class="mx-5">
				<p class="ff">$stock_price</p>
				</div>
				</a>
				<!-- modal shop -->
				<div class="modal fade" id="modal-shop-$product_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content bg-white text-dark">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-shopping-basket"></i> ชื่อสินค้า | • $product_name •</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<p class="text-danger text-center">
				**โปรดอ่านและถ้าซื้อคือยอมรับข้อตกลง**
				</p>
				<p style="font-weight: 700;">ราคา $stock_price</p>
				<hr>
				<div class="img-shop" align="center"><img src="$product_img" height="250" style="width:60%;border-radius: 10px;"></div>
				<p class="mt-4 ">รายละเอียด <br>
				<span class="pl-4">
				$product_detail
				</span>
				</p>
				<p>$stock_text</p>
				</div>
				<hr class="mt-0">
				<div align="center">
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="buyproduct($product_id)"><i class="fas fa-arrow-right"></i> สั่งซื้อสินค้า</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
				</div>
				</div>
				</div>
				</div>
				<!-- end modalshop -->

EOD;
			}
			?>
		</div>
	</div>
</div>
