<?php
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['password'])){
/*echo "<script>window.alert('Akses Tidak Di Ijinkan')</script>";*/
header('location:index.php');
}
else{		
//ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
include "../../config/database.php";
function num($rp){if($rp!=0){$hasil = number_format ($rp, 2, ',', '.');}else{$hasil=0;}return $hasil;}
echo"
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='stylesheet' href='../../css/laporan.css' type='text/css'/>
<link rel='stylesheet' href='../../css/style.css' type='text/css'/>
<title>Laporan Simpanan</title>
</head>  
<body> 
<div id='daddyy'>
<div id='headerr'><h3 align='center'>STRUK TRANSAKSI SIMPANAN NASABAH</h3>
				 <h1 align='center'>KOPERASI SIMPAN PINJAM ARTHA MANDIRI</h1>
				 <h5 align='center'>Kantor Pusat: Jl. MAGELLANG-PURWOREJO Km9 Ruko Jambu Blok 3 Tempuran Magelang</h5></div>
<div id='contentt'>";
$nasabah = mysql_query("SELECT no_pinjam, FROM angsur WHERE no_pinjam='$_POST[no_rek]'");
    $n    = mysql_fetch_array($nasabah);

    echo "<h2 align='center'>SIMPANAN</h2>
	<br>
	<div class='nsb'>
          
          	<table class='listc'>
		  		<tbodyc>
		  			<tr><td class='a'>No pinjam		</td><td class='b'>	:	$n[no_pinjam]	</td></tr>
		  			<tr><td class='a'>Nama				</td><td class='b'>	:	$n[nama]</td></tr>
          			<tr><td class='a'>Simpanan Wajib	</td><td class='b'>	:	Rp ".num($n['wajib'])."</td></tr>
					<tr><td class='a'>Simpanan Pokok	</td><td class='b'>	:	Rp ".num($n['pokok'])."</td></tr>
					<tr><td class='a'>Simpanan Manasuka	</td><td class='b'>	:	Rp ".num($n['sukarela'])."</td></tr>
         			<tr>
          			<td></td>
					</tr>
          </tbodyc>
		  </table>
		  
		  </div>
<h3 align='center'> SIMPANAN MANASUKA </h3>
	<br>
		 <table class='list'><thead>
         <td class='left'>No</td>
		  <td class='left'>Tanggal</td>
		  <td class='left'>Debet</td>
		  <td class='left'>Kredit</td>
          <td class='center'>Saldo</td>
          </tr></thead>
		  <tbody>";
		  
	$struk = mysql_query("select @Urut:=@Urut+1 Urut, tanggal,kode,jenis,
case when kode='D' then nominal else 0 end as Debit,
case when kode='K' then nominal else 0 end as Kredit,
(@LB := @LB + if (kode='D', nominal, -nominal)) as Saldo
from (SELECT @Urut := 0) as Urut,(select @LB := 0) as Awal, simpanan where jenis ='S'
AND no_rek = '$_POST[no_rek]' group by no_rek, tanggal
order by tanggal asc");
    $no=+1;
    while ($r=mysql_fetch_array($struk)){
      echo "<tr>
	  			<td class='left'>$r[Urut]</td>
                <td class='left'>$r[tanggal]</td>
				<td class='left'>Rp ".num($r['Debit'])."</td>
				<td class='left'>Rp ".num($r['Kredit'])."</td>
				<td class='left'>Rp ".num($r['Saldo'])."</td>
			</tr>";
    $no++;
	}
    echo "
</table>
	<br>
		 <div align='center'><input class=noPrint type=button value=Cetak onclick=window.print()></div>		 

<div>
</div>
</body>  
<html>";
		
}

?>

