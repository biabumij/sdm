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
                                    <h3><b>EDIT DATA PEGAWAI</b></h3>
                                </div>
                                <div class="panel-content">
                                    <form method="POST" action="<?php echo site_url('data_pegawai/submit_sunting_pegawai');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>NIP</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nip" required="" value="<?= $row["nip"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nama Pekerja</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="name" required="" value="<?= $row["name"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Jenis Kelamin</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="gender" class="form-control" required="">
                                                     <option value="<?= $row['gender'] ?>"><?= $row['gender'] ?></option>
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
                                                <input type="text" class="form-control dtpicker" name="date_join" required="" value="<?= date('d-m-Y',strtotime($row["date_join"])) ?>">
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
                                                    if (!empty($jabatan)) {
                                                        foreach ($jabatan as $key => $x) {
                                                            ?>
                                                            <option value="<?= $x['admin_group_id']; ?>" <?= ($x['admin_group_id'] == $x['admin_group_id']) ? 'selected' : '' ?>><?= $x['admin_group_name']; ?></option>
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
                                                    if (!empty($departemen)) {
                                                        foreach ($departemen as $key => $x) {
                                                            ?>
                                                            <option value="<?= $x['id']; ?>" <?= ($x['id'] == $x['id']) ? 'selected' : '' ?>><?= $x['nama']; ?></option>
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
                                                <input type="text" class="form-control" name="location" required="" value="<?= $row["location"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Masa Probation</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dtpicker" name="date_probation" required="" value="<?= date('d-m-Y',strtotime($row["date_probation"])) ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Mulai PKWT</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dtpicker" name="date_pkwt" required="" value="<?= date('d-m-Y',strtotime($row["date_pkwt"])) ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Tempat Lahir</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="place_birth" required="" value="<?= $row["place_birth"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Tanggal Lahir</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dtpicker" name="date_birth" required="" value="<?= date('d-m-Y',strtotime($row["date_birth"])) ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Status PTKP</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="ptkp" required="" value="<?= $row["ptkp"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Alamat KTP</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ktp_address" required="" value="<?= $row["ktp_address"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Kelengkapan Data</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="ktp" value="1" <?= (isset($row) && $row['ktp'] == 1) ? 'checked' : '' ;?>> KTP
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="kk" value="1" <?= (isset($row) && $row['kk'] == 1) ? 'checked' : '' ;?>> KK
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="npwp" value="1" <?= (isset($row) && $row['npwp'] == 1) ? 'checked' : '' ;?>> NPWP
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="bpjs_kesehatan" value="1" <?= (isset($row) && $row['bpjs_kesehatan'] == 1) ? 'checked' : '' ;?>> BPJS Kesehatan
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="bpjs_ketenagakerjaan" value="1" <?= (isset($row) && $row['bpjs_ketenagakerjaan'] == 1) ? 'checked' : '' ;?>> BPJS Ketenagakerjaan
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" name="cv" value="1" <?= (isset($row) && $row['cv'] == 1) ? 'checked' : '' ;?>> CV
                                            </div>
                                            <br />
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nomor KTP</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nomor_ktp" required="" value="<?= $row["nomor_ktp"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nomor KK</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nomor_kk" required="" value="<?= $row["nomor_kk"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nomor NPWP</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nomor_npwp" required="" value="<?= $row["nomor_npwp"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nomor BPJS Kesehatan</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nomor_bpjs_kesehatan" required="" value="<?= $row["nomor_bpjs_kesehatan"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Nomor BPJS Ketenagakerjaan</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="nomor_bpjs_ketenagakerjaan" required="" value="<?= $row["nomor_bpjs_ketenagakerjaan"]; ?>">
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-2">
                                                <label>Lampiran</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php
                                                    $dataLampiran = $this->db->get_where('lampiran_pegawai', array('pegawai_id' => $row['id']))->result_array();
                                                    if (!empty($dataLampiran)) {
                                                        foreach ($dataLampiran as $key => $lampiran) {
                                                            ?>
                                                            <div><a href="<?= base_url() . 'uploads/pegawai/' . $lampiran['lampiran']; ?>" target="_blank"><?= $lampiran['lampiran']; ?></a></div>
                                                            <input type="hidden" class="form-control" name="lampiran_pegawai_id" required="" value="<?= $lampiran["pegawai_id"]; ?>">
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <<br />
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
                                    <br />
                                    <br />
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
