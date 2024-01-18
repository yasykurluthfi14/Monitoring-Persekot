<?php
include '../config.php';

require_once('cetak1.php');


function umur($waktustart, $waktuend){
    $datetime1 = new DateTime($waktustart);
    $datetime2 = new DateTime($waktuend);
    $durasi = $datetime2->diff($datetime1)->days;

return $durasi;
}
$pdf = new PDF('L', 'mm','Letter');

$pdf->AddPage();
$pdf->setLeftMargin(5);
$pdf->SetFont('Times','B',14);
$pdf->Cell(0,9,'Monitoring Persekot Dinas Pegawai Per '.date('d M Y') ,0,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,'PT PLN (PERSERO)',0,1,'L');
$pdf->Cell(0,5,'Unit Induk Pembangunan',0,1,'L');
$pdf->Cell(0,5,'Sumatera Bagian Selatan',0,1,'L');
$pdf->setLeftMargin(5);


$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Times','B',9);
$pdf->SetFillColor(210, 180, 140);
$pdf->Cell(8,10,'No',1,0,'C',true);
$pdf->SetFillColor(135, 206, 235);
$pdf->Cell(40,10,'Nama',1,0,'C',true);
$pdf->SetFillColor(154, 205, 49);
$pdf->Cell(23,10,'Dinas',1,0,'C',true);
$pdf->SetFillColor(252, 192, 203);
$pdf->Cell(23,10,'Unit',1,0,'C',true);
$pdf->SetFillColor(154, 205, 49);
$pdf->Cell(30,10,'Tanggal Dokumen',1,0,'C',true);
$pdf->SetFillColor(102, 51, 153);
$pdf->Cell(30,10,'Tanggal Pelaporan',1,0,'C',true);
$pdf->SetFillColor(135, 206, 235);
$pdf->Cell(20,10,'Persekot',1,0,'C',true);
$pdf->SetFillColor(70, 130, 180);
$pdf->Cell(20,10,'Uraian',1,0,'C',true);
$pdf->SetFillColor(252, 192, 203);
$pdf->Cell(35,10,'Umur Persekot (Hari)',1,0,'C',true);
$pdf->SetFillColor(154, 205, 49);
$pdf->Cell(10,10,'I',1,0,'C',true);
$pdf->SetFillColor(154, 205, 49);
$pdf->Cell(10,10,'II',1,0,'C',true);
$pdf->SetFillColor(102, 51, 153);
$pdf->Cell(20,10,'Keterangan',1,1,'C',true);
$pdf->SetFont('Times','',8);


$no=1;
$total = 0;
$hari_ini = date('Y-m-d');

