<?php

include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');

	$total_dibayar = "0";
	$id_angkatan = $_POST['angkatan'];
	$nama_iuran = $_POST['nama_iuran'];
	$total_pembayaran = $_POST['jumlah_iuraninput'];
	$tanggal_bayar = date("Y-m-d H:i:s");

	if ($id_angkatan  ==  ""  or  $total_pembayaran  == "" or $nama_iuran == "") {
    	echo "Input Tidak Boleh Kosong";
	}else {
		$id_siswa = mysqli_query($conn, "SELECT siswa.nisn FROM kelas INNER JOIN siswa ON kelas.id = siswa.id_kelas WHERE kelas.id_angkatan = '$id_angkatan'");
		$result = result($id_siswa);
		$value = [];
		foreach ($result as $k) {
			$id_siswa = $k['nisn'];
			$value[] = "('$nama_iuran','$id_siswa','$tanggal_bayar','$total_pembayaran','$total_dibayar','Angsur')";
		}

		$query = "INSERT INTO pembayaran(nama_iuran, nisn, tanggal_pembayaran, total_pembayaran, total_dibayar, status) VALUES ".implode (',', $value);
		$insert = mysqli_query($conn, $query);
		echo "berhasil disimpan";
	}

