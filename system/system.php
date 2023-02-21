<?php 
session_start();
require 'pdo.php';
require 'vendor/autoload.php';

class heehub {

	function __construct(){
		$this->db = DB();
		$_SESSION['id'] = (!empty($_SESSION['id'])) ? $_SESSION['id'] : NULL;
		$_SESSION['username'] = (!empty($_SESSION['username'])) ? $_SESSION['username'] : NULL;
		$_SESSION['status'] = (!empty($_SESSION['status'])) ? $_SESSION['status'] : NULL;
	}
	
	function register($user,$email,$pass){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :user");
		$stmt->bindparam(":user",$user);
		$stmt->execute();
		if($stmt->rowcount() > 0){
			$message['status'] = "error";
			$message['info'] = "มีผู้ใช้นี้อยู่ในระบบแล้ว";
		}else{
			$ph = $this->db->prepare("SELECT * FROM users WHERE email = :email");
			$ph->bindvalue(":email",$email);
			$ph->execute();
			if($ph->rowcount() > 0){
				$message['status'] = "error";
				$message['info'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
			}else{
				$stmt = $this->db->prepare("INSERT INTO users(username, email, password) VALUES (:user,:email,:pass)");
				try {
					$stmt->execute([':user'=>$user,':pass'=>$pass,':email'=>$email]);
					$message['status'] = "success";
				} catch (Exception $e) {
					$message = $e->getMessage();
				}
			}
		}
		return $message;
	}

	function login($user_email,$pass){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :uname OR email = :uemail");
		$stmt->execute([':uname' => $user_email, ':uemail' => $user_email]);
		$row = $stmt->fetch();
		if($stmt->rowcount() > 0){
			if ($user_email == $row['username'] || $user_email == $row['email']) {
				if (password_verify($pass, $row['password'])) {
					$message['status'] = "success";
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['status'] = $row['status'];
				}else{
					$message['status'] = "error";
					$message['info'] = "คุณใส่รหัสผ่านผิด";
				}
			}else{
				$message['status'] = "error";
				$message['info'] = "ไม่พบ ชื่อผู้ใช้ หรือ อีเมล";
			}
		}else{
			$message['status'] = "error";
			$message['info'] = "ไม่พบ ชื่อผู้ใช้ หรือ อีเมล";
		}
		return $message;
	}

	function session_user(){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :user");
		if (isset($_SESSION['username'])) {
			$stmt->execute([':user'=>$_SESSION['username']]);
		}
		return $stmt;
	}

	function changepassword($pass,$new_password){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :id");
		$stmt->execute([':id'=>$_SESSION['username']]);
		$row = $stmt->fetch();
		if (password_verify($pass, $row['password'])) {
			$stmt = $this->db->prepare("UPDATE users SET password = :newpassword WHERE username = :username");
			try {
				$stmt->execute([':newpassword'=>$new_password, ':username'=>$_SESSION['username']]);
				$message['status'] = "success";	
				session_destroy();
			} catch (Exception $e) {
				$message['status'] = "error";	
				$message['info'] = $e->getMessage();
			}
		}else {
			$message['status'] = "error";	
			$message['info'] = "รหัสผ่านเดิมไม่ถูกต้อง";
		}
		return $message;
	}

	function changeemail($pass,$email){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :id");
		$stmt->execute([':id'=>$_SESSION['username']]);
		$row = $stmt->fetch();
		if (password_verify($pass, $row['password'])) {
			$stmt = $this->db->prepare("UPDATE users SET email = :newemail WHERE username = :username");
			try {
				$stmt->execute([':newemail'=>$email, ':username'=>$_SESSION['username']]);
				$message['status'] = "success";	
				session_destroy();
			} catch (Exception $e) {
				$message['status'] = "error";	
				$message['info'] = $e->getMessage();
			}
		}else {
			$message['status'] = "error";	
			$message['info'] = "รหัสผ่านไม่ถูกต้อง";
		}
		return $message;
	}

	function changeusername($pass,$user){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :id");
		$stmt->execute([':id'=>$_SESSION['username']]);
		$row = $stmt->fetch();
		if (password_verify($pass, $row['password'])) {
			$stmt = $this->db->prepare("UPDATE users SET username = :newusername WHERE username = :username");
			try {
				$stmt->execute([':newusername'=>$user, ':username'=>$_SESSION['username']]);
				$message['status'] = "success";	
				session_destroy();
			} catch (Exception $e) {
				$message['status'] = "error";	
				$message['info'] = $e->getMessage();
			}
		}else {
			$message['status'] = "error";	
			$message['info'] = "รหัสผ่านไม่ถูกต้อง";
		}
		return $message;
	}

	function redeem($phone,$voucher_hash){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://gift.truemoney.com/campaign/vouchers/'.$voucher_hash.'/redeem',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode(array('mobile' => $phone,'voucher_hash' => $voucher_hash)),
			CURLOPT_HTTPHEADER => array(
				'accept: application/json',
				'accept-encoding: gzip, deflate, br',
				'accept-language: en-US,en;q=0.9',
				'content-length: 59',
				'content-type: application/json',
				'origin: https://gift.truemoney.com',
				'referer: https://gift.truemoney.com/campaign/?v='.$voucher_hash,
				'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36 Edg/87.0.664.66',
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($response);
		if (isset($result->status->code)) {
			$codestatus = $result->status->code;
			if ($codestatus == "VOUCHER_OUT_OF_STOCK") {
				$message['status'] = "error";
				$message['info'] = "อั่งเปานี้ถูกใช้งานไปแล้ว";
			}elseif ($codestatus == "VOUCHER_NOT_FOUND") {
				$message['status'] = "error";
				$message['info'] = "ไม่พบอั่งเปานี้!!";
			}elseif ($codestatus == "VOUCHER_EXPIRED"){
				$message['status'] = "error";
				$message['info'] = "อั่งเปาหมดอายุ!!";
			}elseif ($codestatus == "SUCCESS"){
				$balance = $result->data->voucher;
				$ownerprofile = $result->data->owner_profile;
				if ($balance->amount_baht == $balance->redeemed_amount_baht) {
					$topup = $balance->redeemed_amount_baht;
					$name = $ownerprofile->full_name;
					$message['amount_baht'] = $topup;
					$message['voucher_owner'] = $name;
					// decode api
					$top = $this->db->prepare('UPDATE users SET point = point + :topup WHERE username = :user');
					$top->execute(array(':user'=>$_SESSION['username'],':topup'=>$topup));
					$message['status'] = "success";
					$message['info'] = "เติมเงินสำเร็จ!! จำนวน " .$topup. " บาท";
				}else{
					$message['status'] = "error";
					$message['info'] = "กรุณาแบ่งอั่งเปาแค่1คน!!";
				}
			}else{
				$message['status'] = "error";
				$message['info'] = "คุณส่งอั่งเปาเข้าเบอร์ตัวเอง";
			}
		}else{
			$message['status'] = "error";
			$message['info'] = "ลิ้งอั่งเปาไม่ถูกต้อง";
		}

		return $message;
	}

	function product(){
		$stmt = $this->db->prepare("SELECT * FROM product ");
		$stmt->execute();
		return $stmt;
	}

	function showstock($id){
		$stmt = $this->db->prepare("SELECT count(*) FROM stock WHERE type = :id AND owner = ''");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function buyproduct($id){
		$product_id = $id;
		$q = $this->db->prepare('SELECT count(*) FROM stock WHERE type = :id AND owner = ""');
		$q->execute(array(':id'=>$product_id));
		$result = $q->fetchColumn();
		if (empty($_SESSION['username'])) {
			$msg['status'] = 'error';
			$msg['info'] = 'กรุณาเข้าสู่ระบบก่อนดำเนินการ';
		}else{
			if ($result > 0) {
				$q = $this->db->prepare('SELECT * FROM stock WHERE type= :type AND owner="" ORDER BY RAND() LIMIT 1');
				$q->execute(array(':type'=>$product_id));
				$result = $q->fetchAll();
				foreach($result as $row) {
					$item_id = $row['id'];
					$item_type = $row['type'];
					$item_contents = $row['contents'];
					$item_date = $row['date'];
				}
				$q = $this->db->prepare('SELECT * FROM product WHERE id = :id');
				$q->execute(array(':id'=>$item_type));
				$result = $q->fetchAll();
				foreach($result as $row) {
					$product_id = $row['id'];
					$product_name = $row['name'];
					$product_price = $row['price'];
					$product_patt = $row['pattern'];
				}
				$q = $this->db->prepare('SELECT point FROM users where username = :user');
				$q->execute(array(':user'=>$_SESSION['username']));
				$coins = $q->fetchColumn();
				if ($coins >= $product_price) {
					$ras = $this->db->prepare('UPDATE stock SET owner= :owner, date= :date WHERE id= :id');
					$ras->execute(array(':owner'=>rtrim($_SESSION['username']),':id'=>$item_id,':date'=>date("Y-m-d H:i:s")));
					$buy = $this->db->prepare('UPDATE users SET point = point - :amount WHERE username = :user');
					$buy->execute(array(':user'=>$_SESSION['username'],':amount'=>$product_price));
					$msg['status'] = 'success';
				}else{
					$msg['status'] = 'error';
					$msg['info'] = 'ยอดเงินของคุณไม่เพียงพอที่จะซื้อสินค้านี้';
				}
			}else{
				$msg['status'] = 'error';
				$msg['info'] = 'สินค้าหมด!';
			}
		}
		return $msg;
	}

	function myshop(){
		$q1 = $this->db->prepare("SELECT * FROM stock WHERE owner = :user");
		$q1->execute([':user'=>$_SESSION['username']]);
		return $q1;
	}

	function countmyproduct(){
		$stmt = $this->db->prepare("SELECT count(id) FROM stock WHERE owner = :user ");
		if (isset($_SESSION['username'])) {
			$stmt->execute([':user'=>$_SESSION['username']]);
		}
		return $stmt;
	}

	function dsdsd($id){
		$qProductMeta = $this->db->prepare('SELECT * FROM product WHERE id = :id');
		$qProductMeta->execute(array(':id'=>$id));
		return $qProductMeta;
	}

	function selectuser(){
		$add = $this->db->prepare("SELECT * FROM users");
		$add->execute();
		return $add;
	}

	function editselectuser($id){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function deleteuser($id){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function edituser($id,$user,$email,$point,$status){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE users SET point = :point, email = :email, status = :status, username = :user WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':user'=>$user,
				':point'=>$point,
				':email'=>$email,
				':status'=>$status
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function countuser(){
		$stmt = $this->db->prepare("SELECT count(*) FROM users ");
		$stmt->execute();
		return $stmt;
	}

	function countproduct(){
		$stmt = $this->db->prepare("SELECT count(id) FROM product ");
		$stmt->execute();
		return $stmt;
	}

	function selectproduct($id){
		$stmt = $this->db->prepare("SELECT * FROM product WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function deleteproduct($id) {
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM product WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function editproduct($id,$name,$img,$detail,$price,$pattern){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE product SET name = :name, image = :img, detail = :detail, price = :price, pattern = :pat  WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':name'=>$name,
				':img'=>$img,
				':detail'=>$detail,
				':price'=>$price,
				':pat'=>$pattern
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function selectstock(){
		$sdsd = $this->db->prepare("SELECT * FROM stock");
		$sdsd->execute();
		return $sdsd;
	}

	function addstock($inputItemType,$raq){
		$req_type = $inputItemType;
		$req_data = $raq;
		$allData = preg_split('/\r\n|\r|\n/', $req_data);
		if (array_values($allData)[0] == '<batch>') {
			$x = '';
			foreach ($allData as $myData) {
				if ($myData != '<batch>') {
					$q1 = $this->db->prepare('INSERT INTO stock (type, contents, owner, date) VALUES (:a , :b, "", NULL)');
					$q1->execute([':a'=>$req_type,':b'=>$myData]);
					$x .= $this->db->lastInsertId() . ', ';
				}
			}if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}
		}else{
			$q1 = $this->db->prepare('INSERT INTO stock (type, contents, owner, date) VALUES (:a , :b, "", NULL)');
			$q1->execute([':a'=>$req_type,':b'=>$req_data]);
			if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}	
		}
		return $msg;
	}

	function selectstockid($id){
		$sdsd = $this->db->prepare("SELECT * FROM stock WHERE type = :type");
		$sdsd->execute([':type'=>$id]);
		return $sdsd;
	}

	function countstock(){
		$stmt = $this->db->prepare("SELECT count(*) FROM stock");
		$stmt->execute();
		return $stmt;
	}

	function countstockid($id){
		$stmt = $this->db->prepare("SELECT count(*) FROM stock WHERE type = :type ");
		$stmt->execute([':type'=>$id]);
		return $stmt;
	}

	function addproduct($name,$price,$detail,$img,$pattern){
		if ($_SESSION['status'] !== "admin") {
			$msg = "WTFF";
		}else{
			$q1 = $this->db->prepare("INSERT INTO product (name, image, detail, price, pattern) VALUES (:name,:image,:detail,:price,:pattern)");
			$q1->execute(array(':name'=>$name,':image'=>$img,':detail'=>$detail,':price'=>$price,':pattern'=>$pattern));
			if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}
		}
		return $msg;
	}

	function deletestockid($id){
		$stmt = $this->db->prepare("DELETE FROM stock WHERE type = :type");
		$stmt->execute([':type'=>$id]);
		return $stmt;
	}

	function editstock($id,$ct) {
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE stock SET contents = :ct WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':ct'=>$ct
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function deletestock($id){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM stock WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function shopshowid($id){
		$stmt = $this->db->prepare("SELECT * FROM stock WHERE id = :id");
		$stmt->execute(['id'=>$id]);
		return $stmt;
	}

	function add_history_topup($name,$amount,$phone){
		$stmt = $this->db->prepare("INSERT INTO history_topup(user_topup, name_topup, amount_topup,phone_web) VALUES (:user,:name,:amount,:phone)");
		$stmt->execute([':user'=>$_SESSION['username'],':name'=>$name,':amount'=>$amount,':phone'=>$phone]);
		return $stmt;
	}

	function editfontend($name,$video,$phone,$promote,$logo){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("UPDATE web_config SET name = :name, video = :video, phone = :phone, promote = :promote, icon = :logo");
			$stmt->execute([
				':name'=>$name,
				':video'=>$video,
				':phone'=>$phone,
				':promote'=>$promote,
				':logo'=>$logo
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}
	function web_fontend(){
		$stmt = $this->db->prepare("SELECT * FROM web_config");
		$stmt->execute();
		return $stmt;
	}

	function addqa($q,$a){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("INSERT INTO q_a(q,a) VALUES (:q,:a)");
			$stmt->execute([':q'=>$q,':a'=>$a]);
			$msg = "success";
		} else {
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function qa(){
		$stmt = $this->db->prepare("SELECT * FROM q_a");
		$stmt->execute();
		return $stmt;
	}

	function deleteqa($id){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("DELETE FROM q_a WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else {
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function editqa($id,$q,$a){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("UPDATE q_a SET q = :q, a= :a WHERE id = :id");
			$stmt->execute([':id'=>$id,':q'=>$q,':a'=>$a]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function addfun($icon,$head,$detail){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("INSERT INTO function (icon,head,detail) VALUES (:icon,:head,:detail)");
			$stmt->execute([':icon'=>$icon,':head'=>$head,':detail'=>$detail]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function funct(){
		$stmt = $this->db->prepare("SELECT * FROM function");
		$stmt->execute();
		return $stmt;
	}

	function qaid($id){
		$stmt = $this->db->prepare("SELECT * FROM q_a WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function sum_history_topup(){
		$stmt = $this->db->prepare("SELECT SUM(amount_topup) FROM history_topup");
		$stmt->execute();
		return $stmt;
	}

	function sum_users(){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM users");
		$stmt->execute();
		return $stmt;
	}

	function sum_product(){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM product");
		$stmt->execute();
		return $stmt;
	}

	function counter(){

		$ip = $_SERVER["REMOTE_ADDR"];
		if ($ip == '::1') {
			$ip = "127.0.0.1";
		}
		$strSQL = $this->db->prepare("SELECT DATE FROM counter LIMIT 0,1");
		$strSQL->execute();
		$strSQLip = $this->db->prepare(" SELECT * FROM counter WHERE IP = :ip");
		$strSQLip->execute([':ip'=>$ip]);
		$row = $strSQL->fetch();
		$rowip = $strSQLip->fetch();

		if ($ip !== $rowip['IP']) {
			$set_ip = $this->db->prepare(" INSERT INTO counter (DATE,IP) VALUES (:_date,:ip)");
			$date = date('Y-m-d');
			$set_ip->execute([':_date'=>$date,':ip'=>$ip]);
		}

		if($row["DATE"] != date("Y-m-d")) {
			$strSQLin = $this->db->prepare(" INSERT INTO daily (DATE,NUM) SELECT '".date('Y-m-d',strtotime("-1 day"))."',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '".date('Y-m-d',strtotime("-1 day"))."'");
			$strSQLin->execute();		

			$strSQL = $this->db->prepare(" DELETE FROM counter WHERE DATE != '".date("Y-m-d")."' ");
			$strSQL->execute();	
		}


		//today
		$objQuery = $this->db->prepare(" SELECT COUNT(DATE) FROM counter WHERE DATE = :_date ");
		$objQuery->execute([':_date'=>date("Y-m-d")]);
		$conuter['today'] = $objQuery->fetchColumn();

		//yesterday
		$objQueryY = $this->db->prepare( " SELECT NUM FROM daily WHERE DATE = :_date ");
		$objQueryY->execute([':_date'=>date('Y-m-d',strtotime("-1 day"))]);
		$conuter['yesterday'] = $objQueryY->fetchColumn();

		$strSQLM = $this->db->prepare(" SELECT SUM(NUM) FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = :tmon");
		$strSQLM->execute([':tmon'=>date('Y-m')]);
		$conuter['Tmonth'] = $strSQLM->fetchColumn();

		$strSQLLM = $this->db->prepare(" SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  =  :lmon");
		$strSQLLM->execute([':lmon'=>date('Y-m',strtotime("-1 month"))]);
		$conuter['Lmonth'] = $strSQLLM->fetchColumn();

		$strSQLA = $this->db->prepare(" SELECT SUM(NUM) FROM daily ");
		$strSQLA->execute();
		$conuter['All'] = $strSQLA->fetchColumn();

		if ($conuter['today'] == '') {
			$conuter['today'] = '0';
		}

		if ($conuter['yesterday'] == '') {
			$conuter['yesterday'] = '0';
		}

		if ($conuter['Tmonth'] == '') {
			$conuter['Tmonth'] = '0';
		}

		if ($conuter['Lmonth'] == '') {
			$conuter['Lmonth'] = '0';
		}

		if ($conuter['All'] == '') {
			$conuter['All'] = '0';
		}

		if ($conuter['Lmonth'] == '') {
			$conuter['Lmonth'] = '0';
		}

		return $conuter;

	}

	function counterall(){
		$stmt = $this->db->prepare("SELECT * FROM counter");
		$stmt->execute();
		return $stmt;
	}

	function history_topup(){
		$stmt = $this->db->prepare("SELECT * FROM history_topup");
		$stmt->execute();
		return $stmt;
	}

	function editfunt($id,$icon,$head,$detail){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("UPDATE function SET icon = :icon, head = :head, detail = :detail WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':icon'=>$icon,
				':head'=>$head,
				':detail'=>$detail
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function funt(){
		$stmt = $this->db->prepare("SELECT * FROM function");
		$stmt->execute();
		return $stmt;
	}

	function deletefunt($id){
		if ($_SESSION['status'] == 'admin') {
			$stmt = $this->db->prepare("DELETE FROM function WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else {
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function countpdrecom(){
		$stmt = $this->db->prepare("SELECT count(id) FROM recom_product");
		$stmt->execute();
		return $stmt;
	}

	function addpdrecom($no){
		$stm = $this->db->prepare("SELECT * FROM recom_product WHERE no_product = :no");
		$stm->execute([':no'=>$no]);
		$row = $stm->fetch();
		$count = $this->countpdrecom();
		$conutrow = $count->fetchColumn();
		if ($row['no_product'] == $no) {
			$msg = "คุณลงสินค้าชิ้นนี้ไปแล้ว";
		} elseif ($conutrow == 5) {
			$msg = "การแนะนำสินค้าจำนวนจำกัดแล้ว!! หากต้องการลงจริงๆ ให้ลบสินค้าแนะนำชิ้นอื่นออก";
		} else {
			$stmt = $this->db->prepare("INSERT INTO recom_product(no_product) VALUES (:no)");
			$stmt->execute([':no'=>$no]);
			$msg = "success";
		}
		return $msg;
	}

	function pdrecom(){
		$stmt = $this->db->prepare("SELECT * FROM recom_product");
		$stmt->execute();
		return $stmt;
	}

	function delete_pdrecom($id){
		$stmt = $this->db->prepare("DELETE FROM recom_product WHERE no_product = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function history_15(){
		$stmt = $this->db->prepare("SELECT * FROM history_topup ORDER BY id DESC LIMIT 5;");
		$stmt->execute();
		return $stmt;
	}

	function history_shop(){
		$stmt = $this->db->prepare("SELECT * FROM stock WHERE owner != '' LIMIT 5;");
		$stmt->execute();
		return $stmt;
	}
}

?>