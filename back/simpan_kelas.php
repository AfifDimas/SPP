<?php 

	include "koneksi.php";

	$namaKelas = $_POST['namaKelas'];
	$id_angkatan = $_POST['id_angkatan'];

	if ($id_angkatan == 1) {
		$kelas = 12;
	}elseif ($id_angkatan == 2) {
		$kelas = 11;
	}elseif ($id_angkatan == 3) {
		$kelas = 10;
	}

	$select = mysqli_query($conn, "SELECT * FROM kelas WHERE jurusan = '$namaKelas' and kelas = '$kelas'");
	if($sql = mysqli_fetch_assoc($select)){
		if ($sql['jurusan'] == $namaKelas) {
			echo "Kelas ini telah ada";
			exit;
		}
	}

	$query = "INSERT INTO kelas (jurusan, id_angkatan, kelas) VALUES ('$namaKelas', '$id_angkatan', '$kelas')";
	$sql = mysqli_query($conn, $query);
	echo "kelas berhasil ditambahkan";

 ?>