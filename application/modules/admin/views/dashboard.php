<!doctype html>
<html lang="en" class="fixed">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="erp/assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="erp/assets/animate/animate.css" />
        <link rel="stylesheet" href="erp/assets/animate/set.css" />
        <link rel="stylesheet" href="erp/assets/gallery/blueimp-gallery.min.css">
        <link rel="stylesheet" href="erp/assets/style.css">
        <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>
        <?php echo $this->Templates->Header();?>
        <script type = "text/JavaScript">
            function AutoRefresh( t ) {
                setTimeout("location.reload(true);", t);
            }
        </script>
    </head>
    <style type="text/css">
        body {
            font-family: helvetica;
            background-color: #ffffff !important;
        }

        a:hover {
            color: white;
        }

        th, td {
            padding: 15px;
        }

        .chart-container{
            position: relative; max-width: 100%; height:350px; background: #fff;
        }

        .highcharts-figure,
        .highcharts-data-table table {
        min-width: 65%;
        max-width: 100%;
        }

        .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
        }

        .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
        }

        .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
        padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
        background: #f1f7ff;
        }

        blink {
        -webkit-animation: 2s linear infinite kedip; /* for Safari 4.0 - 8.0 */
        animation: 2s linear infinite kedip;
        }
        /* for Safari 4.0 - 8.0 */
        @-webkit-keyframes kedip { 
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
        }
        @keyframes kedip {
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
        }

        /* Animation */
        @keyframes Gradient{0%{background-position:0 50%}50%{background-position:100% 50%}100%{background-position:0 50%}}
        #flippy{text-align:center;margin:auto;display:inline}#flippy button{border-color:rgba(0,0,0,0.0);background:#fff;background-image:linear-gradient(to right,#FF0000 0%,#333333 51%,#FF0000 100%);background-size:200% auto;color:#fff;display:block;width:80%;padding:15px;font-weight:700;font-size:14px;text-align:center;text-transform:uppercase;letter-spacing:0.5px;margin:10px auto;border-radius:10px;box-shadow:0 2px 3px rgba(0,0,0,0.06),0 2px 3px rgba(0,0,0,0.1);transition:all .3s}#flippy button:hover,#flippy button:focus{background-position: right center;outline:none;opacity:1;color:#fff}#flippanel{display:none;padding:10px 0;text-align:left;background:#fff;margin:10px 0 0 0}#flippanel img{background:#f5f5f5;margin:10px auto}

        /* Animation */
        @keyframes Gradient{0%{background-position:0 50%}50%{background-position:100% 50%}100%{background-position:0 50%}}
        #flippy_menu{text-align:center;margin:auto;display:inline}#flippy_menu button{border-color:rgba(0,0,0,0.0);background:#fff;background-image:linear-gradient(to right,#0b5394 0%,#333333 51%,#0b5394 100%);background-size:200% auto;color:#fff;display:block;width:80%;padding:15px;font-weight:700;font-size:14px;text-align:center;text-transform:uppercase;letter-spacing:0.5px;margin:10px auto;border-radius:10px;box-shadow:0 2px 3px rgba(0,0,0,0.06),0 2px 3px rgba(0,0,0,0.1);transition:all .3s}#flippy_menu button:hover,#flippy_menu button:focus{background-position: right center;outline:none;opacity:1;color:#fff}#flippanel{display:none;padding:10px 0;text-align:left;background:#fff;margin:10px 0 0 0}#flippanel img{background:#f5f5f5;margin:10px auto}
    
        button {
			border: none;
			border-radius: 5px;
			padding: 5px;
			font-size: 12px;
			text-transform: uppercase;
			cursor: pointer;
			color: white;
			background-color: none;
			box-shadow: 0 0 4px #999;
			outline: none;
		}

		.ripple {
			background-position: center;
			transition: background 0.8s;
		}
		.ripple:hover {
			background: #eeeeee radial-gradient(circle, transparent 1%, #eeeeee 1%) center/15000%;
		}
		.ripple:active {
			background-color: #e1e1e1;
			background-size: 100%;
			transition: background 0s;
		}
    </style>
    <body onload = "JavaScript:AutoRefresh(360000);">
    <body>
        <div class="wrap-dashboard">
            <?php echo $this->Templates->PageHeader();?>
            <div class="page-body">
                <div id="about" class="container spacer about">
                <?php
                if(in_array($this->session->userdata('admin_group_id'), array(1,2,3))){
                ?>
                    <div class="col-sm-12" style="background-image:linear-gradient(to right,#0B5394 0%,#23649e 51%,#0B5394 100%); font-size:18px; border-radius: 10px; padding:10px; margin-bottom:50px;">
                        <p style="text-align:center; font-weight:bold; color:white;">BUTUH PERSETUJUAN</p>
                        <figure class="highcharts-figure">
                            <?php
                            if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
                            ?>
                            <?php
                            $query = $this->db->select('COUNT(id) as id')
                            ->from('pengajuan_absensi')
                            ->where("status = 'MENUNGGU'")
                            ->get()->row_array();
                            
                            $query = $query['id'];
                            ?>
                                <center><b><a target="_blank" href="<?= base_url("pmm/reports/detail_notification_2/") ?>" style="color:white;"><i class="fa-solid fa-clipboard-check"></i> PENGAJUAN ABSENSI (<blink><?php echo number_format($query,0,',','.');?></blink>)</a><b></center>
                            <?php
                            }
                            ?>

                            <?php
                            if(in_array($this->session->userdata('admin_group_id'), array(1,4))){
                            ?>
                            <?php
                            $query = $this->db->select('COUNT(id) as id')
                            ->from('cuti')
                            ->where("status = 'MENUNGGU'")
                            ->get()->row_array();
                            
                            $query = $query['id'];
                            ?>
                                <center><b><a target="_blank" href="<?= base_url("pmm/reports/detail_notification_2/") ?>" style="color:white;"><i class="fa-solid fa-clipboard-check"></i> CUTI (<blink><?php echo number_format($query,0,',','.');?></blink>)</a><b></center>
                            <?php
                            }
                            ?>
                        </figure>
                    </div>
                    <?php
                    }
                    ?>
                    <div id="flippy_menu">
                        <button title="Click to show/hide content" type="button" onclick="if(document.getElementById('spoiler_menu') .style.display=='none') {document.getElementById('spoiler_menu') .style.display=''}else{document.getElementById('spoiler_menu') .style.display='none'}"><i class="fa-regular fa-hand-point-right"></i> MENU (SHOW/HIDE)</button>
                    </div>
                    <div id="spoiler_menu" style="display:block">        
                        <div class="process">
                            <table width="100%" style="margin-top:100px;">
                                <tr>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#absensi" aria-expanded="false" aria-controls="absensi">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('absensi/form_absensi');?>">
                                                <span style="color:#fffdd0;"><i class="fa-regular fa-clock"></i><b>ABSENSI</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#cuti" aria-expanded="false" aria-controls="cuti">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('absensi/form_cuti');?>">
                                                <span style="color:#fffdd0;"><i class="fa-regular fa-calendar-days"></i><b>CUTI</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#data" aria-expanded="false" aria-controls="sdm">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/absensi_karyawan');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-file-lines"></i><b>REKAP</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#pengajuan" aria-expanded="false" aria-controls="pengajuan">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a>
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-screwdriver-wrench"></i><b>PENGAJUAN</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <th width="25%" class="text-center"></th>
                                    <th width="25%" class="text-center"></th>
                                    <th width="25%" class="text-center"></th>
                                    <th width="25%" class="text-center">
                                        <ul class="row text-center list-inline  wowload bounceInUp collapse" id="pengajuan">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('absensi/form_pengajuan_absensi');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-dollar-sign"></i><b>ABSENSI</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                </tr>
                            </table>
                            <?php
                            if(in_array($this->session->userdata('admin_group_id'), array(1,3,12))){
                            ?>
                            <table width="100%" style="margin-top:100px;">
                                <tr>
                                    <?php
                                    if(in_array($this->session->userdata('admin_group_id'), array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22))){
                                    ?>
                                    <th width="25%"></th>
                                    <?php
                                    }
                                    ?>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#data" aria-expanded="false" aria-controls="sdm">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/absensi');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-file-lines"></i><b>LAPORAN</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#data" aria-expanded="false" aria-controls="sdm">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/data_pegawai');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-users"></i><b>DATA PEGAWAI</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <?php
                                    if(in_array($this->session->userdata('admin_group_id'), array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22))){
                                    ?>
                                    <th width="25%"></th>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if(in_array($this->session->userdata('admin_group_id'), array(1))){
                                    ?>
                                    <th width="25%" class="text-center" data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="beton">
                                        <ul class="row text-center list-inline  wowload bounceIn">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a>
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-gear"></i><b>SETTINGS</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                    <?php
                                    }
                                    ?>
                                </tr>                                    
                            </table>
                            <?php
                            }
                            ?>
                            <table width="100%">
                                <tr>
                                    <th width="25%" class="text-center"></th>
                                    <th width="25%" class="text-center"></th>
                                    <th width="25%" class="text-center">
                                        <ul class="row text-center list-inline  wowload bounceInUp collapse" id="settings">
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/menu');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-bars"></i><b>MENU</b></span></a>
                                            </li>
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/admin_access');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-eye"></i><b>ADMIN<br />ACCESS</b></span></a>
                                            </li>
                                            <li style="background: linear-gradient(110deg, #0B5394 20%, #23649e 40%, #0B5394 80%);">
                                                <a href="<?php echo site_url('admin/admin');?>">
                                                <span style="color:#fffdd0;"><i class="fa-solid fa-user-secret"></i><b>ADMIN</b></span></a>
                                            </li>
                                        </ul>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <?php echo $this->Templates->Footer();?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
        <script src="<?php echo base_url();?>assets/back/theme/vendor/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/theme/vendor/chart-js/chart.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/theme/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/theme/vendor/number_format.js"></script>
        <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/back/theme/vendor/chart-js/chart.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    </body>
</html>
