<?php
// $no=$no ;

// $tamp=mysql_query("select * from vw_kapling WHERE id_kapling='$no' ");
// $data=mysql_fetch_array($tamp);
// $tanggal = $this->app_model->tgl_indo($data['tanggal']);
$tgln = $this->app_model->tgl_indo(date('Y-m-d'));
foreach ($bulanan->result_array() as $row) 
        {
        	$id_kapling = $row['id_kapling'];
        	$nama_rr = $row['nama_rr'];
        	$bidang = $row['bidang'];
        	$jam = $row['jam'];
        	// $tujuan = $row['tujuan'];
        	$acara = $row['acara'];
        	// $jumlah_liter = $row['jumlah_liter'];
        	// $nama_spbu = $row['nama_spbu'];
        	$tanggal = $this->app_model->tgl_indo($row['tanggal']);
			$waktu_kapling = $this->app_model->tgl_indo($row['waktu_kapling']);
        	}
// create new PDF document
//$pdf = new TCPDF('L','mm', array(150,148), true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Kapling RR');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// remove default header/footer
// set default header data
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'4.jpeg';
      	$this->Image($image_file, 15, 7, 10, '', 'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->ln();
		$this->SetFont('Helvetica', '', 9);
		$this->cell(22);
		$this->Cell(0, 5, 'PEMERINTAH KABUPATEN GUNUNGKIDUL', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->ln();
		$this->SetFont('Helvetica', 'B', 10);
		$this->cell(22);
		$this->Cell(0, 5, 'DINAS KESEHATAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	    $this->ln();
   		$this->SetFont('Helvetica','',8);
		$this->cell(22);
$this->Cell(0,5,'Jl.Kolonel Sugiyono No.17 Wonosari Gunungkidul 55812 Telp.(0274) 391503, Fax.(0274) 391322 ',0,false,'C',0,'',0,false,'M','M');
		$this->ln();
		$this->cell(22);
$this->Cell(0,0,'Website: Http://dinkes.gunungkidulkab.go.id , email:dinkes@gunungkidulkab.go.id ',0,true,'C',0,'',0,false,'M','M');
		$this->ln(1);
		$this->Cell(1);
		$this->Cell(0,1,'','T',0);
		$this->ln(0.8);
		$this->Cell(1);
		$this->Cell(0,1,'','T',0);
		$this->ln(0.2);
		$this->Cell(1);
		$this->Cell(0,0,'','T',0);
		$this->ln(30);
		}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', array(148,210), true, 'UTF-8', false);
//$pdf = new TCPDF('L','mm', array(148,210), true, 'UTF-8', false);

//$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, 150);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('Helvetica', '', 12);
// add a page
$page_format['Rotate'] = 360;
$pdf->AddPage('L',$page_format);
$html='
		<table border="0">
			<tr>
		<td  height="30" colspan="3" ><div align="center"><div valign="middle">Kapling Ruang Rapat</div></div></td>
			</tr>
			
			<tr height="30">
			<td width="30%"> Nama RR </td>
					<td width="5%"> :</td>
					<td width="65%"> '.$nama_rr.'</td>
			</tr>
					
					<tr height="30">
					<td > Tanggal </td>
					<td > :</td>
					<td > '.$tanggal.'</td>
					</tr>
					
					<tr height="30">
					<td > Jam </td>
					<td > :</td>
					<td > '.$jam.'</td>
					</tr>
					
					<tr height="30">
					<td> Acara</td>
					<td > :</td>
					<td > '.$acara.'</td>
					</tr>
					
					<tr height="30">
					<td> Bidang/Bagian</td>
					<td > :</td>
					<td > '.$bidang.' </td>
					</tr>

					<tr height="30">
					<td> Waktu Kapling</td>
					<td > :</td>
					<td > '.$waktu_kapling.' </td>
					</tr>
					
					<tr>
					<td colspan="3">
					</td>
					</tr>
				</table>
				<table>
				<tr>
					<td width="40%"></td>
					<td width="10%"></td>
					<td width="50%"></td>
				</tr>
				<tr>
				<td> </td>
				<td> </td>
				<td align="center"> Wonosari, '.$tgln.'</td>
				</tr>
				
				
				<tr>
				<td ></td>
				<td></td>
				<td align="center">Mengetahui,</td>
				</tr>
				
				<tr>
				<td align="center"> Pemohon </td>
				<td> </td>
				<td align="center"> Ka.Subag Umum</td>
				</tr>
				
				<tr>
				<td colspan="3" height="50">
				</td>
				</tr>
				
				<tr>
				<td align="center"> <u>........................</u> </td>
				<td> </td>
				<td align="center"> <u>Heri Namiyarso, SIP</u></td>
				</tr>
				
				<tr>
				<td align="center"> </td>
				<td> </td>
				<td align="center">NIP. 19680711 199301 1 001</td>
				</tr>
				
				</table>	
			';


//$pdf->writeHTMLCell(0, 6, '', '',$data['perihal'], 'LRB', 1, 0,true, false, true, false, 'J');
$pdf->writeHTMLCell(0, 6, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('kapling_RR.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
