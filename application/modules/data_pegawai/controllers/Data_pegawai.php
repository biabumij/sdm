<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends Secure_Controller {

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
	public function form_data_pegawai()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['jabatan'] = $this->db->order_by('admin_group_name', 'asc')->select('*')->get_where('tbl_admin_group')->result_array();
			$data['departemen'] = $this->db->order_by('nama', 'asc')->select('*')->get_where('kategori_departemen')->result_array();
			$this->load->view('data_pegawai/form_data_pegawai', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function form_departemen()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['departemen'] = $this->db->order_by('nama', 'asc')->select('*')->get_where('kategori_departemen')->result_array();
			$this->load->view('data_pegawai/form_departemen', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function submit_departemen()
	{
		$nama = $this->input->post('nama');

		$arr_insert = array(
			'nama' => $nama,
		);

		$this->db->insert('kategori_departemen',$arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Menambahkan Departemen</b>');
			redirect('data_pegawai/form_data_pegawai');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Menambahkan Departemen</b>');
			redirect('data_pegawai/form_data_pegawai');
		}
	}

	public function submit_data_pegawai()
	{
		$nip = $this->input->post('nip');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$date_join = date('Y-m-d',strtotime($this->input->post('date_join')));
		$position = $this->input->post('position');
		$departement = $this->input->post('departement');
		$location = $this->input->post('location');
		$date_probation = date('Y-m-d',strtotime($this->input->post('date_probation')));
		$date_pkwt = date('Y-m-d',strtotime($this->input->post('date_pkwt')));
		$place_birth = $this->input->post('place_birth');
		$date_birth = date('Y-m-d',strtotime($this->input->post('date_birth')));
		$ptkp = $this->input->post('ptkp');
		$ktp_address = $this->input->post('ktp_address');
		$ktp = $this->input->post('ktp');
		$kk = $this->input->post('kk');
		$npwp = $this->input->post('npwp');
		$bpjs_kesehatan = $this->input->post('bpjs_kesehatan');
		$bpjs_ketenagakerjaan = $this->input->post('bpjs_ketenagakerjaan');
		$cv = $this->input->post('cv');
		$nomor_ktp = $this->input->post('nomor_ktp');
		$nomor_kk = $this->input->post('nomor_kk');
		$nomor_npwp = $this->input->post('nomor_npwp');
		$nomor_bpjs_kesehatan = $this->input->post('nomor_bpjs_kesehatan');
		$nomor_bpjs_ketenagakerjaan = $this->input->post('nomor_bpjs_ketenagakerjaan');
		$created_by = $this->session->userdata('admin_id');
        $created_on = date('Y-m-d H:i:s');

		$arr_insert = array(
			'nip' => $nip,
			'name' => $name,
			'gender' => $gender,
			'date_join' => $date_join,
			'position' => $position,
			'departement' => $departement,
			'location' => $location,
			'date_probation' => $date_probation,
			'date_pkwt' => $date_pkwt,
			'place_birth' => $place_birth,
			'date_birth' => $date_birth,
			'ptkp' => $ptkp,
			'ktp_address' => $ktp_address,
			'ktp' => $ktp,
			'kk' => $kk,
			'npwp' => $npwp,
			'bpjs_kesehatan' => $bpjs_kesehatan,
			'bpjs_ketenagakerjaan' => $bpjs_ketenagakerjaan,
			'cv' => $cv,
			'nomor_ktp' => $nomor_ktp,
			'nomor_kk' => $nomor_kk,
			'nomor_npwp' => $nomor_npwp,
			'nomor_bpjs_kesehatan' => $nomor_bpjs_kesehatan,
			'nomor_bpjs_ketenagakerjaan' => $nomor_bpjs_ketenagakerjaan,
			'created_by' => $created_by,
			'created_on' => $created_on,
		);

		if ($this->db->insert('data_pegawai', $arr_insert)) {
			$pegawai_id = $this->db->insert_id();

			if (!file_exists('uploads/pegawai')) {
			    mkdir('uploads/pegawai', 0777, true);
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

					$config['upload_path'] = 'uploads/pegawai';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'pegawai_id' => $pegawai_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->insert('lampiran_pegawai', $data[$i]);
					}
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Membuat Data Pegawai</b>');
			redirect('admin/data_pegawai');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Membuat Data Pegawai</b>');
			redirect('admin/data_pegawai');
		}
	}
	
	public function table_pegawai()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('pg.created_on  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('pg.created_on <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('pg.*, lk.lampiran');
		$this->db->join('lampiran_pegawai lk', 'pg.id = lk.pegawai_id','left');
		$this->db->order_by('pg.created_on','desc');
		$query = $this->db->get('data_pegawai pg');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['name'] = $row['name'];
				$row['date_join'] = date('d F Y',strtotime($row['date_join']));
				$row['position'] = $this->crud_global->GetField('tbl_admin_group',array('admin_group_id'=>$row['position']),'admin_group_name');
				$row['departement'] = $this->crud_global->GetField('kategori_departemen',array('id'=>$row['departement']),'nama');
				$row['lampiran'] = '<a href="' . base_url('uploads/pegawai/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>'; 

				if(in_array($this->session->userdata('admin_group_id'), array(1,3,8))){
					$row['actions'] = '<a href="'.site_url().'data_pegawai/sunting_pegawai/'.$row['id'].'" class="btn btn-warning" style="border-radius:10px;"><i class="fa fa-edit"></i> </a> <a href="javascript:void(0);" onclick="DeleteDataPegawai('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }
	
	public function delete_pegawai()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->db->delete('data_pegawai', array('id' => $id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function sunting_pegawai($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['tes'] = '';
			$data['row'] = $this->db->get_where("data_pegawai", ["id" => $id])->row_array();
			$data['jabatan'] = $this->db->order_by('admin_group_name', 'asc')->select('*')->get_where('tbl_admin_group')->result_array();
			$data['departemen'] = $this->db->order_by('nama', 'asc')->select('*')->get_where('kategori_departemen')->result_array();
			$this->load->view('data_pegawai/sunting_data_pegawai', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_sunting_pegawai()
	{
		$nip = $this->input->post('nip');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$date_join = date('Y-m-d',strtotime($this->input->post('date_join')));
		$position = $this->input->post('position');
		$departement = $this->input->post('departement');
		$location = $this->input->post('location');
		$date_probation = date('Y-m-d',strtotime($this->input->post('date_probation')));
		$date_pkwt = date('Y-m-d',strtotime($this->input->post('date_pkwt')));
		$place_birth = $this->input->post('place_birth');
		$date_birth = date('Y-m-d',strtotime($this->input->post('date_birth')));
		$ptkp = $this->input->post('ptkp');
		$ktp_address = $this->input->post('ktp_address');
		$ktp = $this->input->post('ktp');
		$kk = $this->input->post('kk');
		$npwp = $this->input->post('npwp');
		$bpjs_kesehatan = $this->input->post('bpjs_kesehatan');
		$bpjs_ketenagakerjaan = $this->input->post('bpjs_ketenagakerjaan');
		$cv = $this->input->post('cv');
		$nomor_ktp = $this->input->post('nomor_ktp');
		$nomor_kk = $this->input->post('nomor_kk');
		$nomor_npwp = $this->input->post('nomor_npwp');
		$nomor_bpjs_kesehatan = $this->input->post('nomor_bpjs_kesehatan');
		$nomor_bpjs_ketenagakerjaan = $this->input->post('nomor_bpjs_ketenagakerjaan');
		$updated_by = $this->session->userdata('admin_id');
        $updated_on = date('Y-m-d H:i:s');

		$arr_update = array(
			'nip' => $nip,
			'name' => $name,
			'gender' => $gender,
			'date_join' => $date_join,
			'position' => $position,
			'departement' => $departement,
			'location' => $location,
			'date_probation' => $date_probation,
			'date_pkwt' => $date_pkwt,
			'place_birth' => $place_birth,
			'date_birth' => $date_birth,
			'ptkp' => $ptkp,
			'ktp_address' => $ktp_address,
			'ktp' => $ktp,
			'kk' => $kk,
			'npwp' => $npwp,
			'bpjs_kesehatan' => $bpjs_kesehatan,
			'bpjs_ketenagakerjaan' => $bpjs_ketenagakerjaan,
			'cv' => $cv,
			'nomor_ktp' => $nomor_ktp,
			'nomor_kk' => $nomor_kk,
			'nomor_npwp' => $nomor_npwp,
			'nomor_bpjs_kesehatan' => $nomor_bpjs_kesehatan,
			'nomor_bpjs_ketenagakerjaan' => $nomor_bpjs_ketenagakerjaan,
			'updated_by' => $updated_by,
			'updated_on' => $updated_on,
		);

		if ($this->db->update('data_pegawai', $arr_update)) {
			$pegawai_id = $this->input->post('lampiran_pegawai_id');

			$file = $this->db->select('lampiran')
			->from('lampiran_pegawai')
			->where("pegawai_id = $pegawai_id")
			->get()->row_array();

			$path = './uploads/pegawai/'.$file['lampiran'];
			chmod($path, 0777);
			unlink($path);

			if (!file_exists('uploads/pegawai')) {
			    mkdir('uploads/pegawai', 0777, true);
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

					$config['upload_path'] = 'uploads/pegawai';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'pegawai_id' => $pegawai_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->update('lampiran_pegawai', $data[$i]);
					}
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>Gagal Edit Data Pegawai</b>');
			redirect('admin/data_pegawai');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>Berhasil Edit Data Pegawai</b>');
			redirect('admin/data_pegawai');
		}
	}

	public function table_slip_gaji()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('pg.created_on  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('pg.created_on <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('pg.*, lk.lampiran');
		$this->db->join('lampiran_pegawai lk', 'pg.id = lk.pegawai_id','left');
		$this->db->order_by('pg.created_on','desc');
		$query = $this->db->get('data_pegawai pg');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['name'] = $row['name'];
				$row['date_join'] = date('d F Y',strtotime($row['date_join']));
				$row['position'] = $this->crud_global->GetField('tbl_admin_group',array('admin_group_id'=>$row['position']),'admin_group_name');
				$row['departement'] = $this->crud_global->GetField('kategori_departemen',array('id'=>$row['departement']),'nama');
				$row['lampiran'] = '<a href="' . base_url('uploads/pegawai/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>'; 

				if(in_array($this->session->userdata('admin_group_id'), array(1,3,8))){
					$row['actions'] = '<a href="'.site_url().'data_pegawai/sunting_pegawai/'.$row['id'].'" class="btn btn-warning" style="border-radius:10px;"><i class="fa fa-edit"></i> </a> <a href="javascript:void(0);" onclick="DeleteDataPegawai('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

}
?>