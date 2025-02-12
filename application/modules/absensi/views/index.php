<?php
if(in_array($this->session->userdata('admin_group_id'), array(1,3,12))){
?>
<!doctype html>
<html lang="en" class="fixed">
    <head>
        <?php echo $this->Templates->Header(); ?>
        <style type="text/css">
            body {
                font-family: helvetica;
            }
            
            .mytable thead th {
            background-color:	#e69500;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            padding: 5px;
            }
            
            .mytable tbody td {
            padding: 5px;
            }
            
            .mytable tfoot td {
            background-color:	#e69500;
            color: #FFFFFF;
            padding: 5px;
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
            <?php echo $this->Templates->PageHeader(); ?>
            <div class="page-body">
                <div class="content" style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                    <div class="row animated fadeInUp">
                        <div class="col-sm-12 col-lg-12">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3 class="section-subtitle">
                                        <b style="text-transform:uppercase;">LAPORAN</b>
                                    </h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#absen" aria-controls="absen" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">ABSENSI PEGAWAI</a></li>
                                        <li role="presentation"><a href="#cuti" aria-controls="cuti" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">CUTI PEGAWAI</a></li>
                                        <li role="presentation"><a href="#pengajuan_absensi" aria-controls="cuti" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PENGAJUAN ABSENSI PEGAWAI</a></li>
                                    </ul>
                                    <div class="tab-content">
                                    <br />
                                        <div role="tabpanel" class="tab-pane active" id="absen">
                                            <form action="<?php echo site_url('absensi/cetak_absensi');?>" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date_absensi" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
                                                </div>
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                </div>
                                            </form>
                                            <br />
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_absensi" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Tanggal</th>
                                                            <th>Clock-In</th>
                                                            <th>Clock-Out</th>
                                                            <th>Tindakan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="cuti">
                                            <form action="<?php echo site_url('absensi/cetak_cuti');?>" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date_cuti" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
                                                </div>
                                                <!--<div class="col-sm-3">
                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                </div>-->
                                            </form>
                                            <br />
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_cuti" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>File</th>
                                                            <th>Status</th>
                                                            <th class="text_center">Setujui</th>
                                                            <th class="text_center">Tolak</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="pengajuan_absensi">
                                            <form action="<?php echo site_url('absensi/cetak_pengajuan_absensi');?>" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date_cuti" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
                                                </div>
                                                <!--<div class="col-sm-3">
                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                </div>-->
                                            </form>
                                            <br />
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_pengajuan_absensi" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Tanggal Pengajuan</th>
                                                            <th>Status</th>
                                                            <th>Clock-In</th>
                                                            <th>Clock-Out</th>
                                                            <th>Alasan</th>
                                                            <th class="text_center">Setujui</th>
                                                            <th class="text_center">Tolak</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
            $('.dtpickerange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                showDropdowns: true,
            });
            
            /*ABSENSI*/
            var table_absensi = $('#table_absensi').DataTable( {"bAutoWidth": false,
                ajax: {
                    processing: true,
                    serverSide: true,
                    url: '<?php echo site_url('absensi/table_absensi'); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.filter_date = $('#filter_date_absensi').val();
                    }
                },
                responsive: true,
                paging : false,
                "deferRender": true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                columns: [
                    {
                        "data": "no"
                    },
                    {
                        "data": "nama_pegawai"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "clock_in"
                    },
                    {
                        "data": "clock_out"
                    },
                    {
                        "data": "actions"
                    },
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0, "className": 'text-center'},
                    { "width": "20%", "targets": [1,2,3,4], "className": 'text-left'},
                    { "width": "15%", "targets": 5, "className": 'text-center'},
                ],
            });

            $('#filter_date_absensi').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                table_absensi.ajax.reload();
            });

            function DeleteDataAbsensi(id) {
            bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                    // console.log('This was logged in the callback: ' + result); 
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('absensi/delete_absensi'); ?>",
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(result) {
                                if (result.output) {
                                    table_absensi.ajax.reload();
                                    bootbox.alert('<b>DELETED</b>');
                                } else if (result.err) {
                                    bootbox.alert(result.err);
                                }
                            }
                        });
                    }
                });
            }

            /*CUTI*/
            var table_cuti = $('#table_cuti').DataTable( {"bAutoWidth": false,
                ajax: {
                    processing: true,
                    serverSide: true,
                    url: '<?php echo site_url('absensi/table_cuti'); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.filter_date = $('#filter_date_cuti').val();
                    }
                },
                responsive: true,
                paging : false,
                "deferRender": true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                columns: [
                    {
                        "data": "no"
                    },
                    {
                        "data": "nama_pegawai"
                    },
                    {
                        "data": "lampiran"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "approve"
                    },
                    {
                        "data": "reject"
                    },
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0, "className": 'text-center'},
                    { "width": "10%", "targets": [4,5], "className": 'text-center'},
                ],
            });

            $('#filter_date_cuti').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                table_cuti.ajax.reload();
            });

            /*PENGAJUAN ABSENSI*/
            var table_pengajuan_absensi = $('#table_pengajuan_absensi').DataTable( {"bAutoWidth": false,
                ajax: {
                    processing: true,
                    serverSide: true,
                    url: '<?php echo site_url('absensi/table_pengajuan_absensi'); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.filter_date = $('#filter_date_pengajuan_absensi').val();
                    }
                },
                responsive: true,
                paging : false,
                "deferRender": true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                columns: [
                    {
                        "data": "no"
                    },
                    {
                        "data": "nama_pegawai"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "clock_in"
                    },
                    {
                        "data": "clock_out"
                    },
                    {
                        "data": "reason"
                    },
                    {
                        "data": "approve"
                    },
                    {
                        "data": "reject"
                    },
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0, "className": 'text-center'},
                    { "width": "5%", "targets": [7,8], "className": 'text-center'},
                ],
            });

            $('#filter_date_pengajuan_absensi').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                table_pengajuan_absensi.ajax.reload();
            });
        </script>
    </body>
</html>
<?php
}
else {
    redirect('admin');
}
?>