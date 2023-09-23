<?php 

	include "../koneksi.php";
	require '../../vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


$id_kelas = $_POST['id_kelas'];
$id_angkatan =$_POST['id_angkatan'];

$target_dir = "../../assets/uploads/";

$nama_file  = $_FILES["file"]["name"];
$target_file = $target_dir . basename($nama_file);


$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($imageFileType != "xlsx") {
    echo "File Harus Berformat Excel.";
    exit();
}


if ($_FILES["file"]["size"] > 500000) {
    echo "File Anda Terlalu Besar.";
    exit();

  }
  
$new_file = $target_dir.time().".".$imageFileType;
$uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $new_file);

$reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($new_file);
$worksheet 				= $spreadsheet->getActiveSheet();


    // Hitung Baris number
    $highestRow 			= $worksheet->getHighestRow();
    // Highest Colom Alpabhet string
    $highestColumn 			= $worksheet->getHighestColumn();
   	// Highest index colom number
    $highestColumnIndex 	= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
    $kolom_str                  = array("nama","jenis_kelamin","alamat","telepon");
    // array output
    $hasil                  = array();
    for ($baris=1; $baris <= $highestRow ; $baris++) { 
        if ($baris == 1) {
            continue;
        }
        $hasil_baris    = array();
        // baris
        for($kolom=1;$kolom <= $highestColumnIndex; $kolom++){
            $hasil_baris[$kolom_str[$kolom-1]] = $worksheet->getCellByColumnAndRow($kolom, $baris)->getFormattedValue();
        }
        $hasil[]    = $hasil_baris;

    }
    foreach($hasil as $h) {
        $sql = mysqli_query($conn, ("INSERT INTO siswa(nama, id_kelas, jenis_kelamin, alamat, telepon, id_angkatan) VALUES 
        (\"".$h['nama']."\",'$id_kelas',\"".$h['jenis_kelamin']."\",\"".$h['alamat']."\",\"".$h['telepon']."\", '$id_angkatan')"));
    }
    
    unlink($new_file);
    
    echo "Import Siswa Berhasil";
