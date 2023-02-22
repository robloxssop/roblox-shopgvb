<?php 


$class = new heehub;
$counter = $class->counter();

$dsd = $class->sum_history_topup();
$sumt = $dsd->fetchColumn();
$users = $class->sum_users();
$sumu = $users->fetchColumn();
$product = $class->sum_product();
$sumpd = $product->fetchColumn();
$his = $class->history_topup();
$hist = $his->fetchAll();
$numhis = $class->history_topup();
$numhist = $numhis->fetch();
$hisshop =  $class->history_shop();
$shophis = $hisshop->fetchColumn();


if ($sumt == "") {
	$sumt = "0";
}else{
	$sumt;
}

if ($sumu == "") {
	$sumu = "0";
}else{
	$sumu;
}

if ($sumpd == "") {
	$sumpd = "0";
}else{
	$sumpd;
}

?>

<div class="container mt-5 text-dark" style="font-family: 'Kanit', sans-serif;">
	<div class="d-grid-4">
		<div class="card bg-white" style="font-family: 'Kanit', sans-serif;">
			<div class="card-header"></div>
			<h4 class="mt-3" align="center" style="font-family: 'Kanit', sans-serif; font-weight: 600;"><i class="text-success fad fa-chart-line"></i> ผู้เข้าชมวันนี้</h4>
			<div class="px-2 text-center">
				
				<h1 style="font-family: 'Kanit', sans-serif;"><?=$counter['today']?> คน </h1>
			</div>
			<a data-toggle="modal" data-target="#counter" class="text-dark">
				<div class="card-footer p-0 text-center text-grey">
					<p class="m-0 text-success">แสดงทั้งหมด <i class="fad fa-caret-circle-down"></i></p>
				</div>
			</a>
		</div>
		<div class="card bg-white">
			<div class="card-header"></div>
			<h4 class="mt-3" align="center" style="font-family: 'Kanit', sans-serif; font-weight: 600;"><i class="text-warning fad fa-wallet"></i> รายได้ทั้งหมด</h4>
			<div class="px-2 text-center">
			
				<h1 style="font-family: 'Kanit', sans-serif;"><?=$sumt?> บาท</h1>	
			</div>
			<a data-toggle="modal" data-target="#tp-his" class="text-dark">
				<div class="card-footer p-0 text-center text-grey">
					<p class="m-0 text-warning">แสดงทั้งหมด <i class="fad fa-caret-circle-down"></i></p>
				</div>
			</a>
		</div>
		<div class="card bg-white">
			<div class="card-header"></div>
			<h4 class="mt-3" align="center" style="font-family: 'Kanit', sans-serif; font-weight: 600;"><i class="text-info fad fa-users"></i> ผู้ใช้ทั้งหมด	</h4>
			<div class="px-2 text-center">
				
				<h1 style="font-family: 'Kanit', sans-serif;"><?=$sumu?> คน</h1>	
			</div>
			<a href="/backend/users" class="text-dark">
				<div class="card-footer p-0 text-center text-grey">
					<p class="m-0 text-info">แสดงทั้งหมด <i class="fad fa-caret-circle-down"></i></p>
				</div>
			</a>
		</div>
		<div class="card bg-white">
			<div class="card-header"></div>
			<h4 class="mt-3" align="center" style="font-family: 'Kanit', sans-serif; font-weight: 600;"><i class="text-primary fad fa-shopping-cart"></i> สินค้าทั้งหมด</h4>
			<div class="px-2 text-center">
			
				<h1 style="font-family: 'Kanit', sans-serif;"><?=$sumpd?> ชิ้น</h1>	
			</div>
			<a href="/backend/products" class="text-dark">
				<div class="card-footer p-0 text-center text-grey">
					<p class="m-0 text-primary">แสดงทั้งหมด <i class="fad fa-caret-circle-down"></i></p>
				</div>
			</a>
		</div>
	</div>
	<div class="d-grid-2 w-100 mt-4" style="grid-template-columns: repeat(2, 1fr);grid-column-gap: 20px;
	grid-row-gap: 20px;">
	<div class="card bg-white mb-5" style="height: 430px;">
		<div class="card-header"></div>
		<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-history"></i> ประวัติการเติม 5 คน ล่าสุด</h4>
		
		<div class="table-responsive px-2">
			<table id="example" class="table text-dark text-center">
				<thead style="border-top: 2px solid #fff;">
					<tr>
						<th>ที่</th><th>ผู้ใช้ที่เติม</th><th>ชื่อเบอร์</th><th>จำนวน</th><th>วันที่/เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$class = new heehub;
					$history = $class->history_15();
					$history15 = $history->fetchAll();
					$hischeck = $class->history_15();
					$histo = $hischeck->fetchColumn();
					if ($histo == 0) {?>
						<td colspan="6">ไม่มีประวัติการเติม</td>
						<?php 
					}

					foreach ($history15 as $row) {
						?>
						<tr>
							<td><?=$i?></td><td><?=$row['user_topup']?></td><td><?=$row['name_topup']?></td><td> <?=$row['amount_topup']?> </td><td class="text-warning"><?=$row['date_set']?></td>
						</tr>
						<?php
						$i++;
					} 
					
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="card bg-white mb-5" style="height: 430px;">
		<div class="card-header"></div>
		<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-pallet"></i> ประวัติการซื้อ 5 ชิ้น ล่าสุด</h4>
		<hr class="mt-0">
		<div class="table-responsive px-2">
			<table id="example" class="table text-dark text-center">
				<thead style="border-top: 2px solid #fff;">
					<tr>
						<th>ที่</th><th>ชื่อสินค้า</th><th>ผู้ใข้ที่ซื้อ</th><th>สินค้า</th><th>จำนวน</th><th>วันที่/เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$history_shop = $class->history_shop();
					$history_5 = $history_shop->fetchAll();
					if ($shophis == 0) { ?>
						<td colspan="6">ไม่มีประวัติการซื้อ</td>
						<?php 
					}

					foreach ($history_5 as $row) {
						$qProductMeta = $class->dsdsd($row['type']);
						$resultProductMeta = $qProductMeta->fetchAll();
						foreach($resultProductMeta as $data)
						{
							$product_name = $data['name'];
							$product_price = $data['price'] . " บาท";
						}
						?>
						<tr>
							<td><?=$i?></td><td><?=$product_name?></td><td><?=$row['owner']?></td><td><?=$row['contents']?></td><td><?=$product_price?></td><td class="text-warning"><?=$row['date']?></td>
						</tr>
						<?php
						$i++;
					} 
					
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>

