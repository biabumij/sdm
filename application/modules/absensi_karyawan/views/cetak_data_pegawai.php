<!DOCTYPE html>
<html>
	<head>
	<?= include 'lib.php'; ?>
	  <title>DATA PEGAWAI</title>

	  <?php
		$search = array(
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
		);
		
		$replace = array(
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
		);
		
		$subject = "$filter_date";

		echo str_replace($search, $replace, $subject);

	  ?>
	  
	  <style type="text/css">
	  	body{
		  font-family: helvetica;
		  font-size: 8px;
	  	}
		table tr.table-active{
            background-color: #0B5394;
			color: #ffffff;
			font-weight: bold;
        }
        table tr.table-active2{
            background-color: #cac8c8;
        }
		table tr.table-active3{
            background-color: #eee;
        }
		hr{
			margin-top:0;
			margin-bottom:30px;
		}
		h3{
			margin-top:0;
		}
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 10px;">Data Pegawai</div>
				</td>
			</tr>
		</table>

		<br /><br />
		<table width="98%" border="0" cellpadding="3">
			<?php

				$this->db->select('admin_photo');
				$this->db->where('admin_id',$row['login']);
				$photo = $this->db->get('tbl_admin')->row_array();
				$photo = $photo['admin_photo'];
			?>
			<tr>
                <th align="center"><img src="<?=$photo?>" width="70px" border="1"></th>
            </tr>
			<br />
			<br />
            <tr>
                <th width="25%">Akun Login Sistem</th>
                <th width="2%">:</th>
                <th width="73%" align="left"><?= $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['login']),'admin_email'); ?></th>
            </tr>
			<tr>
                <th>NIP</th>
                <th >:</th>
                <th align="left"><?= $row['nip'];?></th>
            </tr>
			<tr>
                <th>Nama Pekerja</th>
                <th >:</th>
                <th align="left"><?php echo $row['name'];?></th>
            </tr>
			<tr>
                <th>Jenis Kelamin</th>
                <th >:</th>
                <th align="left"><?= $row['gender'];?></th>
            </tr>
			<tr>
                <th>Tanggal Bergabung</th>
                <th >:</th>
                <th align="left"><?= convertDateDBtoIndo($row["date_join"]); ?></th>
            </tr>
			<tr>
                <th>Jabatan</th>
                <th >:</th>
                <th align="left"><?= $this->crud_global->GetField('tbl_admin_group',array('admin_group_id'=>$row['position']),'admin_group_name'); ?></th>
            </tr>
			<tr>
                <th>Departemen</th>
                <th >:</th>
                <th align="left"><?= $this->crud_global->GetField('kategori_departemen',array('id'=>$row['departement']),'nama'); ?></th>
            </tr>
			<tr>
                <th>Lokasi Tempat Kerja</th>
                <th >:</th>
                <th align="left"><?= $this->crud_global->GetField('kategori_proyek',array('id'=>$row['location']),'nama'); ?></th>
            </tr>
			<?php
				$waktustart = date('Y-m-d',strtotime($row["date_join"]));
				$waktuend = date('Y-m-d');

				$datetime1 = new DateTime($waktustart);
				$datetime2 = new DateTime($waktuend);
				$durasi = $datetime1->diff($datetime2);
				?>
			<tr>
                <th>Lama Bekerja</th>
                <th >:</th>
                <th align="left"><?php echo $durasi->format('%y tahun, %m bulan'), "\n";?></th>
            </tr>
			<tr>
                <th>Tempat Lahir</th>
                <th >:</th>
                <th align="left"><?= $row['place_birth'];?></th>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <th >:</th>
                <th align="left"><?= convertDateDBtoIndo($row["date_birth"]); ?></th>
            </tr>
			<tr>
                <th>Alamat KTP</th>
                <th >:</th>
                <th align="left"><?= $row['ktp_address'];?></th>
            </tr>
			<?php
			$ktp = $row['ktp'];
			if($ktp == '1'){
				$ktp = 'Ada';
			}else {
				$ktp = 'Tidak Ada';
			}

			$kk = $row['kk'];
			if($kk == '1'){
				$kk = 'Ada';
			}else {
				$kk = 'Tidak Ada';
			}

			$npwp = $row['npwp'];
			if($npwp == '1'){
				$npwp = 'Ada';
			}else {
				$npwp = 'Tidak Ada';
			}

			$bpjs_kesehatan = $row['bpjs_kesehatan'];
			if($bpjs_kesehatan == '1'){
				$bpjs_kesehatan = 'Ada';
			}else {
				$bpjs_kesehatan = 'Tidak Ada';
			}

			$bpjs_ketenagakerjaan = $row['bpjs_ketenagakerjaan'];
			if($bpjs_ketenagakerjaan == '1'){
				$bpjs_ketenagakerjaan = 'Ada';
			}else {
				$bpjs_ketenagakerjaan = 'Tidak Ada';
			}
			?>
			<tr>
                <th rowspan="5">Kelengkapan Data</th>
                <th  rowspan="5">:</th>
                <th align="left">KTP = <?= $ktp;?></th>
            </tr>
			<tr>
                <th align="left">KK = <?= $kk;?></th>
            </tr>
			<tr>
                <th align="left">NPWP = <?= $npwp;?></th>
            </tr>
			<tr>
                <th align="left">BPJS Kesehatan = <?= $bpjs_kesehatan;?></th>
            </tr>
			<tr>
                <th align="left">BPSJ Ketenagakerjaan = <?= $bpjs_ketenagakerjaan;?></th>
            </tr>
			<tr>
                <th>Nomor KTP</th>
                <th >:</th>
                <th align="left"><?= $row['nomor_ktp'];?></th>
            </tr>
			<tr>
                <th>Nomor KK</th>
                <th >:</th>
                <th align="left"><?= $row['nomor_kk'];?></th>
            </tr>
			<tr>
                <th>NPWP</th>
                <th >:</th>
                <th align="left"><?= $row['nomor_npwp'];?></th>
            </tr>
			<tr>
                <th>Nomor BPJS Kesehatan</th>
                <th >:</th>
                <th align="left"><?= $row['nomor_bpjs_kesehatan'];?></th>
            </tr>
        </table>
	</body>
</html>