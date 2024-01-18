<?php 
	session_start();
	error_reporting(0);
	include '../config.php';
		
	$query = mysqli_query($koneksi, "SELECT * FROM data_persekot WHERE status_persekot != 'Selesai' ORDER BY id ASC");
	$data = mysqli_num_rows($query);

	$query2 = mysqli_query($koneksi, "SELECT * FROM data_persekot WHERE status_persekot = 'Selesai' ORDER BY id ASC");
	$data2 = mysqli_num_rows($query2);

	$query1 = mysqli_query($koneksi, "SELECT * FROM login  ORDER BY id ASC");
	$data1 = mysqli_num_rows($query1);

     
	$total_jumlah = $tot_bayar;

	if(!isset($_SESSION['username']) && $_SESSION['role'] != "srm keuangan"){
		header('location:login.php');
	}
	

	include 'template/header.php'
 ?>
            
            <main class="content">
				<div class="container-fluid p-0">
					
					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Data Persekot (Proses)</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="briefcase"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $data ?></h1>
												<div class="mb-0">
													<span class="text-muted">Pada Tanggal</span>
													 <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php echo date('d-m-Y') ?></span>							
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Jumlah User</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $data1 ?></h1>
												<div class="mb-0">
													<span class="text-muted">Pada Tanggal</span>
													 <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php echo date('d-m-Y') ?></span>							
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Data Persekot (Selesai)</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"> <?php echo $data2 ?></h1>
												<div class="mb-0">
													<span class="text-muted">Pada Tanggal</span>
													 <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php echo date('d-m-Y') ?></span>							
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Persekot</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<?php
												$query3 = mysqli_query($koneksi, "SELECT SUM(persekot) FROM data_persekot WHERE status_persekot != 'Selesai' ORDER BY id ASC");
												while($data3 = mysqli_fetch_array($query3) ){ ?>
												<h1 class="mt-1 mb-3">Rp <?php echo number_format($data3['SUM(persekot)'], 0, ',', '.') ; ?></h1>
											<?php } ?>
												<div class="mb-0">
													<span class="text-muted">Pada Tanggal</span>
													 <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php echo date('d-m-Y') ?></span>							
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
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
	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>