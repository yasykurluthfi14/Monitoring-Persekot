<?php
include '../config.php';

    if ($_GET['status'] == "selesai") {
				
	 $query = mysqli_query($koneksi, "UPDATE data_persekot SET status_persekot='".$_GET['status']."'");
	    if ($query) {
		    header('location:../admin/dashboard_admin.php');
	    }

    }
?>