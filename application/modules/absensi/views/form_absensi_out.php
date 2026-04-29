<!doctype html>
<html lang="en" class="fixed">
	<head>
		<?php echo $this->Templates->Header();?>

		<style type="text/css">
			body{
				font-family: helvetica;
			}
			.table-center th, .table-center td{
				text-align:center;
			}

			button {
                border: none;
                border-radius: 5px;
                padding: 5px;
                font-size: 12px;
                text-transform: uppercase;
                cursor: pointer;
                color: white;
                background-color: #2196f3;
                box-shadow: 0 0 4px #999;
                outline: none;
            }

            .ripple {
                background-position: center;
                transition: background 0.8s;
            }
            .ripple:hover {
                background: #47a7f5 radial-gradient(circle, transparent 1%, #47a7f5 1%) center/15000%;
            }
            .ripple:active {
                background-color: #6eb9f7;
                background-size: 100%;
                transition: background 0s;
            }
		</style>
	</head>

	<body>
		<div class="wrap">
			<?php echo $this->Templates->PageHeader();?>
			<div class="page-body">
				<div class="content" style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
					<div class="row animated fadeInUp">
						<div class="col-sm-12 col-lg-12">
							<div class="panel">
								<div class="panel-header"> 
									<div class="text-left">
                                        <a href="<?php echo site_url('admin');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
									<div class="text-center">
										<h3><b>Form Absensi</b></h3>
									</div>
								</div>
								<div class="panel-content">
									<form method="POST" action="<?= site_url('absensi/submit_clock_out'); ?>" id="form-po">
										<input type="hidden" name="lat" id="lat">
										<input type="hidden" name="lon" id="lon">
										<div class="text-center" style="margin-bottom: 20px;">
											<div id="camera_container">
												<video id="webcam" autoplay playsinline width="300" style="border-radius: 10px; border: 2px solid #ddd;"></video>
											</div>
											
											<div id="preview_container" style="display:none;">
												<canvas id="canvas" width="300" height="225" style="border-radius: 10px; border: 2px solid #2196f3;"></canvas>
											</div>

											<br>
											<button type="button" id="btn-ambil" onclick="snap()" class="btn btn-info" style="margin-top:10px;">
												<i class="fa fa-camera"></i> Ambil Foto
											</button>
											<button type="button" id="btn-ulang" onclick="ulangFoto()" class="btn btn-warning" style="margin-top:10px; display:none;">
												<i class="fa fa-rotate"></i> Foto Ulang
											</button>

											<input type="hidden" name="image_data" id="image_data">
										</div>
										<div class="text-center">
											<button type="button" onclick="prosesAbsen('clock_out')" class="btn btn-danger" style="width:150px; font-weight:bold; border-radius:10px;">Clock-Out</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>
		
		<?php echo $this->Templates->Footer(); ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/jquery.number.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/bootbox.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
        <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

		<script type="text/javascript">
			$('#form-po').submit(function(e){
				e.preventDefault();
				var currentForm = this;
				bootbox.confirm({
					message: "Apakah anda yakin clock-in sekarang ?",
					buttons: {
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						},
						cancel: {
							label: 'No',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if(result){
							currentForm.submit();
						}
						
					}
				});
				
			});
		</script>
		<script>
			const video = document.getElementById('webcam');
			const canvas = document.getElementById('canvas');
			const imageDataInput = document.getElementById('image_data');
			const cameraContainer = document.getElementById('camera_container');
			const previewContainer = document.getElementById('preview_container');
			const btnAmbil = document.getElementById('btn-ambil');
			const btnUlang = document.getElementById('btn-ulang');

			// Aktifkan Kamera saat halaman dimuat
			navigator.mediaDevices.getUserMedia({ video: true, audio: false })
				.then(function(stream) {
					video.srcObject = stream;
				})
				.catch(function(err) {
					alert("Kamera tidak dapat diakses atau izin ditolak.");
				});

			// Fungsi saat tombol "Ambil Foto" diklik
			function snap() {
				const context = canvas.getContext('2d');

				// --- PENGATURAN RESOLUSI ---
				const lebarTarget = 300; // Tentukan lebar foto yang diinginkan (dalam pixel)
				const skala = lebarTarget / video.videoWidth;
				const tinggiTarget = video.videoHeight * skala;

				// Set ukuran internal canvas (ini menentukan ukuran file gambar)
				canvas.width = lebarTarget;
				canvas.height = tinggiTarget;

				// Gambar ulang video ke canvas dengan ukuran baru yang sudah disesuaikan
				context.drawImage(video, 0, 0, lebarTarget, tinggiTarget);

				// Simpan ke input hidden dengan kompresi 0.7 (70% kualitas)
				const dataUrl = canvas.toDataURL('image/jpeg', 0.7);
				imageDataInput.value = dataUrl;

				// Tukar tampilan kamera dengan hasil foto
				cameraContainer.style.display = 'none';
				previewContainer.style.display = 'block';
				btnAmbil.style.display = 'none';
				btnUlang.style.display = 'inline-block';
			}

			// Fungsi jika ingin foto ulang
			function ulangFoto() {
				imageDataInput.value = ""; // Kosongkan data lama
				cameraContainer.style.display = 'block';
				previewContainer.style.display = 'none';
				btnAmbil.style.display = 'inline-block';
				btnUlang.style.display = 'none';
			}

			// Modifikasi fungsi prosesAbsen lama Anda
			function prosesAbsen(tipe) {
				// Cek apakah sudah ambil foto
				if (imageDataInput.value === "") {
					bootbox.alert("Silakan ambil foto selfie terlebih dahulu!");
					return;
				}

				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						document.getElementById('lat').value = position.coords.latitude;
						document.getElementById('lon').value = position.coords.longitude;

						bootbox.confirm({
							message: "Kirim absensi sekarang?",
							callback: function (result) {
								if(result) {
									document.getElementById('form-po').submit();
								}
							}
						});
					}, function() {
						alert("Gagal mengambil lokasi. Pastikan GPS aktif.");
					});
				}
			}
		</script>
	</body>
</html>