<div class="modal fade " id="counter" tabindex="-1" role="dialog" aria-labelledby="kuy4" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-white text-dark" style="font-family: 'Kanit', sans-serif;">
			<div class="modal-header">
				<h5 class="modal-title" id="dd" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-chart-line"></i> ผู้เข้าชมทั้งหมด</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="p-2">
					<div class="row">
						<div class="col">วันนี้</div>
						<div class="col"><?=$counter['today']?> คน</div>
					</div>
					<hr class="">
					<div class="row">
						<div class="col">เมื่อวานนี้ <span style="color:Gray;">(ไม่รวมวันนี้)</span></div>
						<div class="col"><?=$counter['yesterday']?> ครั้ง</div>
					</div>
					<hr class="">
					<div class="row">
						<div class="col">เดือนนี้ <span style="color:Gray;">(ไม่รวมวันนี้)</span></div>
						<div class="col"><?=$counter['Tmonth']?> ครั้ง</div>
					</div>
					<hr class="">
					<div class="row">
						<div class="col">เดือนที่แล้ว <span style="color:Gray;">(ไม่รวมวันนี้)</span></div>
						<div class="col"><?=$counter['Lmonth']?> ครั้ง</div>
					</div>
					<hr class="">
					<div class="row">
						<div class="col">ทั้งหมด <span style="color:Gray;">(ไม่รวมวันนี้)</span></div>
						<div class="col"><?=$counter['All']?> ครั้ง</div>
					</div>
					<hr>
				</div>
				<div>	
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bd-example-modal-lg" id="tp-his" tabindex="-1" role="dialog" aria-labelledby="kuy4" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-white text-dark" style="font-family: 'Kanit', sans-serif;">
			<div class="modal-header">
				<h5 class="modal-title" id="dd" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-wallet"></i> รายได้ทั้งหมด</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div style="height: 500px;overflow-x: auto;">
					<table id="example" class="table text-dark text-center">
						<thead style="border-top: 2px solid #fff;">
							<tr>
								<th>#</th><th>ผู้ใช้ที่เติมเงิน</th><th>ชื่อที่เติม</th><th>จำนวน</th><th>เวลา</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($numhist['id'] == '') { ?>
								<td colspan="5">ไม่มีประวัติการเติม</td>
							<?php }else{

								foreach ($hist as $rowhis) { ?>
									<tr>
										<td><?=$rowhis['id']?></td><td><?=$rowhis['user_topup']?></td><td><?=$rowhis['name_topup']?></td><td><?=$rowhis['amount_topup']?> บาท</td><td><?=$rowhis['date_set']?></td>
									</tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>
					<div>	
					</div>
				</div>
			</div>
		</div>
	</div>