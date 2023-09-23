<?php 
	include "koneksi.php";
	date_default_timezone_set('asia/jakarta');

	$nisn = $_POST['nisn'];
	$namaIuran = $_POST['namaIuran'];
	$jumlah_iuran = $_POST['jumlah_bayar'];

	$tanggalInput = date("Y-m-d H:i:s");
	$jumlahDibayar = 0;
	$status = "angsur";

	$query = "INSERT INTO pembayaran(nama_iuran, nisn, tanggal_pembayaran, total_pembayaran, total_dibayar, status) VALUES ('$namaIuran', '$nisn', '$tanggalInput', '$jumlah_iuran', '$jumlahDibayar', '$status')";
	$sql = mysqli_query($conn, $query);

	echo "iuran berhasil dibuat";



 ?>