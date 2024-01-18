<?php
session_start();
error_reporting(0);
include '../config.php';
if (!isset($_SESSION['username']) && $_SESSION['role'] != 'srm keuangan') {
	header('location:login.php');
}
function umur($waktustart, $waktuend)
{
	$datetime1 = new DateTime($waktustart);
	$datetime2 = new DateTime($waktuend);
	$durasi = $datetime2->diff($datetime1)->days;

	return $durasi;
}

include 'template/header.php';
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
						<th>Persekot</th>
						<th>Uraian</th>
						<th>Status</th>
						<!-- <th class="d-none d-md-table-cell">Action</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysqli_query(
						$koneksi,
						"SELECT * FROM data_persekot WHERE status_persekot = 'Selesai' ORDER BY id ASC"
					);
					while ($r = mysqli_fetch_assoc($query)) {

						$waktustart = $r['tgl_dokumen'];
						$waktuend = date('d-m-Y h:i:sa');
						?>


						<tr>
							<td class="d-none d-xl-table-cell">
								<?php echo $no++; ?>
							</td>
							<td class="d-none d-xl-table-cell">
								<?php echo $r['nama_lengkap']; ?>
							</td>
							<td class="d-none d-xl-table-cell">
								<?php echo $r['dinas']; ?>
							</td>
							<td class="d-none d-xl-table-cell">
								<?php echo $r['unit']; ?>
							</td>
							<td class="d-none d-xl-table-cell">Rp
								<?php echo number_format(
									$r['persekot'],
									0,
									',',
									'.'
								); ?>
							</td>
							<td class="d-none d-xl-table-cell">
								<?php echo $r['uraian']; ?>
							</td>
							<td class="d-none d-xl-table-cell">
								<?php echo $r['status_persekot']; ?>
							</td>


							<?php if (isset($_POST['Update'])) {
								$update = mysqli_query(
									$koneksi,
									"UPDATE data_persekot SET dinas='" .
									$_POST['dinas'] .
									"', unit='" .
									$_POST['unit'] .
									"', tgl_dokumen='" .
									$_POST['tgl_dokumen'] .
									"',persekot='" .
									$_POST['persekot'] .
									"',uraian='" .
									$_POST['uraian'] .
									"',keterangan='" .
									$_POST['keterangan'] .
									"', status_persekot = 'Menunggu Konfirmasi' WHERE id='" .
									$_POST['id'] .
									"' "
								);
								if ($update) {
									echo "<script>alert('Data di Update')</script>";
									echo "<script>location='persekot.php'</script>";
								}
							} ?>
			</div>
		</div>
		</div>
		<?php
					}
					?>
	</tbody>
	</table>



	</div>
	</div>
</main>


<?php include 'template/footer.php'; ?>
</div>
</div>

<script src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	crossorigin="anonymous"></script>

</body>

</html>