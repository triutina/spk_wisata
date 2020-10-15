<?php
	include '../db/db_config.php';
	extract($_POST);
	$pass = $password;
	$sql = $db->select('*','user')->where("username='$username' and password='$pass'");
	$check = $sql->count();
	if($check==1){
		foreach ($sql->get() as $data) {
			$id_user = $data['id_user'];
			
		}
		session_start();
		$_SESSION['id'] = $id_user;
		$_SESSION['name'] = $username;
		
		header('location:../index.php');       
	} else {
?>
			<script type="text/javascript">
				alert("Anda gagal login!!");
				window.location='../login.php';
			</script>
		<?php
			}
?>