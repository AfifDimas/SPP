<?php 

include "koneksi.php";

$id = $_POST['id'];
$passLama = $_POST['passLama'];
$passBaru = $_POST['passBaru'];
$konfirmasiPass = $_POST['konfirmasiPass'];


$querySelect = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id'");
$result = mysqli_fetch_assoc($querySelect);

// cocokan password lama dengan yang di database
if(password_verify($passLama, $result['password']) === FALSE) {
    echo "password lama yang anda masukan salah";
    exit();
}

if($passBaru != $konfirmasiPass) {
    echo "konfirmasi password yang anda masukan salah";
    exit();
}

$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "UPDATE users SET password = '$passBaru' WHERE id_user = '$id'");

echo "Password berhasil di ganti";