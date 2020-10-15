<?php
	include '../db/db_config.php';
	extract($_POST);
	if($db->insert('hasil_tpa',"'','$id_alternatif','$K1','$K2','$K3','$K4'")->count() == 1){
		header('location:../tpa_show.php');
	}
?>