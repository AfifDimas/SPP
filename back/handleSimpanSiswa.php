<?php 

	include "koneksi.php";

	$id_angkatan = $_POST['id_angkatan'];
	$id_kelas = $_POST['id_kelas'];
	$namaSiswa = $_POST['namaSiswa'];
	$alamat = $_POST['alamat'];
	$jenisKelamin = $_POST['jenisKelamin'];
	$noTelepon = $_POST['noTelepon'];


	$query = "INSERT INTO siswa (nama, id_kelas, jenis_kelamin, alamat, telepon, id_angkatan) VALUES ('$namaSiswa', '$id_kelas', '$jenisKelamin', '$alamat', '$noTelepon', '$id_angkatan')";
	$sql = mysqli_query($conn, $query);

	echo "siswa berhasil ditambahkan";

 ?>