<!doctype html>
<html lang="en" class="fixed">
    <?php include 'lib.php'; ?>
    <head>
        <?php echo $this->Templates->Header();?>

        <style type="text/css">
            body{
                font-family: helvetica;
            }
            
            .form-approval {
                display: inline-block;
            }
            
            .mytable thead th {
            background-color: #D3D3D3;
            /*border: solid 1px #000000;*/
            color: #000000;
            text-align: center;
            vertical-align: middle;
            padding : 10px;
            }
            
            .mytable tbody td {
            padding: 5px;
            }
            
            .mytable tfoot th {
            padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <?php echo $this->Templates->PageHeader();?>
            <div class="page-body">
                
                <div class="content">
                    <div class="row animated fadeInUp">
                        <div class="col-sm-12 col-lg-12">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3><b>EDIT SLIP GAJI</b></h3>
                                </div>
                                <div class="panel-content">
                                    <form method="POST" action="<?php echo site_url('data_pegawai/submit_sunting_slip_gaji');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <div class="row">
											<div class="col-sm-2">
												<label>Nama Pegawai</label>
											</div>
											<div class="col-sm-2">
                                                <select class="form-control form-select2" name="nama_pegawai" required="" >
                                                    <option>Pilih Pegawai</option>
                                                    <?php
                                                    if(!empty($pegawai)){
                                                        foreach ($pegawai as $key => $x) {
                                                            ?>
                                                            <option value="<?= $x['id']; ?>" <?= ($x['id'] == $row['nama_pegawai']) ? 'selected' : '' ?>><?= $x['name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Gaji Pokok</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="basic_salary" class="form-control rupiahformat text-right" required="" value="<?php echo number_format($row["basic_salary"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label></label>
											</div>
											<div class="col-sm-2 text-center">
												<label style="color:red;">Tunjangan</label>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>PPH21</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="tax" class="form-control rupiahformat text-right" value="<?php echo number_format($row["tax"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>JKK</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jkk" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jkk"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>JKM</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jkm" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jkm"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>JHT Perusahaan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jht_perusahaan" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jht_perusahaan"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Jaminan Pensiun Perusahaan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jaminan_pensiun_perusahaan" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jaminan_pensiun_perusahaan"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>BPJS Kesehatan Perusahaan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="bpjs_kesehatan_perusahaan" class="form-control rupiahformat text-right"value="<?php echo number_format($row["bpjs_kesehatan_perusahaan"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label></label>
											</div>
											<div class="col-sm-2 text-center">
												<label style="color:red;">Potongan</label>
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>BPJS Kesehatan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="bpjs_kesehatan" class="form-control rupiahformat text-right"value="<?php echo number_format($row["bpjs_kesehatan"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>BPJS Ketenagakerjaan</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jht" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jht"],0,',','.');?>">
											</div>
											<br />
											<br />
											<div class="col-sm-2">
												<label>Jaminan Pensiun</label>
											</div>
											<div class="col-sm-2">
												<input type="text" name="jaminan_pensiun" class="form-control rupiahformat text-right"value="<?php echo number_format($row["jaminan_pensiun"],0,',','.');?>">
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
            $('input.rupiahformat').number( true, 0,',','.' );
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
                    message: "Apakah anda yakin untuk mengedit data pegawai sekarang ?",
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
