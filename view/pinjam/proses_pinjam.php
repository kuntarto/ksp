
<html>
<link rel="stylesheet" href="../../css/style.css" type="text/css" />
<body>
<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
header('location:index.php');
}
else{		
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
include "../../config/database.php";
include "../../controller/rp.php";
$view=$_GET['view'];
$act=$_GET['act'];


if ($view=='pinjam' AND $act=='hapus'){
	$data			= "select sisa from pinjam where no_pinjam='$_GET[no_pinjam]'";
	$hasil			= mysql_query($data);
	$list			= mysql_fetch_array($hasil);
	$cek			= $list['sisa'];
	
	if ($cek!= "0") echo "<script>window.alert('Tidak Bisa Dihapus, Masih Memiliki Hutang')</script>	
	 							  <meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
		else{
  				
  				$a		=mysql_query("DELETE FROM pinjam WHERE no_pinjam='$_GET[no_pinjam]'");
				$b		=mysql_query(	"UPDATE nasabah  	SET hutang				=	'N'	
													where no_rekening	= 	'$_GET[no_rekening]'") or die("n");							

					if($a AND $b)
							echo "<script>window.alert('Peminjam Berhasil Dihapus')</script>
							<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";
									else{
										echo "<script>window.alert('Terjadi Kesalahan')</script>";
										echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";
										}
			}
 
}

elseif($view=='pinjam' AND $act=='batal'){
	
  				
				$a		=mysql_query("DELETE FROM pinjam WHERE no_pinjam='$_GET[no_pinjam]'") or die("n");
  				$b		=mysql_query(	"UPDATE nasabah  	SET hutang				=	'N'	
													where no_rekening	= 	'$_GET[no_rekening]'") or die("n");							

					if($a AND $b)
							echo "<script>window.alert('Pengajuan Di Batalkan')</script>
							<meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=cek_pengajuan'>";
									else{
										echo "<script>window.alert('Terjadi Kesalahan')</script>";
										echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";
										}
			
 
}


elseif($view=='pinjam' AND $act=='pinjam'){
	
	$no_pinjam		= $_POST['no_pinjam'];
	$no_rek			= $_POST['no_rek'];
	$jumlah			= $_POST['jumlah'];
	$lama			= $_POST['lama'];
	$bunga			= $_POST['bunga'];
	$jenis			= $_POST['jenis'];
	$nama_jaminan	= $_POST['nama_jaminan'];
	$nama_pemilik	= $_POST['nama_pemilik'];
	$alamat_pemilik	= $_POST['alamat_nasabah'];
	$keterangan		=	"Belum Disetujui";
	
	$petugas		= $_SESSION['nip'];
	$total	= (($bunga/100)*$jumlah)+$jumlah;
	
	
$a				= mysql_query(	"INSERT INTO pinjam (`no_pinjam`, `no_rek`, `tanggal`, `jumlah`, `lama`, `bunga`, `total`,`keterangan`,
								`nama_jaminan`,`jenis`,`nama_pemilik`,`alamat_pemilik`, `petugas`) 
								VALUES ('$no_pinjam','$no_rek', now(), '$jumlah', '$lama', '$bunga', '$total','$keterangan','$nama_jaminan','$jenis','$nama_pemilik','$alamat_pemilik','$petugas')") or die("a");
	
$b				= mysql_query(	"UPDATE nasabah  	SET hutang				=	'Y'	
													where no_rekening	= 	'$_POST[no_rek]'") or die("n");	

	if($a.$b)		echo "<script>window.alert('Silahkan Tunggu 1X24 Jam')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=cek_pengajuan'>";	
			
	else
		{
					echo "<script>window.alert('Terjadi Kesalahan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=tambahpeminjam'>";	
		}
	
	}
	
	
	
	
	
elseif($view=='pinjam' AND $act=='editpengajuan'){

$a		=		 mysql_query(	"UPDATE pinjam  	SET 
													tanggal				= 	now(),
													jumlah				=	'$_POST[jumlah]',
													lama		=	'$_POST[lama]',
													bunga				=	'$_POST[bunga]',
													total		=	(($_POST[bunga]/100)*$_POST[jumlah])+$_POST[jumlah],
													status				=	'B',
													keterangan			=	'Belum Disetujui',
													nama_jaminan 		=	'$_POST[nama_jaminan]',
													jenis 				=	'$_POST[jenis]',
													nama_pemilik 		=	'$_POST[nama_pemilik]',
													alamat_pemilik 		=	'$_POST[alamat_pemilik]',
													status_jaminan    	=	'B',
													petugas				=	'$_SESSION[nip]'
													where no_pinjam	= 	'$_POST[no_pinjam]'") or die("p");	


	if($a)		echo "<script>window.alert('Silahkan Tunggu Max 1X24 Jam')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=cek_pengajuan'>";	
			
	else
		{
					echo "<script>window.alert('Terjadi Kesalahan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=editpengajuan'>";	
		}
	
}


elseif($view=='pinjam' AND $act=='input'){


$a		=		mysql_query(	"UPDATE pinjam Set tanggal= now(),
													sisa  = '$_POST[total]',
													status = 'Y',
													keterangan='Memiliki Hutang',
													status_jaminan	= 'T',
													petugas= '$_SESSION[nip]'
													where no_pinjam='$_POST[no_pinjamm]'")or die("p");
													
	  
	
if($a)	

	echo "<script>window.alert('Berhasil, Menambah Peminjam')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam'>";	
			
	else
		{
					echo "<script>window.alert('Terjadi Kesalahan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
		}
 
}

elseif($view=='pinjam' AND $act=='prosespinjam'){



$a		=		 mysql_query(	"UPDATE Pinjam  
												SET status =	'$_POST[status]', keterangan='$_POST[alamat_pemilik]',petugas='$_SESSION[nip]'
										where no_pinjam	= 	'$_POST[no_pinjam]'") or die("p");	
	  

if($a)	

	echo "<script>window.alert('Terimakasih')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=daftar_pengajuan'>";	
			
	else
		{
					echo "<script>window.alert('Terjadi Kesalahan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
		}
 
}



elseif($view=='pinjam' AND $act=='angsur'){
	$no_pinjam			= $_POST['no_pinjamA'];
	$no_angsur			= $_POST['no_angsurA'];
	$no_rek				= $_POST['no_rekA'];
	$total				= $_POST['totalA'];
	$angsuran_ke		= $_POST['angsuran_keA'];
	$lama				= $_POST['lamaA'];
	$denda				= $_POST['dendaA'];
	$angsuran_bulan_ini = $_POST['besar_angsuran'];
	$besar_angsuran		= $angsuran_bulan_ini-$denda; 	
	$sisa_angsuran		= $lama-$angsuran_ke;
	$sisa				= $_POST['sisaA'];
	$petugas			= $_SESSION['nip'];
	$data				= "select sisa_hutang from pinjam where no_pinjam='$no_pinjam'";
	$hasil				= mysql_query($data);
	$list				= mysql_fetch_array($hasil);
	$cek				= $list['sisa_hutang'];
	$nol				= "select angsuran_ke, lama from pinjam p inner join angsur a on p.no_pinjam=a.no_pnjm where no_pinjam='$no_pinjam' order by no_angsur desc limit 1";
	$ada				= mysql_query($nol);
	$berapa				= mysql_fetch_array($ada);
	$kosong				= $berapa['angsuran_ke']-$berapa['lama'];
	
	
				
	if ($cek == "0") echo "<script>window.alert('Hutang Anda Sudah Lunas')</script>	
	 							  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=angsur&no_pinjam=$no_pinjam'>";	
		else{
				if ($sisa_angsuran == "-1") echo "<script>window.alert('Hutang Anda Sudah Lunas')</script>	
												  <meta http-equiv='refresh' content='0; url=../../main.php?view=pinjam&act=angsur&no_pinjam=$no_pinjam'>";											
				else{	
					
						$pertama	="INSERT INTO angsur (`no_angsur`, `no_pnjm`,  `tanggal_angsur`, `angsuran_ke`,`besar_angsuran`, `sisa_angsuran`,`denda`, `petugas`)
		 							  VALUES ('$no_angsur', '$no_pinjam', now(),'$angsuran_ke' ,'$besar_angsuran' ,  '$sisa_angsuran', '$denda', '$petugas')";		   
						$a=mysql_query($pertama) or die("Gagal menyimpan data angsuran");	
								if($a)
								
										echo "<script>window.alert('Angsuran Sebesar ".num($angsuran_bulan_ini)." Telah Berhasil')</script>
												<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";
								else{
													echo "<script>window.alert('Terjadi Kesalahan')</script>";
													echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";
									
													}
					}
		}
}




elseif(empty($view)and empty($act)){	
			/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
			header('location:../../main.php?view=home');
									}

}
?>
</body>
</html>