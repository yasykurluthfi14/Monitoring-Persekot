<?php
include('../config.php');
require('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();

function umur($waktustart, $waktuend){
       $datetime1 = new DateTime($waktustart);
       $datetime2 = new DateTime($waktuend);
       $durasi = $datetime2->diff($datetime1)->days;

return $durasi;
}

$query = mysqli_query($koneksi,"SELECT * FROM data_persekot WHERE status_persekot != 'Selesai'");

$html = '<h4>PT PLN (PERSERO)<br>UNIT INDUK PEMBANGUNAN<br>SUMATERA SELATAN</h4></><br/>';
$html .= '<center><p><b>MONITORING PERSEKOT DINAS PEGAWAI PER '.date('d-M-Y').'</b></p></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
       <th rowspan="2" style="background-color: sandybrown;">No</th>
       <th rowspan="2" style="background-color: skyblue;">Nama</th>
       <th rowspan="2" style="background-color: darkkhaki;">Pengguna Persekot Dinas</th>
       <th rowspan="2" style="background-color: lightpink;">Unit</th>
       <th rowspan="2" style="background-color: darkkhaki;">Tanggal Dokumen</th>
       <th rowspan="2" style="background-color: mediumpurple;">Tanggal Pelaporan</th>
       <th rowspan="2" style="background-color: skyblue;">Persekot</th>
       <th rowspan="2" style="background-color: dodgerblue;">Uraian</th>
       <th rowspan="2" style="background-color: lightpink;">Umur Persekot (Hari)</th>
       <th colspan="2" style="background-color: darkkhaki;">Surat Perpanjangan</th>
       <th rowspan="2" style="background-color: mediumorchid;">Keterangan</th>
 </tr>';

$html .= 
 '<tr>
       <th style="background-color: darkkhaki;">I</th>
       <th style="background-color: darkkhaki;">II</th>
 </tr>';

$total = 0;
$no = 1;
while ($row = mysqli_fetch_array($query)) {
       $total += $row['persekot'];
	$waktustart = $row['tgl_dokumen'];
	$waktuend = date('d-m-Y h:i:sa');
    $html .=
        "<tr>
 <td>" .
        $no .
        "</td>
 <td>" .
        $row['nama_lengkap'] .
        "</td>
 <td>" .
        $row['dinas'] .
        "</td>
 <td>" .
        $row['unit'] .
        "</td>
 <td>" .
        $row['tgl_dokumen'] .
        "</td>
 <td>" .
        date('Y-m-d').
        "</td>
 <td>" .
        $row['persekot'] .
        "</td>
 <td>" .
        $row['uraian'] .
        "</td>

" .(($row['tgl_dokumen'] == null) ? 
       "<td style='background-color: Aquamarine;'> 0 </td>"  : " " )."

" .(($row['tgl_dokumen'] != null) && (umur($waktustart, $waktuend) > 0 && umur($waktustart, $waktuend) < 2500) ? 
       "<td style='background-color: Aquamarine;'>".umur($waktustart, $waktuend)."</td>"  : " " )."

" .(($row['tgl_dokumen'] != null) && (umur($waktustart, $waktuend) > 25 && umur($waktustart, $waktuend) < 29 ) ? 
       "<td style='background-color: Aquamarine;'>".umur($waktustart, $waktuend)."</td>"  : " " )."

" .($row['status_dokumen'] == 1 ? "<td>Ada</td>"  : "<td>Tidak Ada</td>" )."

" .($row['status_dokumen2'] == 1 ? "<td>Ada</td>"  : "<td>Tidak Ada</td>" )."

<td>" .
        $row['keterangan'] .
        "</td>

 </tr>";

 

//  if ($row['tgl_dokumen'] == null) {
//        echo
//        '<td class="d-none d-md-table-cell">0</td>';
       
// }elseif ($r['tgl_dokumen'] != null) {
       
//        if ((umur($waktustart, $waktuend) > 0 && umur($waktustart, $waktuend) < 25)) {
//               echo
//               '<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';

//        } elseif ((umur($waktustart, $waktuend) > 25 && umur($waktustart, $waktuend) < 29 )) {
//               echo
//               '<td class="d-none d-md-table-cell" style="background-color: yellow;" >'. umur($waktustart, $waktuend).'</td>';

//        } elseif ((umur($waktustart, $waktuend) >= 30  && umur($waktustart, $waktuend) < 55  )) {

//               if ($r['status_dokumen'] == 1) {
//                      echo
//                      '<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';
//               }elseif ($r['status_dokumen'] != 1) {
//                      echo
//                      '<td class="d-none d-md-table-cell" style="background-color: red;" >'. umur($waktustart, $waktuend).'</td>';
//               }

//        } elseif ((umur($waktustart, $waktuend) >= 55 && umur($waktustart, $waktuend) <= 59 )) {
//               echo
//               '<td class="d-none d-md-table-cell" style="background-color: yellow;" >'. umur($waktustart, $waktuend).'</td>';
              
//        }elseif ((umur($waktustart, $waktuend) >= 60 )) {

//               if ($r['status_dokumen2'] == 1) {
//                      echo
//                      '<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';
//               }elseif ($r['status_dokumen2'] != 1) {
//                      echo
//                      '<td class="d-none d-md-table-cell" style="background-color: red;" >'. umur($waktustart, $waktuend).'</td>';
//               }
//        }
// }
    $no++;
}
$html .= 
 '<tr>
       <th colspan="6" style="background-color: gold;">Total Saldo Persekot</th>
       <th colspan="6" style="background-color: gold;">Rp '.number_format($total, 0, ',', '.') .'</th>
 </tr>';
$html .= '</html>';
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('letter', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('data_persekot.pdf');
?>
