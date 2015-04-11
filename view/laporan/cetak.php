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
//ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
include "../../config/database.php";
function num($rp){
if($rp!=0){
	$hasil = number_format ($rp, 2, ',', '.');
	}
	else{
	$hasil=0;
	}
return $hasil;
}
$jenis		=$_POST['jenis'];
$cabang		=$_POST['cab'];
$bulan		=$_POST['lama'];
$tahun		=$_POST['bunga'];
$slash		="-";
$periode	=$tahun.$slash.$bulan;
$tanggal	=date("d-m-Y");
			if ($jenis=="simpan"){
				$hasil = mysql_query("select tanggal from nasabah n inner join simpanan s on n.no_rekening=s.no_rek where tanggal  Like '%$periode%' ");
     		if (mysql_num_rows($hasil) == 0) echo "<script>window.alert('Tidak Ada Transaksi Diperiode Tersebut')</script>
									  				<meta http-equiv='refresh' content='0; url=../../main.php?view=laporan'>";	
   		  	else
     		{
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
<div id='headerr'><h3 align='center'>LAPORAN TRANSAKSI SIMPANAN NASABAH</h3>
				 <h1 align='center'>KOPERASI SIMPAN PINJAM ARTHA MANDIRI</h1>
				 <h5 align='center'>Kantor Pusat: Jl. MAGELLANG-PURWOREJO Km9 Ruko Jambu Blok 3 Tempuran Magelang </h5></div>
<div id='contentt'>";
	
    $cab=mysql_query("SELECT no_cab,nama_cab from cabang where no_cab='$cabang'");
	$c=mysql_fetch_array($cab);
	$tot=mysql_query("SELECT count(no_rekening) as jumlah, sum(wajib) as saldo from nasabah where cabang='$cabang'");
	$tot=mysql_fetch_array($tot);
	$pokok=mysql_query("select no_rekening,cabang,tanggal,sum(nominal)as saldo from nasabah n inner join simpanan s on n.no_rekening=s.no_rek where cabang='$cabang' and tanggal Like '%$periode%' and jenis='P'"  );
	$pok=mysql_fetch_array($pokok);
	$sukarela=mysql_query("select no_rekening,cabang,tanggal,sum(nominal)as saldo from nasabah n inner join simpanan s on n.no_rekening=s.no_rek where jenis='S' and kode='D' and cabang='$cabang' and tanggal Like '%$periode%'" );
	$suk=mysql_fetch_array($sukarela);
	$sukarela1=mysql_query("select no_rekening,cabang,tanggal,sum(nominal)as saldo from nasabah n inner join simpanan s on n.no_rekening=s.no_rek where jenis='S' and kode='K' and cabang='$cabang' and tanggal Like '%$periode%'" );
	$suk1=mysql_fetch_array($sukarela1);
	$suk3=$suk['saldo']-$suk1['saldo'];
	$jm=mysql_query("select sum(wajib)as wajib, sum(pokok)as pokok, sum(sukarela)as sukarela from nasabah where cabang='$cabang'");
	$jum=mysql_fetch_array($jm);
	
echo"
<h3 align='center'> SIMPANAN WAJIB </h3>
<br>
 <table class='list'><thead>
		<tr><td class='center'>Cabang</td>
		<td class='center'>Peridoe</td>
		<td class='center'>Jumlah Nasabah</td>
		<td class='center'>Jumlah Simpanan Wajib</td>
		<thead><tbody>
		</tr>
		<tr><td class='center'>$c[no_cab] - $c[nama_cab]</td>
		<td class='center'>Bulan ke-$bulan Tahun-$tahun</td>
		<td class='center'>$tot[jumlah]</td>
		<td class='center'>Rp ".num($tot['saldo'])."</td>
		</tr>
</table><br>
<h3 align='center'> TRANSAKSI SIMPANAN WAJIB </h3>
	<br>
		 <table class='list'><thead>
         <tr><td class='center'>No</td>
		 <td class='left'>No Rekening</td>
         <td class='left'>Nama</td>
		 <td class='left'>Tanggal</td>
         <td class='center'>Wajib</td>
		  </thead>
		  <tbody>";
		  
    $tampil=mysql_query("SELECT no_rekening,nama,wajib,tgldibuat,cabang from nasabah where cabang='$cabang' ORDER BY no_rekening asc");
    $no=+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[tgldibuat]</td>
				 <td class='left'>Rp ".num($r['wajib'])."</td>
		        </tr>";
    $no++;
	}
    echo "</table><br>
<h3 align='center'> SIMPANAN POKOK </h3>
	<br>
 <table class='list'><thead>
		<tr><td class='center'>Cabang</td>
		<td class='center'>Peridoe</td>
		<td class='center'>Jumlah Nasabah</td>
		<td class='center'>Jumlah Simpanan Pokok</td>
		<thead><tbody>
		</tr>
		<tr><td class='center'>$c[no_cab] - $c[nama_cab]</td>
		<td class='center'>Bulan ke-$bulan Tahun-$tahun</td>
		<td class='center'>$tot[jumlah]</td>
		<td class='center'>Rp ".num($pok['saldo'])."</td>
		</tr>
</table>		 
	<br>
<h3 align='center'> TRANSAKSI SIMPANAN POKOK </h3>
	<br>
		 <table class='list'><thead>
          <tr><td class='center'>No</td>
		  <td class='left'>No Simpanan</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama</td>
		   <td class='left'>Tanggal</td>
          <td class='center'>Pokok</td>
		  </thead>
		  
		  
		  <tbody>";
		  
    $tampil=mysql_query("SELECT no_simpanan,no_rekening,nama,tanggal,cabang,nominal from nasabah n inner join simpanan s on n.no_rekening=s.no_rek where cabang='$cabang' and jenis='P' ORDER BY no_rekening asc");
    $no=+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='left'>$r[no_simpanan]</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
				 <td class='left'>Rp ".num($r['nominal'])."</td>
				
		        </tr>";
    $no++;
	}
    echo "</table><br>	 
		 
