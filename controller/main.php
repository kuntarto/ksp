<?php
$mod = $_GET['view'];
if ($mod=='home'){
	echo "<div class='beranda'>
	
	<div class='beranda-kiri-dalam' align='center'>
	<img src='foto_petugas/medium_$_SESSION[foto]' border='0' title='$_SESSION[nama]' />
	</div>
	<div class='beranda-kanan-dalam'>
	<div class='beranda-profil'><h2 align=center>SELAMAT BERTUGAS DI KSP ARTHA MANDIRI</h2>
	<br>
	<table class='listc'>
		  		<tbodyc>
		  			<tr><td><b>	CABANG	</b></td><td>	: <b>$_SESSION[cab]</b></td></tr>
					<tr><td>	Nip			</td><td>	: $_SESSION[nip]		</td></tr>
		  			<tr><td>	Nama		</td><td>	: $_SESSION[nama]		</td></tr>
					<tr><td><br></td><td></td></tr>
					<tr><td></td><td>
					<input type='image'  src='images/my.png' onclick=location.href='?view=dataku' />
					
         			
          </tbodyc>
		  </table>
	</div>
	</div>	
	</div>";	
 
}
 
elseif ($mod=='cabang'){
    include "view/cabang/cabang.php";
}
elseif ($mod=='petugas'){
    include "view/petugas/petugas.php";
}
elseif ($mod=='dataku'){
    include "view/petugas/dataku.php";
}
elseif ($mod=='nasabah'){
    include "view/nasabah/nasabah.php";
}
elseif ($mod=='transaksi'){
    include "view/transaksi/transaksi.php";
}
elseif ($mod=='jenis'){
    include "view/jenis/jenis.php";
}
elseif ($mod=='pinjam'){
    include "view/pinjam/pinjam.php";
}
elseif ($mod=='jaminan'){
    include "view/jaminan/jaminan.php";
}

elseif ($mod=='laporan'){
    include "view/laporan/laporan.php";
}
//////////////////AKUNTANSI////////////////////

elseif ($mod=='sop'){
 	include "view/akuntansi/sop/sop.php";
 }
 elseif ($mod=='backup'){
 	include "view/akuntansi/backup/backup.php";
 }
elseif ($mod=='telpon'){
 	include "view/akuntansi/telpon/telpon.php";
}
else{
 echo "<script>window.alert('Halaman Tidak Di Temukan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=main.php?view=home'>";

}
?>