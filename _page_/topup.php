<div class="container text-white" style="margin-top: 100px; font-family: 'Kanit', sans-serif;">
	<h1 style="font-family: 'Kanit', sans-serif;"><i class="fad fa-donate"></i> เติมเงินเข้าสู่ระบบ</h1>
	<hr>
	<div class="d-grid">
		<a class="mx-auto card-topup" align="center" data-toggle="modal" data-target="#angpao">
			<img src="/assets/img/angpao.png" height="250" style="border-radius: 5px">
		</a>
	</div>
</div>

<div class="modal fade" id="angpao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-white text-dark">
			<div class="modal-header">
				<h5 style="font-family: 'Kanit', sans-serif;" class="modal-title" id="exampleModalLabel">เติมเงิน : <span class="text-danger"><i class="fad fa-gift-card"></i> อั่งเปา</span></h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<div class="text-center">
					<img src="/assets/img/ap2.png" class="topup-gift">
					<h5 style="font-weight: 700; color:#F39C12; font-family: 'Kanit', sans-serif;">!! กรุณาอ่านก่อนทำการเติม</h5>
					<p style="font-family: 'Kanit', sans-serif;">
						<span class="text-danger" >คำเตือน </span>กรุณาใส่ช่อง <span style="font-weight: 600;">กรอกจำนวนคนที่รับซองเป็น 1 คน</span><br>
						หากไม่ทำตามทางเราจะไม่รับผิดชอบ
					</p>
				</div>
				<label><h5 class="mb-0" style="font-family: 'Kanit', sans-serif;">ลิ้งก์ซองอั่งเปา</h5></label>
				<input type="text" name="" id="link_gift" placeholder="https://gift.truemoney.com/campaign/?v=xxxxxxxx" class="form-control">
				<div align="center" style="font-family: 'Kanit', sans-serif;">
					<button class="w3-button w3-deep-orange w3-round-large p-1 w-75 mt-2" onclick="topup_gift()"><i class="fas fa-arrow-right" aria-hidden="true"></i> ดำเนินการต่อ</button>
				</div>
			</div>
		</div>
	</div>
</div>