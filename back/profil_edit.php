<?php 

include "koneksi.php";

// if ($_FILES['foto'] == false) {
// 	echo "foto tidak diubah";
// }else{
	$foto = $_FILES['foto']['name'];
	$ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
	$filename = date('dmyhis').'.'.$ext;
	$lokasi = $_FILES['foto']['tmp_name'];
    $folder = "../assets/img/img_profil/";
    move_uploaded_file($lokasi, $folder.$filename);

	echo "berhasil";


	


 ?>