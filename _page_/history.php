<?php 
$class = new heehub;
$stock = $class->myshop();
$result = $stock->fetchAll();
$num = $class->countmyproduct();
$numpd = $num->fetchColumn();
?>
<div class="container">
	<div class="card bg-white text-dark" style="margin-top: 150px;">	
		<h4 class="text-dark mt-2 ml-4"><i class="fad fa-shopping-cart"></i> ประวัติการซื้อ</h4>
		<hr class="text-dark mx-4 mt-1">
		<p class="text-dark m-0 text-right mr-5">จำนวนการซื้อทั้งหมด : <?=$numpd?> รายการ</p>
		<div class="table-responsive px-5">
			<table id="example" class="table text-dark text-center">
				<thead style="border-top: 2px solid #fff;">
					<tr>
						<th>#</th><th>รายการ</th><th>ราคา</th><th>ข้อความ</th><th>เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($numpd == 0) { ?>
					<td colspan="5">
						<h5 class="m-0">ไม่มีประวัติการซื้อสินค้า</h5>
					</td>
				<?php } else {
					foreach ($result as $row) {
						$qProductMeta = $class->dsdsd($row['type']);
						$resultProductMeta = $qProductMeta->fetchAll();
						foreach($resultProductMeta as $data)
						{
							$product_id = $data['id'];
							$product_name = $data['name'];
							$product_price = $data['price'] . " บาท";
						}
						?>
						<tr>
							<td><?=$row['id']?></td><td><?=$product_name?></td><td><?=$product_price?></td><td style="text-align:left;"> <?=$row['contents']?> </td><td><?=$row['date']?></td>
						</tr>
						<?php
					} 
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>