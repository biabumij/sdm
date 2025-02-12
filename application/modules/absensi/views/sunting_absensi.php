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
                                    <h3><b>EDIT ABSENSI</b></h3>
                                </div>
                                <div class="panel-content">
                                    <form method="POST" action="<?php echo site_url('absensi/submit_sunting_absensi');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="200px">Date</th>
                                            <td><input type="text" class="form-control dtpicker" name="date"  value="<?= date('d-m-Y',strtotime($row["date"])) ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th width="200px">Clock-In</th>
                                            <td><input type="text" name="clock_in" class="form-control"  value="<?= date('H:i:s',strtotime($row["clock_in"])) ?>"></td>
                                        </tr>
                                        <tr>
                                            <th width="200px">Clock-Out</th>
                                            <td><input type="text" name="clock_out" class="form-control" value="<?= date('H:i:s',strtotime($row["clock_out"])) ?>"></td>
                                        </tr>
                                    </table>
                                    <br />
                                    <br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= base_url('admin/absensi') ?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
                                            <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
                                        </div>
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
                    message: "Apakah anda yakin untuk proses data ini ?",
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
