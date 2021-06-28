<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM daful_konfigurasi");
$hsl = mysqli_fetch_array($que);
// $timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk verifikasi daftar ulang di YP IPPI Jakarta">
    <!-- <meta name="author" content="slamet.bsan@gmail.com"> -->
    <title>Daftar Ulang Online</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
    <style type="text/css">
        .tdpad{
            padding: 8px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Daftar Ulang <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <!-- <li><a href="#about">About</a></li> -->
                <!-- <li><a href="#contact">Contact</a></li> -->
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

<div class="container">
        <!-- <h2 align="center">Pengumuman Kelulusan 
<?=$hsl['tahun'] ?></h2> -->
        <h3 align="center" style="font-weight: bold;">Form Daftar Ulang Peserta Didik</h3>
        <h3 align="center" style="font-weight: bold;">SMP - SMA - SMK YP IPPI Jakarta</h3>
        <h3 align="center" style="font-weight: bold;">Tahun Pelajaran 2021/2022</h3>
        <!-- countdown -->
        
        <div id="clock" class="lead"></div>
        
        <div id="xpengumuman">

<?php
	if(isset($_REQUEST['submit']))
	{
		$kode = $_POST['kode'];
        $nis = $_POST['nis'];

        $hasil = mysqli_query($db_conn,"SELECT * FROM daful_siswa WHERE nis='$nis' AND kode_verifikasi='$kode'");

        if(mysqli_num_rows($hasil) > 0)
        {
            $data = mysqli_fetch_array($hasil);
            $cabang = ucfirst($data['cabang']);
            $instansi = strtoupper($data['unit']);

            $belum = '<div class="alert alert-danger" role="alert">Daftar Ulang untuk '.strtoupper($data['unit']).' belum tersedia.</div>';
            // var_dump($data['id']);
            // die();

?>
            <table class="table table-bordered">
                <tr>
                    <td>NIS</td>
                    <td><?php echo $data['nisn']; ?></td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>
                        <?php
                            echo $instansi." YP IPPI ".$cabang;
                        ?>                            
                    </td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td><?php echo strtoupper($data['nama']); ?></td>
                </tr>
                <tr>
                    <td>Terdaftar Ulang di</td>
                    <td><?php echo strtoupper($data['kelas_naik']); ?></td>
                </tr>
            </table>

            <form method="post" action="prosespdf.php">
                <input type="hidden" name="id" value=<?php echo $data['id']; ?>>
                <input type="submit" name="submit" value="Cetak Form Daftar Ulang" class="btn btn-primary btn-sm">
            </form>
<?php

        }
        else
        {
            echo 'NIS dan Kode Verifikasi yang anda masukkan salah! Mohon periksa kembali!';
?>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nis" class="form-control" placeholder="NIS" required>
            <input type="text" name="kode" class="form-control" placeholder="Kode Verifikasi" required>
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Daftar Ulang</button>
            <!-- </span> -->
        </div>
    </form>

        <br>
        <br>
        <div align="center" style="font-size: 18px;">
            BIAYA ADMINISTRASI DAFTAR ULANG
        </div>
        <br>
        <table border='1' width="100%" style="font-size: 18px;">
            <tr style="text-align: center; font-weight: bolder;">
                <td class="tdpad">No</td>
                <td class="tdpad">Unit</td>
                <td class="tdpad">Biaya</td>
                <td class="tdpad">Ket</td>
            </tr>
            <tr>
                <td style="text-align: center;">1</td>
                <td class="tdpad">SMP IT YP IPPI Petojo</td>
                <td class="tdpad">Rp. 330.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td class="tdpad">SMA YP IPPI Petojo</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td class="tdpad">SMK YP IPPI Petojo</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td class="tdpad">SMP IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td class="tdpad">SMA IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td class="tdpad">SMK IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
        </table>
        <br>
        <div align="center" style="font-size: 18px;">
            Pembayaran dapat dilakukan melalui<br>
            transfer ke rekening sekolah<br>
            Bank BCA : 5980-309-021
        </div>
    </div><!-- /.container -->
<?php  
        }
	
?>


<?php }else {?>
<!-- form ujian========================================================     -->
    

    <p>Masukkan NIS dan Kode Verifikasi</p>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nis" class="form-control" placeholder="NIS" required>
            <input type="text" name="kode" class="form-control" placeholder="Kode Verifikasi" required>
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Daftar Ulang</button>
            <!-- </span> -->
        </div>
    </form>
        <br>
        <br>
		<div align="center" style="font-size: 18px;">
            BIAYA ADMINISTRASI DAFTAR ULANG
        </div>
        <br>
        <table border='1' width="100%" style="font-size: 18px;">
            <tr style="text-align: center; font-weight: bolder;">
                <td class="tdpad">No</td>
                <td class="tdpad">Unit</td>
                <td class="tdpad">Biaya</td>
                <td class="tdpad">Ket</td>
            </tr>
            <tr>
                <td style="text-align: center;">1</td>
                <td class="tdpad">SMP IT YP IPPI Petojo</td>
                <td class="tdpad">Rp. 330.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td class="tdpad">SMA YP IPPI Petojo</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td class="tdpad">SMK YP IPPI Petojo</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td class="tdpad">SMP IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td class="tdpad">SMA IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td class="tdpad">SMK IT YP IPPI Cakung</td>
                <td class="tdpad">Rp. 350.000</td>
                <td class="tdpad"></td>
            </tr>
        </table>
        <br>
        <div align="center" style="font-size: 18px;">
            Pembayaran dapat dilakukan melalui<br>
            transfer ke rekening sekolah<br>
            Bank BCA : 5980-309-021
        </div>
    </div><!-- /.container -->
<!-- form ujian========================================================     -->	

<?php }?>

	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah']; ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%D Hari %H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>
</body>
</html>
