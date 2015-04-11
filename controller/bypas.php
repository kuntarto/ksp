<html>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<body>
<?php
include "../config/database.php";
function anti_injection($data){
$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
return $filter;
}

$username = anti_injection($_POST['username']);
$password = anti_injection (md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($password)){
	echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";
	echo"<meta http-equiv='refresh' content='0; url=../'>";	
}
else{
$login=mysql_query("select * from petugas WHERE nip='$username' AND password='$password' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[cab]  		= $r[cab];
  $_SESSION[nip]  		= $r[nip];
  $_SESSION[nama]  		= $r[nama];
  $_SESSION[alamat] 	= $r[alamat];
  $_SESSION[tlp]  		= $r[tlp];
  $_SESSION[foto]  		= $r[foto];
  $_SESSION[jabatan] 	= $r[jabatan];
  $_SESSION[password]   = $r[password];
  
  	header('location:../main.php?view=home');
}
else{
 	echo "<script>window.alert('Maaf, Username & Password Salah! Atau Terblokir')</script>";
	echo"<meta http-equiv='refresh' content='0; url=../'>";
	}
}
?>
</body>
</html>