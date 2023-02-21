<?php
$class = new heehub;
$num = $class->countmyproduct();
$numpd = $num->fetchColumn();

if ($numpd == '0') {
  $numtext = '';
} else {
  $numtext = '<span class="badge badge-pill bg-danger">' . $numpd . '</span>';
}

?>
<style type="text/css">
  .btn .btn-outline-danger .btn-round :hover {
    background-color: #f5365c;
  }

  div.card.set-size {
    top: 60px;
    right:20%;
    position:absolute;
    display:none;
    border:1px solid #2121;
    z-index:2000;
  }

  @media (max-width: 1500px) {
    div.card.set-size {
      right:5%;
    }
  }

</style>

<nav class="navbar navbar-expand navbar-light bg-white fixed-top" style="	font-family: 'Kanit', sans-serif;">
  <div class="container mx-auto">
    <ul class="navbar-nav d-none d-md-flex">
      <li class="nav-item">
        <a class="c-nav px-2" href="../home"><i class="fad fa-home-lg-alt"></i> หน้าหลัก</a>
      </li>
      <li class="nav-item">
        <a class="c-nav px-2" href="#" data-toggle="modal" data-target="#howtouse"><i class="fad fa-photo-video"></i> วิธีใช้งาน</a>
      </li>
      <?php if (isset($_SESSION['username'])) { ?>
        <li class="nav-item">
          <a class="c-nav px-2" href="../shop"><i class="fad fa-shopping-basket"></i> สินค้า</a>
        </li>
      <?php } ?>
    </ul>
    <ul class="d-block d-md-none mb-0 ">
      <a href="javascript:void(0);" class="icon-res text-white" onclick="navRes()">
        <i class="fa fa-bars res-i" style="color:black;"></i>
      </a>
    </ul>
    <div class="float-right">
      <?php if (!isset($_SESSION['username'])) { ?>
        <a class="pop text-white w3-button w3-orange  p-0 py-1 px-4 my-2 my-sm-0" style="border-radius: 15px;font-size: 12px; background:rgb(248, 132, 2 , 0.5); color:white;" href="register">สมัครสมาชิก</a>
        <a class="pop w3-button w3-red p-0 py-1 px-4 my-2 my-md-0" style="border-radius: 15px;font-size: 12px; background:#F88402; color:black;" href="login">เข้าสู่ระบบ</a>
      <?php } else { ?>
        <div class="d-flex" style="font-family: 'Kanit' , sans-serif;">
          <?php if ($session_user['status'] == "ผู้ดูแลระบบ") { ?>
            <a type="button" href="../backend" class=" p-1 ml-4 mr-2 text-dark my-0"><i class="fad fa-tasks"></i><span class="text-none"> จัดการหลังร้าน</span></a>
          <?php } ?>
          <a type="button" href="../topup" class="btn btn-dark p-1 px-2 mr-4  my-0"><i class="fad fa-donate"></i><span class="text-none-sm"> เติมเงิน</span></a>
          <a href="javascript:void(0);" onclick="manumy()">
            <h5 class=" mb-0" style="color:#454545;"><?= $session_user['username'] ?><span class="ml-2" style="font-size: 15px;"><i class="fas fa-angle-down"></i></span></h5>
          </a>
        </div>
        <div class="card set-size p-2 text-center" id="d-none-arrow">
          <a href="/profire">
            <br>
            <img src="../assets/img/profile.jpg" width="70px" style="border-radius: 50%;">
            <hr>
          </a>
          <h5 class="text-left mx-1 mb-0" style="color: #000;font-family: 'Kanit', sans-serif;"><i class="fas fa-user-circle"></i> ชื่อผู้ใช้ : <?= $session_user['username'] ?> <span style="font-size: 12px;"></span></h5>
          <p class="text-set-nav text-left m-0"><i class="fas fa-coin"></i> พ้อยท์ : <?= $session_user['point'] ?> บาท</p>
          <a class="nav-link text-set-nav text-left" href="../history">
            <span><i class="fas fa-shopping-cart"></i></span>
            ประวัติการซื้อ <?= $numtext ?>
          </a>
          <a class="nav-link text-set-nav text-left" href="../profire">
            <span><i class="fad fa-cogs"></i></span>
            ตั้งค่าข้อมูล
          </a>
          <hr class="bg-white mt-0" style="height: 0px;">
          <button type="button" class="btn btn-outline-danger btn-round p-0 py-1 px-4 logout" style="border-radius: 15px;">ออกจากระบบ <i class="fad fa-sign-out-alt"></i></button>
        </div>
      <?php } ?>
    </div>
  </div>
</nav>
<div class="fixed-top" id="manu-nav" style="background:white;">
  <li class="de-nav">
    <a class="c-nav" href="../home">หน้าหลัก</a>
  </li>
  <li class="de-nav">
    <a class="c-nav" href="#" data-toggle="modal" data-target="#howtouse">วิธีใช้งาน</a>
  </li>
  <li class="de-nav">
    <a class="c-nav" href="../shop">สินค้า</a>
  </li>
</div>

<div class="modal fade" id="howtouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fad fa-photo-video"></i> คลิปวิดีโอสอนใช้งาน</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div align="center" style="overflow-x: auto;">
          <iframe width="400" height="315" src="https://www.youtube.com/embed/<?= $web['video'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p>Link : <a href="https://youtu.be/<?= $web['video'] ?>" target="_blank">https://youtu.be/<?= $web['video'] ?></a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(".logout").click(function() {
    Swal.fire({
      title: 'คุณแน่ใจมั้ย?',
      text: "คุณต้องการที่จะออกจากระบบจริงๆหรอ!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#00C851',
      cancelButtonColor: '#d33',
      cancelButtonText: 'ไม่',
      confirmButtonText: 'ใช่'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "system/data/logout.php",
          success: function(data) {
            Swal.fire({
              text: 'ออกจากระบบสำเร็จ',
              type: 'success',
              timer: 2500,
              confirmButtonColor: '#00C851',
              confirmButtonText: 'ตกลง'
            }).then((result) => {
              window.location.href = "./home";
            });
          }
        });
      }
    })
  });
</script>