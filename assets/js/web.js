function navRes() {
	var x = document.getElementById("manu-nav");
	if (x.style.display === "block") {
		x.style.display = "none";
	} else {
		x.style.display = "block";
	}
}

function editusername() {
	var user = $('#user').val();
	var cfpass = $('#cfpass').val();

	$.ajax({
		type:'POST',
		url:'system/data/editusername.php',
		data:{
			user:user,
			cfpass:cfpass
		},success:function(data) {
			var obj = JSON.parse(data);

			if (obj.status == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เปลี่ยนชื่อผู้ใช้เรียบร้อย',
					type: obj.status,
					showConfirmButton: false,
					timer: 1500
				}).then((result)=>{
					window.location.href="../login";
				});
			} else {
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
}

function editpassword() {
	var passwd = $('#passwd').val();
	var cfpass = $('#cfpass').val();

	$.ajax({
		type:'POST',
		url:'system/data/editpass.php',
		data:{
			passwd:passwd,
			cfpass:cfpass
		},success:function(data) {
			var obj = JSON.parse(data);

			if (obj.status == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เปลี่ยนรหัสผ่านเรียบร้อย',
					type: obj.status,
					showConfirmButton: false,
					timer: 1500
				}).then((result)=>{
					window.location.href="../login";
				});
			} else {
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
}

function editemail() {
	var email = $('#email').val();
	var pass = $('#pass').val();

	$.ajax({
		type:'POST',
		url:'system/data/editemail.php',
		data:{
			email:email,
			pass:pass
		},success:function(data) {
			var obj = JSON.parse(data);

			if (obj.status == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เปลี่ยนอีเมลเรียบร้อย',
					type: obj.status,
					showConfirmButton: false,
					timer: 1500
				}).then((result)=>{
					window.location.href="../login";
				});
			} else {
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
}

function manumy() {
	var y = document.getElementById("d-none-arrow");
	if (y.style.display == "block") {
		y.style.display = "none";
	} else {
		y.style.display = "block";
	}
}

function buyproduct(id) {
	Swal.fire({
		title: 'แน่ใจหรือไม่',
		text: "หากท่านซื้อสินค้าผิดทางเราจะไม่รับผิดชอบใดๆทั้งสิ้น",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		confirmButtonText: 'ดำเนินการต่อ',
		cancelButtonText: 'ยกเลิก',
		reverseButtons: false,
		allowEscapeKey: false,
		allowEnterKey: false,
		allowOutsideClick: false
	}).then((result) => {
		if (result.value) {
			swal({
				title: 'Processing', 
				text: 'กำลังทำรายการโปรดรอสักครู่...',
				type: 'info',
				showCancelButton: false,
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
				onOpen: () => {
					$.ajax({
						type:"POST",
						url:"system/data/buyproduct.php",
						data:{
							id:id,
						},
					}).done(function(data){
						var obj = JSON.parse(data);
							//console.log(obj);
							if (obj.status == 'success') {
								Swal.fire({
									title: 'สำเร็จ!', 
									text: 'ซื้อสินค้าสำเร็จ', 
									type: 'success',
									cancelButtonColor: '#d33',
									confirmButtonColor: '#00C851',
									timer: 1500,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false,
									allowEscapeKey: false
								}).then(
								function() {  window.location.href = '../history'; });
							}else{
								Swal.fire({
									title: 'Error!', 
									text: obj.info,
									type: obj.status,
									confirmButtonColor: '#00C851',
									timer: 1500,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false,
									allowEscapeKey: false
								})
							}
						}).fail(function(obj){
							console.log(obj);
						});
					}
				});
		} else if (result.dismiss === swal.DismissReason.cancel) {
			swal.close();
		}
	})
}

function iconnav() {
	var icon = document.getElementById("manu-icon");
	var manu = document.getElementById("manu-admin");
	var area = document.getElementById("area");
	if (icon.classList == 'fas fa-times') {
		manu.style.display = "none";
		icon.classList.remove('fas','fa-times');
		icon.classList.add("fa","fa-bars");
		area.style.left = "0px";
	} else {
		manu.style.display = "block";
		manu.style.background = "rgba(173, 173, 173, 0)";
		icon.classList.remove("fa","fa-bars");
		icon.classList.add("fas","fa-times");
		area.style.left = "300px";
	}
}

function saveedituser(id) {
	var user = $("#username").val();
	var email = $("#email").val();
	var point = $("#point").val();
	var status = $("#status").val();

	$.ajax({
		type:'POST',
		url:'../system/data/edituser.php',
		data:{
			id:id,
			user:user,
			email:email,
			point:point,
			status:status,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'อัพเดตผู้ใช้ที่ ' + id + ' เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/users";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function deleteuser(id) {
	Swal.fire({
		title: 'คุณแน่ใจมั้ย?',
		text: 'คุณต้องการลบผู้ใช้ '+ id + ' ใช่มั้ย!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		cancelButtonText: 'ไม่',
		confirmButtonText: 'ใช่'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type:'POST',
				url:".../system/data/deleteuser.php",
				data:{
					id:id,
				},success:function(data){
					if (data == "success") {
						Swal.fire({
							text: 'ลบผู้ใช้ '+ id + ' สำเร็จ',
							type: 'success',
							timer: 2500, 
							confirmButtonColor: '#00C851',
							confirmButtonText: 'ตกลง'
						}).then((result)=>{
							window.location.href="/backend/users";
						});
					} else {
						Swal.fire({
							title: 'ผิดพลาด',
							text: data,
							type: 'error',
						});
					} 
				}
			});
		}
	});
}

function deleteproduct(id) {
	Swal.fire({
		title: 'คุณแน่ใจมั้ย?',
		text: 'หากลบสินค้า สินค้าในสต๊อกนี้จะถูกลบทั้งหมด แน่ใจหรือไม่!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		cancelButtonText: 'ไม่',
		confirmButtonText: 'ใช่'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type:'POST',
				url:"/system/data/deleteproduct.php",
				data:{
					id:id,
				},success:function(data){
					if (data == "success") {
						Swal.fire({
							text: 'ลบสินค้า ID : '+ id + ' สำเร็จ',
							type: 'success',
							timer: 2500, 
							confirmButtonColor: '#00C851',
							confirmButtonText: 'ตกลง'
						}).then((result)=>{
							window.location.href="/backend/products";
						});
					} else {
						Swal.fire({
							title: 'ผิดพลาด',
							text: data,
							type: 'error',
						});
					} 
				}
			});
		}
	});
}

function addstock(id) {
	var inputItemData = $("#inputItemData").val();
	$.ajax({
		type:"POST",
		url:"/system/data/addstock.php",
		data:{
			id:id,
			inputItemData:inputItemData,
		},success:function(data){
			if (data=="success") {
				Swal.fire({
					text: 'เพิ่มสต๊อกสำเร็จ!',
					type: 'success',
					confirmButtonColor: '#00C851',
					confirmButtonText: 'ตกลง',
					timer: 2500
				}).then((result)=>{
					window.location.href="/backend/products";
				});
			}else{
				Swal.fire({
					title: 'ผิดผลาด',
					text: data,
					type: 'error',
					confirmButtonColor: '#00C851',
					confirmButtonText: 'ตกลง',
					timer: 3500
				})
			}
		}
	});
}
function topup_gift() {
	var link_gift = $('#link_gift').val();

	Swal.fire({
		title: 'คุณแน่ใจมั้ย?',
		text: "คุณต้องการที่จะเติมเงินใช่หรือไม่!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		cancelButtonText: 'ไม่',
		confirmButtonText: 'ใช่'
	}).then((result) => {
		if (result.value) {
			swal({
				title: 'Processing', 
				text: 'กำลังทำรายการโปรดรอสักครู่...',
				type: 'info',
				showCancelButton: false,
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
				onOpen: () => {
					$.ajax({
						type:'POST',
						url:"/system/data/topup_gift.php",
						data:{
							link_gift:link_gift
						},
					}).done(function(data){
						var obj = JSON.parse(data);

						if (obj.status == "success") {
							Swal.fire({
								type: obj.status,
								title: obj.info,
								showConfirmButton: false,
								timer: 1500
							}).then((result)=>{
								window.location.href="../profire";
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
					})
				}
			})
		}
	})
}

function editfontend() {
	var name = $('#name').val();
	var video = $('#video').val();
	var phone = $('#phone').val();
	var promote = $('#promote').val();
	var logo = $('#logo').val();

	$.ajax({
		type:'POST',
		url:'/system/data/editfontend.php',
		data:{
			name:name,
			video:video,
			phone:phone,
			promote:promote,
			logo:logo,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'แก้ไขระบบเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function checkvideo() {
	var str = $("#video").val();
	var myarr = str.split("https://www.youtube.com/");
	var res = myarr[1];
	document.getElementById("video_test").src = "https://www.youtube.com/embed/" + res;
}


function getId(url){
	var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	var match = url.match(regExp);
	if (match && match[2].length == 11) {
		document.getElementById("video_test").src = "https://www.youtube.com/embed/" + match[2]; 
	} else {
		alert("Could not extract video ID.");
	}
}

function addq_a() {
	var q = $('#q_a-q').val();
	var a = $('#q_a-a').val();

	$.ajax({
		type:'POST',
		url:'/system/data/addqa.php',
		data:{
			q:q,
			a:a,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เพิ่ม Q&A เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function deleteqa(id) {
	$.ajax({
		type:'POST',
		url:'/system/data/deleteqa.php',
		data:{
			id:id
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'ลบ Q&A เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}


function editqa(id) {
	var	q = $('#q_a-q-e').val();
	var	a = $('#q_a-a-e').val();


	$.ajax({
		type:'POST',
		url:'/system/data/editqa.php',
		data:{
			id:id,
			q:q,
			a:a
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'แก้ไข Q&A เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function addfunt() {

	var	icon = $('#icon').val();
	var	head = $('#head').val();
	var	detail = $('#detail').val();


	$.ajax({
		type:'POST',
		url:'/system/data/addfun.php',
		data:{
			icon:icon,
			head:head,
			detail:detail
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เพิ่มฟังก์ชั่นเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function editfunt(id) {
	var	icon = $('#edicon').val();
	var	head = $('#edhead').val();
	var	detail = $('#eddetail').val();


	$.ajax({
		type:'POST',
		url:'/system/data/editfunt.php',
		data:{
			id:id,
			icon:icon,
			head:head,
			detail:detail
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'แก้ไขฟันก์ชั่นเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function deletefunt(id) {
	$.ajax({
		type:'POST',
		url:'/system/data/deletefunt.php',
		data:{
			id:id,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'ลบฟันก์ชั่นเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function addproduct() {
	var name = $('#name').val();
	var detail = $('#myTextarea').val();
	var price = $('#price').val();
	var pattern = $('#pattern').val();
	var img = $('#pdimg').val();

	$.ajax({
		type:'POST',
		url:'/system/data/addproducts.php',
		data:{
			name:name,
			detail:detail,
			price:price,
			pattern:pattern,
			img:img
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เพิ่มสินค้าเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/products";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function addrecompd() {
	var	pdrecom = $('#addrepd').val();

	$.ajax({
		type:'POST',
		url:'/system/data/addrecompd.php',
		data:{
			pdrecom:pdrecom
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'เพิ่มสินค้าแนะนำเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function delete_recom(id) {
	$.ajax({
		type:'POST',
		url:'/system/data/deleterecompd.php',
		data:{
			id:id
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'ลบสินค้าแนะนำเรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/editfontend";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function con_editpd(id) {
	var name = $("#name").val();
	var img = $("#pdimg").val();
	var detail = $("#myTextarea").val();
	var price = $("#price").val();
	var pattern = $("#pattern").val();

	$.ajax({
		type:'POST',
		url:'/system/data/editproduct.php',
		data:{
			id:id,
			name:name,
			img:img,
			detail:detail,
			price:price,
			pattern:pattern,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'แก้ไขสินค้าที่ ' + id + ' เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/products";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function editstock(id) {
	var content = $("#content").val();

	$.ajax({
		type:'POST',
		url:'/system/data/editstock.php',
		data:{
			id:id,
			content:content,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'แก้ไขสต๊อกที่ ' + id + ' เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/products/addstock/" + id;
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function deletestock(id) {
	Swal.fire({
		title: 'คุณแน่ใจมั้ย?',
		text: 'คุณต้องการลบสต๊อกที่ '+ id + ' ใช่มั้ย!',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		cancelButtonText: 'ไม่',
		confirmButtonText: 'ใช่'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type:'POST',
				url:"/system/data/deletestock.php",
				data:{
					id:id,
				},success:function(data){
					if (data == "success") {
						Swal.fire({
							text: 'ลบสต๊อกที่ '+ id + ' สำเร็จ',
							type: 'success',
							timer: 2500, 
							confirmButtonColor: '#00C851',
							confirmButtonText: 'ตกลง'
						}).then((result)=>{
							window.location.href="/backend/products/addstock/" + id;
						});
					} else {
						Swal.fire({
							title: 'ผิดพลาด',
							text: data,
							type: 'error',
						});
					} 
				}
			});
		}
	});
}

function saveedituser(id) {
	var user = $("#username").val();
	var email = $("#email").val();
	var point = $("#point").val();
	var status = $("#status").val();

	$.ajax({
		type:'POST',
		url:'/system/data/edituser.php',
		data:{
			id:id,
			user:user,
			email:email,
			point:point,
			status:status,
		},success:function(data) {
			if (data == "success") {
				Swal.fire({
					title: 'สำเร็จ',
					text: 'อัพเดตผู้ใช้ที่ ' + id + ' เรียบร้อย',
					type: 'success',
				}).then((result)=>{
					window.location.href="/backend/users";
				});
			}else{
				Swal.fire({
					title: 'ผิดพลาด',
					text: data,
					type: 'error',
				});
			}
		}
	});
}

function deleteuser(id) {
	Swal.fire({
		title: 'คุณแน่ใจมั้ย?',
		text: 'คุณต้องการลบผู้ใช้ '+ id + ' ใช่มั้ย!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#00C851',
		cancelButtonColor: '#d33',
		cancelButtonText: 'ไม่',
		confirmButtonText: 'ใช่'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type:'POST',
				url:"/system/data/deleteuser.php",
				data:{
					id:id,
				},success:function(data){
					if (data == "success") {
						Swal.fire({
							text: 'ลบผู้ใช้ '+ id + ' สำเร็จ',
							type: 'success',
							timer: 2500, 
							confirmButtonColor: '#00C851',
							confirmButtonText: 'ตกลง'
						}).then((result)=>{
							window.location.href="/backend/users";
						});
					} else {
						Swal.fire({
							title: 'ผิดพลาด',
							text: data,
							type: 'error',
						});
					} 
				}
			});
		}
	});
}

function addusers() {
	var username = $("#txt_username").val();
	var email = $("#txt_email").val();
	var password = $("#txt_password").val();
	$.ajax({
		type:"POST",
		url:"/system/data/addusers.php",
		data:{
			username:username,
			email:email,
			password:password,
		},success:function(data){
			var obj = JSON.parse(data);

			if (obj.status == "success") {
				Swal.fire({
					type: obj.status,
					title: 'เพิ่มผู้ใช้เรียบร้อย',
					showConfirmButton: false,
					timer: 1500
				}).then((result)=>{
					window.location.href="/backend/users";
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
}
