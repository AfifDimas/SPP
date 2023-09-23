<?php 
	include "koneksi.php";

	$nama_iuran = $_POST['nama_iuran'];

	$query = "DELETE FROM pembayaran WHERE nama_iuran = '$nama_iuran'";
	$sql = mysqli_query($conn, $query);

	echo "pembayaran berhasil dihapus";


 ?>