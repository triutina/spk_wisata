<?php
	include '../db/db_config.php';
	extract($_POST);
	if(isset($_FILES)){
		$target_dir = "../assets/foto_alternatif/";
		$file_name = $_FILES['foto']['name'];
		$target_file = $target_dir.basename($_FILES['foto']['name']);
		$file_type = $_FILES['foto']['type'];
		//print_r($_FILES);
		if(empty($file_type)){
			echo $file_type = substr($file_name, -3);
			if($file_type=='jpg' || $file_type=='gif' || $file_type=='jpeg'){
				$file_type = 'image/'.$file_type;
			} else {
				header('location:../edit_alternatif.php?error_msg=error_type&id='.$id_alternatif);
			}
		}
		if($file_type=='image/jpeg' || $file_type=='image/gif' || $file_type=='image/jpg'){
			//echo $_FILES['foto']['size'];
			if($_FILES['foto']['size'] < 10000000){
				if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
					if($db->update('alternatif',"nama='$nama',foto='$file_name',tgl_didirikan='$tgl',deskripsi='$deskripsi'")->where("id_alternatif='$id_alternatif'")->count()==1){
						header('location:../alternatif_show.php');
					} else {
						header('location:../edit_alternatif.php?error_msg=Gagal Update&id='.$id_alternatif);
					}
				} else {
					header('location:../edit_alternatif.php?error_msg=error_upload&id='.$id_alternatif);
				}
			} else {
				header('location:../edit_alternatif.php?error_msg=Gagal Update (Pastikan Format Foto Berupa jpeg/png/jpg dan Tidak Melebihi 1MB)&id='.$id_alternatif);
			} 
		} else {
			header('location:../edit_alternatif.php?error_msg=Gagal Update (Pastikan Format Foto Berupa jpeg/png/jpg dan Tidak Melebihi 1MB)&id='.$id_alternatif);
		}
	} else{
		if($db->update('alternatif',"nama='$nama',tgl_didirikan='$tgl',deskripsi='$deskripsi'")->where("id_alternatif='$id_alternatif'")->count()==1){
			header('location:../alternatif_show.php');
		} else {
			header('location:../edit_alternatif.php?error_msg=update_gagal&id='.$id_alternatif);
		}
	}
	
	
?>