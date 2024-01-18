<?php 
	session_start();
	error_reporting(0);
	include '../config.php';
	if(!isset($_SESSION['username']) && $_SESSION['role'] != "user"){
		header('location:login.php');
	}

	include 'template/header.php'
 ?>

            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Input Dokumen </strong>Persekot</h1>
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
											<th class="d-none d-md-table-cell">Dokumen 1</th>
                      						<th class="d-none d-md-table-cell">Dokumen 2</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>								
									</thead>
									<tbody>
									<?php
										$nama = ucwords($_SESSION['data']['nama']);
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM data_persekot WHERE nama_lengkap = '$nama' ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) { 
											$waktustart = $r['tgl_dokumen'];
											$waktuend = date('d-m-Y h:i:sa');
											?>

										<tr>
											<td><?php echo $no++; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama_lengkap']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dinas']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['unit']; ?></td>
											<td class="d-none d-xl-table-cell col-2"><?php echo $r['dokumen']; ?>
											<br>
											<br>
												<a class="badge bg-success" href="download.php?filename=dokumen1_<?php echo $r['dokumen'];?>" ><i  data-feather="download"></i> Unduh</a>
											</td>
                      						<td class="d-none d-xl-table-cell col-2"><?php echo $r['dokumen2']; ?>
												<br>
												<br>
												<a class="badge bg-success" href="download.php?filename=dokumen2_<?php echo $r['dokumen2'];?>" ><i  data-feather="download"></i> Unduh</a>
											</td>
											<td class="d-none d-md-table-cell">
												<a class="badge bg-primary" type="button " data-toggle="modal" data-target="#exampleModal1<?php echo $r['id'] ?>"><i  data-feather="file-plus"></i> Input Dokumen 1</a>
												<br>
												<br>
												<a class="badge bg-warning" type="button " data-toggle="modal" data-target="#exampleModal2<?php echo $r['id'] ?>"><i  data-feather="file-plus"></i> Input Dokumen 2</a> 
											</td>
										</tr>
										<div class="modal fade" id="exampleModal1<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Input Dokumen 1</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
													<input hidden type="text" name="unit" value="<?php echo ucwords($_SESSION['data']['unit']); ?>">
													<input hidden type="text" name="dinas" value="<?php echo ucwords($_SESSION['data']['dinas']); ?>">
													<div class="mb-3">
														<label class="form-label">Dokumen </label>
														<?php
															if ($r['status_persekot'] == 'Selesai') {
																echo
																'<input disabled class="form-control form-control-lg" type="file" name="dokumen"  required />';
															}elseif ($r['status_persekot'] != 'Selesai') {
																echo
																'<input class="form-control form-control-lg" type="file" name="dokumen"  required />';
															}
														?>
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="kirim1" value="Kirim1" class="btn btn-success">Submit</button>
													</div>
													</form>

													<?php 
														if(isset($_POST['kirim1'])){
														$id = $_POST['id'];
														$unit = $_POST['unit'];
														$dinas = $_POST['dinas'];
														$status_persekot = 'Konfirmasi Admin';
		                                    			$status = 1;

														
														$ekstensi =  array('png','jpg','doc','pdf','xlsx');
														$filename = $_FILES['dokumen']['name'];
														$ukuran = $_FILES['dokumen']['size'];
														$ext = pathinfo($filename, PATHINFO_EXTENSION);


														if($ukuran > 0){
															$xx = $filename;
															move_uploaded_file($_FILES['dokumen']['tmp_name'], '../assets/img/dokumen/dokumen1_'.$xx);
															$update=mysqli_query($koneksi,"UPDATE data_persekot SET unit ='$unit', dinas='$dinas', status_persekot = '$status_persekot', dokumen = '$xx' , status_dokumen = '$status' WHERE id ='$id'");
															if($update){
															echo "<script>alert('Dokumen Terkirim')</script>";
															echo "<script>location='input_dokumen.php ';</script>";
															}
														}
														}
													?>
												</div>
											</div>
										</div>
										
										<div class="modal fade" id="exampleModal2<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Input Dokumen 2</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
													<input hidden type="text" name="unit" value="<?php echo ucwords($_SESSION['data']['unit']); ?>">
													<input hidden type="text" name="dinas" value="<?php echo ucwords($_SESSION['data']['dinas']); ?>">
													<div class="mb-3">
														<label class="form-label">Dokumen 2</label>
														<?php
															if ($r['status_persekot'] == 'Selesai') {
																echo
																'<input disabled class="form-control form-control-lg" type="file" name="dokumen2"  required />';
															}elseif ($r['status_persekot'] != 'Selesai') {
																echo
																'<input class="form-control form-control-lg" type="file" name="dokumen2"  required />';
															}
														?>
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="kirim" value="Kirim" class="btn btn-success">Submit</button>
													</div>
													</form>

													<?php 
														if(isset($_POST['kirim'])){
														$id = $_POST['id'];
														$unit = $_POST['unit'];
														$dinas = $_POST['dinas'];
														$status_persekot = 'Konfirmasi Admin';
		                                    			$status = 1;

														$rand = rand();
														$ekstensi =  array('png','jpg','doc','pdf','xlsx');
														$filename = $_FILES['dokumen2']['name'];
														$ukuran = $_FILES['dokumen2']['size'];
														$ext = pathinfo($filename, PATHINFO_EXTENSION);


														if($ukuran > 0){
															$xx = $filename;
															move_uploaded_file($_FILES['dokumen2']['tmp_name'], '../assets/img/dokumen/dokumen2_'.$xx);
															$update=mysqli_query($koneksi,"UPDATE data_persekot SET unit ='$unit', dinas='$dinas', status_persekot = '$status_persekot', dokumen2 = '$xx' , status_dokumen2 = '$status' WHERE id ='$id'");
															if($update){
															echo "<script>alert('Dokumen Terkirim')</script>";
															echo "<script>location='input_dokumen.php ';</script>";
															}
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