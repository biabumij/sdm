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
										<h3><b>Data Absensi</b></h3>
									</div>
								</div>
								<div class="panel-content">
									<div class="col-sm-3">
										<label>Nama Pegawai</label>
									</div>
									<div class="col-sm-3">
										<?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['nama_pegawai']),'admin_name');?>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Tanggal</label>
									</div>
									<div class="col-sm-3">
										<?php echo date('d/m/Y',strtotime($row['date']))?>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Clock-In</label>
									</div>
									<div class="col-sm-3">
										<?php echo $row['clock_in']?>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Foto Selfie Clock-In</label>
									</div>
									<div class="col-sm-3">
										<?php
										// 1. Buat URL Foto (Hanya link-nya saja, bukan tag <a>-nya)
										$url_foto = base_url("uploads/absensi/" . $row['foto']);
										?>
										<a href="<?= $url_foto ?>" target="_blank" class="btn btn-sm btn-primary">
											Lihat Foto Selfie Clock-In
										</a>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Lokasi Clock-In</label>
									</div>
									<div class="col-sm-3">
										<?php
										$google_maps_url = "https://www.google.com/maps?q=" . $row['lat'] . "," . $row['lon'];
										?>
										<a href="<?= $google_maps_url ?>" target="_blank" class="btn btn-sm btn-primary">
											Lihat Peta
										</a>
									</div>
									</br/>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Clock-Out</label>
									</div>
									<div class="col-sm-3">
										<?php
										// Cara paling aman mengecek "Bukan Null" dan "Bukan Kosong"
										if (!empty($row['clock_out']) && $row['clock_out'] !== '00:00:00') {
											// Jika SUDAH clock-out (Data ada dan bukan 00:00:00)
											echo date('H:i', strtotime($row['clock_out']));
										} else {
											// Jika MASIH null atau 00:00:00
											echo "<span class='text-muted'>Belum Clock-Out</span>";
										}
										?>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Foto Selfie Clock-Out</label>
									</div>
									<div class="col-sm-3">
										<?php
										$url_foto_out = base_url("uploads/absensi_out/" . $row['foto_out']);
										// 1. Perbaiki logika: Jika foto TIDAK kosong DAN bukan string 'NULL'
										if (!empty($row['foto_out']) && $row['foto_out'] !== 'NULL') {
											// Maka tampilkan link fotonya
											?>
											<a href="<?= $url_foto_out ?>" target="_blank" class="btn btn-sm btn-primary">
												Lihat Foto Selfie Clock-Out
											</a>
											<?php
										} else {
											// Jika kosong, baru tampilkan pesan belum ada foto
											echo "<span class='text-muted'>Tidak Ada Foto Clock-Out</span>";
										}
										?>
									</div>
									</br/>
									</br/>
									<div class="col-sm-3">
										<label>Lokasi Clock-Out</label>
									</div>
									<div class="col-sm-3">
										<?php
										// Pastikan lat_out dan lon_out ada isinya dan bukan 'NULL'
										if (!empty($row['lat_out']) && !empty($row['lon_out']) && $row['lat_out'] !== 'NULL') {
											// Gunakan format URL Google Maps yang standar
											$google_maps_url = "https://www.google.com/maps?q=" . $row['lat_out'] . "," . $row['lon_out'];
											?>
											<a href="<?= $google_maps_url ?>" target="_blank" class="btn btn-sm btn-primary">
												Lihat Peta
											</a>
											<?php
										} else {
											echo "<span class='text-muted'>Tidak Ada Data Lokasi</span>";
										}
										?>
									</div>
									</br/>
									</br/>
								</div>
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
	</body>
</html>
