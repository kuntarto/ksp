
<?php
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['password'])){
/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
header('location:index.php');
}
else{		
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
include "../../config/database.php";
$view=$_GET['view'];
$act=$_GET['act'];
// Hapus cabang
if ($view=='cabang' AND $act=='hapus'){
 $pertama=mysql_query("DELETE FROM cabang WHERE no_cab='$_GET[no_cab]'");
  if($pertama) 
  			echo "<script>window.alert('Cabang $_GET[no_cab] Berhasil Dihapus')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
		else{
			echo "<script>window.alert('Tidak Bisa Menghapus Cabang $_GET[no_cab]')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
			}
}
// INPUT CABANG
elseif($view=='cabang' AND $act=='input'){
	$no_cabang=$_POST['no_cab'];
	$nama_cabang=$_POST['nama_cab'];
	$alamat_cabang=$_POST['alamat_cab'];
	$tlp_cabang=$_POST['tlp_cab'];
    $pertama= mysql_query("INSERT INTO cabang(no_cab,nama_cab,alamat_cab,tlp_cab) 
                           VALUES('$no_cabang','$nama_cabang','$alamat_cabang','$tlp_cabang')");								   
	if($pertama) 
  			/*echo "<script>window.alert('Cabang $nama_cabang Berhasil Ditambah')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	*/
			 header('location:../../main.php?view='.$view);
		else{
			echo "<script>window.alert('Tidak Bisa Menambah Cabang $nama_cabang')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=cabang&act=tambahcabang'>";	
			}
}

// EDIT CABANG
elseif ($view=='cabang' AND $act=='update'){
    $pertama=mysql_query("UPDATE cabang SET nama_cab = '$_POST[nama_cab]',
                                   alamat_cab   = '$_POST[alamat_cab]',
								   tlp_cab   = '$_POST[tlp_cab]'   
                             WHERE no_cab= '$_POST[no_cab]'");
if($pertama) 
			 header('location:../../main.php?view='.$view);
		else{
			echo "<script>window.alert('Tidak Bisa Edit Cabang $nama_cabang')</script>
 			<meta http-equiv='refresh' content='0;url=../../main.php?view=$view'>";	
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