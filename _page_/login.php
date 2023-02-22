<div class="container text-white text-center" style="margin-top: 200px; font-family: 'Kanit', sans-serif;">
	<div class="card mx-auto bg-white text-dark py-3 mb-5 set-rp-rg">
		<h3 class="my-2"><i class="fad fa-sign-in"></i> เข้าสู่ระบบ</h3>
		<div class="container text-left px-5">
			<label class="mt-2"><i class="fad fa-user-tag"></i> ชื่อผู้ใช้ หรือ อีเมล</label>
			<input type="text" name="" placeholder="Username OR Email ..." id="email_or_user" class="form-control">
			<label class="mt-2"><i class="fad fa-unlock-alt"></i> รหัสผ่าน</label>
			<input type="password" name="" placeholder="Password ..." id="password" class="form-control">
			<div class="px-lg-4" align="center">
				<button class="btn btn-outline-success w-100 m-0 mt-4 p-2" id="btn_login">เข้าสู่ระบบ <i class="fad fa-sign-in"></i></button>
			</div>
			<div class="d-flex">
				<hr class="w-100 my-3"><span class="px-2"> OR </span><hr class="w-100 my-3">
			</div>
			<p align="center">หากยังไม่มีมีบัญชี ? <a href="register">สมัครสมาชิก</a></p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#btn_login").click(function() {
		var user_email = $("#email_or_user").val();
		var pass = $("#password").val();
		$.ajax({
			type:"POST",
			url:"system/data/login.php",
			data:{
				user_email:user_email,
				pass:pass,
			},success:function(data) {
				var obj = JSON.parse(data);

				if (obj.status == "success") {
					Swal.fire({
						type: obj.status,
						title: 'เข้าสู่ระบบสำเร็จ',
						showConfirmButton: false,
						timer: 1500
					}).then((result)=>{
						window.location.href="/";
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
		})
	});
</script>