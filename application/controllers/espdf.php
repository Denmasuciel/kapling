<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class espdf extends CI_Controller{
    //put your code here
      public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    	 $this->load->library('pdf'); // Load library
    	  // $this->load->library('fpdf');
      define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $logged_in = $this->session->userdata('logged_in');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }  
    
    public function index() {
        //$this->load->model('rptpdf');
        //$res['data'] = $this->rptpdf->select_data();
		//$this->load->library('fungsi_indotgl.php');
		//define('FPDF_FONTPATH','font/');
		$this->load->view('sisum/pdf1');
    }
	
	
	function testpdf()
{
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->cell(25,6,'',0,0,'C',0); 
                $pdf->cell(100,6,'Laporan daftar pegawai gubugkoding.com',0,1,'L',1); 
                $pdf->cell(25,6,'',0,0,'C',0); 
                $pdf->cell(100,6,"Periode : ".date('M Y'),0,1,'L',1); 
                $pdf->cell(25,6,'',0,0,'C',0); 
                $pdf->cell(100,6,'Lokasi : Semarang, Jawa Tengah',0,1,'L',1); 
                

$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
	
$pdf->Write(5, 'Some sample text');
$pdf->Output('My-File-Name.pdf', 'I');}
    
}