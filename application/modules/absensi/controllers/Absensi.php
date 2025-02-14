<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends Secure_Controller {

	public function __construct()
	{
        parent::__construct();
        // Your own constructor code
        $this->load->model(array('admin/m_admin','crud_global','m_themes','pages/m_pages','menu/m_menu','admin_access/m_admin_access','DB_model','member_back/m_member_back','m_member','pmm/pmm_model','admin/Templates','pmm/pmm_finance','produk/m_produk'));
        $this->load->library('enkrip');
		$this->load->library('filter');
		$this->load->library('waktu');
		$this->load->library('session');
    }

	/*ABSENSI*/
	public function form_absensi()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$this->load->view('absensi/form_absensi', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function submit_clock_in()
	{
		$date = date('Y-m-d');
		$created_by = $this->session->userdata('admin_id');
        $created_on = date('H:i:s');

		$arr_insert = array(
			'nama_pegawai' => $created_by,
			'date' => $date,
			'clock_in' => $created_on,
			'clock_out' =>  date('00:00:00'),
			'status' => 'Hadir',
		);

		$this->db->insert('absensi',$arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Clock-In</b>');
			redirect('admin');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Clock-In</b>');
			redirect('admin');
		}
	}

	public function submit_clock_out()
	{
		$date = date('Y-m-d');
		$created_by = $this->session->userdata('admin_id');
        $clock_out = date('H:i:s');

		$get_date = $this->db->select('*')
        ->from('absensi')
        ->where('date',$date)
        ->get()->row_array();
		$id = $get_date['id'];

		$this->db->set("clock_out", $clock_out);
		$this->db->where("id", $id);
		$this->db->update("absensi");

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Clock-Out</b>');
			redirect('absensi');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Clock-Out</b>');
			redirect('admin');
		}
	}
	
	public function table_absensi()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('date  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('date <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('*');
		$this->db->order_by('date','desc');
		$query = $this->db->get('absensi');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['nama_pegawai'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['nama_pegawai']),'admin_name');
				$row['date'] = date('d F Y',strtotime($row['date']));
				$row['clock_in'] = date('H:i:s',strtotime($row['clock_in']));

				if($row['clock_out'] == '00:00:00'){
				    $row['clock_out'] = 'Belum Clock-Out';
				}else {
					$row['clock_out'] = date('H:i:s',strtotime($row['clock_out']));
				}

				if(in_array($this->session->userdata('admin_group_id'), array(1,3,8))){
					$row['actions'] = '<a href="'.site_url().'absensi/sunting_absensi/'.$row['id'].'" class="btn btn-warning" style="border-radius:10px;"><i class="fa fa-edit"></i> </a> <a href="javascript:void(0);" onclick="DeleteDataAbsensi('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }
	
	public function delete_absensi()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->db->delete('absensi', array('id' => $id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function sunting_absensi($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['tes'] = '';
			$data['row'] = $this->db->get_where("absensi", ["id" => $id])->row_array();
			$this->load->view('absensi/sunting_absensi', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_sunting_absensi()
	{
		$date = $this->input->post('date');
		$clock_in = $this->input->post('clock_in');
		$clock_out = $this->input->post('clock_out');

		$arr_update = array(
			'date' => date('Y-m-d', strtotime($date)),
			'clock_in' => $clock_in,
			'clock_out' => $clock_out,
		);

		$this->db->update('absensi',$arr_update);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Clock-In</b>');
			redirect('admin');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Clock-In</b>');
			redirect('admin');
		}
	}

	public function cetak_absensi()
	{
		$this->load->library('pdf');
	
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(5, 5, 5);
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('L');

		$arr_data = array();
		$arr_date = $this->input->get('filter_date');
		if(empty($arr_date)){
			$filter_date = '-';
		}else {
			$arr_filter_date = explode(' - ', $arr_date);
			$start_date = date('Y-m-d',strtotime($arr_filter_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d F Y',strtotime($arr_filter_date[0])).' - '.date('d F Y',strtotime($arr_filter_date[1]));
		}
		$this->db->order_by('date','asc');
		$query = $this->db->get('absensi');
		$data['data'] = $query->result_array();

		$data['filter_date'] = $filter_date;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['data'] = $query->result_array();
		file_put_contents("D:\\test.txt", $this->db->last_query());
        $html = $this->load->view('absensi/cetak_absensi',$data,TRUE);
        
		$pdf->SetTitle('');
        $pdf->nsi_html($html);
        $pdf->Output('absensi'.'.pdf', 'I');
	}

	/*CUTI*/
	public function form_cuti()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['tipe_cuti'] = $this->db->select('*')->get_where('kategori_cuti')->result_array();
			$data['admin'] = $this->db->order_by('admin_name', 'asc')->select('*')->get_where('tbl_admin')->result_array();
			$this->load->view('absensi/form_cuti', $data);
		} else {
			redirect('admin');
		}
	}

	public function form_kategori_cuti()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['kategori_cuti'] = $this->db->order_by('nama', 'asc')->select('*')->get_where('kategori_cuti')->result_array();
			$this->load->view('absensi/form_kategori_cuti', $data);
		} else {
			redirect('admin/');
		}
	}

	public function submit_kategori_cuti()
	{
		$nama = $this->input->post('nama');

		$arr_insert = array(
			'nama' => $nama,
		);

		$this->db->insert('kategori_cuti',$arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Menambahkan Kategori Cuti</b>');
			redirect('absensi/form_cuti');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Menambahkan Kategori Cuti</b>');
			redirect('absensi/form_cuti');
		}
	}

	public function submit_cuti()
	{
		$type = $this->input->post('type');
		$date_start = date('Y-m-d',strtotime($this->input->post('date_start')));
		$date_end = date('Y-m-d',strtotime($this->input->post('date_end')));
		$reason = $this->input->post('reason');
		$delegate = $this->input->post('delegate');
		$created_by = $this->session->userdata('admin_id');
        $created_on = date('Y-m-d H:i:s');

		$arr_insert = array(
			'type' => $type,
			'date_start' => $date_start,
			'date_end' => $date_end,
			'reason' => $reason,
			'delegate' => $delegate,
			'created_by' => $created_by,
			'created_on' => $created_on,
			'status' => 'MENUNGGU',
		);

		if ($this->db->insert('cuti', $arr_insert)) {
			$cuti_id = $this->db->insert_id();

			if (!file_exists('uploads/cuti')) {
			    mkdir('uploads/cuti', 0777, true);
			}

			$data = [];
			$count = count($_FILES['files']['name']);
			for ($i = 0; $i < $count; $i++) {

				if (!empty($_FILES['files']['name'][$i])) {

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = 'uploads/cuti';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'cuti_id' => $cuti_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->insert('lampiran_cuti', $data[$i]);
					}
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Mengirim Pengajuan Cuti</b>');
			redirect('admin');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Mengirim Pengajuan Cuti</b>');
			redirect('admin');
		}
	}

	public function table_cuti()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('c.created_on  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('c.created_on <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('c.*, lk.lampiran');
		$this->db->join('lampiran_cuti lk', 'c.id = lk.cuti_id','left');
		$this->db->order_by('c.created_on','desc');
		$query = $this->db->get('cuti c');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['nama_pegawai'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
				$row['lampiran'] = '<a href="' . base_url('uploads/cuti/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>'; 

				

				if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
					$row['approve'] = '<a href="'.site_url().'absensi/approve_cuti/'.$row['id'].'" class="btn btn-success" style="border-radius:10px;"><i class="fa-solid fa-v"></i> </a>';
				}else {
					$row['approve'] = 'Tidak Ada Akses';
				}

				if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
					$row['reject'] = '<a href="'.site_url().'absensi/reject_cuti/'.$row['id'].'" class="btn btn-danger" style="border-radius:10px;"><i class="fa-solid fa-xmark"></i> </a>';
				}else {
					$row['reject'] = 'Tidak Ada Akses';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function approve_cuti($id)
	{

		$this->db->set("status", "DISETUJUI");
		$this->db->set("updated_by", $this->session->userdata('admin_id'));
		$this->db->set("updated_on", date('Y-m-d H:i:s'));
		$this->db->where("id", $id);
		$this->db->update("cuti");
		$this->session->set_flashdata('notif_success','<b>Cuti Telah Disetujui</b>');
		redirect("admin/absensi");
	}

	public function reject_cuti($id)
	{
		$this->db->set("status", "DITOLAK");
		$this->db->set("updated_by", $this->session->userdata('admin_id'));
		$this->db->set("updated_on", date('Y-m-d H:i:s'));
		$this->db->where("id", $id);
		$this->db->update("cuti");
		$this->session->set_flashdata('notif_reject','<b>Cuti Ditolak</b>');
		redirect("admin/absensi");
	}

	/*PENGAJUAN ABSENSI*/
	public function form_pengajuan_absensi()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$this->load->view('absensi/form_pengajuan_absensi', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_pengajuan_absensi()
	{
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$nama_pegawai = $this->session->userdata('admin_id');
		$clock_in = $this->input->post('clock_in');
		$clock_out = $this->input->post('clock_out');
		$reason = $this->input->post('reason');
		

		$arr_insert = array(
			'nama_pegawai' => $nama_pegawai,
			'date' => $date,
			'clock_in' => $clock_in,
			'clock_out' => $clock_out,
			'reason' => $reason,
			'status' => 'MENUNGGU',
			'created_by' => $this->session->userdata('admin_id'),
        	'created_on' => date('Y-m-d H:i:s')
		);

		$this->db->insert('pengajuan_absensi',$arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Melakukan Pengajuan Absensi</b>');
			redirect('admin');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Melakukan Pengajuan Absensi-In</b>');
			redirect('admin');
		}
	}

	public function table_pengajuan_absensi()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('date  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('date <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('*, date as date_pengajuan');
		$this->db->order_by('date','desc');
		$query = $this->db->get('pengajuan_absensi');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['nama_pegawai'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['nama_pegawai']),'admin_name');
				$row['date'] = date('d F Y',strtotime($row['date']));
				$row['status'] = $row['status'];
				$row['clock_in'] = date('H:i:s',strtotime($row['clock_in']));
				$row['clock_out'] = date('H:i:s',strtotime($row['clock_out']));

				if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
					$row['approve'] = '<a href="'.site_url().'absensi/approve_pengajuan_absensi/'.$row['id'].'/'.$row['created_by'].'/'.$row['date_pengajuan'].'/'.$row['clock_in'].'/'.$row['clock_out'].'" class="btn btn-success" style="border-radius:10px;"><i class="fa-solid fa-v"></i> </a>';
				}else {
					$row['approve'] = 'Tidak Ada Akses';
				}

				if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
					$row['reject'] = '<a href="'.site_url().'absensi/reject_pengajuan_absensi/'.$row['id'].'" class="btn btn-danger" style="border-radius:10px;"><i class="fa-solid fa-xmark"></i> </a>';
				}else {
					$row['reject'] = 'Tidak Ada Akses';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function approve_pengajuan_absensi($id,$created_by,$date,$clock_in,$clock_out)
	{

		$this->db->set("status", "DISETUJUI");
		$this->db->set("updated_by", $this->session->userdata('admin_id'));
		$this->db->set("updated_on", date('Y-m-d H:i:s'));
		$this->db->where("id", $id);
		$this->db->update("pengajuan_absensi");

		$this->db->set("clock_in", $clock_in);
		$this->db->set("clock_out", $clock_out);
		$this->db->set("pengajuan_absensi_id", $id);
		$this->db->where("nama_pegawai", $created_by);
		$this->db->where("date", $date);
		$this->db->update("absensi");

		$this->session->set_flashdata('notif_success','<b>Pengajuan Absensi Telah Disetujui</b>');
		redirect("admin/absensi");
	}

	public function reject_pengajuan_absensi($id)
	{
		$this->db->set("status", "DITOLAK");
		$this->db->set("updated_by", $this->session->userdata('admin_id'));
		$this->db->set("updated_on", date('Y-m-d H:i:s'));
		$this->db->where("id", $id);
		$this->db->update("pengajuan_absensi");
		$this->session->set_flashdata('notif_reject','<b>Pengajuan Absensi Ditolak</b>');
		redirect("admin/absensi");
	}

}
?>