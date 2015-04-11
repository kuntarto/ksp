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
$view=$_GET['view'];
$act=$_GET['act'];




if($view=='transaksi' AND $act=='transaksi')
{
	$no_rekening=$_POST['no_rekening'];
	$no_transaksi=$_POST['no_transaksi'];
	$kode=$_POST['kode'];	
	$petugas=$_SESSION['nip'];
	$nominal=$_POST['ambil'];
	$kode=$_POST['kode'];
	$saldo_terahkir=$_POST['saldo_terahkir'];
	
	
	if(empty($kode)and empty($nominal)){	
			echo "<script>window.alert('Anda Belum Memilih Tindakan Dan Nominal Masih Kosong')</script>
			<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";	
										}

	if($kode=="D"){
			if (empty($nominal)) echo "<script>window.alert('Nominal Tidak Boleh Kosong')</script>
									  <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";									
				else{
				$pertama="INSERT INTO Simpanan(no_simpanan,no_rek,tanggal,jenis,kode,nominal,petugas) 
         								VALUES ('$no_transaksi','$no_rekening',now(),'S','$kode','$nominal','$petugas')";
					if(mysql_query($pertama)) echo "<script>window.alert('Transaksi Berhasil')</script>
										 <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=struk&no_rekening=$no_rekening'>";
						else
							{
								echo "<script>window.alert('Silahkan Ulangi Kembali')</script>";
								echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";
							}
					}

				}
	
	if($kode=="K"){
		if (empty($nominal)) echo "<script>window.alert('Nominal Tidak Boleh Kosong')</script>	
							<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";									
			else{
				if ($nominal > $saldo_terahkir) echo "<script>window.alert('Transaksi Gagal Saldo Tidak Cukup')</script>
													  <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";									
					else{
						$pertama="INSERT INTO simpanan(no_simpanan,no_rek,tanggal,jenis,kode,nominal,petugas) 
         										VALUES ('$no_transaksi','$no_rekening',now(),'S','$kode','$nominal','$petugas')";
							if(mysql_query($pertama)) echo "<script>window.alert('Transaksi Pengambilan Berhasil')</script>
										 <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=struk&no_rekening=$no_rekening'>";
							else
								{
								echo "<script>window.alert('Silahkan Ulangi Kembali')</script>";
								echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transaksi&no_rekening=$no_rekening'>";
								}
						}

				}

			}
}

elseif($view=='transaksi' AND $act=='transfer'){
	
	$no_rekening=$_POST['no_rekening'];
	$no_transaksi=$_POST['no_transaksi'];	
	$petugas=$_SESSION['nip'];
	$nominal=$_POST['nominal'];
	$saldo=$_POST['saldo'];
	$tujuan=$_POST['tujuan'];
	$no_tf			=$no_transaksi;
	$urut_tf 		= substr ($no_tf,6,3);
	$next_tf		=$urut_tf+1;
	$next_number_tf = sprintf ('%03s',$next_tf);
	$t="T";
	$slash="-";
	$no_nb			=$tujuan;
	$urut_nb 		= substr ($no_nb,0,3);
	$next_number_nb = sprintf ('%03s',$urut_nb);
	$no_transaksi_tujuan=$t.$slash.$next_number_nb.$slash.$next_number_tf;	
		
	
	
if ($tujuan==$no_rekening)
			 echo "<script>window.alert('Akses Tidak Diijinkan')</script>	
				  <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transfer&no_rekening=$no_rekening'>";	
				  
				  else {
					  
			if ($tujuan=="Rekening Tujuan Tidak Ditemukan")
			 	echo "<script>window.alert('Transfer Gagal Rekening Tujuan Tidak Ditemukan')</script>	
				  <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transfer&no_rekening=$no_rekening'>";	
				  
			else{
				if ($nominal > $saldo) echo "<script>window.alert('Transfer Gagal Saldo Tidak Cukup')</script>
													  <meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=transfer&no_rekening=$no_rekening'>";		
				  								
						else{
							$pertama=mysql_query("INSERT INTO sukarela(no_sukarela,no_rek,tanggal,kode,nominal,petugas) 
           									VALUES('$no_transaksi','$no_rekening',now(),'K','$nominal','$petugas')") or die("my");	
							$kedua=mysql_query("INSERT INTO sukarela(no_sukarela,no_rek,tanggal,kode,nominal,petugas) 
            								VALUES('$no_transaksi_tujuan','$tujuan',now(),'D','$nominal','$petugas')") or die ("to");	
							if($pertama.$kedua)
							echo "<script>window.alert('Transfer Berhasil')</script>
							<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=struk&no_rekening=$no_rekening'>";
									else{
										echo "<script>window.alert('Terjadi Kesalahan')</script>";
										echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=transaksi&act=tambahnasabah'>";
										}
							}
				}
			}
	}




elseif($view=='transaksi' AND $act=='pokok'){
	$no_rek=$_POST['no_rekening'];
	$no_pokok=$_POST['no_pokok'];
	$nominal=$_POST['nominal'];
	$petugas=$_SESSION['nip'];
        mysql_query("INSERT INTO simpanan(no_simpanan,
                                    no_rek,
									tanggal,
									jenis,
									kode,
									nominal,
									petugas) 
                            VALUES('$no_pokok',
                                   '$no_rek',
								   now(),
								   'P',
								   'D',
								   '$nominal',
								   '$petugas')");
								   
  header('location:../../main.php?view='.$view);
}

elseif(empty($view)and empty($act)){	
			/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
			header('location:../../main.php?view=home');
									}
  

}
?>
</body>
</html>