<h3 align='center'> SIMPANAN SUKARELA </h3>
	<br>
 <table class='list'><thead>
		<tr><td class='center'>Cabang</td>
		<td class='center'>Peridoe</td>
		<td class='center'>Jumlah Nasabah</td>
		<td class='center'>Jumlah Simpanan Sukarela</td>
		<thead><tbody>
		</tr>
		<tr><td class='center'>$c[no_cab] - $c[nama_cab]</td>
		<td class='center'>Bulan ke-$bulan Tahun-$tahun</td>
		<td class='center'>$tot[jumlah]</td>
		<td class='center'>Rp ".num($suk3)."</td>
		</tr>
</table>		 
<br>
<h3 align='center'> TRANSAKSI SIMPANAN SUKARELA </h3>
	<br>
		 <table class='list'><thead>
          <tr><td class='center'>No</td>
		  <td class='left'>No Simpanan</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
          <td class='left'>Tanggal</td>
		  <td class='center'>Debit</td>
          <td class='center'>Kredit</td>
		  <td class='center'>Saldo</td>
		  </thead> 
		  <tbody>";
	$struk = mysql_query("select no_simpanan,no_rek,nama,tanggal,kode,jenis,
case when kode='D' then nominal else 0 end as Debit,
case when kode='K' then nominal else 0 end as Kredit,
(@LB := @LB + if (kode='D', nominal, -nominal)) as Saldo
from (select @LB := 0) as Awal ,simpanan s left join nasabah n on n.no_rekening=s.no_rek  where jenis='S' AND no_simpanan like'%$cabang%'");
	
    $no=+1;
    while ($r=mysql_fetch_array($struk)){
      echo "<tr><td class='center'>$no</td>
				<td class='left'>$r[no_simpanan]</td>
				<td class='left'>$r[no_rek]</td>
                <td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
				 <td class='left'>Rp ".num($r['Debit'])."</td>
				 <td class='left'>Rp ".num($r['Kredit'])."</td>
				 <td class='left'>Rp ".num($r['Saldo'])."</td>
				 
				
		        </tr>";
    $no++;
	}
    echo "</table><br>	
<h3 align='center'> SALDO AKHIR </h3>
	<br>
 <table class='list'><thead>
		<tr><td class='center'>Cabang</td>
		<td class='center'>Peridoe</td>
		<td class='center'>Jumlah Nasabah</td>
		<td class='center'>Saldo Simpanan Wajib</td>
		<td class='center'>Saldo Simpanan Pokok</td>
		<td class='center'>Saldo Simpanan Sukarela</td>
		<thead><tbody>
		</tr>
		<tr><td class='center'>$c[no_cab] - $c[nama_cab]</td>
		<td class='center'>Hingga Tanggal $tanggal</td>
		<td class='center'>$tot[jumlah]</td>
		<td class='center'>Rp ".num($jum['wajib'])."</td>
		<td class='center'>Rp ".num($jum['pokok'])."</td>
		<td class='center'>Rp ".num($jum['sukarela'])."</td>
		</tr>
</table>		 
		 <br>

	<br>
		 <div align='center'><input class=noPrint type=button value=Cetak onclick=window.print()></div>
		 
		 
		 
		 
		 



</div>
				 

<div>
</div>
</body>  
<html>";
			}
}



