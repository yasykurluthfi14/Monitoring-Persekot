<?php 
	session_start();
	error_reporting(0);
	include '../config.php';

	$id = $_SESSION['data']['id'];
	$query = mysqli_query($koneksi, "SELECT * FROM login WHERE id = '$id' ");
	$data = mysqli_fetch_assoc($query);


	if(!isset($_SESSION['username']) && $_SESSION['role'] != "user"){
		header('location:login.php');
	}
	
	include 'template/header.php'
 ?>





			<main class="content">
				<div class="container-fluid p-0">
					
				

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Profile</h1>
						<a class="badge bg-success text-white ms-2" data-toggle="modal" data-target="#exampleModal" >
      Edit Profile
  </a>
					</div>

										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-md" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
												<form action="../backend/proses_profile.php" method="POST" role="form" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo ucwords($_SESSION['data']['id']); ?>">
													<div class="mb-3">
														<label class="form-label">Nama</label>
														<input class="form-control form-control-lg" type="text" name="nama" value="<?php echo ucwords($_SESSION['data']['nama']); ?>" placeholder="Nama" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Dinas</label>
														<input class="form-control form-control-lg" type="text" name="dinas" value="<?php echo ucwords($_SESSION['data']['dinas']); ?>" placeholder="Dinas" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Unit</label>
														<select name="unit" class="form-control form-control-lg" data-bs-toggle="dropdown" required>
															<option value="UPP Sumbagsel 1">UPP Sumbagsel 1</option>
															<option value="UPP Sumbagsel 2">UPP Sumbagsel 2</option>
															<option value="UPP Sumbagsel 3">UPP Sumbagsel 3</option>
														</select>
														
													</div>
													<div class="mb-3">
														<label class="form-label">Alamat</label>
														<input class="form-control form-control-lg" type="text" name="alamat" value="<?php echo ucwords($_SESSION['data']['alamat']); ?>" placeholder="Alamat" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Foto Profile</label>
														<input class="form-control form-control-lg" type="file" name="foto" value="<?php echo ucwords($_SESSION['data']['foto']); ?>" placeholder="Foto" required />
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-lg btn-primary">Submit</button>
													</div>
													</form>

												
												</div>
											</div>
										</div>








					<div class="row">
						<div class="col-md-8 col-xl-9">
							<div class="card mb-20">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Details</h5>
								</div>
								<div class="card-body text-center h-100">
									<img src="../assets/img/foto<?php echo $data['foto'] ?>" alt="Unknown" class="img-fluid rounded-circle mb-2" width="170" height="150" />
									<h5 class="card-title mb-0"><?php echo $data['nama'] ?></h5>
									<div class="text-muted mb-2"><?php echo $data['unit'] ?></div>

									
								</div>
								<hr class="my-0" />
								<div class="card-body text-center">
									<h5 class="h6 card-title">About</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#"><?php echo $data['alamat'] ?></a></li>

										<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">PLN Sumbagsel</a></li>
										<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Dinas <a href="#"><?php echo $data['dinas'] ?></a></li>
										<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Unit <a href="#"><?php echo $data['unit']?></a></li>
									</ul>
								</div>
								<hr class="my-0" />
								<div class="card-body text-center">
									<h5 class="h6 card-title">Elsewhere</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><a href="#">staciehall.co</a></li>
										<li class="mb-1"><a href="#">Twitter</a></li>
										<li class="mb-1"><a href="#">Facebook</a></li>
										<li class="mb-1"><a href="#">Instagram</a></li>
										<li class="mb-1"><a href="#">LinkedIn</a></li>
									</ul>
								</div>
							</div>
						</div>

				
						
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