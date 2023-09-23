<?php
include 'koneksi.php';
error_reporting(0);
include "../view/V_head.php";
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
$tgl1 = date($_POST['tanggal1']." 1:00:00");
$tgl2 = date($_POST['tanggal2']." 23:00:00");
$spreadsheet = new Spreadsheet();
$sheet =$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->mergeCells('A1:C1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Data Pendapatan');
 $sheet->setCellValue('A'.'2',"Tanggal:"." ");	
 $sheet->setCellValue('B'.'2',$_POST['tanggal1'].' - '.$_POST['tanggal2']);	
 $sheet->setCellValue('A'.'3',"Total:"." ");


 $query3 = mysqli_query($conn,"SELECT SUM(jumlah_dibayar)  
as total FROM pembayaranrecord where tanggal_bayar BETWEEN '$tgl1' AND '$tgl2'");
while($row3 = mysqli_fetch_assoc($query3))
{
	$sheet->setCellValue('C'.'3',"Rp".number_format($row3['total']));	
}
 

//Font Color
$spreadsheet->getActiveSheet()->getStyle('A4:C4')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

// Background color
    $spreadsheet->getActiveSheet()->getStyle('A4:C4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

// $spreadsheet->getNumberFormat()->setFormatCode('#,##0.00');
$sheet->setCellValue('A4', 'No');
$sheet->setCellValue('B4', 'Nama Pembayaran');
$sheet->setCellValue('C4', 'Pendapatan');
date_default_timezone_set('Asia/Jakarta');
$tgl_pinjam = date('Y-m-d');

$query = mysqli_query($conn,"SELECT nama_iuran,SUM(jumlah_dibayar)  
as total_didapat FROM pembayaranrecord where tanggal_bayar BETWEEN '$tgl1' AND '$tgl2'
GROUP BY nama_iuran");
$i = 5;
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	// $val = $row['isbn']; // Any long numerical text.

	// $rt = new RichText();
	// $rt->createText($val);

	// Adding the above to a cawaitell
	// $col = 'A'; $row = 2;

	$sheet->setCellValue('B'.$i, $row['nama_iuran']);
	$sheet->setCellValue('C'.$i, "Rp".number_format($row['total_didapat']));		
	$i++;
}
$sheet->getStyle('A:C')->getAlignment()->setHorizontal('center');
foreach(range('A','C') as $columnID) {
    $sheet->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i = $i - 1;

$sheet->getStyle('A4:C'.$i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);
date_default_timezone_set('Asia/Jakarta');
$writer->save('../assets/downloads/'.'laporan pembayaran '.date('d-m-Y').'.xlsx');
header('location:../assets/downloads/'.'laporan pembayaran '.date('d-m-Y').'.xlsx');


?>

