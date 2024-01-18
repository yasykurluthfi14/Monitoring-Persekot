<?php 
	session_start();
	error_reporting(0);
	include '../config.php';
	if(!isset($_SESSION['username']) && $_SESSION['role'] != "user"){
		header('location:login.php');
	}
	function umur($waktustart, $waktuend){
		$datetime1 = new DateTime($waktustart);
		$datetime2 = new DateTime($waktuend);
		$durasi = $datetime2->diff($datetime1)->days;

	return $durasi;
	}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/Logo_PLN.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>PLN - Monitoring Persekot | Admin</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.semanticui.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      
      
    <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );
      
    </script>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row">
			<a class="sidebar-brand" href="dashboard_admin.php">
          <span class="align-middle"><img src="img/icons/Logo_pln_landscape.png" width="100px"></span>
        </a>

						<div class="text-center mt-4">
							<h1 class="h2">Monitoring Persekot Dinas Pegawai </h1>
							<p class="lead">
							
							</p>
						</div>

						<table class="ui celled table"  id="example" style="width: 100%;">
									<thead>
										<tr align="center">
											<th rowspan="2">No</th>
											<th rowspan="2">Nama</th>
											<th rowspan="2">Pengguna Persekot Dinas</th>
											<th rowspan="2">Unit</th>
											<th rowspan="2">Tanggal Dokumen</th>
											<th rowspan="2">Tanggal Pelaporan</th>
											<th rowspan="2" class="d-none d-md-table-cell">Persekot</th>
											<th rowspan="2" class="d-none d-md-table-cell">Uraian</th>
											<th rowspan="2" class="d-none d-md-table-cell">Umur Persekot (Hari)</th>
											<th colspan="2" class="d-none d-md-table-cell">Surat Perpanjangan</th>
											<th rowspan="2" class="d-none d-md-table-cell">Keterangan</th>
											
										</tr>
										<tr align="center">
											<th class="d-none d-md-table-cell">I</th>
											<th class="d-none d-md-table-cell">II</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
                                    	$total = 0;
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM data_persekot WHERE status_persekot != 'Selesai'  ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) {
	                                    	$total += $r['persekot'];
											$waktustart = $r['tgl_dokumen'];
											$waktuend = date('d-m-Y h:i:sa');
											?>

										
										<tr align="center">
											<td class="d-none d-xl-table-cell"><?php echo $no++ ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama_lengkap']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dinas']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['unit']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['tgl_dokumen']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo date('d-m-Y') ?></td>
											<td class="d-none d-xl-table-cell">Rp <?php echo number_format($r['persekot'], 0, ',', '.') ; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['uraian']; ?></td>
											
											<?php
											if ($r['tgl_dokumen'] == null) {
												echo
												'<td class="d-none d-md-table-cell">0</td>';
												
											}elseif ($r['tgl_dokumen'] != null) {
												
												if ((umur($waktustart, $waktuend) > 0 && umur($waktustart, $waktuend) < 25)) {
													echo
													'<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';

												} elseif ((umur($waktustart, $waktuend) > 25 && umur($waktustart, $waktuend) < 29 )) {
													echo
													'<td class="d-none d-md-table-cell" style="background-color: yellow;" >'. umur($waktustart, $waktuend).'</td>';

												} elseif ((umur($waktustart, $waktuend) >= 30  && umur($waktustart, $waktuend) < 55  )) {

													if ($r['status_dokumen'] == 1) {
														echo
														'<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';
													}elseif ($r['status_dokumen'] != 1) {
														echo
														'<td class="d-none d-md-table-cell" style="background-color: red;" >'. umur($waktustart, $waktuend).'</td>';
													}
							
												} elseif ((umur($waktustart, $waktuend) >= 55 && umur($waktustart, $waktuend) <= 59 )) {
													echo
													'<td class="d-none d-md-table-cell" style="background-color: yellow;" >'. umur($waktustart, $waktuend).'</td>';
													
												}elseif ((umur($waktustart, $waktuend) >= 60 )) {

													if ($r['status_dokumen2'] == 1) {
														echo
														'<td class="d-none d-md-table-cell" style="background-color: Aquamarine;" >'. umur($waktustart, $waktuend).'</td>';
													}elseif ($r['status_dokumen2'] != 1) {
														echo
														'<td class="d-none d-md-table-cell" style="background-color: red;" >'. umur($waktustart, $waktuend).'</td>';
													}
												}
											}
											?>
											
											<td class="d-none d-xl-table-cell">
											<?php 
											if ($r['status_dokumen'] == 1) {
		                                    	echo
		                                    	'&radic;';
											}else if($r['status_dokumen'] == 0){
												echo
												'&times;';
											}
											?>
											</td>
											<td class="d-none d-xl-table-cell">
											<?php 
											if ($r['status_dokumen2'] == 1) {
												echo
												'&radic;';
											} else if($r['status_dokumen2'] == 0){
												echo
												'&times;';
											}
											?>
											</td>
											<td class="d-none d-xl-table-cell"><?php echo $r['keterangan']; ?></td>
											
										</tr>

										
									
										<?php } ?>
									</tbody>
									<tfoot>
										<tr align="center">
											<th colspan="6" class="d-none d-md-table-cell">Total Saldo Persekot</th>
											<th colspan="6" class="d-none d-md-table-cell">Rp <?php echo number_format($total, 0, ',', '.') ?></th>
										</tr>
									</tfoot>
								</table>


								<div class="text-center mt-3">
								
								<a href="cetak1.php" style="float: left;" target="_blank" class="btn btn-lg btn-warning" >Cetak</a>
								<a href="dashboard_admin.php" style="float: right;" class="btn btn-lg btn-danger">Back</a>||
								<a href="../backend/proses_selesai.php?status=selesai&status=selesai" style="float: right;" onclick="return confirm('Apakah Anda Ingin Menyelesaikan Persekot?')" class="btn btn-lg btn-success" >Selesai</a>
								
								</div>
				
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>


