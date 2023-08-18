<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="gambar/ikon_pesawat.ico" type="image/x-icon">
    <link rel="stylesheet" href="library/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css">
    <title>Rute Penerbangan</title>
  </head>
  <body>
		<nav class="navbar bg-primary bg-gradient">
			<div class="container-lg">
				<a class="navbar-brand text-white" href="https://miftah-dev.netlify.app/">
					<img src="gambar/ikon_pesawat.ico" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
					MIF`s Route Flight
				</a>
			</div>
		</nav>
		<div class="container">
			<h1 class="mt-5">Pendaftaran Rute Penerbangan</h1>
			<!-- Awal Form -->
			<form action="process.php" method="post"> <!--form menggunakan method post -->
				<!-- input maskapai-->
				<div class="row mb-3">
					<label for="nama_maskapai" class="col-sm-2 col-form-label">Maskapai</label>
					<div class="col-sm-10">
						<input
							type="Text"
							class="form-control"
							id="nama_maskapai"
							name="nama_maskapai"
							required
						/>
					</div>
				</div>
				<!-- input bandara asal -->
				<div class="row mb-3">
					<label for="bandara_asal" class="col-sm-2 col-form-label"
						>Bandara Asal</label
					>
					<div class="col-sm-10">
						<select
							class="form-select"
							id="bandara_asal"
							name="bandara_asal"
							aria-label="Floating label select"
							required
						>
							<option selected>Pilih Bandara Asal</option>
							<option value="CGK">Soekarno-Hatta (CGK)</option>
							<option value="BDO">Husein Sastranegara (BDO)</option>
							<option value="MLG">Abdul Rachman Saleh (MLG)</option>
							<option value="SUB">Juanda (SUB)</option>
						</select>
					</div>
				</div>
				<!-- input bandara Tujuan -->
				<div class="row mb-3">
					<label for="bandara_tujuan" class="col-sm-2 col-form-label"
						>Bandara Tujuan</label
					>
					<div class="col-sm-10">
						<select
							class="form-select"
							id="bandara_tujuan"
							name="bandara_tujuan"
							aria-label="Floating label select"
							required
						>
							<option selected>Pilih Bandara Tujuan</option>
							<option value="DPS">Ngurah Rai (DPS)</option>
							<option value="UPG">Hasanuddin (UPG)</option>
							<option value="INX">Inanwatan (INX)</option>
							<option value="BTJ">Sultan Iskandarmuda (BTJ)</option>
						</select>
					</div>
				</div>
				<!-- input Harga Tiket-->
				<div class="row mb-3">
					<label for="harga" class="col-sm-2 col-form-label">Harga Tiket</label>
					<div class="col-sm-10">
						<input type="Text" class="form-control" id="harga_tiket" name="harga_tiket" required/>
					</div>
				</div>
				<div
					class="container mx-auto d-flex align-items-center justify-content-center"
				>
				<!-- Button untuk mengirimkan data ke process -->
					<button type="submit" class="btn btn-primary" style="width: 200px">
						Submit
					</button>
				</div>
			</form>
			<!-- Akhir dari form -->

			<!-- Awal Output Data-->
			<div class="container mt-5">
					<h2>Daftar Rute Tersedia</h2>
					<table class="table table-striped-columns">
							<thead>
									<tr>
											<th>Nama Maskapai</th>
											<th>Bandara Asal</th>
											<th>Bandara Tujuan</th>
											<th>Harga Tiket</th>
											<th>Pajak</th>
											<th>Total Harga Tiket</th>
									</tr>
							</thead>
							<tbody class="table-group-divider">
									<?php
									// penginisialisasian dari kode menjadi nama bandara lengkap
									$bandara_names = [
												"CGK" => "Soekarno-Hatta (CGK)",
												"BDO" => "Husein Sastranegara (BDO)",
												"MLG" => "Abdul Rachman Saleh (MLG)",
												"SUB" => "Juanda (SUB)",
												"DPS" => "Ngurah Rai (DPS)",
												"UPG" => "Hasanuddin (UPG)",
												"INX" => "Inanwatan (INX)",
												"BTJ" => "Sultan Iskandarmuda (BTJ)",
										];
									// mengambil data dari json kemudian ditampilkan ke dalam sebuah tabel
									$data = json_decode(file_get_contents("data.json"), true);
									foreach ($data as $row) {
											echo "<tr>";
											foreach ($row as $index => $value) {
													if (($index == 1 || $index == 2) && isset($bandara_names[$value])) {
															echo "<td>{$bandara_names[$value]}</td>";
													} else {
															echo "<td>$value</td>";
													}
											}
											echo "</tr>";
									}
									?>
	
							</tbody>
					</table>
			</div>
		</div>
    <script src="library/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
