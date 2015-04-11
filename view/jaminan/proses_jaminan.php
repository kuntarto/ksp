<html>
<link rel="stylesheet" href="../../css/style.css" type="text/css" />
<body>
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
if ($view=='jaminan' AND $act=='hapus'){
  mysql_query("DELETE FROM jaminan WHERE jaminan='$_GET[no_jaminan]'");
  header('location:../../main.php?view='.$view);
}
elseif ($view=='jaminan' AND $act=='update'){
    $pertama="UPDATE pinjam SET 
	nama_jaminan   = '$_POST[nama_jaminan]',
	jenis = '$_POST[jenis]', 
	nama_pemilik   = '$_POST[nama_pemilik]',
	alamat_pemilik   = '$_POST[alamat_pemilik]' , 
	status_jaminan   = '$_POST[status]' 
                            WHERE no_pinjam= '$_POST[no_jaminan]' ";						 
							 mysql_query($pertama) or die("Gagal update ");
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