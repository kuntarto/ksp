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
include "../../helper/image.php";
$view=$_GET['view'];
$act=$_GET['act'];

if ($view=='petugas' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT foto FROM petugas WHERE nip='$_GET[nip]'"));
  if ($data['foto']!=''){
	 unlink("../../foto_petugas/$data[foto]");
	 unlink("../../foto_petugas/medium_$data[foto]");
	 unlink("../../foto_petugas/small_$data[foto]");  
     mysql_query("DELETE FROM petugas WHERE nip='$_GET[nip]'");
     
	 echo "<script>window.alert('Petugas Berhasil Dihapus')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	 
  }
  else{
    mysql_query("DELETE FROM petugas WHERE nip='$_GET[nip]'");
	echo "<script>window.alert('Petugas Berhasil Dihapus')</script>
 			<meta http-equiv='refresh' content='0; url=../../main.php?view=$view'>";	
  }
  	
}

elseif($view=='petugas' AND $act=='input'){
	
	$lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
	
	$nip=$_POST['nipp'];
	$cab=$_POST ['cab'];
	$nama=$_POST['nama'];
	$jenis_kelamin=$_POST['jenis_kelamin'];
	$tanggal_lahir=$_POST['tanggal_lahir'];
	$alamat=$_POST['alamat'];
	$jabatan=$_POST['jabatan'];
	$tlp=$_POST['tlp'];
	$email=$_POST['email'];
	$pass=md5(12345);
if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../main.php?view=$view')</script>";
    }
    else{
    Petugas($nama_file_unik);
        
		mysql_query("INSERT INTO petugas
		(`nip`, `cab`, `nama`, `jenis_kelamin`, `tanggal_lahir`,  `jabatan`, `alamat`, `tlp`, `email`, `password`, `foto`, `blokir`) VALUES ('$nip', '$cab', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$jabatan', '$alamat', '$tlp', '$email', '$pass', '$nama_file_unik', 'N')");
			header('location:../../main.php?view='.$view);
}
  }
			
	 else{
    mysql_query("INSERT INTO petugas
		(`nip`, `cab`, `nama`, `jenis_kelamin`, `tanggal_lahir`,  `jabatan`, `alamat`, `tlp`, `email`, `password`,  `blokir`) VALUES ('$nip', '$cab', '$nama', '$jenis_kelamin', '$tanggal_lahir',  '$jabatan', '$alamat', '$tlp', '$email', '$pass',  'N')");
			header('location:../../main.php?view='.$view);
  }		
			
			
			
			if( mysql_query){
echo "<script>window.alert('Data telah disimpan')</script>";
 header('location:../../main.php?view='.$view);
}
else
{
echo "<script>window.alert('Terjadi Kessalahan')</script>";
echo"<meta http-equiv='refresh' content='0; url=../../main.php?view=petugas&act=tambahpetugas'>";
};
 
}





elseif ($view=='petugas' AND $act=='update'){
 
 $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
  
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 if (empty($lokasi_file)){
    mysql_query("UPDATE petugas SET 
										cab = '$_POST[cab]',
										nama = '$_POST[nama]',
										jenis_kelamin = '$_POST[jenis_kelamin]',
										tanggal_lahir = '$_POST[tanggal_lahir]',
										jabatan = '$_POST[jabatan]',
										alamat = '$_POST[alamat]',
										tlp = '$_POST[tlp]',
										email = '$_POST[email]',
										password = '$_POST[password]',
										blokir = '$_POST[blokir]'
                             			WHERE nip= '$_POST[nipp]'");
  header('location:../../main.php?view='.$view);
  }
  
  
  else{
	  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../main.php?view=petugas')</script>";
    }
	else{
    Petugas($nama_file_unik);
	 $data=mysql_fetch_array(mysql_query("SELECT foto FROM petugas WHERE nip='$_POST[nipp]'"));
    unlink("../../foto_petugas/$data[foto]");
	 unlink("../../foto_petugas/medium_$data[foto]");
	 unlink("../../foto_petugas/small_$data[foto]");  

	
	
	
	 mysql_query("UPDATE petugas SET 
										cab = '$_POST[cab]',
										nama = '$_POST[nama]',
										jenis_kelamin = '$_POST[jenis_kelamin]',
										tanggal_lahir = '$_POST[tanggal_lahir]',
										jabatan = '$_POST[jabatan]',
										alamat = '$_POST[alamat]',
										tlp = '$_POST[tlp]',
										email = '$_POST[email]',
										password = '$_POST[password]',
										foto = '$nama_file_unik',
										blokir = '$_POST[blokir]'
                             			WHERE nip= '$_POST[nipp]'");
  header('location:../../main.php?view='.$view);
}
}
}




elseif ($view=='petugas' AND $act=='dataku'){
 $password1=$_POST['password1'];
 $pass=md5($password1);
 if (empty($password1)){
    mysql_query("UPDATE petugas SET 	alamat = '$_POST[alamat]',
										tlp = '$_POST[tlp]',
										email = '$_POST[email]',
										password = '$_POST[password2]'
                             			WHERE nip= '$_POST[nipp]'");
   session_destroy();
  /*echo "<script>alert('Anda telah keluar dari view administrator'); window.location = '../'</script>";
  */
  header('location:../../');
  }
  
	else{
			
	 mysql_query("UPDATE petugas SET 
										
										alamat = '$_POST[alamat]',
										tlp = '$_POST[tlp]',
										email = '$_POST[email]',
										password = '$pass'
										
                             			WHERE nip= '$_POST[nipp]'");
   session_destroy();
  /*echo "<script>alert('Anda telah keluar dari view administrator'); window.location = '../'</script>";
  */
  header('location:../../');

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