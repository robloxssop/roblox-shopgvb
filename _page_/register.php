<div class="container text-white text-center" style="width: 100%; margin-top: 150px; font-family: 'Kanit', sans-serif;">
	<div class="card mx-auto bg-white text-dark py-3 mb-5 set-rp-rg">
		<h3 class="my-2"><i class="fad fa-user-plus"></i> สมัครสมาชิก</h3>
		<div class="container text-left px-5">
			<label class="mt-2"><i class="fad fa-user-tag"></i> ชื่อผู้ใช้</label>
			<input type="text" id="txt_username" placeholder="Username ..." class="form-control">
			<label class="mt-2"><i class="fad fa-at"></i> อีเมล</label>
			<input type="text" id="txt_email" placeholder="Email ..." class="form-control">
			<label class="mt-2"><i class="fad fa-unlock-alt"></i> รหัสผ่าน</label>
			<input type="password" id="txt_password" placeholder="Password ..." class="form-control">
			<label class="mt-2"><i class="fad fa-lock"></i> ยืนยันรหัสผ่าน</label>
			<input type="password" id="re_password" placeholder="Confirm Password ..." class="form-control">
			<div class="mt-2" align="center">
				<div class="g-recaptcha" data-sitekey="<?= $_CONFIG['site_key'] ?>" align="center"></div>
			</div>
			<div class="px-lg-4" align="center">
				<button class="btn btn-outline-danger w-100 m-0 mt-4 p-2" id="register">สมัครสมาชิก <i class="fad fa-user-plus"></i></button>
			</div>
			<div class="d-flex">
				<hr class="w-100"><span class="px-2"> OR </span><hr class="w-100">
			</div>
			<p align="center">หากมีบัญชีอยู่แล้ว ? <a href="login">เข้าสู่ระบบ</a></p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#register").click(function(){
		var username = $("#txt_username").val();
		var email = $("#txt_email").val();
		var password = $("#txt_password").val();
		var repassword = $("#re_password").val();
		$.ajax({
			type:"POST",
			url:"system/data/register.php",
			data:{
				username:username,
				email:email,
				password:password,
				repassword:repassword,
				recaptcha: grecaptcha.getResponse(),
			},success:function(data){
				var obj = JSON.parse(data);

				if (obj.status == "success") {
					Swal.fire({
						type: obj.status,
						title: 'สมัครสมาชิกเรียบร้อย',
						showConfirmButton: false,
						timer: 1500
					}).then((result)=>{
						window.location.href="./login";
					});
				}else{
					Swal.fire({
						title: 'ผิดพลาด',
						text: obj.info,
						type: obj.status,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});
</script>