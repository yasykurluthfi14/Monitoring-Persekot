<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/Logo_PLN.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>PLN - Menu Admin</title>

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
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="dashoard_admin.php">
          <span class="align-middle"><img src="img/icons/Logo_pln_landscape.png" width="100px"></span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="dashboard_admin.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="persekot.php">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Persekot</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="monitoring_persekot.php">
              <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Monitoring Persekot</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="history_persekot.php">
              <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">History Persekot</span>
            </a>
					</li>

					<li class="sidebar-header">
						Kelola User
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="kelola_admin.php">
              <i class="align-middle" data-feather="corner-down-right"></i> <span class="align-middle">Admin</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="kelola_user.php">
              <i class="align-middle" data-feather="corner-down-right"></i> <span class="align-middle">User</span>
            </a>
					</li>

					
				</ul>

				

				<div class="sidebar-cta">
					
				</div>
				<br>
				<br>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg" >
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align"></ul>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
              <!--  <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> --><span class="text-dark"><?php echo ucwords($_SESSION['data']['nama']); ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log Out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav> 	