<?php 
	session_start();
	error_reporting(0);
	include '../config.php';
	if(!isset($_SESSION['username']) && $_SESSION['role'] != "admin"){
		header('location:login.php');
	}
 ?>
<?php
include 'template/header.php'
?>
            
            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Kelola</strong> Admin</h1>
					<a class="badge bg-success" type="button " data-toggle="modal" data-target="#tambah_user"><i data-feather="user-plus"></i> Tambah Admin</a>
					<br>
					<br>
					<div class="row">
						<div class="card-header">
							
						</div>
								<table class="table table-hover my-0" id="example">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th class="d-none d-xl-table-cell">Username</th>
											<th class="d-none d-xl-table-cell">Email</th>
											<th>Role</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM login WHERE role = 'admin' ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['username']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['email']; ?></td>
											<td><span class="badge bg-warning"><?php echo $r['role']; ?></span></td>
											<td class="d-none d-md-table-cell">
												<a class="badge bg-primary" type="button " data-toggle="modal" data-target="#exampleModal<?php echo $r['id'] ?>"><i  data-feather="edit"></i>  More</a>  <a class="badge bg-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="kelola_user.php?p=user_hapus&id=<?php echo $r['id'] ?>"><i  data-feather="delete"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="exampleModal<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
													<div class="mb-3">
														<label class="form-label">Nama</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['nama'] ?>" name="nama" placeholder="Enter your name" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Username</label>
														<input class="form-control form-control-lg" type="text" value="<?php echo $r['username'] ?>" name="username" placeholder="Enter your username" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Email</label>
														<input class="form-control form-control-lg" type="email" value="<?php echo $r['email'] ?>" name="email" placeholder="Enter your email" required />
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="Update" value="Simpan" class="btn btn-success">Kirim</button>
													</div>
													</form>

													<?php 
														if(isset($_POST['Update'])){
															$update=mysqli_query($koneksi,"UPDATE login SET nama='".$_POST['nama']."',username='".$_POST['username']."',email='".$_POST['email']."',role='".$_POST['role']."' WHERE id='".$_POST['id']."' ");
															if($update){
																echo "<script>alert('Data di Update')</script>";
																echo "<script>location='kelola_admin.php'</script>";
															}
														}
													?>
												</div>
											</div>
										</div>
										<?php } ?>
									</tbody>
								</table>



										<div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">
													<div class="mb-3">
														<label class="form-label">Nama Lengkap</label>
														<input class="form-control form-control-lg" type="text" name="nama" placeholder="Enter your name" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Username</label>
														<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Email</label>
														<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" required />
													</div>
													<div class="mb-3">
														<label class="form-label">Password</label>
														<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" required />
													</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="input" value="Simpan" class="btn btn-success">Kirim</button>
													</div>
													</form>

													<?php 
													if(isset($_POST['input'])){
														$id = $_POST['id'];
														$nama = $_POST['nama'];
														$username = $_POST['username'];
														$password = md5($_POST['password']);
														$email = $_POST['email'];
														$role = 'user';

														$query=mysqli_query($koneksi, "INSERT INTO login (id, nama, username, password, email, role)
														VALUES ('$id','$nama','$username','$password','$email','$role')");
														if($query){
															echo "<script>alert('Data Ditambahkan')</script>";
															echo "<script>location='kelola_admin.php'</script>";
														}
													}
												?>
												</div>
											</div>
										</div>
					</div>

				</div>
			</main>
			<?php
            if ($_GET['p'] == "user_hapus") {
				
	            $query = mysqli_query($koneksi, "DELETE FROM login WHERE id='" . $_GET['id'] . "'");
	            if ($query) {
		            header('location:kelola_admin.php');
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