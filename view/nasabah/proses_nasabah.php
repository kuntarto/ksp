<html>
<link rel="stylesheet" href="../../css/style.css" type="text/css" />
<body>
<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:../../index.php');
}
else
{
include "../../config/database.php";
$view=$_GET['view'];
$act=$_GET['act'];

if ($view=='nasabah' AND $act=='hapus'){
  $pertama=mysql_query("DELETE FROM nasabah WHERE no_rekening='$_GET[a]' ");
	if($pertama) 
  			echo "<script>window.alert('Nasabah Berhasil Dihapus')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
		else{
			echo "<script>window.alert('Nasabah Masih Memiliki Hutang Tidak Bisa Dihapus')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
			}
}


elseif($view=='nasabah' AND $act=='input'){
	
	$no_rekening				=$_POST['rek'];
	$cabang						=$_SESSION ['cab'];
	$nama						=$_POST['name'];
	$jenis_kelamin				=$_POST['gender'];
	$tanggal_lahir				=$_POST['date'];
	$pekerjaan					=$_POST['job'];
	$alamat_nasabah				=$_POST['add'];
	$no_identitas				=$_POST['id'];
	$hp_nasabah					=$_POST['hp'];
	$petugas					=$_SESSION['nip'];
	$no_sukarela				=$_POST['no_sukarela'];
	$wajib						=$_POST['wajib'];
	$pokok						=$_POST['pokok'];
	$nominal					=$_POST['nominal'];
	$slash_t					="-";
	$kode_t						="T"; 
	$seleksi					="SELECT substring(no_simpanan, 7, 3)AS no_simpanan FROM simpanan  ORDER BY no_simpanan  DESC LIMIT 1";
	$hasil_t 					=mysql_query($seleksi);	
	$t							=mysql_fetch_array($hasil_t);					
	$no_t						=$t['no_simpanan'];
	$ambl_t 					=substr ($no_t,0,3);
	$next_t						=$ambl_t+1;
	$pokok_t					=$next_t+1;	
	$next_number_t				= sprintf ('%03s',$pokok_t);	
	$no_pokok					=$kode_t.$slash_t.$cabang.$slash_t.$next_number_t;
	$nasabah					="INSERT INTO nasabah
										(no_rekening,cabang,wajib,nama,jenis_kelamin,tanggal_lahir,pekerjaan,alamat,no_identitas,hp,tgldibuat,petugas) 
            					  VALUES('$no_rekening','$cabang','$wajib','$nama','$jenis_kelamin','$tanggal_lahir','$pekerjaan','$alamat_nasabah','$no_identitas','$hp_nasabah',now(),'$petugas')";
	$sukarela					="INSERT INTO simpanan
										(no_simpanan,no_rek,tanggal,jenis,kode,nominal,petugas) 
								  VALUES('$no_sukarela','$no_rekening',now(),'S','D','$nominal','$petugas')";
	$pokok						="INSERT INTO simpanan
										(no_simpanan,no_rek,tanggal,jenis,kode,nominal,petugas) 
            					  VALUES('$no_pokok','$no_rekening',now(),'P','D','$pokok','$petugas')";
	$query1						=mysql_query($nasabah) or die("eror nasabah");
	$query2						=mysql_query($sukarela)or die("eror sukarela");
	$query3						=mysql_query($pokok)or die("eror pokok");

			
			if($query1.$query2.$query3)
				/*	echo "<script>window.alert('Berhasil Menambah Nasabah')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	*/
			 header('location:../../main.php?view='.$view);
		else{
			echo "<script>window.alert('Terjadi Kesalahan')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=nasabah&act=tambahnasabah'>";	
			}
}


elseif ($view=='nasabah' AND $act=='update'){
	
    $query1="UPDATE nasabah SET 	nama 			= '$_POST[nama]',
									jenis_kelamin 	= '$_POST[jenis_kelamin]',
                                   	tanggal_lahir    = '$_POST[tanggal_lahir]',
								   pekerjaan    	= '$_POST[pekerjaan]',
								   alamat    		= '$_POST[alamat]',
								   no_identitas    		= '$_POST[no_identitas]',
								   hp   			= '$_POST[hp_nasabah]',
								   petugas 			= '$_SESSION[nip]'   
                            						 WHERE no_rekening='$_POST[no_rekening]'";
	
					
$simpan1 = mysql_query($query1)  or exit("Error query : <b>".$query1."</b>.");

header('location:../../main.php?view=nasabah&act=detailnasabah&a='.$_POST['no_rekening']);
}

elseif(empty($view)and empty($act)){	
			/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
			header('location:../../main.php?view=home');
									}
  
}
?>
</body>
</html>