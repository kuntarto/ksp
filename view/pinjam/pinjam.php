
<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);

$proses="view/pinjam/proses_pinjam.php";
include "config/database.php";
include "controller/class_paging.php";
include "controller/no_pinjam.php";
include "controller/no_angsur.php";
include "controller/no_jaminan.php";
include "controller/no_pengajuan.php";
include "controller/rp.php";


switch($_GET['act'])
{
  default:
  	if ($_SESSION['jabatan']=='sa')
{
	 if (empty($_GET['no_pinjam'])){
    echo "<h2 align='center'>DAFTAR PEMINJAM</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=pinjam>
					&nbsp;&nbsp;&nbsp;<input type=button value='Daftar Pengajuan' onclick=location.href='?view=pinjam&act=daftar_pengajuan'>
					<input type=button value='Pengajuan Pinjaman' onclick=location.href='?view=pinjam&act=tambahpeminjam'>
					<input type=button value='Cek Pengajuan' onclick=location.href='?view=pinjam&act=cek_pengajuan'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='no_pinjam' id='no_pinjam' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='center'>No Pinjam</td>
          <td class='center'>No Rekening</td>
		  <td class='center''>Nama</td>
		  <td class='center'>Tanggal Pinjam</td>
		  <td class='center'>Jumlah Pinjam</td>
		   <td class='center'>Lama Angsuran</td>
		   <td class='center'>Bunga</td>
		  <td class='center'>Sisa Hutang</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging;
    $batas  = 4;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
SELECT cabang,no_rekening,no_pinjam,nama,alamat,jumlah,lama,tanggal,sisa,bunga
  From nasabah n inner join pinjam p
  on n.no_rekening = p.no_rek where status='Y'
   ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='center' width='50'>$r[no_pinjam]</td>
                <td class='center' width='80'>$r[no_rekening]</td>
				<td class='center' >$r[nama]</td>
				<td class='center' >$r[tanggal]</td>
				<td class='center'>".num($r[jumlah])."</td>
				<td class='center' width='20'>$r[lama] bulan</td>
				<td class='center' width='15'>$r[bunga] % </td>
				<td class='center' width='90'>".num($r[sisa])."</td>
                <td class='center' width='85'>";
				if($r['sisa']=="0") echo"
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>
	            <a href='$proses?view=pinjam&act=hapus&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
				else {
				echo"
				<a href='?view=pinjam&act=angsur&no_pinjam=$r[no_pinjam]'><img src='images/angsur.png' border='0' title='Angsuran' /></a>
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>";
					}
		        echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("select cabang from nasabah n inner join pinjam p on n.no_rekening=p.no_rek " ));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";

   break;
	 }
   else{
	    echo "<h2 align='center'>DAFTAR PEMINJAM</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=pinjam>

					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='no_pinjam' id='no_pinjam' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='center'>No Pinjam</td>
          <td class='center''>No Rekening</td>
		  <td class='center'>Nama</td>
		  <td class='center'>Tanggal Pinjam</td>
		  <td class='center'>Jumlah Pinjam</td>
		   <td class='center'>Lama Angsuran</td>
		   <td class='center'>Bunga</td>
		  <td class='center'>Sisa Hutang</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging14;
    $batas  = 4;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
SELECT cabang,no_rekening,no_pinjam,nama,alamat,jumlah,lama,tanggal,sisa,bunga
  From nasabah n inner join pinjam p
  on n.no_rekening = p.no_rek where status='Y' and  no_pinjam LIKE '%$_GET[no_pinjam]%' ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='center' width='50'>$r[no_pinjam]</td>
                <td class='center' width='80'>$r[no_rekening]</td>
				<td class='center' >$r[nama]</td>
				<td class='center' >$r[tanggal]</td>
				<td class='center'>".num($r[jumlah])."</td>
				<td class='center' width='20'>$r[lama] bulan</td>
				<td class='center' width='15'>$r[bunga] % </td>
				<td class='center' width='90'>".num($r[sisa])."</td>
                <td class='center' width='85'>";
				if($r['sisa']=="0") echo"
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>
	            <a href='$proses?view=pinjam&act=hapus&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
				else {
				echo"
				<a href='?view=pinjam&act=angsur&no_pinjam=$r[no_pinjam]'><img src='images/angsur.png' border='0' title='Angsuran' /></a>
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>";
					}
		        echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("select cabang from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where no_pinjam LIKE '%$_GET[no_pinjam]%'" ));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
	break;
	}
	
}

	
else{

	 if (empty($_GET['no_pinjam'])){
    echo "<h2 align='center'>DAFTAR PEMINJAM</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=pinjam>
					&nbsp;&nbsp;&nbsp;<input type=button value='Pengajuan Pinjaman' onclick=location.href='?view=pinjam&act=tambahpeminjam'>
					<input type=button value='Cek Pengajuan' onclick=location.href='?view=pinjam&act=cek_pengajuan'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='no_pinjam' id='no_pinjam' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='left'>No Pinjam</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal Pinjam</td>
		  <td class='left'>Jumlah Pinjam</td>
		   <td class='left'>Lama Angsuran</td>
		   <td class='left'>Bunga</td>
		  <td class='left'>Sisa Hutang</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging;
    $batas  = 4;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
SELECT cabang,no_rekening,no_pinjam,nama,alamat,jumlah,lama,tanggal,sisa,bunga
  From nasabah n inner join pinjam p
  on n.no_rekening = p.no_rek where cabang='$_SESSION[cab]' and status='Y'
   ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  				<td class='center' width='50'>$r[no_pinjam]</td>
                <td class='center' width='80'>$r[no_rekening]</td>
				<td class='center' >$r[nama]</td>
				<td class='center' >$r[tanggal]</td>
				<td class='center'>".num($r[jumlah])."</td>
				<td class='center' width='20'>$r[lama] bulan</td>
				<td class='center' width='15'>$r[bunga] % </td>
				<td class='center' width='90'>".num($r[sisa])."</td>
                <td class='center' width='85'>";
				if($r['sisa']=="0") echo"
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>
	            <a href='$proses?view=pinjam&act=hapus&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
				else {
				echo"
				<a href='?view=pinjam&act=angsur&no_pinjam=$r[no_pinjam]'><img src='images/angsur.png' border='0' title='Angsuran' /></a>
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>";
					}
		        echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("select cabang from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$_SESSION[cab]'" ));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";

   break;
	 }
   else{
	    echo "<h2 align='center'>DAFTAR PEMINJAM</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=pinjam>

					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='no_pinjam' id='no_pinjam' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='left'>No Pinjam</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal Pinjam</td>
		  <td class='left'>Jumlah Pinjam</td>
		   <td class='left'>Lama Angsuran</td>
		   <td class='left'>Bunga</td>
		  <td class='left'>Sisa Hutang</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging14;
    $batas  = 4;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
SELECT cabang,no_rekening,no_pinjam,nama,alamat,jumlah,lama,tanggal,sisa,bunga
  From nasabah n inner join pinjam p
  on n.no_rekening = p.no_rek where cabang='$_SESSION[cab]' and status='Y' and  no_pinjam LIKE '%$_GET[no_pinjam]%' ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  				<td class='center' width='50'>$r[no_pinjam]</td>
                <td class='center' width='80'>$r[no_rekening]</td>
				<td class='center' >$r[nama]</td>
				<td class='center' >$r[tanggal]</td>
				<td class='center'>".num($r[jumlah])."</td>
				<td class='center' width='20'>$r[lama] bulan</td>
				<td class='center' width='15'>$r[bunga] % </td>
				<td class='center' width='90'>".num($r[sisa])."</td>
                <td class='center' width='85'>";
				if($r['sisa']=="0") echo"
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>
	            <a href='$proses?view=pinjam&act=hapus&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
				else {
				echo"
				<a href='?view=pinjam&act=angsur&no_pinjam=$r[no_pinjam]'><img src='images/angsur.png' border='0' title='Angsuran' /></a>
				<a href='?view=pinjam&act=detail&no_pinjam=$r[no_pinjam]'><img src='images/detail.png' border='0' title='Detail Peminjaman' /></a>";
					}
		        echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("select cabang from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$_SESSION[cab]' and no_pinjam LIKE '%$_GET[no_pinjam]%'" ));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
	break;
	}
	}
	
  
  case "tambahpeminjam":
  	if ($_SESSION['jabatan']=='sa')
{
      echo "<h2 align='center'>PENGAJUAN PEMINJAMAN</h2>
	  <div class='nsb'>
          <form name='nasabah' id='nasabah'  method=POST action='$proses?view=pinjam&act=pinjam' >
          	<table class='listc'>
		  		<tbodyc>
		  			<input type=hidden name='no_pinjam'  value='$no_pinjam' readonly='true' size=20 >
          			<tr><td class='a'>		No Pengajuan		</td><td  	class='b'>:	$no_pinjam</td></tr>";
		   echo "   <tr><td  class='a'>		Rekening Peminjam	</td><td 	class='b'>:  <select name='no_rek' id='no_rek'><option selected>- Masukan No Rekening -</option>";
            $tampil=mysql_query("SELECT * from nasabah WHERE  hutang='N' ");
            while($z=mysql_fetch_array($tampil)){
           echo "<option value=$z[no_rekening]> $z[no_rekening] </option>";
            }
				
		 echo "  <tr><td  class='a'>Jumlah Pinjam	</td><td class='b'> : <input type=text name='jumlah'  id='jumlah' maxlength='8'></td></tr>
			 	 <tr><td  class='a'>Lama Pinjam		</td><td class='b'> :  <select name='lama' id='lama'><option value='a' selected>- Lama -</option>
			 														<option value=2 >- 2 Bulan -</option>
																	<option value=6 >- 6 Bulan -</option>
																	<option value=10 >- 10 Bulan -</option>
																	<option value=12 >- 12 Bulan -</option>
																	<option value=24 >- 24 Bulan -</option>
																	<option value=36 >- 36 Bulan -</option>
																	</select>
			  	<tr><td  class='a'>Bunga</td>  <td class='b'> 	:  <select name='bunga' id='bunga'><option value='a' selected>- Bunga -</option>
			 														<option value=0 >- 0% -</option>
																	<option value=1 >- 1% -</option>
																	<option value=2 >- 2% -</option>
																	<option value=2 >- 3% -</option>
																	<option value=4 >- 4% -</option>
																	<option value=5 >- 5% -</option>
																	<option value=6 >- 6% -</option>
																	<option value=7 >- 7% -</option>
																	<option value=8 >- 8% -</option>
																	<option value=9 >- 9% -</option>
																	<option value=10>- 10% -</option>
																	<option value=11>- 11% -</option>
																	<option value=12>- 12% -</option>
																	<option value=13>- 13% -</option>
																	<option value=14>- 14% -</option>
																	<option value=15>- 15% -</option>
																	<option value=16>- 16% -</option>
																	<option value=17>- 17% -</option>
																	<option value=18>- 18% -</option>
																	<option value=19>- 19% -</option>
																	<option value=20>- 20% -</option>
																	<option value=25>- 25% -</option>
																	<option value=50>- 50% -</option>
																	<option value=100>- 100% -</option>
																	</select>
			   
					 <tr><td class='a'>Jenis Jaminan</td>     <td class='b'> : <input type=radio name='jenis' id='jenis' value='Surat'> Surat   
                            			               						 <input type=radio name='jenis' value='Barang' id='jenis' > Barang/Kendaraan </td></tr>
					  <tr><td  class='a'>Nama Jaminan</td><td class='b'>  : <input type=text name='nama_jaminan' id='nama_jaminan' size=20></td></tr>
					  <tr><td  class='a'>Nama pemilik </td><td class='b'>  : <input type=text name='nama_pemilik' id='nama_pemilik'size=20></td></tr>
					  <tr><td  class='a'>Alamat pemilik</td><td class='b'>  : <textarea rows=4	cols='17' name='alamat_nasabah' id='alamat_nasabah'></textarea></td></tr>
          <tr><td></td><td><input type=submit value=Ajukan>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
}else{
	
	 echo "<h2 align='center'>PENGAJUAN PEMINJAMAN</h2>
	  <div class='nsb'>
          <form name='nasabah' id='nasabah'  method=POST action='$proses?view=pinjam&act=pinjam' >
          	<table class='listc'>
		  		<tbodyc>
		  			<input type=hidden name='no_pinjam'  value='$no_pinjam' readonly='true' size=20 >
          			<tr><td class='a'>		No Pengajuan		</td><td  	class='b'>:	$no_pinjam</td></tr>";
		   echo "   <tr><td  class='a'>		Rekening Peminjam	</td><td 	class='b'>:  <select name='no_rek' id='no_rek'><option selected>- Masukan No Rekening -</option>";
            $tampil=mysql_query("SELECT * from nasabah WHERE cabang LIKE '%$_SESSION[cab]%' and hutang='N' ");
            while($z=mysql_fetch_array($tampil)){
           echo "<option value=$z[no_rekening]> $z[no_rekening] </option>";
            }
				
		 echo "  <tr><td  class='a'>Jumlah Pinjam	</td><td class='b'> : <input type=text name='jumlah'  id='jumlah' maxlength='8'></td></tr>
			 	 <tr><td  class='a'>Lama Pinjam		</td><td class='b'> :  <select name='lama' id='lama'><option value='a' selected>- Lama -</option>
			 														<option value=2 >- 2 Bulan -</option>
																	<option value=6 >- 6 Bulan -</option>
																	<option value=10 >- 10 Bulan -</option>
																	<option value=12 >- 12 Bulan -</option>
																	<option value=24 >- 24 Bulan -</option>
																	<option value=36 >- 36 Bulan -</option>
																	</select>
			  	<tr><td  class='a'>Bunga</td>  <td class='b'> 	:  <select name='bunga' id='bunga'><option value='a' selected>- Bunga -</option>
			 														<option value=0 >- 0% -</option>
																	<option value=1 >- 1% -</option>
																	<option value=2 >- 2% -</option>
																	<option value=2 >- 3% -</option>
																	<option value=4 >- 4% -</option>
																	<option value=5 >- 5% -</option>
																	<option value=6 >- 6% -</option>
																	<option value=7 >- 7% -</option>
																	<option value=8 >- 8% -</option>
																	<option value=9 >- 9% -</option>
																	<option value=10>- 10% -</option>
																	<option value=11>- 11% -</option>
																	<option value=12>- 12% -</option>
																	<option value=13>- 13% -</option>
																	<option value=14>- 14% -</option>
																	<option value=15>- 15% -</option>
																	<option value=16>- 16% -</option>
																	<option value=17>- 17% -</option>
																	<option value=18>- 18% -</option>
																	<option value=19>- 19% -</option>
																	<option value=20>- 20% -</option>
																	<option value=25>- 25% -</option>
																	<option value=50>- 50% -</option>
																	<option value=100>- 100% -</option>
																	</select>
			   
					 <tr><td class='a'>Jenis Jaminan</td>     <td class='b'> : <input type=radio name='jenis' id='jenis' value='Surat'> Surat   
                            			               						 <input type=radio name='jenis' value='Barang' id='jenis' > Barang/Kendaraan </td></tr>
					  <tr><td  class='a'>Nama Jaminan</td><td class='b'>  : <input type=text name='nama_jaminan' id='nama_jaminan' size=20></td></tr>
					  <tr><td  class='a'>Nama pemilik </td><td class='b'>  : <input type=text name='nama_pemilik' id='nama_pemilik'size=20></td></tr>
					  <tr><td  class='a'>Alamat pemilik</td><td class='b'>  : <textarea rows=4	cols='17' name='alamat_nasabah' id='alamat_nasabah'></textarea></td></tr>
          <tr><td></td><td><input type=submit value=Ajukan>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
	
	
	}
     break;
    
	
	case"cek_pengajuan":
	  	if ($_SESSION['jabatan']=='sa')
{
	 echo "<h2 align='center'>STATUS PENGAJUAN PEMINJAMAN</h2>
<br>
          
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='left'>No Pinjam</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal pengajuan</td>
		  <td class='left'>Jumlah Pinjam</td>
		   <td class='left'>Keterangan</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging7;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
select cabang,no_pinjam,no_rek,nama,tanggal,jumlah,status,keterangan from pinjam p inner join
nasabah n  on n.no_rekening=p.no_rek ORDER BY no_pinjam asc LIMIT $posisi,$batas");
  
   
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='left'>$r[no_pinjam]</td>
                <td class='left'>$r[no_rek]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
				<td class='left'>$r[jumlah]</td>
				<td class='left'>$r[keterangan]</td>
			
                <td class='center' width='130'>";
				
				if ($r[status]=='S'){
      echo"		
	 <input type=button value='Proses' onclick=location.href='?view=pinjam&act=proses&a=$r[no_pinjam]'>
		        </tr>";
    }
    else if ($r[status]=='B'){
        echo"		<input type=button value='Edit' onclick=location.href='?view=pinjam&act=edit_pengajuan&a=$r[no_pinjam]'>
		        </tr>";
    }
	 else if ($r[status]=='Y'){
        echo"		Hutang
		        </tr>";
    }	
	else {
		
        echo"		
		<input type=button value='Ulang' onclick=location.href='?view=pinjam&act=edit_pengajuan&a=$r[no_pinjam]'>
		 <input type=button value='Batal Pinjam' onclick=location.href='$proses?view=pinjam&act=batal&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rek]'>
		        </tr>";
    }
				
				
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query(" select cabang from nasabah"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
   
}else{
	 echo "<h2 align='center'>STATUS PENGAJUAN PEMINJAMAN</h2>
<br>
          
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='left'>No Pinjam</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal pengajuan</td>
		  <td class='left'>Jumlah Pinjam</td>
		   <td class='left'>Keterangan</td>
		 
		  
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging7;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
select cabang,no_pinjam,no_rek,nama,tanggal,jumlah,status,keterangan from pinjam p inner join
nasabah n  on n.no_rekening=p.no_rek where cabang ='$_SESSION[cab]'
   ORDER BY no_pinjam asc LIMIT $posisi,$batas");
  
   
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='left'>$r[no_pinjam]</td>
                <td class='left'>$r[no_rek]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
				<td class='left'>$r[jumlah]</td>
				<td class='left'>$r[keterangan]</td>
			
                <td class='center' width='130'>";
				
				if ($r[status]=='S'){
      echo"		
	 <input type=button value='Proses' onclick=location.href='?view=pinjam&act=proses&a=$r[no_pinjam]'>
	 
		        </tr>";
    }
    else if ($r[status]=='B'){
        echo"		<input type=button value='Edit' onclick=location.href='?view=pinjam&act=edit_pengajuan&a=$r[no_pinjam]'>
		        </tr>";
    }
	 else if ($r[status]=='Y'){
        echo"		Hutang
		        </tr>";
    }	
	else {
		
        echo"
		<input type=button value='Ulang' onclick=location.href='?view=pinjam&act=edit_pengajuan&a=$r[no_pinjam]'>
		 <input type=button value='Batal Pinjam' onclick=location.href='$proses?view=pinjam&act=batal&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rek]'>
		        </tr>";
    }
				
				
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query(" select cabang from nasabah where cabang ='$_SESSION[cab]'"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
	
	}
	break;
	
	
	case"proses":
		$ok = mysql_query("select no_pinjam,no_rek,lama,nama,bunga,tanggal,jumlah,total,jenis,nama_jaminan,nama_pemilik,alamat_pemilik from pinjam p inner join nasabah n 
		on n.no_rekening=p.no_rek where no_pinjam='$_GET[a]'");
    	$r    = mysql_fetch_array($ok);

      echo "<h2 align='center'>PROSES PENGAJUAN PEMINJAMAN</h2>
	  <br>
	  <div class='nsb'>
          <form name='nasabah' id='nasabah'  method=POST action='$proses?view=pinjam&act=input' >
          	<table class='listc'>
		  		<tbodyc>
					<input type=hidden name='no_pinjamm'  value='$_GET[a]' readonly='true' size=20 >
					<input type=hidden name='total'  value='$r[total]' readonly='true' size=20 >
          			<tr><td  class='a'>		No Pinjam		</td><td class='b'>:	$_GET[a]</td></tr>
		    		<tr><td  class='a'>		Rekening Peminjam	</td><td class='b'>:  	$r[no_rek]</td></tr>		
		 			<tr><td  class='a'>		Jumlah Pinjam		</td><td class='b'>: 	$r[jumlah] </td></tr>
			 	 	<tr><td  class='a'>		Lama Pinjam			</td><td class='b'>: 	$r[lama]  Bulan </td></tr>
			  		<tr><td  class='a'>		Bunga				</td><td class='b'>:  	$r[bunga]  %</td></tr>
					<tr><td  class='a'>		Total			</td><td class='b'>: 	$r[total]  </td></tr>
					<tr><td  class='a'>		Jenis Jaminan		</td><td class='b'>:	$r[jenis] </td></tr>
					<tr><td  class='a'>		Nama Jaminan		</td><td class='b'>:	$r[nama_jaminan]</td></tr>
					<tr><td  class='a'>		Nama pemilik 		</td><td class='b'>: 	$r[nama_pemilik]</td></tr>
					<tr><td  class='a'>		Alamat pemilik		</td><td class='b'>: 	$r[alamat_pemilik]</td></tr>
          <tr><td></td><td><input type=submit value=Ajukan>
          <input type=button value=Kembali onclick=self.history.back()>
		   </form>
		    <input type=button value='Batal Pinjam' onclick=location.href='$proses?view=pinjam&act=batal&no_pinjam=$r[no_pinjam]&no_rekening=$r[no_rek]'>
		 </td></tr>
          </tbodyc>
		  </table>
		 
		 
		  </div>";
	break;
	
	case "edit_pengajuan":
		$edit = mysql_query("select no_pinjam,no_rek,lama,bunga,tanggal,jumlah,status,keterangan,jenis,nama_jaminan,nama_pemilik,alamat_pemilik from pinjam where no_pinjam='$_GET[a]'");
    	$r    = mysql_fetch_array($edit);

      echo "<h2 align='center'>EDIT PENGAJUAN PEMINJAMAN</h2>
	 <div class='nsb'>
          <form name='nasabah' id='nasabah'  method=POST action='$proses?view=pinjam&act=editpengajuan' >
          	<table class='listc'>
		  		<tbodyc>
				
		  			<input type=hidden name='no_pinjam'  value='$r[no_pinjam]' readonly='true' size=20 >
		  			<input type=hidden name='no_jmn'  	value='$r[no_jmn]' readonly='true' size=20 >
          			<input type=hidden name='no_reke' id='no_reke' value='$r[no_rek]' readonly='true'> 
					<tr><td class='a'>		No Pengajuan		</td><td  	class='b'>:	 $r[no_pinjam]</td></tr>
		     <tr><td  class='a'>		No Rekening	</td><td 	class='b'>: $r[no_rek]</td></tr>";
		 	echo "  <tr><td  class='a'>Jumlah Pinjam	</td><td class='b'> : <input type=text name='jumlah' value='$r[jumlah]' id='jumlah' maxlength='8'></td></tr>
			 	 <tr><td  class='a'>Lama Pinjam		</td><td class='b'> :  <select name='lama' id='lama'><option value='$r[lama]' selected>- $r[lama] Bulan-</option>
			 														<option value=2 >- 2 Bulan -</option>
																	<option value=6 >- 6 Bulan -</option>
																	<option value=10 >- 10 Bulan -</option>
																	<option value=12 >- 12 Bulan -</option>
																	<option value=24 >- 24 Bulan -</option>
																	<option value=36 >- 36 Bulan -</option>
																	</select>
			  	<tr><td  class='a'>Bunga</td>  <td class='b'> 	:  <select name='bunga' id='bunga'><option value='$r[bunga]' selected>- $r[bunga] % -</option>
			 														<option value=0 >- 0% -</option>
																	<option value=1 >- 1% -</option>
																	<option value=2 >- 2% -</option>
																	<option value=2 >- 3% -</option>
																	<option value=4 >- 4% -</option>
																	<option value=5 >- 5% -</option>
																	<option value=6 >- 6% -</option>
																	<option value=7 >- 7% -</option>
																	<option value=8 >- 8% -</option>
																	<option value=9 >- 9% -</option>
																	<option value=10>- 10% -</option>
																	<option value=11>- 11% -</option>
																	<option value=12>- 12% -</option>
																	<option value=13>- 13% -</option>
																	<option value=14>- 14% -</option>
																	<option value=15>- 15% -</option>
																	<option value=16>- 16% -</option>
																	<option value=17>- 17% -</option>
																	<option value=18>- 18% -</option>
																	<option value=19>- 19% -</option>
																	<option value=20>- 20% -</option>
																	<option value=25>- 25% -</option>
																	<option value=50>- 50% -</option>
																	<option value=100>- 100% -</option>
																	</select>";
					if ($r[jenis]=='Surat'){
      	echo "<tr><td class='a'>Jenis Jaminan</td>     <td class='b'> : <input type=radio name='jenis' id='jenis' value='Surat' checked> Surat
         					                                    <input type=radio name='jenis' id='jenis'value='Barang' > Barang/Kendaraan </td></tr>";
    							}
    else{
      	echo "<tr><td class='a'>Jenis Jaminan</td>     <td class='b'> : <input type=radio name='jenis' value='Surat' > Surat  
         				                                 <input type=radio name='jenis' value='Barang' checked> Barang/Kendaraan</td></tr>";
   								 }
			   
				echo "	
					  <tr><td  class='a'>Nama Jaminan</td><td class='b'>  : <input type=text name='nama_jaminan' id='nama_jaminan' maxlength='30' value='$r[nama_jaminan]' ></td></tr>
					  <tr><td  class='a'>Nama pemilik </td><td class='b'>  : <input type=text name='nama_pemilik' id='nama_pemilik' maxlength='30' value='$r[nama_pemilik]'></td></tr>
					  <tr><td  class='a'>Alamat pemilik</td><td class='b'>  : <textarea rows=4	cols='17' name='alamat_pemilik' id='alamat_pemilik' maxlength='100' >$r[alamat_pemilik]</textarea></td></tr>
          <tr><td></td><td><input type=submit value=Update>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
	
     break;
	
	
	
  case "angsur":
	$query_ke 		= "SELECT substring(angsuran_ke, 1)AS ke FROM angsur where no_pnjm='$_GET[no_pinjam]' ORDER BY no_angsur  DESC LIMIT 1";
    $hasil_ke 		= mysql_query($query_ke);	
	$ke				= mysql_fetch_array($hasil_ke);					
	$no_ke			= $ke['ke'];
	$next_ke		= $no_ke+1;
	$next_number_pj = sprintf ('%02s',$next_ke);
	$sql 			= mysql_query(" select * from nasabah n 
inner join pinjam p on n.no_rekening=p.no_rek
left join angsur a on p.no_pinjam=a.no_pnjm where no_pinjam='$_GET[no_pinjam]'");
	
	$r  			= mysql_fetch_array($sql);
  	$date			= strtoupper($r['tanggal_angsur']);
  	$slash			= explode("-", $date);
  	$th				= $slash[0];
  	$bl				= $slash[1];
  	$all			= $th.$bl;
	
	
	$date1			= strtoupper($r['tanggal']);
  	$slash1			= explode("-", $date1);
  	$th1				= $slash1[0];
  	$bl1				= $slash1[1];
  	$all1			= $th1.$bl1;

  	$now			= date("Y-m-d");
  	$datenow 		= strtoupper($now);
  	$slashnow 		= explode("-", $datenow);
  	$thnow			= $slashnow[0];
  	$blnow			= $slashnow[1];
  	$allnow			= $thnow.$blnow;
	$besar_angsuran	= $r['total']/$r['lama']; 
	$persen			= (1/100)*$besar_angsuran;
	$denda			= $persen*($allnow-$all);
	$tgl_pinjam		= $r['tanggal']; 
	$tgl			= substr ($tgl_pinjam,8,9);
	$kata			= "Per Tanggal";
	$spasi			= " ";
	$jatuh_tempo	= $kata."".$spasi."".$tgl;
	$tipe_data_float= $besar_angsuran+$denda;
	$angsuran_bulan_ini = (int)$tipe_data_float;
	$sisahutang		= $r['sisa'];
	$sisa_hutang 	= (int)$sisahutang;
	
	
	$denda1	= $persen*($allnow-$all1);
	$tipe_data_float1= $besar_angsuran+$denda1;
	$angsuran_bulan_ini1 = (int)$tipe_data_float1;
if (empty($r['tanggal_angsur'])){
echo "<h2 align='center'>ANGSURAN</h2>
	<br>
	<div class='nsb'>
<form name='nasabah' id='nasabah' method=post action=$proses?view=pinjam&act=angsur>
     <table class='listc'>
		<tbodyc>
		<input	type=hidden		name='no_angsurA'	value='$no_angsur'  		readonly='true' size=20>
		<input	type=hidden		name='no_pinjamA'   	value='$r[no_pinjam]' 		readonly='true' size=20>
		<input	type=hidden		name='no_rekA'   	value='$r[no_rekening]' 			readonly='true' size=20>
		<input	type=hidden		name='lamaA' 		value='$r[lama]' 	readonly='true' size=20>
		<input	type=hidden		name='totalA' 		value='$r[total]' 	readonly='true' size=20>
		<input	type=hidden		name='sisaA'			value='$sisa_hutang' 	readonly='true' size=20>
		<input	type=hidden		name='angsuran_keA' 	value='$next_ke' 		readonly='true' size=20>
		<input	type=hidden		name='dendaA' 		value='$denda1' 				readonly='true' size=20>
		<tr><td>No Pinjam			</td><td>	: $r[no_pinjam]		</td></tr>
		<tr><td>No Rekening			</td><td>	: $r[no_rekening]		</td></tr>
		<tr><td>Nama				</td><td>	: $r[nama]			</td></tr>
		<tr><td>Jumlah Pinjam (Rp)	</td><td>	: ".num($r[jumlah])."	</td></tr> 
		<tr><td>Lama Pinjam			</td><td>	: $r[lama]	Bulan		</td></tr>
		<tr><td>Bunga 				</td><td>	: $r[bunga]		%	</td></tr> 	
		<tr><td>Total Hutang		</td><td>  	: ".num($r[total])."	</td></tr> 	
		<tr><td>Sisa Hutang (Rp)	</td><td>  	: ".num($r[sisa])."	</td></tr> 
		<tr><td>Jatuh Tempo			</td><td>  	: $jatuh_tempo		</td></tr>
		<tr><td>Angsuran Ke			</td><td>  	: $next_ke		</td></tr> 
		<tr><td>Denda				</td><td>  	: ".num($denda1)."			 </td></tr>  
		<tr><td>Angsuran Bulan Ini	</td><td>  	: ".num($angsuran_bulan_ini1)."</td></tr>
		<tr><td class='a'>Besar Angsuran		</td><td class='b'> 	:  <input type=text name='besar_angsuran' id='besar_angsuran' value='$angsuran_bulan_ini1' maxlength='10'>	</td></tr>  					 
        <tr><td></td><td>
		<input type=submit value=Angsur>
        <input type=button value=Batal onclick=self.history.back()>
		</td></tr>
        </tbodyc>
	</table>
</form>
</div>";
}else{
echo "<h2 align='center'>ANGSURAN</h2>
	<br>
	<div class='nsb'>
<form name='nasabah' id='nasabah' method=post action=$proses?view=pinjam&act=angsur>
     <table class='listc'>
		<tbodyc>
		<input	type=hidden		name='no_angsurA'	value='$no_angsur'  		readonly='true' size=20>
		<input	type=hidden		name='no_pinjamA'   	value='$r[no_pinjam]' 		readonly='true' size=20>
		<input	type=hidden		name='no_rekA'   	value='$r[no_rekening]' 			readonly='true' size=20>
		<input	type=hidden		name='lamaA' 		value='$r[lama]' 	readonly='true' size=20>
		<input	type=hidden		name='totalA' 		value='$r[total]' 	readonly='true' size=20>
		<input	type=hidden		name='sisaA'			value='$sisa_hutang' 	readonly='true' size=20>
		<input	type=hidden		name='angsuran_keA' 	value='$next_ke' 		readonly='true' size=20>
		<input	type=hidden		name='dendaA' 		value='$denda' 				readonly='true' size=20>
		<tr><td>No Pinjam			</td><td>	: $r[no_pinjam]		</td></tr>
		<tr><td>No Rekening			</td><td>	: $r[no_rekening]		</td></tr>
		<tr><td>Nama				</td><td>	: $r[nama]			</td></tr>
		<tr><td>Jumlah Pinjam (Rp)	</td><td>	: ".num($r[jumlah])."	</td></tr> 
		<tr><td>Lama Pinjam			</td><td>	: $r[lama]	Bulan		</td></tr>
		<tr><td>Bunga 				</td><td>	: $r[bunga]		%	</td></tr> 	
		<tr><td>Total Hutang		</td><td>  	: ".num($r[total])."	</td></tr> 	
		<tr><td>Sisa Hutang (Rp)	</td><td>  	: ".num($r[sisa])."	</td></tr> 
		<tr><td>Jatuh Tempo			</td><td>  	: $jatuh_tempo		</td></tr>
		<tr><td>Angsuran Ke			</td><td>  	: $next_ke		</td></tr> 
		<tr><td>Denda				</td><td>  	: ".num($denda)."			 </td></tr>  
		<tr><td>Angsuran Bulan Ini	</td><td>  	: ".num($angsuran_bulan_ini)."</td></tr>
		<tr><td class='a'>Besar Angsuran		</td><td class='b'> 	:  <input type=text name='besar_angsuran' id='besar_angsuran' value='$angsuran_bulan_ini' maxlength='10'>	</td></tr>  					 
        <tr><td></td><td>
		<input type=submit value=Angsur>
        <input type=button value=Batal onclick=self.history.back()>
		</td></tr>
        </tbodyc>
	</table>
</form>
</div>";
	
	
	
	}
    break;  
	
	
	
	case"detail";
	
	 $detail = mysql_query("SELECT no_pinjam,no_rekening,nama,alamat,hp,
tanggal,jumlah,lama,
bunga,total,sisa,nama_jaminan,nama_pemilik,alamat_pemilik
  From nasabah n inner join pinjam p
    on n.no_rekening = p.no_rek  where no_pinjam='$_GET[no_pinjam]'");
    $r    = mysql_fetch_array($detail);


          $tampil=mysql_query("
select cabang,nama_cab from nasabah n inner join cabang c
on n.cabang = c.no_cab where no_rekening='$r[no_rekening]'");
 $d    = mysql_fetch_array($tampil);


    echo "<h2 align='center'>INFO PEMINJAMAN</h2>
	<br>
	<div class='nsb'>
          <form method=POST action=$proses?view=karyawan&act=update enctype='multipart/form-data'>
          	 <table class='listc'>
		  <tbodyc>
          <tr><td>No Pinjam				</td><td>	:	$r[no_pinjam]</td></tr>
		  <tr><td>No Rekening			</td><td>	:	$r[no_rekening]</td></tr>
		  <tr><td>Cabang Pinjam		</td><td>	:	$d[cabang] - $d[nama_cab]</td></tr>
		  <tr><td>Nama					</td><td>	:	$r[nama]</td></tr>
		  <tr><td>Alamat				</td><td>	:	$r[alamat]</td></tr>
		  <tr><td>No Tlp				</td><td>	:	$r[hp]</td></tr>
		  <tr><td>Jumlah Pinjam			</td><td>	:   $r[jumlah]</td></tr>
		  <tr><td>Lama Angsuran			</td><td>	:	$r[lama]</td></tr>
		  <tr><td>Bunga					</td><td>	:	$r[bunga]</td></tr>
		  <tr><td>Total Hutang			</td><td>	:	$r[total]</td></tr>
		  <tr><td>Sisa Hutang			</td><td>	:	$r[sisa]</td></tr>
		  <tr><td>Nama Jaminan			</td><td>	:	$r[nama_jaminan]</td></tr>
		  <tr><td>Nama Pemilik			</td><td>	:	$r[nama_pemilik]</td></tr>
		  <tr><td>Alamat Pemilik		</td><td>	:	$r[alamat_pemilik]</td></tr>
		  
		  
		 
         <tr><td></td> <td><input type=button value=Kembali onclick=self.history.back()>
		 <input type=button value='Struk' onclick=location.href='?view=pinjam&act=strukangsur&no_pinjam=$r[no_pinjam]'>
		
          </tbodyc>
		  </table>
		
		  </form>
		  </div>";
	
	
	break;
	
	
	
	
	
	case"strukangsur";
	 $detail = mysql_query("SELECT no_pinjam,no_rekening,nama,hp,
tanggal,jumlah,lama,
bunga,total,sisa
  From nasabah n inner join pinjam p
    on n.no_rekening = p.no_rek  where no_pinjam='$_GET[no_pinjam]'");
    $st    = mysql_fetch_array($detail);
	
	
     echo "<h2 align='center'>Riwayat Angsuran</h2>
          <table class='list'><thead>
		  <tr><td>No Pinjam		</td><td>	:	$st[no_pinjam]</td></tr>
		  <tr><td>No Rekening		</td><td>	:	$st[no_rekening]</td></tr>
		  <tr><td>Nama		</td><td>	:	$st[nama]</td></tr>
		  <tr><td>No Tlp		</td><td>	:	$st[hp]</td></tr>
		  <tr><td>Jumlah Pinjam		</td><td>	: ".num($st[jumlah])."</td></tr>
		  <tr><td>Bunga		</td><td>	:	$st[bunga] %</td></tr>
		  <tr></tr>
		  <tr></tr>
		  <tr></tr>
		  <tr></tr>
		  
          <tr><td class='center'>No</td>
		  <td class='left'>No Angsur</td>
          <td class='left'>Tanggal Angsur</td>
		  <td class='left'>Angsuran ke</td>
		  <td class='left'>Besar Angsuran</td>
		   <td class='left'>Sisa Angsuran</td>
		   <td class='left'>Denda</td>
		  
		 <td class='left'>Petugas</td>
		  
		  <tbody>";
		  $a      = new Paging10;
    $bts  = 3;
    $ps = $a->cariPosisi($bts);
    $tampil=mysql_query(" SELECT * from angsur where no_pnjm='$_GET[no_pinjam]' ORDER BY no_angsur asc LIMIT $ps,$bts");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='left'>$r[no_angsur]</td>
                <td class='left'>$r[tanggal_angsur]</td>
				<td class='left'>$r[angsuran_ke]</td>
				<td class='left'> ".num($r[besar_angsuran])."</td>
				<td class='left'>$r[sisa_angsuran]</td>
				
				<td class='left'>$r[denda]</td>
				<td class='left'>$r[petugas]</td>
						
		        </tr>";
    $no++;
	}
    echo "</table>";
	echo "<form action='view/pinjam/cetak.php' method='post'>
			<input type=button value=Kembali onclick=self.history.back()>
	<input class=noPrint type=button value=Print onclick=window.print()>   
	</form>
	";
	$jmldata = mysql_num_rows(mysql_query(" select no_angsur from angsur where no_pnjm ='$_GET[no_pinjam]'"));

	$jmlhalaman  = $a->jumlahHalaman($jmldata, $bts);
    $linkHalaman = $a->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
	
	
	break;
	
	
	
	case"daftar_pengajuan";
	
	if ($_SESSION['jabatan']=='sa') {
	
	echo "<h2 align='center'>DAFTAR PENGAJUAN PEMINJAMAN</h2>
<br>
          
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
		   <td class='left'>No Pengajuan</td>
          <td class='left'>No Rekening</td>
		  <td class='left'>Nama</td>
		  <td class='left'>Tanggal pengajuan</td>		 
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging4;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("
select cabang,no_pinjam,no_rek,nama,tanggal,status from pinjam p inner join
nasabah n  on n.no_rekening=p.no_rek where status='B'
   ORDER BY no_pinjam asc LIMIT $posisi,$batas");
  
   
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
	  			<td class='left'>$r[no_pinjam]</td>
                <td class='left'>$r[no_rek]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[tanggal]</td>
                <td class='center' width='130'>
				
				<input type=button value='lihat' onclick=location.href='?view=pinjam&act=lihat&a=$r[no_pinjam]'>
							
				</td>
		   		</tr>";
	
				
				
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query(" select status from pinjam p inner join
nasabah n on n.no_rekening=p.no_rek where status='B' "));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
	
	}
	else {
	echo "<script>window.alert('Halaman Tidak Di Temukan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=main.php?view=home'>";
	}
	
	break;
	
	
	case "lihat";
	$ok = mysql_query("select no_pinjam,no_rek,lama,nama,bunga,tanggal,jumlah,
		status,keterangan,jenis,nama_jaminan,nama_pemilik,alamat_pemilik from pinjam p inner join nasabah n 
		 on n.no_rekening=p.no_rek  where no_pinjam='$_GET[a]'");
    	$r    = mysql_fetch_array($ok);

if ($_SESSION['jabatan']=='sa') {
	
	
      echo "<h2 align='center'>PENGAJUAN PEMINJAMAN</h2>
	  <br>
	  <div class='nsb'>
          <form name='nasabah' id='nasabah'  method=POST action='$proses?view=pinjam&act=prosespinjam' >
          	<table class='listc'>
		  		<tbodyc>
					<input type=hidden name='no_pinjam'  value='$r[no_pinjam]' readonly='true' size=20 >
          			<tr><td  class='a'>		No Pengajuan		</td><td class='b'>:	$_GET[a]</td></tr>
		    		<tr><td  class='a'>		Rekening Peminjam	</td><td class='b'>:  	$r[no_rek]</td></tr>		
		 			<tr><td  class='a'>		Jumlah Pinjam		</td><td class='b'>: 	$r[jumlah] </td></tr>
			 	 	<tr><td  class='a'>		Lama Pinjam			</td><td class='b'>: 	$r[lama]  Bulan </td></tr>
			  		<tr><td  class='a'>		Bunga				</td><td class='b'>:  	$r[bunga]  %</td></tr>
					<tr><td  class='a'>		Jenis Jaminan		</td><td class='b'>:	$r[jenis] </td></tr>
					<tr><td  class='a'>		Nama Jaminan		</td><td class='b'>:	$r[nama_jaminan]</td></tr>
					<tr><td class='a'>		Status				</td><td class='b'> : 	<input type=radio name='status' id='jenis' value='S'> Setujui   
                            			               						 <input type=radio name='status' value='T' id='jenis' > Tolak </td></tr>
					<tr><td  class='a'>		Keterangan		</td><td class='b'>:<textarea rows='4' cols='17'  name='alamat' id='alamat' maxlength='50'></textarea></td></tr>
          <tr><td></td><td><input type=submit value=Proses>
          <input type=button value=Kembali onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
		  
}
else {
	echo "<script>window.alert('Halaman Tidak Di Temukan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=main.php?view=home'>";
	}
	
	break;
	
	
}
?>