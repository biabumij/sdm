<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_karyawan extends Secure_Controller {

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
	
	public function table_absensi()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		$id = $this->session->userdata('admin_id');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('date  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('date <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('*');
		$this->db->where('nama_pegawai',$id);
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

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
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
		$id = $this->session->userdata('admin_id');
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
		$this->db->where('nama_pegawai',$id);
		$query = $this->db->get('absensi');
		$data['data'] = $query->result_array();

		$data['filter_date'] = $filter_date;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['data'] = $query->result_array();
        $html = $this->load->view('absensi/cetak_absensi',$data,TRUE);
        
		$pdf->SetTitle('');
        $pdf->nsi_html($html);
        $pdf->Output('absensi'.'.pdf', 'I');
	}

	public function table_pengajuan_absensi()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		$id = $this->session->userdata('admin_id');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('date  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('date <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('*, date as date_pengajuan');
		$this->db->where('nama_pegawai',$id);
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

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	/*CUTI*/
	public function table_cuti()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		$id = $this->session->userdata('admin_id');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('c.created_on  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('c.created_on <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('c.*, lk.lampiran');
		$this->db->join('lampiran_cuti lk', 'c.id = lk.cuti_id','left');
		$this->db->where('created_by',$id);
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
					$row['approve'] = '-';
				}

				if(in_array($this->session->userdata('admin_group_id'), array(1,3))){
					$row['reject'] = '<a href="'.site_url().'absensi/reject_cuti/'.$row['id'].'" class="btn btn-danger" style="border-radius:10px;"><i class="fa-solid fa-xmark"></i> </a>';
				}else {
					$row['reject'] = '-';
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
		$this->session->set_flashdata('notif_success','<b>Cuti Telah Disteujui</b>');
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

	/*DATA PEGAWAI*/
	public function table_pegawai()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		$id = $this->session->userdata('admin_id');
			
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
            $start_date = $arr_date[0];
            $end_date = $arr_date[1];
			$this->db->where('pg.created_on  >=', date('Y-m-d G:i:s', strtotime($start_date.' 00:00:00')));
            $this->db->where('pg.created_on <=', date('Y-m-d G:i:s', strtotime($end_date.' 23:59:59')));
		}
        $this->db->select('pg.*, lk.lampiran');
		$this->db->join('lampiran_pegawai lk', 'pg.id = lk.pegawai_id','left');
		$this->db->where('pg.login',$id);
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
					$row['actions'] = '<a href="'.site_url().'absensi_karyawan/cetak_data_pegawai/'.$row['id'].'" class="btn btn-info" style="border-radius:10px;"><i class="fa-solid fa-print"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function cetak_data_pegawai()
	{
		$this->load->library('pdf');
	
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(5, 5, 5);
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('P');

		$arr_data = array();
		$arr_date = $this->input->get('filter_date');
		$id = $this->session->userdata('admin_id');
		if(empty($arr_date)){
			$filter_date = '-';
		}else {
			$arr_filter_date = explode(' - ', $arr_date);
			$start_date = date('Y-m-d',strtotime($arr_filter_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d F Y',strtotime($arr_filter_date[0])).' - '.date('d F Y',strtotime($arr_filter_date[1]));
		}
		$this->db->where('login',$id);
		$query = $this->db->get('data_pegawai');
		$data['row'] = $query->row_array();

		$data['filter_date'] = $filter_date;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
        $html = $this->load->view('absensi_karyawan/cetak_data_pegawai',$data,TRUE);
        
		$pdf->SetTitle('');
        $pdf->nsi_html($html);
        $pdf->Output('data_pegawai'.'.pdf', 'I');
	}

}
?>