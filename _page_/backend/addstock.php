<?php
$class = new heehub;
$stock = $class->selectstock();
$result = $stock->fetch();
$product = $class->product();
$resultpd = $product->fetchAll();
if (empty($stockid)) {
	$s_card = "d-none";
	$select = "selected";
	$select_ch = "";
	$cpd = $class->countstock();
	$ss = $cpd->fetchColumn();
} else {
	$select = "";
	$select_ch = "selected";
	$cpd = $class->countstockid($stockid);
	$ss = $cpd->fetchColumn();
}

?>
<div class="container " style="font-family: 'Kanit', sans-serif;">
	<div class="card-header bg-white mt-5 mb-2"><h4 style="font-family: 'Kanit', sans-serif;" class="my-2 text-dark"><i class="fad fa-box-open"></i> ลงสต๊อกสินค้า</h4></div>
	<div class="card bg-white text-dark mb-2">
		<div class="container my-2">
			<label>สินค้า</label>
			<select class="form-control" required="" onchange="location = this.value;">
				<?php foreach ($resultpd  as $rowp) { ?>
					<option value="/backend/products/addstock/<?=$rowp['id']?>" <?php if (empty($stockid)) { echo ""; } else { if ($rowp['id'] == $stockid) { echo $select_ch; }} ?>><?=$rowp['name']?></option>
				<?php } ?>
				<option value="/backend/products/addstock" <?=$select?>>...ดูทั้งหมด...</option> 
			</select><br>
			<div class="<?=$s_card?>">
				<div class="d-flex">
					<label>สต๊อก</label><p class="ml-auto text-muted"><span id="stock">0</span> ชิ้น</p>
				</div>
				<textarea id="inputItemData" placeholder="ลงสินค้าที่ต้องการจะส่งให้กับลูกค้า..." class="form-control" rows="5"></textarea>
				<label class="mt-2 text-danger">* เพิ่มสต๊อก หากปล่อยให้บรรทัดใดว่าง สินค้าในบรรทัดนั้นจะว่าง !!</label>
				<button class="btn btn-success btn-block" onclick="addstock(<?=$stockid?>)">เพิ่มสต๊อก</button>
			</div>
		</div>
	</div>
	<div class="card bg-white text-dark mb-5">
		<h4 class="m-4" style="font-family: 'Kanit', sans-serif;">สต๊อกที่ลง</h4>
		<div class="container mb-5" style="overflow-x: auto;height: 350px;">
			<table id="example" class="table text-dark text-center">
				<thead style="border-top: 2px solid gray;">
					<tr>
						<th>#</th><th>รายการ</th><th>ราคา</th><th>ข้อความ</th><th>ผู้ที่ซื้อ</th><th>วันที่ / เวลา</th><th>แก้ไข</th>
					</tr>
				</thead>
				<tbody>

					<?php if ($ss == 0) { ?>
						<tr>
							<td colspan="7"><h3 class="mb-0">ไม่มีสินค้าในสต๊อก</h3></td>
						</tr>
					<?php } ?>
					<?php 
					if (empty($stockid)) {
						$sestock = $class->selectstock();
						$restock = $sestock->fetchAll();
					}else{
						$sestock = $class->selectstockid($stockid);
						$restock = $sestock->fetchAll();
					}

					foreach ($restock as $row) {

						if ($row['owner'] == NULL) {
							$product_owner = "<span style='color:Gray;'>ยังไม่มีคนซื้อ</span>";
							$product_date = "<span style='color:Gray;'>ยังไม่มีคนซื้อ</span>";
						} else {
							$product_owner = $row['owner'];
							$product_date = $row['date'];
						}

						$qProductMeta = $class->dsdsd($row['type']);
						$resultProductMeta = $qProductMeta->fetchAll();
						foreach($resultProductMeta as $data)
						{
							$product_name = $data['name'];
							$product_price = $data['price'] . " บาท";
						}
						?>

						<tr>
							<td><?=$row['id']?></td><td><?=$product_name?></td><td><?=$product_price?></td><td style="text-align:left;"> <?=$row['contents']?> </td><td><?=$product_owner?></td><td><?=$product_date?></td><td class="p-2"><a class="btn btn-sm btn-block btn-danger" href="/backend/products/editstock/<?=$row['id']?>">Edit/Delete</a></td>
						</tr>
						<?php
					} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var items = $('#stock');
		$('#inputItemData').keydown(function(e) {
			newLines = $(this).val().split("\n").length;
			items.text(newLines);
		});
	});
</script>