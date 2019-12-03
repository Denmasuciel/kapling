<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kapling extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('pdf');
        // $this->load->library('fpdf');
  		$this->load->helper('terbilang');
      	define('FPDF_FONTPATH',$this->config->item('fonts_path'));
      
	  	$this->load->model('kapling_model');
		 $logged_in = $this->session->userdata('logged_in');
        if(!$logged_in){
            header("location: ".base_url());
        }
		
		
    } 

	
	public function index()
	{
	 	$logged_in = $this->session->userdata('logged_in');
        if(!$logged_in){
            header("location: ".base_url());
        }else{
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="Kapling Ruang Rapat";
			
			$id_bidang=$this->session->userdata('id_bidang');
			$text = "SELECT * FROM tbl_bidang where id_bidang=$id_bidang";
			$d['bidang'] = $this->app_model->manualQuery($text);
			
			$text0 = "SELECT * FROM tbl_bidang";
			$d['bidang_admin'] = $this->app_model->manualQuery($text0);
			$text2 = "SELECT * FROM tbl_rr";
			$d['rr'] = $this->app_model->manualQuery($text2);
			$d['level']=$this->session->userdata('level');
			
			$level=$this->session->userdata('level');
			if($level=='admin'){	
			$d['content'] = $this->load->view('kapling/kapling', $d, true);		
			$this->load->view('home',$d);
			}else{
			$d['content'] = $this->load->view('kapling/kapling_user', $d, true);		
			$this->load->view('home',$d);
			};
			}
	}
	
		
		
	public function ajax_edit($id)
	{
		$data = $this->kapling_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam'),
				'acara' => $this->input->post('acara'),
				'id_rr' => $this->input->post('id_rr'),
				'id_bidang' => $this->input->post('id_bidang')
				);
		$insert = $this->kapling_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
			'tanggal'=>$this->input->post('tanggal'),
			'jam'=>$this->input->post('jam'),
			'acara'=>$this->input->post('acara'),
			'id_rr'=>$this->input->post('id_rr'),
			'id_bidang'=>$this->input->post('id_bidang')
				);
		$this->kapling_model->update(array('id_kapling' => $this->input->post('id_kapling')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->kapling_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

public function view_data()//ok
	{
		$id_bidang=$this->session->userdata('id_bidang');
		$bulan=date("m");
		$tahun=date("Y");	
		$hari_ini=date("Y-m-d");
		$minggu_depan=date('Y-m-d',strtotime("+14 day"));
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM vw_kapling where (tanggal between '$hari_ini' and '$minggu_depan')")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM vw_kapling where (tanggal between '$hari_ini' and '$minggu_depan') ORDER BY tanggal ASC");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_kapling'=>$data['id_kapling'],
							'tanggal'=>$data['tanggal'],
							'jam'=>$data['jam'],
							'acara'=>$data['acara'],
							'id_rr'=>$data['id_rr'],
							'nama_rr'=>$data['nama_rr'],
							'id_bidang'=>$data['id_bidang'],
							'bidang'=>$data['bidang'],
							'tgl'=>$this->app_model->tgl_indo($data['tanggal'])		,		
							'waktu_kapling'=>$this->app_model->tgl_indo($data['waktu_kapling'])		,			
							'hapus'=>'<div align="center">
							<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$data['id_kapling']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						</a>
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$data['id_kapling']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
							<a class="red" href="javascript:void(0)" title="Cetak" onclick="cetak('."'".$data['id_kapling']."'".')"><i class="ace-icon fa fa-print bigger-130"></i></a>
							  
							</div>'          
							          
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}

public function view_data_all()//ok
	{
		$id_bidang=$this->session->userdata('id_bidang');
		$bulan=date("m");
		$tahun=date("Y");	
		$hari_ini=date("Y-m-d");
		$minggu_depan=date('Y-m-d',strtotime("+14 day"));
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM vw_kapling ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM vw_kapling  ORDER BY tanggal ASC");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_kapling'=>$data['id_kapling'],
							'tanggal'=>$data['tanggal'],
							'jam'=>$data['jam'],
							'acara'=>$data['acara'],
							'id_rr'=>$data['id_rr'],
							'nama_rr'=>$data['nama_rr'],
							'id_bidang'=>$data['id_bidang'],
							'bidang'=>$data['bidang'],
							'tgl'=>$this->app_model->tgl_indo($data['tanggal'])		,	
							'waktu_kapling'=>$this->app_model->tgl_indo($data['waktu_kapling'])		,				
							'hapus'=>'<div align="center">
							<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$data['id_kapling']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						</a>
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$data['id_kapling']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
							<a class="red" href="javascript:void(0)" title="Cetak" onclick="cetak('."'".$data['id_kapling']."'".')"><i class="ace-icon fa fa-print bigger-130"></i></a>
							  
							</div>'          
							          
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
	public function view_data_user()//ok
	{
		$id_bidang=$this->session->userdata('id_bidang');
		$bulan=date("m");
		$tahun=date("Y");	
		$hari_ini=date("Y-m-d");
		$minggu_depan=date('Y-m-d',strtotime("+14 day"));
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM vw_kapling where (tanggal between '$hari_ini' and '$minggu_depan') and id_bidang='$id_bidang'")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM vw_kapling where (tanggal between '$hari_ini' and '$minggu_depan')  and id_bidang='$id_bidang' ORDER BY tanggal ASC");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_kapling'=>$data['id_kapling'],
							'tanggal'=>$data['tanggal'],
							'jam'=>$data['jam'],
							'acara'=>$data['acara'],
							'id_rr'=>$data['id_rr'],
							'nama_rr'=>$data['nama_rr'],
							'id_bidang'=>$data['id_bidang'],
							'bidang'=>$data['bidang'],
							'tgl'=>$this->app_model->tgl_indo($data['tanggal'])		,		
							'waktu_kapling'=>$this->app_model->tgl_indo($data['waktu_kapling'])		,			
							'hapus'=>'<div align="center">
							<a class="red" href="javascript:void(0)" title="Cetak" onclick="cetak('."'".$data['id_kapling']."'".')"><i class="ace-icon fa fa-print bigger-130"></i></a>		  
							</div>'          
							          
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}

	
public function cetak_bon($id)
		{
		//$id = $_POST['id'];
		$no = $this->uri->segment('3');
		 $text3="select * from vw_kapling WHERE id_kapling='$no' ";
		 // $d['bulanan'] = $this->app_model->manualQuery($text3)->result_array();
		$d['bulanan'] = $this->db->query($text3);
		if(!isset($_POST))	
		show_404();
		$this->load->view('kapling/kapling_pdf',$d);
		}

}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */