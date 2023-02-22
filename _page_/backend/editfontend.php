<?php 

$class = new heehub;
$q_a = $class->qa();
$qa = $q_a->fetchAll();
$qaf = $class->qa();
$qafetch = $qaf->fetch();
$fun = $class->funct();
$funct = $fun->fetchAll();
$func = $class->funct();
$funcheck = $func->fetch();
$pd = $class->product();
$product = $pd->fetchAll();

?>
<div class="container my-5 text-dark" style="font-family: 'Kanit', sans-serif;">
	<div class="card-header bg-white"><h3 style="font-family: 'Kanit', sans-serif;" class="m-0"><i class="fad fa-home-alt"></i> แก้ไขหน้าบ้าน</h3></div>
	<div class="card bg-white mt-2 p-2">
		<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-tags"></i> ชื่อเว็บ</h4>
		<hr class="mt-0">
		<textarea type="text" id="name" placeholder="แก้ไขชื่อเว็บ.." class="form-control" rows="1"><?=$web['name']?></textarea>
	</div>
	<div class="card bg-white mt-2 p-2">
		<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-play-circle"></i> วิดีโอสอนใช้</h4>
		<hr class="mt-0">
		<div align="center" style="overflow-x: auto;">
			<iframe src="https://www.youtube.com/embed/<?=$web['video']?>" id="video_test" width="560" height="315" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<div class="d-flex mx-auto">
			<input type="text" placeholder="วิดีโอ..." value="https://www.youtube.com/watch?v=<?=$web['video']?>" id="video" class="form-control" style="border-radius: 4px 0px 0px 4px;">
			<button class="text-dark btn btn-light m-0 w-50"  style="border-radius: 0px 4px 4px 0px;" onclick="getId($('#video').val())">เช็ควิดีโอ</button>
		</div>
	</div>
	<div class="d-grid-2-rs">
		<div class="card bg-white mt-2 p-2">
			<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-money-bill"></i> ช่องทางระบบเติมเงิน</h4>
			<hr class="mt-1">
			<select class="form-control w-50 mx-auto">
				<option onclick="" selected="">• Wallet Gift | ระบบเติมแบบซองของขวัญ •</option>
			</select>
			<hr>
			<div class="select-topup">
				<h5>Wallet Gift</h5>
				<input type="text" id="phone" value="<?=$web['phone']?>" placeholder="เบอร์ทรูมันนี่วอเล็ต..." class="form-control">
			</div>
		</div>
		<div class="card bg-white mt-2 p-2">
			<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-ad"></i> ข้อความโปรโมท</h4>
			<hr class="mt-0">
			<textarea placeholder="แก้ไขช้อความโปรโมท..." id="promote" class="form-control" rows="5" style="margin-top: 12px;"><?=$web['promote']?></textarea>
		</div>
		<div>
			<div class="card bg-white mt-2 p-2">
				<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-image-polaroid"></i> ไอคอนเว็บ</h4>
				<hr class="mt-0">
				<div class="" align="center">
					<img src="<?=$web['icon']?>" style="height: 104px;width: 100px;" id="img-addpd">				
				</div>
				<div class="d-flex mt-2 mx-auto">
					<input type="text" placeholder="แก้ไขโลโก้เว็บ..." class="form-control" id="logo" value="<?=$web['icon']?>" style="border-radius: 4px 0px 0px 4px;">
					<button class="text-dark btn btn-light m-0 w-50"  style="border-radius: 0px 4px 4px 0px;" onclick="checkimgpd()">เช็ครูปภาพ</button>
				</div>
			</div>
			<div class="card bg-white mt-2 p-2 text-dark">
				<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-question-circle"></i> คำถาม Q&A</h4>
				<hr class="mt-0">
				<div class="d-flex">
					<button class="btn btn-light w-100 text-dark" data-toggle="modal" data-target="#q_a-popup"><i class="fad fa-list"></i></button>
				</div>
			</div>
		</div>
		<div class="card bg-white mt-2 p-2 text-dark">
			<h4 class="m-2" style="font-family: 'Kanit', sans-serif;"><i class="fad fa-badge-check"></i> สินค้าแนะนำ <span class="text-danger" style="font-size: 12px;"> จำกัด 5 ชิ้น</span></h4>
			<hr class="mt-0">
			<div class="d-block" style="overflow-y: auto;height: 250px">
				<?php

				$pdre = $class->pdrecom();
				$reco = $pdre->fetchAll();
				$pdref = $class->pdrecom();
				$recof = $pdref->fetch();
				if (empty($recof['id'])) { ?>
					<h3 class="text-center">คุณไม่ได้ลงสินค้าแนะนำ</h3>
					<?php 
				}

				foreach ($reco  as $rowF) {

					$sp = $class->selectproduct($rowF['no_product']);
					$seproduct = $sp->fetchAll();
					foreach ($seproduct as $rowse) { 
						?>
						<div  align="center">
							<img src="<?=$rowse['image']?>" style="height: 200px;width: 200px;border-radius: 10px;">
							<h5 class="text-center"><?=$rowse['name']?></h5>
							<hr>
						</div>
						<?php 
					} 
				} 
				?>
			</div>
			<button class="btn btn-dark p-0" data-toggle="modal" data-target="#add-pd-n">...เลือกสินค้าที่จะแนะนำ...</button>
		</div>
	</div>
	<div class="card bg-white mt-2 p-2">
		<h4 style="font-family: 'Kanit', sans-serif;" class="m-2 text-center text-dark"><i class="fas fa-th"></i> ฟังก์ชั่น(FEATURES)</h4>
		<hr class="mt-0">
		<div align="center">
			<button class="btn btn-light btn-block text-dark"  data-toggle="modal" data-target="#addfunction"><i class="fad fa-list"></i></button>
		</div>
	</div>
	<div class="card bg-white mt-2">
		<button style="font-family: 'Kanit', sans-serif;" onclick="editfontend()" class="btn btn-success">ยืนยันการแก้ไข</button>
	</div>
