<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('pdf');
        // $this->load->library('fpdf');
  		$this->load->helper('terbilang');
      	$this->load->library('upload');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
       	$this->load->model('master_model');
		 $logged_in = $this->session->userdata('logged_in');
        if(!$logged_in){
            header("location: ".base_url());
        }
    } 

	
	public function index()
	{$logged_in = $this->session->userdata('logged_in');
        if(!$logged_in){
            header("location: ".base_url());
        }else{
		
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="DATA MASTER";
			
			$id_bidang=$this->session->userdata('id_bidang');
			$text = "SELECT * FROM tbl_bidang ";
			$d['bidang'] = $this->app_model->manualQuery($text);
			$d['level']=$this->session->userdata('level');
			
			$level=$this->session->userdata('level');
			$d['username_nip']=$this->session->userdata('username');
			//$username_nip=$this->session->userdata('username');
			$d['content'] = $this->load->view('master/master', $d, true);		
			$this->load->view('home',$d);			
	}
	}
			
	public function ajax_edit_user($id)
	{
		$data = $this->master_model->get_by_id_user($id);
		echo json_encode($data);
	}

	public function ajax_edit_bidang($id)
	{
		$data = $this->master_model->get_by_id_bidang($id);
		echo json_encode($data);
	}
	
	public function ajax_edit_rr($id)
	{
		$data = $this->master_model->get_by_id_rr($id);
		echo json_encode($data);
	}
	


	public function ajax_add_user()
	{
		$data = array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')),
			'nama_lengkap'=>$this->input->post('nama_lengkap'),
			'level'=>$this->input->post('level'),
			'id_bidang'=>$this->input->post('id_bidang')
			);
		$insert = $this->master_model->save_user($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_add_bidang()
	{
		$data = array(
			'bidang'=>$this->input->post('nama_bidang')
			);
		$insert = $this->master_model->save_bidang($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_rr()
	{
		$data = array(
			'nama_rr'=>$this->input->post('nama_rr')
			);
		$insert = $this->master_model->save_rr($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_update_user()
	{
			if($this->input->post('password') == ''){
       		$data = array(
			'username'=>$this->input->post('username'),
			'nama_lengkap'=>$this->input->post('nama_lengkap'),
			'level'=>$this->input->post('level'),
			'id_bidang'=>$this->input->post('id_bidang')
			);
			}else{
			$data = array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')),
			'nama_lengkap'=>$this->input->post('nama_lengkap'),
			'level'=>$this->input->post('level'),
			'id_bidang'=>$this->input->post('id_bidang')
			);
			};
		$this->master_model->update_user(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_bidang()
	{
			$data = array(
			'bidang'=>$this->input->post('nama_bidang')
			);
		$this->master_model->update_bidang(array('id_bidang' => $this->input->post('id_bidang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_rr()
	{
			$data = array(
			'nama_rr'=>$this->input->post('nama_rr')
			);
		$this->master_model->update_rr(array('id_rr' => $this->input->post('id_rr')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	
	public function ajax_delete_user($id)
	{
		$this->master_model->delete_by_id_user($id);
		echo json_encode(array("status" => TRUE));
	}
	
public function ajax_delete_bidang($id)
	{
		$this->master_model->delete_by_id_bidang($id);
		echo json_encode(array("status" => TRUE));
	}

public function ajax_delete_rr($id)
	{
		$this->master_model->delete_by_id_rr($id);
		echo json_encode(array("status" => TRUE));
	}
	
		
	
	
	//VIEW ADMIN
	public function view_user()
	{	
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM users ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM users  order by level ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_user'=>$data['id_user'],
							'username'=>$data['username'],
							'password'=>$data['password'],
							'nama_lengkap'=>$data['nama_lengkap'],
							'level'=>$data['level'],
							'id_bidang'=>$data['id_bidang'],
							'hapus'=>'<div align="center">
						<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$data['id_user']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						
							</a>	
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$data['id_user']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>							
  						</div>' 
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
	public function view_bidang()
	{	
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM tbl_bidang ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM tbl_bidang  order by id_bidang ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_bidang'=>$data['id_bidang'],
							'bidang'=>$data['bidang'],
							'hapus'=>'<div align="center">
					<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_bidang('."'".$data['id_bidang']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						
							</a>	
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_bidang('."'".$data['id_bidang']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>							
  						</div>' 
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}


	public function view_rr()
	{	
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM tbl_rr ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("SELECT * FROM tbl_rr  order by id_rr ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'no'=>$no++,
							'id_rr'=>$data['id_rr'],
							'nama_rr'=>$data['nama_rr'],
							'hapus'=>'<div align="center">
					<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_rr('."'".$data['id_rr']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						
							</a>	
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_rr('."'".$data['id_rr']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>							
  						</div>' 
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}
	
	
	
}
/* End of file crud.php */
/* Location: ./application/controllers/crud.php */