<?php
	include '../db/db_config.php';
	extract($_POST);
	$target_dir = "../assets/foto_alternatif/";
	$file_name = $_FILES['foto']['name'];
	$target_file = $target_dir.basename($_FILES['foto']['name']);
	$file_type = $_FILES['foto']['type'];
	if($file_type=='image/jpeg' || $file_type=='image/png' || $file_type=='image/JPG' || $file_type=='image/JPG') {
		//echo $_FILES['foto']['size'];
		if($_FILES['foto']['size'] < 1000000){
			if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
				$db->insert('alternatif',"'','$nama','$file_name','$tgl','$deskripsi'")->count();
				header('location:../alternatif_show.php');
			} else {
				header('location:../input_alternatif.php?error_msg=error_upload');
			} 
		} else {
			header('location:../input_alternatif.php?error_msg=Gagal Input (Pastikan Format Foto Berupa jpeg/png/jpg dan Tidak Melebihi 1MB');
		} 
	} else {
		header('location:../input_alternatif.php?error_msg=Gagal Input (Pastikan Format Foto Berupa jpeg/png/jpg dan Tidak Melebihi 1MB');
	}
?>