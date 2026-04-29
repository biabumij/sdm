<!DOCTYPE html>
<html>
	<head>
	<?= include 'lib.php'; ?>
	  <title>ABSENSI</title>

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
		<table width="100%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 10px;">Absensi</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">Periode <?php echo str_replace($search, $replace, $subject);?></div>
				</td>
			</tr>
		</table>

		<br /><br />
		<table cellpadding="3" width="98%">
			<tr class="table-active">
				<th align="center" width="10%">NIP</th>
				<th align="center" width="20%">Nama</th>
				<th align="center" width="10%">Posisi</th>
				<th align="center" width="10%">Tanggal</th>
				<th align="center" width="10%">Organisasi</th>
				<th align="center" width="10%">Status Kehadiran</th>
				<th align="center" width="10%">Jam Masuk</th>
				<th align="center" width="10%">Jam Keluar</th>
				<th align="center" width="10%">Jumlah Jam Kerja</th>
            </tr>
			<?php foreach ($data as $key => $x): ?>
			<tr>
				<td align="center"><?= $this->crud_global->GetField('tbl_admin',array('admin_id'=>$x['nama_pegawai']),'nip'); ?></td>
				<td align="center"><?= $this->crud_global->GetField('tbl_admin',array('admin_id'=>$x['nama_pegawai']),'admin_name'); ?></td>
				
				<?php
				$admin_id = $x['nama_pegawai'];
				$admin_group_id = $this->db->select('g.admin_group_name')
				->from('tbl_admin a')
				->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left')
				->where("a.admin_id = $admin_id")
				->get()->row_array();
				$admin_group_id = $admin_group_id['admin_group_name'];
				?>
				<td align="center"><?php echo $admin_group_id;?></td>
				<td align="center"><?= date('d F Y',strtotime($x['date'])); ?></td>
				<td align="center"><?= $this->crud_global->GetField('tbl_admin',array('admin_id'=>$x['nama_pegawai']),'organisasi'); ?></td>
				<td align="center"><?php echo $x['status'];?></td>
				
				<?php
				$clock_in = $x['clock_in'];
				$styleColor = $clock_in > date('H:i',strtotime('08:00')) ? 'color:red' : 'color:black';
				?>
				<td align="center" style="<?php echo $styleColor ?>"><?= date('H:i',strtotime($clock_in)); ?></td>

				<?php
				$clock_out = $x['clock_out'];
				$styleColor = $clock_out < date('H:i',strtotime('17:00')) ? 'color:red' : 'color:black';
				?>
				<td align="center" style="<?php echo $styleColor ?>"><?= date('H:i',strtotime($clock_out)); ?></td>

				<td align="center" style="<?php echo $styleColor ?>">
				<?php
				$waktustart = date('H:i',strtotime($clock_in));
				$waktuend = date('H:i',strtotime($clock_out));

				$datetime1 = new DateTime($waktustart);
				$datetime2 = new DateTime($waktuend);
				$durasi = $datetime1->diff($datetime2);

				$styleColor = $durasi < date('H:i',strtotime('08:00')) ? 'color:red' : 'color:black';

				echo $durasi->format("%H:%I"), "\n";
				
				?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</body>
</html>