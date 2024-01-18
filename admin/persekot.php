<?php 
	session_start();
	error_reporting(0);
	include '../config.php';
	if(!isset($_SESSION['username']) && $_SESSION['role'] != "admin"){
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
											<th>Umur Persekot</th>
											<th>Dokumen 1</th>
											<th>Dokumen 2</th>
											<th>Uraian</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM data_persekot WHERE status_persekot != 'Selesai'  ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) { 
											$waktustart = $r['tgl_dokumen'];
											$waktuend = date('d-m-Y h:i:sa');
											?>

										
										<tr>
											<td class="d-none d-xl-table-cell"><?php echo $no++ ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama_lengkap']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dinas']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['unit']; ?></td>
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
										
											
											</td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dokumen']; ?>
												<br>
												<br>
												<a class="badge bg-success" href="download.php?filename=dokumen1_<?php echo $r['dokumen'];?>" ><i  data-feather="download"></i> Unduh</a>
											</td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dokumen2']; ?>
												<br>
												<br>
												<a class="badge bg-success" href="download.php?filename=dokumen2_<?php echo $r['dokumen2'];?>" ><i  data-feather="download"></i> Unduh</a>
											</td>
											<td class="d-none d-xl-table-cell"><?php echo $r['uraian']; ?></td>
											<td class="d-none d-md-table-cell col-3">
												<a class="badge bg-primary" type="button" data-toggle="modal" data-target="#exampleModal<?php echo $r['id'] ?>"><i  data-feather="eye"></i>  More</a> ||
												<a class="badge bg-warning" type="button" data-toggle="modal" data-target="#validasi<?php echo $r['id'] ?>"><i  data-feather="check"></i>  Validasi</a> ||
												<a class="badge bg-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="persekot.php?p=data_hapus&id=<?php echo $r['id'] ?>"><i  data-feather="delete"></i> Hapus</a>
											</td>
										</tr>


										<div class="modal fade" id="validasi<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Data Persekot</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
													<div class="col s12 m6 text-center">
													<p>Apakah Anda Yakin ingin Menyelesaikan Persekot?</p>	
													
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="Update2" value="Simpan" class="btn btn-primary">Submit</button>
													</div>
													</form>

													<?php 

														if(isset($_POST['Update2'])){
															$update=mysqli_query($koneksi,"UPDATE data_persekot SET  status_persekot = 'Selesai' WHERE id='".$_POST['id']."' ");
															if($update){
																echo "<script>alert('Data telah selesai')</script>";
																echo "<script>location='persekot.php'</script>";
															}
														}
													?>

													
												</div>
											</div>
										</div>
										
									</div>












										<div class="modal fade" id="exampleModal<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Data Persekot</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
													<div class="col s12 m6">
														<p>Tanggal Dokumen : <?php echo $r['tgl_dokumen']; ?></p>
														<p>Tanggal Pelaporan : <?php echo date('Y-m-d') ?></p>
														<p>Umur Persekot : <?php echo umur($waktustart,$waktuend)?> hari</p>
														<p>Dokumen 1 : 
														<?php 
														if ($r['status_dokumen'] == 1) {
															echo
															'&radic;';
														}else if($r['status_dokumen'] == 0){
															echo
															'&times;';
														}
														 ?>
														 </p>
														<p>Dokumen 2 : 
														<?php 
														if ($r['status_dokumen2'] == 1) {
															echo
															'&radic;';
														}else if($r['status_dokumen2'] == 0){
															echo
															'&times;';
														}
														?>
														</p>



													</div>
													<div class="modal-footer">
													<h5 class="modal-title" id="exampleModalLabel">Edit Persekot</h5>
													</div>
													<div class="mb-3">
														<label class="form-label">Dinas</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['dinas']; ?>" name="dinas" placeholder="Dinas"  />
													</div>
													<div class="mb-3">
														<label class="form-label">Unit</label>
														<select name="unit" class="form-control form-control-lg" data-bs-toggle="dropdown" >
															<option value="UPP Sumbagsel 1">UPP Sumbagsel 1</option>
															<option value="UPP Sumbagsel 2">UPP Sumbagsel 2</option>
															<option value="UPP Sumbagsel 3">UPP Sumbagsel 3</option>
														</select>
														
													</div>
													<div class="mb-3">
														<label class="form-label">Tanggal Dokumen</label>
														<input class="form-control form-control-lg" type="date" value="<?php echo $r['tgl_dokumen']; ?>"  name="tgl_dokumen" placeholder="Date"  />
													</div>
													<div class="mb-3">
														<label class="form-label">Persekot</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['persekot']; ?>" name="persekot" placeholder="Persekot"  />
													</div>
													<div class="mb-3">
														<label class="form-label">Uraian</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['uraian']; ?>" name="uraian" placeholder="Uraian" />
													</div>
													<div class="mb-3">
														<label class="form-label">Keterangan</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['keterangan']; ?>" name="keterangan" placeholder="Keterangan"  />
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="Update1" value="Simpan" class="btn btn-success">Kirim</button>
													</div>
													</form>

													<?php 
														if(isset($_POST['Update1'])){
															$update=mysqli_query($koneksi,"UPDATE data_persekot SET dinas='".$_POST['dinas']."', unit='".$_POST['unit']."', tgl_dokumen='".$_POST['tgl_dokumen']."',persekot='".$_POST['persekot']."',uraian='".$_POST['uraian']."',keterangan='".$_POST['keterangan']."', status_persekot = 'Menunggu Konfirmasi' WHERE id='".$_POST['id']."' ");
															if($update){
																echo "<script>alert('Data di Update')</script>";
																echo "<script>location='persekot.php'</script>";
															}
														}

														if(isset($_POST['Update2'])){
															$update=mysqli_query($koneksi,"UPDATE data_persekot SET  status_persekot = 'Selesai' WHERE id='".$_POST['id']."' ");
															if($update){
																echo "<script>alert('Data di Update')</script>";
																echo "<script>location='persekot.php'</script>";
															}
														}
													?>

													
												</div>
											</div>
										</div>
										<?php } ?>
									</tbody>
								</table>

								
				</div>
			</main>
			<?php
            if ($_GET['p'] == "data_hapus") {
				
	            $query = mysqli_query($koneksi, "DELETE FROM data_persekot WHERE id='" . $_GET['id'] . "'");
	            if ($query) {
					echo "<script>alert('Data Berhasil Dihapus')</script>";
		            echo "<script>location='persekot.php'</script>";
	            }

            }

			?>

			<?php
                include 'template/footer.php'
            ?>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	

</body>

</html>