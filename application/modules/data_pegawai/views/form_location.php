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
									<div class="text-left">
										<h3><b>Form Lokasi Kerja</b></h3>
									</div>
								</div>
								<div class="panel-content">
									<form method="POST" action="<?php echo site_url('Data_pegawai/submit_location');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
										<div class="row">
											<div class="col-sm-2">
												<label>Nama Departemen</label>
											</div>
											<div class="col-sm-6">
												<input type="text" class="form-control" name="nama" required="">
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
			$('.form-select2').select2();

			$('.dtpicker').daterangepicker({
				singleDatePicker: true,
				showDropdowns : true,
				locale: {
				format: 'DD-MM-YYYY'
				}
			});
			$('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY'));
			});

			$('#form-po').submit(function(e){
				e.preventDefault();
				var currentForm = this;
				bootbox.confirm({
					message: "Apakah anda yakin menambahkan lokasi kerja baru sekarang ?",
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
