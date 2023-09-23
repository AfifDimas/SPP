<?php 

	include "koneksi.php";

	date_default_timezone_set('Asia/Jakarta');

	$foto = $_FILES['foto']['name'];
	$ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
	$filename = date('dmyhis').'.'.$ext;
    $lokasi = $_FILES['foto']['tmp_name'];
    $folder = "../assets/img/img_profil/";
    move_uploaded_file($lokasi, $folder.$filename);

	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = password_hash($password, PASSWORD_DEFAULT);
	$jabatan = $_POST['jabatan'];

	if ($nama == "" or $email == "" or $username == "" or $password == "" or $jabatan == "" or $filename == "") {
		echo "gagal membuat akun baru";
	}else {
		$query = "INSERT INTO users (nama, username, password, email, jabatan, foto) VALUES ('$nama','$username','$password','$email','$jabatan','$filename')";
		$sql = mysqli_query($conn, $query);
		echo "berhasil menambahkan akun baru";
	}

	



?>