<?php 
	session_start();
	error_reporting(0);
	include '../../config.php';
	if(!isset($_SESSION['username']) && $_SESSION['role'] != "user"){
		header('location:login.php');
	}
	function umur($waktustart, $waktuend){
		$datetime1 = new DateTime($waktustart);
		$datetime2 = new DateTime($waktuend);
		$durasi = $datetime2->diff($datetime1)->days;

	return $durasi;
	}

	include 'template/header.php'
 ?>

            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Data </strong> Persekot</h1>
					<br>
					<br>
					<div class="row">
						<div class="card-header">
							
						</div>
								<table class="ui celled table" id="example" style="width: 100%;">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Dinas</th>
											<th>Unit</th>
											<th>Tanggal Dokumen</th>
											<th>Tanggal Pelaporan</th>
											<th>Persekot</th>
											<th>Uraian</th>
											<th>Umur</th>
											<th>Keterangan</th>
											
										</tr>
										
									</thead>
									<tbody>
									<?php
                                    include '../config.php';
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM data_persekot  ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) { 
											$waktustart = $r['tgl_dokumen'];
											$waktuend = date('d-m-Y h:i:sa');
											?>

										
										<tr>
											<td class="d-none d-xl-table-cell"><?php echo $no++ ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama_lengkap']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dinas']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['unit']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['tgl_dokumen']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo date('d-m-Y') ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['persekot']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['uraian']; ?></td>
											
												<?php 
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
												?>
											
											
											
											<td class="d-none d-xl-table-cell"><?php echo $r['keterangan']; ?></td>
											
										</tr>
										
										<?php } ?>
									</tbody>
								</table>					
					</div>

				</div>
			</main>
			

			<?php
                include 'template/footer.php'
            ?>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	

</body>

</html>