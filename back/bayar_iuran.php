<?php 
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');

	$id = $_POST['id_pembayaran'];
	$queryselect = "SELECT * FROM pembayaran WHERE id_pembayaran = '$id'";
	$sqlselect = mysqli_query($conn, $queryselect);
	$result = mysqli_fetch_assoc($sqlselect);
	$tanggal_bayar = date("Y-m-d H:i:s");
	$jumlah = $_POST['total_bayar'];
	$kurang = $result['total_pembayaran'] - $result['total_dibayar'];
	if ($jumlah > $kurang) {
		echo "uang yang dibayarkan terlalu banyak";
		return;
	}
	$status = "angsur";

	if ($jumlah == $kurang) {
		$status = "lunas";
	}
	

	if ($id == "" or $jumlah == "") {
		echo "isi tidak boleh kosong";
	} else {
		
		$query = "UPDATE pembayaran SET total_dibayar = total_dibayar+'$jumlah', tanggal_pembayaran = '$tanggal_bayar', status = '$status' WHERE id_pembayaran = '$id'";
		$insert = mysqli_query($conn, $query);
		// input record
		
		$nisn = $result['nisn'];
		$show = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'"));
		$id_angkatan = $show['id_angkatan'];
		$nama_iuran = $result['nama_iuran'];
		$queryrecord ="INSERT INTO pembayaranrecord (nisn, id_angkatan, nama_iuran, jumlah_dibayar, tanggal_bayar) VALUES ('$nisn','$id_angkatan','$nama_iuran','$jumlah','$tanggal_bayar')";
		

		$record = mysqli_query($conn, $queryrecord);
		echo "berhasil disimpan";
	}




 ?>