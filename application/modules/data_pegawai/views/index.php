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
                                        <b style="text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></b>
                                    </h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#data_pegawai" aria-controls="data_pegawai" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">DATA PEGAWAI</a></li>
                                        <li role="presentation"><a href="#slip_gaji" aria-controls="slip_gaji" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">SLIP GAJI</a></li>
                                    </ul>
                                    <div class="tab-content">
                                    <br />
                                        <div role="tabpanel" class="tab-pane active" id="data_pegawai">
                                            <form action="<?php echo site_url('absensi/cetak_absensi');?>" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date_pegawai" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
                                                </div>
                                            </form>
                                            <div class="col-sm-3">
                                                <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('data_pegawai/form_data_pegawai'); ?>"><b style="color:white;">Input Data Pegawai</b></a></button>
                                            </div>
                                            <br />
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_pegawai" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Tanggal Bergabung</th>
                                                            <th>Jabatan</th>
                                                            <th>Departemen</th>
                                                            <th>Lampiran</th>
                                                            <th>Tindakan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="slip_gaji">
                                            <form action="<?php echo site_url('absensi/cetak_slip_gaji');?>" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date_slip_gaji" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
                                                </div>
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                </div>
                                            </form>
                                            <br />
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_slip_gaji" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pegawai</th>
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
            
            /*DATA PEGAWAI*/
            var table_pegawai = $('#table_pegawai').DataTable( {"bAutoWidth": false,
                ajax: {
                    processing: true,
                    serverSide: true,
                    url: '<?php echo site_url('data_pegawai/table_pegawai'); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.filter_date = $('#filter_date_pegawai').val();
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
                        "data": "name"
                    },
                    {
                        "data": "date_join"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "departement"
                    },
                    {
                        "data": "lampiran"
                    },
                    {
                        "data": "actions"
                    },
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0, "className": 'text-center'},
                    { "width": "15%", "targets": [1,2,3,4,5], "className": 'text-left'},
                    { "width": "10%", "targets": 6, "className": 'text-center'},
                ],
            });

            $('#filter_date_pegawai').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                table_pegawai.ajax.reload();
            });

            function DeleteDataPegawai(id) {
            bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                    // console.log('This was logged in the callback: ' + result); 
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('data_pegawai/delete_pegawai'); ?>",
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(result) {
                                if (result.output) {
                                    table_pegawai.ajax.reload();
                                    bootbox.alert('<b>DELETED</b>');
                                } else if (result.err) {
                                    bootbox.alert(result.err);
                                }
                            }
                        });
                    }
                });
            }

            /*DATA SLIP GAJI*/
            var table_slip_gaji = $('#table_slip_gaji').DataTable( {"bAutoWidth": false,
                ajax: {
                    processing: true,
                    serverSide: true,
                    url: '<?php echo site_url('data_pegawai/table_slip_gaji'); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.filter_date = $('#filter_date_slip_gaji').val();
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
                        "data": "name"
                    },
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0, "className": 'text-center'},
                ],
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