elseif($jenis=="pinjam")
{
	
	$hasil = mysql_query("select tanggal_angsur, tanggal from nasabah n inner join angsur a inner join pinjam p on n.no_rekening=a.no_rek 
 and n.no_rekening=p.no_rek where tanggal_angsur  Like '%$periode%' or tanggal Like '%$periode'");
     if (mysql_num_rows($hasil) == 0) echo "<script>window.alert('Tidak Ada Transaksi Peminjaman Dan Angsuran Diperiode Tersebut')</script>
									  <meta http-equiv='refresh' content='0; url=../../main.php?view=laporan'>";	
   		  else
     		{
	 echo"<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='stylesheet' href='../../css/laporan.css' type='text/css'/>
<link rel='stylesheet' href='../../css/style.css' type='text/css'/>
<title>Laporan Pinjaman</title>
</head>  
<body> 
<div id='daddyy'>
<div id='headerr'><h3 align='center'>LAPORAN TRANSAKSI PINJAMAN DAN ANGSURAN NASABAH</h3>
				 <h1 align='center'>KOPERASI SIMPAN PINJAM ARTHA MANDIRI</h1>
				 <h5 align='center'>Kantor Pusat: Jl. MAGELLANG-PURWOREJO Km9 Ruko Jambu Blok 3 Tempuran Magelang </h5></div>
<div id='contentt'>";
	$cab=mysql_query("SELECT no_cab,nama_cab from cabang where no_cab='$cabang'");
	$c=mysql_fetch_array($cab);
	$pjm=mysql_query("Select no_rekening,nama,cabang,count(no_pinjam)as total,no_pinjam,jumlah,lama,status,keterangan
	from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang'");
	$d=mysql_fetch_array($pjm);
	
	
	$e=mysql_query("Select tanggal,count(status) as belum from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang' and  status='B' and tanggal Like '%$periode%'");
	$mengajukan=mysql_fetch_array($e);
	$f=mysql_query("Select count(status) as sudah from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang' and status='Y'  and tanggal Like '%$periode%'");
	$disetujui=mysql_fetch_array($f);
	$g=mysql_query("Select count(status) as tolak from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang' and status='T'  and tanggal Like '%$periode%'");
	$ditolak=mysql_fetch_array($g);
	$a=mysql_query("Select sum(jumlah) as keluar, sum(sisa)as sisa from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang' and status='Y' and tanggal Like '%$periode%'");
	$keluar=mysql_fetch_array($a);
	$b=mysql_query("Select sum(total) as laba from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang'  and status='Y' and tanggal Like '%$periode%'");
	$laba=mysql_fetch_array($b);
	$untung=$laba['laba']-$keluar['keluar'];
	$h=mysql_query("Select sum(besar_angsuran) as besar,sum(denda) as denda from nasabah n inner join angsur a on n.no_rekening=a.no_rek where cabang='$cabang'  and tanggal_angsur Like '%$periode%'");
	$masuk=mysql_fetch_array($h);
	$total_keuntungan=$untung+$masuk['denda'];
	
	
    
	
echo"
<h3 align='center'> PINJAMAN </h3>
<br>
Cabang &nbsp;&nbsp;:$c[no_cab] - $c[nama_cab]<br>
Priode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Bulan ke-$bulan Tahun-$tahun
<br>
<br>
 <table class='list'><thead>
		<tr>
		<td class='center'>Jumlah Peminjam</td>
		<td class='center'>Dalam Proses</td>
		<td class='center'>Disetujui</td>
		<td class='center'>Ditolak</td>
		<td class='center'>Saldo Keluar</td>
		<td class='center'>Bunga</td>
		<td class='center'>Saldo Masuk</td>
		<td class='center'>Denda</td>
		<td class='center'>Laba</td>
		<thead><tbody>
		</tr>
		<tr>
		<td class='center'>$d[total]</td>
		<td class='center'>$mengajukan[belum]</td>
		<td class='center'>$disetujui[sudah]</td>
		<td class='center'>$ditolak[tolak]</td>
		<td class='center'>Rp ".num($keluar['keluar'])."</td>
		<td class='center'>Rp ".num($untung)."</td>
		<td class='center'>Rp ".num($masuk['besar'])."</td>
		<td class='center'>Rp ".num($masuk['denda'])."</td>
		<td class='center'>Rp ".num($total_keuntungan)."</td>
		</tr>
</table>

<br>
<h3 align='center'>DAFTAR PEMINJAM </h3>
<br>

 <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>No Pinjam</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal Pinjam</td>
          <td class='left'>Jumlah Pinjam</td>
          <td class='center'>Sisa Hutang</td>
		  <td class='center'>Jaminan</td>
		  </thead>
		  
		  
		  <tbody>";
		  
    $tampil=mysql_query("
select no_rekening,cabang,no_pinjam,nama,tanggal,jumlah,sisa,jenis from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$cabang' and status='Y' ORDER BY no_rekening asc");
    $no=+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[no_pinjam]</td>
                <td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
				<td class='left'>$r[jumlah]</td>
				 <td class='left'>$r[sisa]</td>
				  <td class='left'>$r[jenis]</td>
				  
				
		        </tr>";
    $no++;
	}
    echo "<tr><thead><td></td><td></td><td ></td><td c></td><td class='center'>Jumlah</td><td class='left'>Rp ".num($keluar['keluar'])."</td><td class='left'>Rp ".num($keluar['sisa'])."</td><td ></td></thead>
	</tr></table>



		 <br>
		 <div align='center'><input class=noPrint type=button value=Cetak onclick=window.print()></div>



</div>
				 

<div>
</div>
</body>  
<html>";
			}
	 
}



}


?>

</body>
</html>

