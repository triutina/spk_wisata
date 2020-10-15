<?php
	include '../db/db_config.php';
	$id = $_GET['id'];
	if($db->delete('alternatif')->where('id_alternatif='.$id)->count() == 1){
		header('location:../alternatif_show.php');
	} else {
		header('location:../alternatif_show.php?error_msg=error_delete');
	}
?>