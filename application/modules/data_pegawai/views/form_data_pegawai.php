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
										<h3><b>Form Data Karyawan</b></h3>
									</div>
								</div>
								<div class="panel-content">
									<form method="POST" action="<?php echo site_url('data_pegawai/submit_data_pegawai');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
										<div class="row">
											<div class="col-sm-2">
												<label>NIP</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nip" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nama Pekerja</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="name" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Jenis Kelamin</label>
											</div>
											<div class="col-sm-2">
												<select name="gender" class="form-control" required="">
													<option>Pilih Jenis Kelamin</option>
													<option value="Laki-Laki">Laki-Laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Tanggal Bergabung</label>
											</div>
											<div class="col-sm-2">
												<input type="date" class="form-control" name="date_join" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Jabatan</label>
											</div>
											<div class="col-sm-2">
												<select class="form-control form-select2" name="position" required="" >
													<option>Pilih Jabatan</option>
													<?php
													if(!empty($position)){
														foreach ($position as $x) {
															?>
															<option value="<?php echo $x['admin_group_id'];?>"><?php echo $x['admin_group_name'];?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
											<div class="col-sm-2">
												<button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:15px; text-transform:capitalize;"><a href="<?php echo site_url('admin/admin_access'); ?>"><b style="color:white;"><i class="fa-solid fa-plus"></i> Tambah Jabatan</b></a></button>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Departemen</label>
											</div>
											<div class="col-sm-2">
												<select class="form-control form-select2" name="departement" required="" >
													<option>Pilih Departemen</option>
													<?php
													if(!empty($departement)){
														foreach ($departement as $x) {
															?>
															<option value="<?php echo $x['id'];?>"><?php echo $x['nama'];?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
											<div class="col-sm-2">
												<button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:15px; text-transform:capitalize;"><a href="<?php echo site_url('data_pegawai/form_departemen'); ?>"><b style="color:white;"><i class="fa-solid fa-plus"></i> Tambah Departemen</b></a></button>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Lokasi Tempat Kerja</label>
											</div>
											<div class="col-sm-2">
												<select class="form-control form-select2" name="location" required="" >
													<option>Pilih Lokasi Kerja</option>
													<?php
													if(!empty($location)){
														foreach ($location as $x) {
															?>
															<option value="<?php echo $x['id'];?>"><?php echo $x['nama'];?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
											<div class="col-sm-2">
												<button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:15px; text-transform:capitalize;"><a href="<?php echo site_url('data_pegawai/form_location'); ?>"><b style="color:white;"><i class="fa-solid fa-plus"></i> Tambah Lokasi Kerja</b></a></button>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Masa Probation</label>
											</div>
											<div class="col-sm-2">
												<input type="date" class="form-control" name="date_probation" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Mulai PKWT</label>
											</div>
											<div class="col-sm-2">
												<input type="date" class="form-control" name="date_pkwt" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Tempat Lahir</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="place_birth" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Tanggal Lahir</label>
											</div>
											<div class="col-sm-2">
												<input type="date" class="form-control" name="date_birth" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Agama</label>
											</div>
											<div class="col-sm-2">
												<select name="religion" class="form-control" required="">
													<option>Pilih Agama</option>
													<option value="Islam">Islam</option>
													<option value="Katolik">Katolik</option>
													<option value="Hindu">Hindu</option>
													<option value="Budha">Budha</option>
													<option value="Konghucu">Konghucu</option>
												</select>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Status PTKP</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="ptkp" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Alamat KTP</label>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ktp_address" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Kelengkapan Data</label>
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="ktp" value="1"> KTP
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="kk" value="1"> KK
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="npwp" value="1"> NPWP
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="bpjs_kesehatan" value="1"> BPJS Kesehatan
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="bpjs_ketenagakerjaan" value="1"> BPJS Ketenagakerjaan
											</div>
											<div class="col-sm-1">
                                                <input type="checkbox" name="cv" value="1"> CV
											</div>
											<br />
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nomor KTP</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nomor_ktp" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nomor KK</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nomor_kk" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nomor NPWP</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nomor_npwp" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nomor BPJS Kesehatan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nomor_bpjs_kesehatan" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Nomor BPJS Ketenagakerjaan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" name="nomor_bpjs_ketenagakerjaan" required="">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Upload File</label>
											</div>
											<div class="col-sm-6">
												<input type="file" class="form-control" name="files[]"  multiple="" />
											</div>
											<br />
											<br />
											<br />
											<br />
											<div class="text-center">
												<a href="<?= site_url('admin');?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
												<button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
											</div>
											<br />
											<br />
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
					message: "Apakah anda yakin menambahkan data pegawai sekarang ?",
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
