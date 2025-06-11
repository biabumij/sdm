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
		  font-size: 5px;
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
		<table width="100%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 10px;">Data Karyawan</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">Periode <?php echo str_replace($search, $replace, $subject);?></div>
				</td>
			</tr>
		</table>

		<br /><br />
		<table cellpadding="3" width="98%">
			<tr class="table-active">
				<th align="center">NIP</th>
				<th align="center">Nama Pekerja</th>
				<th align="center">Jenis Kelamin</th>
				<th align="center">Tanggal Bergabung</th>
				<th align="center">Jabatan</th>
				<th align="center">Dept</th>
				<th align="center">Lokasi Tempat Kerja</th>
				<th align="center">Lama Bekerja</th>
				<th align="center">Tempat Lahir</th>
				<th align="center">Tgl. Lahir</th>
				<th align="center">Alamat KTP</th>
            </tr>
			<?php foreach ($data as $key => $x): ?>
			<tr>
				<td align="center"><?php echo $x['nip'];?></td>
				<td align="left"><?php echo $x['name'];?></td>
				<td align="center"><?php echo $x['gender'];?></td>
				<td align="left"><?= convertDateDBtoIndo($x["date_join"]); ?></td>
				<td align="left"><?= $this->crud_global->GetField('tbl_admin_group',array('admin_group_id'=>$x['position']),'admin_group_name'); ?></td>
				<td align="left"><?= $this->crud_global->GetField('kategori_departemen',array('id'=>$x['departement']),'nama'); ?></td>
				<td align="left"><?= $this->crud_global->GetField('kategori_proyek',array('id'=>$x['location']),'nama'); ?></td>
				<?php
				$waktustart = date('Y-m-d',strtotime($x["date_join"]));
				$waktuend = date('Y-m-d');

				$datetime1 = new DateTime($waktustart);
				$datetime2 = new DateTime($waktuend);
				$durasi = $datetime1->diff($datetime2);
				?>
				<td align="left"><?php echo $durasi->format('%y tahun, %m bulan'), "\n";?></td>
				<td align="left"><?php echo $x['place_birth'];?></td>
				<td align="left"><?= convertDateDBtoIndo($x["date_birth"]); ?></td>
				<td align="left"><?php echo $x['ktp_address'];?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</body>
</html>