</div>


<!-- popup -->
<div class="modal fade bd-example-modal-lg" id="q_a-popup" tabindex="-1" role="dialog" aria-labelledby="kuy1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-white text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-question-circle"></i> คำถาม Q&A</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="p-2" style="overflow-y: auto;height: 200px;">
					<?php if (empty($qafetch['id'])) { ?>
						<h3 class="text-center">ยังไม่มี Q&A</h3>
						<?php 
					}

					foreach ($qa as $rowqa) { ?>
						<h4>Q : <?=$rowqa['q']?></h4>
						<p style="font-family: 'Prompt', sans-serif;font-weight: 400px;padding-left: 10px;">A : <?=$rowqa['a']?></p>
						<div class="d-flex">
							<button class="btn btn-warning w-100" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ed-qa-<?=$rowqa['id']?>" ><i class="fad fa-cog"></i></button>
							<button class="btn btn-danger w-100" onclick="deleteqa(<?=$rowqa['id']?>)"><i class="fad fa-trash-alt"></i></button>
						</div>
						<hr>
					<?php } ?>
				</div>
				<div>
					<hr style="box-shadow: 0 0 10px 1px #67736b;">
					<div align="center">เพิ่มคำถาม & คำตอบ</div>
					<h4>Q : คำถาม</h4>
					<textarea class="form-control" placeholder="เพิ่มคำถาม..." id="q_a-q" rows="4"></textarea><br>
					<h4>A : คำตอบ</h4>
					<textarea class="form-control" placeholder="เพิ่มคำตอบ..." id="q_a-a" rows="4"></textarea>
					<button class="btn btn-success btn-block mt-4" onclick="addq_a()">เพิ่ม Q&A</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php foreach ($qa as $rowqa) {?>
	<div class="modal fade" id="ed-qa-<?=$rowqa['id']?>" tabindex="-1" role="dialog" aria-labelledby="kuy2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-white text-dark">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-question-circle"></i> แก้ไข Q&A</h5>
					<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="p-2">
						<h4>Q : คำถาม</h4>
						<textarea class="form-control" placeholder="แก้คำถาม..." id="q_a-q-e" rows="4"><?=$rowqa['q']?></textarea><br>
						<h4>A : คำตอบ</h4>
						<textarea class="form-control" placeholder="แก้คำตอบ..." id="q_a-a-e" rows="4"><?=$rowqa['a']?></textarea>
						<button class="btn btn-success btn-block mt-4" onclick="editqa(<?=$rowqa['id']?>)">ยืนยันการแก้ไข Q&A นี้</button>
						<hr>
					</div>
					<div>	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="modal fade bd-example-modal-lg" id="addfunction" tabindex="-1" role="dialog" aria-labelledby="kuy3" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-white text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="dd"><i class="fas fa-th"></i> Function (คุณสมบัติของเว็บ)</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-body">

					<div class="" style="overflow-y: auto;height: 200px;">

						<?php if (empty($funcheck)) { ?>
							<h3 class="text-center">คุณยังไม่เพิ่มฟังก์ชั่น</h3>
							<?php 

						}

						foreach ($funct as $rowF) { ?>
							<h4>ไอคอน : <?=$rowF['icon']?></h4>
							<h4>หัวข้อ : <?=$rowF['head']?></h4>
							<h4>รายละเอียดย่อ : <?=$rowF['detail']?></h4>
							<div class="d-flex">
								<button class="btn btn-warning w-100" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#edfunct-<?=$rowF['id']?>" ><i class="fad fa-cog"></i></button>
								<button class="btn btn-danger w-100" onclick="deletefunt(<?=$rowF['id']?>)"><i class="fad fa-trash-alt"></i></button>
							</div>
							<hr>
						<?php } ?>
					</div>
					<div>
						<hr style="box-shadow: 0 0 10px 1px #67736b;">
						<div align="center">เพิ่มฟังก์ชั่น</div>
						<h4>ไอคอน</h4>
						<input type="text" id="icon" placeholder="เพิ่มไอคอน..." class="form-control"><br>
						<h4>หัวข้อ</h4>
						<textarea class="form-control" id="head" placeholder="เพิ่มหัวข้อ..." id="" rows="4"></textarea><br>
						<h4>รายละเอียดย่อ</h4>
						<textarea class="form-control" placeholder="เพิ่มรายละเอียดย่อ..." id="detail" rows="4"></textarea><br>
						<button class="btn btn-success btn-block mt-4" onclick="addfunt()">เพิ่มฟังก์ชั่น</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php foreach ($funct as $rowF) { ?>
	<div class="modal fade " id="edfunct-<?=$rowF['id']?>" tabindex="-1" role="dialog" aria-labelledby="kuy4" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-white text-dark">
				<div class="modal-header">
					<h5 class="modal-title" id="dd"><i class="fas fa-th"></i> แก้ไขฟังก์ชั่น</h5>
					<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>ไอคอน</h4>
					<textarea class="form-control" id="edicon" placeholder="แก้ไขไอคอน..." id="" rows="1"><?=$rowF['icon']?></textarea>
					<h4>หัวข้อ</h4>
					<textarea class="form-control" id="edhead" placeholder="แก้ไขหัวข้อ..." id="" rows="4"><?=$rowF['head']?></textarea><br>
					<h4>รายละเอียดย่อ</h4>
					<textarea class="form-control" placeholder="แก้ไขรายละเอียดย่อ..." id="eddetail" rows="4"><?=$rowF['detail']?></textarea><br>
					<button class="btn btn-warning btn-block mt-4" onclick="editfunt(<?=$rowF['id']?>)">แก้ไขฟังก์ชั่น</button>
					<div>	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="modal fade bd-example-modal-lg" id="add-pd-n" tabindex="-1" role="dialog" aria-labelledby="kuy1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-white text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-badge-check"></i> สินค้าแนะนำ <span class="text-danger" style="font-size: 12px;"> จำกัด 5 ชิ้น</span></h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>
					<div style="height: 240px; overflow-y: auto;">
						<?php

						$pdref = $class->pdrecom();
						$recof = $pdref->fetch();
						$pdre = $class->pdrecom();
						$reco = $pdre->fetchAll();
						if (empty($recof['id'])) { ?>
							<h3 class="text-center">คุณไม่ได้ลงสินค้าแนะนำ</h3>
							<?php 
						}


						foreach ($reco  as $rowF) {

							$sp = $class->selectproduct($rowF['no_product']);
							$seproduct = $sp->fetchAll();
							foreach ($seproduct as $rowse) { 
								?>
								<div  align="center">
									<img src="<?=$rowse['image']?>" style="height: 200px;width: 200px;border-radius: 10px;">
									<h5 class="text-center"><?=$rowse['name']?></h5>
									<button class="btn btn-danger" onclick="delete_recom(<?=$rowF['no_product']?>)"><i class="fad fa-minus-circle"></i></button>
									<hr>
								</div>
								<?php 
							} 
						} 
						?>
					</div>
					<hr style="box-shadow: 0 0 10px 1px #67736b;">
					<h5 align="center"><i class="fad fa-badge-check"></i> เลือกสินค้าแนะนำ</h5>
					<select class="form-control mt-4" id="addrepd" required="">
						<option value="0" selected>...เลือกสินค้าที่จะแนะนำ...</option>
						<?php foreach ($product  as $rowpd) { ?>
							<option value="<?=$rowpd['id']?>"><?=$rowpd['name']?></option>
						<?php } ?>
					</select>
					<button class="btn btn-success btn-block mt-4" onclick="addrecompd()">เพิ่มสินค้าแนะนำ</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end -->

<script type="text/javascript">
	function checkimgpd() {
		var img = $('#logo').val();

		document.getElementById('img-addpd').src = img;

	}
</script>