$hasil = mysqli_query($koneksi, "SELECT * FROM data_persekot WHERE status_persekot != 'Selesai'  order by id asc");
while ($data = mysqli_fetch_array($hasil)){
    $total += $data['persekot'];
    $waktustart = $data['tgl_dokumen'];
	$waktuend = date('d-m-Y h:i:sa');
    $umur = umur($waktustart, $waktuend);
    $cellWidth=20; //lebar sel
	$cellHeight=6; //tinggi sel satu baris normal
	
	//periksa apakah teksnya melibihi kolom?
	if($pdf->GetStringWidth($data['uraian']) < $cellWidth){
		//jika tidak, maka tidak melakukan apa-apa
		$line=1;
	}else{
		//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
		//dengan memisahkan teks agar sesuai dengan lebar sel
		//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
		
		$textLength=strlen($data['uraian']);	//total panjang teks
		$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
		$startChar=0;		//posisi awal karakter untuk setiap baris
		$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
		$textArray=array();	//untuk menampung data untuk setiap baris
		$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)
		
		while($startChar < $textLength){ //perulangan sampai akhir teks
			//perulangan sampai karakter maksimum tercapai
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
			($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($data['uraian'],$startChar,$maxChar);
			}
			//pindahkan ke baris berikutnya
			$startChar=$startChar+$maxChar;
			//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
			array_push($textArray,$tmpString);
			//reset variabel penampung
			$maxChar=0;
			$tmpString='';
			
		}
		//dapatkan jumlah baris
		$line=count($textArray);
	}


	
    //tulis selnya
    $pdf->SetFillColor(255,255,255);
	$pdf->Cell(8,($line * $cellHeight),$no++,1,0,'C',true); //sesuaikan ketinggian dengan jumlah garis
	$pdf->Cell(40,($line * $cellHeight),$data['nama_lengkap'],1,0,'C',true); //sesuaikan ketinggian dengan jumlah garis
	$pdf->Cell(23,($line * $cellHeight),$data['dinas'],1,0,'C',true);
    $pdf->Cell(23,($line * $cellHeight),$data['unit'],1,0,'C',true);
    $pdf->Cell(30,($line * $cellHeight),$data['tgl_dokumen'],1,0,'C',true);
    $pdf->Cell(30,($line * $cellHeight),$hari_ini,1,0,'C',true);
    $pdf->Cell(20,($line * $cellHeight),'Rp '.number_format($data['persekot'], 0, ',', '.'),1,0,'C');
	//memanfaatkan MultiCell sebagai ganti Cell
	//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
	//ingat posisi x dan y sebelum menulis MultiCell
	$xPos=$pdf->GetX();
	$yPos=$pdf->GetY();
	$pdf->MultiCell($cellWidth,$cellHeight,$data['uraian'],1,'L');
	
	//kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
	$pdf->SetXY($xPos + $cellWidth , $yPos);

	if ($data['tgl_dokumen'] == null) {
		$pdf->Cell(35,($line * $cellHeight),'0',1,0,'C',true);

	}elseif ($data['tgl_dokumen'] != null) {											
	
		if ((umur($waktustart, $waktuend) > 0 && umur($waktustart, $waktuend) < 25)) {
			$pdf->SetFillColor(115, 255, 216);
			$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);

		}elseif ((umur($waktustart, $waktuend) > 25 && umur($waktustart, $waktuend) < 29 )) {

			if ($data['status_dokumen'] == 1 && $data['status_dokumen2'] == 1 ) {
				$pdf->SetFillColor(115, 255, 216);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen'] == 1 || $data['status_dokumen2'] == 1) {
				$pdf->SetFillColor(255, 255, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen'] != 1 && $data['status_dokumen2'] != 1) {
				$pdf->SetFillColor(255, 255, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}

		}elseif ((umur($waktustart, $waktuend) >= 30  && umur($waktustart, $waktuend) < 55  )) {

			if ($data['status_dokumen'] == 1) {
				$pdf->SetFillColor(115, 255, 216);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen'] != 1) {
				$pdf->SetFillColor(255, 0, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}

		}elseif ((umur($waktustart, $waktuend) >= 55 && umur($waktustart, $waktuend) <= 59 )) {

			if ($data['status_dokumen'] == 1 && $data['status_dokumen2'] == 1 ) {	
				$pdf->SetFillColor(115, 255, 216);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen'] == 1 || $data['status_dokumen2'] == 1) {
				$pdf->SetFillColor(255, 255, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen'] != 1 && $data['status_dokumen2'] != 1) {
				$pdf->SetFillColor(255, 255, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}
			
		}elseif ((umur($waktustart, $waktuend) >= 60 )) {

			if ($data['status_dokumen2'] == 1) {
				$pdf->SetFillColor(115, 255, 216);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}elseif ($data['status_dokumen2'] != 1) {
				$pdf->SetFillColor(255, 0, 0);
				$pdf->Cell(35,($line * $cellHeight),umur($waktustart, $waktuend),1,0,'C',true);
			}
		}	
	}

	
    //sesuaikan ketinggian dengan jumlah garis

    if ($data['status_dokumen'] == 1) {

        $pdf->Cell(10,($line * $cellHeight),'Ada' ,1,0,'C');
        
    }else if($data['status_dokumen'] == 0){

        $pdf->Cell(10,($line * $cellHeight),'-' ,1,0,'C');
    }

    if ($data['status_dokumen2'] == 1) {

        $pdf->Cell(10,($line * $cellHeight),'Ada' ,1,0,'C');
        
    }else if($data['status_dokumen2'] == 0){

        $pdf->Cell(10,($line * $cellHeight),'-' ,1,0,'C');
    }

    $xPos=$pdf->GetX();
	$yPos=$pdf->GetY();

	$text = $data['keterangan'];
	$wak = $pdf->WordWrap($text,120);
	$pdf->MultiCell($cellWidth,($line * $cellHeight),$wak,1,'L');

	$pdf->SetXY($xPos + $cellWidth , $yPos);
	$pdf->Cell(35,($line * $cellHeight),'',0,1,'C');
}

$pdf->SetFont('Times','B',8);

$pdf->SetFillColor(252, 165, 3);
$pdf->Cell(154, 8, 'Total Jumlah Persekot', 1, 0, 'C',true);
$pdf->SetFillColor(252, 165, 3);
$pdf->Cell(20, 8, 'Rp '.number_format($total, 0, ',', '.') , 1, 0, 'C',true);
$pdf->SetFillColor(252, 165, 3);
$pdf->Cell(95, 8, ' ', 1, 0, 'C',true);

$pdf->Output();
// $pdf->Output('D','monitoring persekot.pdf');
?>