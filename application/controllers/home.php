<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('url','download'));
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
			$d['level']=$this->session->userdata('level');
			$d['judul']="Home";		
			$d['content']= $this->load->view('content',$d,true);
			$this->load->view('home',$d);
			}
	}
	
	public function logout(){
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/login');
		}else{
			$this->session->sess_destroy();
			header('location:'.base_url().'index.php/login');
		}
	}
	
	
	
	
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */