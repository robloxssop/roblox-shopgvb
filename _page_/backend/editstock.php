<?php 
$class = new heehub;
$stock = $class->shopshowid($stockid);
$result = $stock->fetch();
if ($result['id'] == '') { ?>
	<script type="text/javascript">
		window.location.href="/backend";
	</script>
<?php } else {?>
<div class="container" style="font-family: 'Kanit', sans-serif;">
	<div class="card-header bg-white mt-5 mb-2"><h4 style="font-family: 'Kanit', sans-serif;" class="my-2 text-dark">แก้ไขสต๊อกสินค้า</h4></div>
	<div class="card bg-white text-dark mb-2">
		<div class="container my-2">
			<label style="font-family: 'Kanit', sans-serif;">สต๊อก ID</label>
			<input type="text" name="" value="" placeholder="<?=$stockid?>" class="form-control" disabled=""><br>
			<div class="<?=$s_card?>">
				<label style="font-family: 'Kanit', sans-serif;">สต๊อก</label>
				<input type="text" value="<?=$result['contents']?>" placeholder="ลงสินค้าที่ต้องการจะส่งให้กับลูกค้า..." id="content" class="form-control">
				<div class="d-flex">
					<button class="btn btn-warning btn-block mx-1 mt-2" onclick="editstock(<?=$stockid?>)">แก้ไขสต๊อก</button>
					<button class="btn btn-danger btn-block mx-1 mt-2" onclick="deletestock(<?=$stockid?>)">ลบสต๊อก</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>