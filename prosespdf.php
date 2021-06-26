<?php 
// ini_set('display_errors', 1);
include "database.php";
$id = $_POST['id'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$hasil = mysqli_query($db_conn,"SELECT * FROM daful_siswa WHERE id='$id'");
$konfigurasi = mysqli_query($db_conn,"SELECT * FROM daful_konfigurasi");

if(mysqli_num_rows($hasil) > 0)
{

	$data = mysqli_fetch_array($hasil);
	$konfig = mysqli_fetch_array($konfigurasi);
	
	$noujian = $data['no_ujian'];
	$cabang= ucfirst($data['cabang']);

	// var_dump($cabang);
	// die();

	$unitjudul = ($data['unit']=="smp")?("SEKOLAH MENENGAH PERTAMA (SMP)"):($data['unit']=="sma"?"SEKOLAH MENENGAH ATAS (SMA)":"SEKOLAH MENENGAH KEJURUAN (SMK)");

		// var_dump($unitjudul);
	// die();
	// $jakarta= ($data['cabang']=="petojo") ? "Jakarta Pusat" : "Jakarta Timur";
	$alamatippi = ($data['cabang']=="petojo") ? "Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055" : "Jl. P. Komarudin Ujung Krawang Kober Limo, Pulogebang, Cakung - Jakarta Timur";
	$emailsma = ($data['cabang']=="cakung")?"smas.ypippickg@gmail.com":"smaypippi_1951@yahoo.com";
	$hr=($data['cabang']=="cakung")?"":"<hr style=border-width:2px; width:100%;>";
	if($data['cabang']=="petojo")
	{

		$html='

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
					}

					.tablenilaismk
					{
						margin:5px 120px 0px 120px;
						border-collapse: collapse;
					}

					.tablenilaismk td
					{
						border: 1px solid black;
						padding: 1px;
					}

					.ttd
					{
						border-collapse: collapse;
						margin:10px 50px 0px 50px;
						padding: 0px;
					}

					.text-center
					{
						text-align:center;
					}

					.fontnormal
					{
						font-size: 12px;
					}
				</style>
			</head>
			<body>
			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
						<tr>
							<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
							</td>
							<td align="center">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>
								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
								<span class="kopsedang">'.$unitjudul.' YP IPPI PETOJO</span><br/>
								<span class="kopsedang">JAKARTA PUSAT</span><br/>
								<span class="kopbesar">AKREDITASI : "A"</span><br/>
								<span class="kopkecil">'.$alamatippi.'</span><br/>
								<span class="kopkecil">Telp. (021) 48703207 Fax. (021)4808359 Email : '.$emailsma.'
							</td>
						</tr>
				</table>
				<table class="fontnormal" border="0">
						<tr>
							<td colspan="3">
								'.$hr.'
							</td>
						</tr>

						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<div style=font-size:16px;>
									<span>FORM DAFTAR ULANG PESERTA DIDIK</span><br>
									<span>SMP - SMA - SMK YP IPPI JAKARTA</span><br>
									<span>TAHUN PELAJARAN 2021 - 2022</span>
								</div>
								<div>
									Terima kasih. Anda telah terdaftar di tingkat selanjutnya.
								</div>
							</td>





		';

	}
	else
	{
		echo "asjdkjashdkjash";
	}

}


// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

// $dompdf->stream('SKL_'.$nisn.'.pdf');	
$dompdf->stream("skl2021-".$data['nisn'].".pdf", array("Attachment" => 0));
// exit(0);



 ?>