<?php
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function tgl_indo2($tgl){
			$tanggal2 = substr($tgl,8,2);
			$bulan2 = substr($tgl,5,2);
			$tahun2 = substr($tgl,0,4);
			return $tanggal2.'-'.$bulan2.'-'.$tahun2;		 
	}	


	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
			
			function terbilang($satuan){
			 $huruf = array ("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh","sebelas"); 				if ($satuan < 12) return " ".$huruf[$satuan];
			  elseif ($satuan < 20) return terbilang($satuan - 10)." belas";
			 elseif ($satuan < 100) return terbilang($satuan / 10)." puluh".terbilang($satuan % 10);
			  elseif ($satuan < 200) return "seratus".terbilang($satuan - 100);
			   elseif ($satuan < 1000) return terbilang($satuan / 100)." ratus".terbilang($satuan % 100);
			    elseif ($satuan < 2000) return "seribu".terbilang($satuan - 1000);
				 elseif ($satuan < 1000000) return terbilang($satuan / 1000)." ribu".terbilang($satuan % 1000);
				  elseif ($satuan < 1000000000) return terbilang($satuan / 1000000)." juta".terbilang($satuan % 1000000);
				   elseif ($satuan >= 1000000000) echo "Angka yang Anda masukkan terlalu besar"; 
				   }


date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
