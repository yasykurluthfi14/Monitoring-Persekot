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
	<link rel="shortcut icon" href="assets/img/logo_PLN.png">

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>PLN | SIGN IN </title>

	<link href="admin/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
						<a href="index.php"><img src="assets/img/Logo_pln_landscape.png"  width="200"  /></a>
										
										<br>
										<br>
									
							<h1 class="h2">MONITORING PERSEKOT</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="POST"> 
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											
										</div>
										
										<div class="text-center mt-3">
											<button type="submit" name="login" value="Login" class="btn btn-lg btn-primary">Sign in</button>
											
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>


<?php 

include 'config.php';

error_reporting(0);

	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM login WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	

		if($cek>0){
			if($data['role']=="user"){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['role']='user';
			header('location:user/dashboard_user.php');
			}
			else if($data['role']=="admin"){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['role']='admin';
			header('location:admin/dashboard_admin.php');
			}
		}
		else{
			echo "<script>alert('Username atau Password Salah')</script>";
		}

	}
 ?>

