<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "spp";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
	echo "connection failed " . $conn->connect_error;
}

define('BASE_URL', 'http://localhost/spp/');

function result($data){
  $arr = array();
  while($k = mysqli_fetch_assoc($data)){
    $arr[] = $k;
  }
  return $arr;
}

 ?>