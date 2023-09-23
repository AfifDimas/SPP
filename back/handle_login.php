<?php 

include "koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$db = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$data     = result($db);
        
// check username
if (count($data) == 0) {
    echo "Username tidak ditemukkan";
    exit();
}

// cek password
$password_db = $data[0]['password'];
if (password_verify($password,$password_db) === FALSE) {
    echo "Password Salah";
    exit();
}

		$_SESSION['username'] = $data[0]['username'];
		$_SESSION['nama'] = $data[0]['nama'];
		$_SESSION['foto'] = $data[0]['foto'];
		$_SESSION['id_user'] = $data[0]['id_user'];
		$_SESSION['jabatan'] = $data[0]['jabatan'];
		echo "login berhasil";

// $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

// if (mysqli_num_rows($sql) != 1) {
// 	echo "username tidak dapat ditemukan";
// 	exit;
// }
// 	$row = mysqli_fetch_assoc($sql);
// 	if (password_verify($password, $row['password']) == FALSE) {
// 		echo "password salah";
// 		exit;
// 	}
// 		$_SESSION['username'] = $row['username'];
// 		$_SESSION['nama'] = $row['nama'];
// 		$_SESSION['username'] = $row['username'];
// 		$_SESSION['jabatan'] = $row['jabatan'];
// 		$_SESSION['jabatan'] = $row['jabatan'];
// 		$_SESSION['email'] = $row['email'];
		// echo "login berhasil $password";


 ?>