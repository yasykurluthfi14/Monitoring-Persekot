<?php 
	session_start();
	error_reporting(0);
	include 'config.php';
	if(!isset($_SESSION['username'])){
		header('location:index.php');
	}
	elseif($_SESSION['role'] != "user"){
		header('location:index.php');
	}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PLN-Halaman User</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/Logo_PLN.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );
      
    </script>

  <!-- =======================================================
  * Template Name: Lumia - v4.9.1
  * Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html"><img src="assets/img/Logo_pln_landscape.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="halaman_user.php">Persekot</a></li>
          <li><a class="nav-link scrollto" href="#">History Persekot</a></li>
          <li class="dropdown"><a href="#">Selamat Datang<span style="color: orange;">&nbsp;<?php echo ucwords($_SESSION['data']['nama']); ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
              </li>
            </ul>
          </li>
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex align-items-center">
        <a href="https://twitter.com/pln_123" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/cc123pln" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/pln_id/" class="instagram"><i class="bi bi-instagram"></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>Portal PLN</span></h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>History Persekot</h2>
          <p>Data Persekot Anda</p>
        </div>

        <table class="table table-hover my-0" id="example">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th class="d-none d-md-table-cell">Dokumen 1</th>
                      <th class="d-none d-md-table-cell">Dokumen 2</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
                    include 'config.php';
                    $nama = ucwords($_SESSION['data']['nama']);
										$no=1;
										$query = mysqli_query($koneksi,"SELECT * FROM data_persekot WHERE nama_lengkap = '$nama' ORDER BY id ASC");
										while ($r=mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['nama_lengkap']; ?></td>
											<td class="d-none d-xl-table-cell"><?php echo $r['dokumen']; ?></td>
                      <td class="d-none d-xl-table-cell"><?php echo $r['dokumen2']; ?></td>
											<td class="d-none d-md-table-cell">
												<a class="badge bg-primary" type="button " data-toggle="modal" data-target="#exampleModal<?php echo $r['id'] ?>"><i  data-feather="edit"></i>  Input Dokumen 2</a>  <a class="badge bg-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=admin_hapus&id=<?php echo $r['id'] ?>"><i  data-feather="delete"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="exampleModal<?php echo $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Monitoring Persekot</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" enctype="multipart/form-data">

                          <input type="hidden" value="<?php echo $r['id'] ?>" name="id">
												
														<label for="">Dokumen 2</label>
														<div class="card-body">
															<input class="form-control" type="file" name="dokumen2">
														</div>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
														<button type="submit" name="kirim" value="Kirim" class="btn btn-success">Kirim</button>
													</div>
													</form>
												</div>
											</div>
									</div>
										<?php } ?>

                    <?php 
                        if(isset($_POST['kirim'])){
                          $id = $_POST['id'];

                          $rand = rand();
                          $ekstensi =  array('png','jpg','doc','pdf','xlsx');
                          $filename = $_FILES['dokumen2']['name'];
                          $ukuran = $_FILES['dokumen2']['size'];
                          $ext = pathinfo($filename, PATHINFO_EXTENSION);


                          if($query && $ukuran > 0){
                            $xx = $rand.'_'.$filename;
                            move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/dokumen2'.$rand.'_'.$filename);
                            $update=mysqli_query($koneksi,"UPDATE data_persekot SET  dokumen2 = '$xx' WHERE id ='$id'");
                            if($update){
                              echo "<script>alert('Dokumen Terkirim')</script>";
                              echo "<script>location='history_user.php ';</script>";
                            }
                          }
                        }
			               ?>
									</tbody>
								</table>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>PLN</h3>
            <p>
              Bukit Sangkal <br>
              Kec Kalidoni, Kota Palembang<br>
              Sumatera Selatan <br><br>
              <strong>Phone:</strong> +628122123123<br>
              <strong>Email:</strong> pln123@pln.co.id<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Layanan</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Pasang Baru</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sambungan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Ubah Daya</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Simulasi</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Informasi</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Promo</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Info Layanan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Status Permohonan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Entri Kode Konfirmasi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Gratis/Diskon Stimulus PSBB</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Informasi Tagihan Listrik / Pembelian Token</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p></p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Injectech</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/lumia-bootstrap-business-template/ -->
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/pln_123" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/cc123pln" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/pln_id" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>