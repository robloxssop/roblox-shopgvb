<?php 
include '../system.php';
$class = new heehub;
$q_a = $class->qaid($_GET['id']);
$rowqa = $q_a->fetch();

?>
<div class="modal fade show in" id="ed-qa-<?=$rowqa['id']?>" tabindex="-1" role="dialog" aria-labelledby="kuy2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-question-circle"></i> แก้ไข Q&A</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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