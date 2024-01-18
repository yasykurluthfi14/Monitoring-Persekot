<?php 
	session_start();
	error_reporting(0);
	include 'config.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['role'] != "user"){
		header('location:../index.php');
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
          <li><a class="nav-link scrollto" href="#contact">Persekot</a></li>
          <li><a class="nav-link scrollto" href="history_user.php">History Persekot</a></li>
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

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
      <div class="container">

        <div class="section-title">
          <h2>What We Do</h2>
          <p>Magnam dolores commodi suscipit consequatur ex aliquid</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End What We Do Section -->

    <!-- ======= About Section ======= -->
    

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Persekot Pegawai</h2>
          <p>Form Penginputan Data</p>
        </div>

        

        <div class="row mt-5 justify-content-center">
          <div class="col-lg-10">
            <form action="backend/proses.php" method="POST" role="form" enctype="multipart/form-data">
              <div class="row">

              <div class="col-md-6 form-group">
                <input type="text" name="nama_lengkap" required readonly value="<?php echo ucwords($_SESSION['data']['nama']); ?>" class="form-control" id="name" placeholder="Nama Lengkap" required>
              </div>

              <div class="form-group col-md-6">
                <input type="file" class="form-control" name="dokumen" required>
              </div>

              <div class="my-3">
  
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
            </form>
          </div>

        </div>

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