
<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}

ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$proses="view/nasabah/proses_nasabah.php";
include "config/database.php";
include "controller/class_paging.php";
include "controller/no_rekening.php";
include "controller/no_sukarela.php";
include "controller/no_pokok.php";

switch($_GET[act])
{
  default:
  
  
if ($_SESSION['jabatan']=='sa')
{

	 if (empty($_GET['rekening'])){
    echo "<h2 align='center'>NASABAH</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=nasabah>
					&nbsp;&nbsp;&nbsp;<input type=button value='Tambah Nasabah' onclick=location.href='?view=nasabah&act=tambahnasabah'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='rekening' id='rekening' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
          
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>Identitas</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT no_rekening,nama,alamat,no_identitas,hutang FROM nasabah ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
				<td class='left'>$r[no_identitas]</td>
                <td class='center' width='125'>";
				if($r['hutang']=="Y")
				echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>";
				else {
					echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>
	                <a href='$proses?view=nasabah&act=hapus&a=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
					}
		        echo "</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT no_rekening FROM nasabah"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
  
	 break;
	 }
   else{
	  echo "<h2 align='center'>NASABAH</h2>
		<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=nasabah>
					
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='rekening' id='rekening'maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 	
	
          
       <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>Identitas</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging11;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT no_rekening,nama,alamat,no_identitas,hutang FROM nasabah WHERE no_rekening LIKE '%$_GET[rekening]%' ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
				<td class='left'>$r[no_identitas]</td>
                 <td class='center' width='125'>";
				if($r['hutang']=="Y")
				echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>";
				else {
					echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>
	                <a href='$proses?view=nasabah&act=hapus&a=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
					}
		        echo "</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT no_rekening FROM nasabah WHERE no_rekening LIKE '%$_GET[rekening]%'"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
   break;  
	 }
}
else{
	 if (empty($_GET['rekening'])){
 echo "<h2 align='center'>NASABAH</h2>
	<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=nasabah>
					&nbsp;&nbsp;&nbsp;<input type=button value='Tambah Nasabah' onclick=location.href='?view=nasabah&act=tambahnasabah'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='rekening' id='rekening'maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
	
          <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>Identitas</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $c=mysql_query("SELECT cab from petugas where nip='$_SESSION[nip]'");
		  $cb=mysql_fetch_array($c);
		  $cbg=$cb['cab'];
		  $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT no_rekening,nama,alamat,no_identitas,hutang FROM nasabah where cabang='$cbg'  ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
				<td class='left'>$r[no_identitas]</td>
                 <td class='center' width='125'>";
				if($r['hutang']=="Y")
				echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>";
				else {
					echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>
	                <a href='$proses?view=nasabah&act=hapus&a=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
					}
		        echo "</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT no_rekening FROM nasabah where cabang='$cbg'  "));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";	
	
 break;
	 }
   else{
	    echo "<h2 align='center'>NASABAH</h2>
	<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=nasabah>
					
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='rekening' id='rekening'maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>Identitas</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $c=mysql_query("SELECT cab from petugas where nip='$_SESSION[nip]'");
		  $cb=mysql_fetch_array($c);
		  $cbg=$cb['cab'];
		  $p      = new Paging11;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT no_rekening,nama,alamat,no_identitas,hutang FROM nasabah where cabang='$cbg' and no_rekening LIKE '%$_GET[rekening]%'  ORDER BY no_rekening asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rekening]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
				<td class='left'>$r[no_identitas]</td>
                 <td class='center' width='125'>";
				if($r['hutang']=="Y")
				echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>";
				else {
					echo"
					<a href='?view=nasabah&act=detailnasabah&a=$r[no_rekening]'><img src='images/detail.png' border='0' title='detail' /></a>
					<a href='?view=nasabah&act=editnasabah&a=$r[no_rekening]'><img src='images/edit.png' border='0' title='edit' /></a>
	                <a href='$proses?view=nasabah&act=hapus&a=$r[no_rekening]'><img src='images/del.png' border='0' title='hapus' /></a>";
					}
		        echo "</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT no_rekening FROM nasabah where cabang='$cbg' and no_rekening LIKE '%$_GET[rekening]%' "));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";	
	   }

break;
}
  case "tambahnasabah":
  
      echo "
	  <h2 align=center>NASABAH BARU</h2>
	  <br>
	  <div class='nsb'>
  		<form name='nasabah' id='nasabah' method='POST' action='?view=nasabah&act=simpanan' >
      			<table class='listc'>
		<tbodyc>
		  			<tr><td class='a'><b>NO REKENING		</b></td><td class='b'>	: <b>$no_rekening</b>	</td></tr>
		  		    <tr><td class='a'>	Nama Lengkap 		</td><td class='b'> 	: <input type=text 	name='nama'  	maxlength='30' 	id='nama' > 	</td></tr>
					<tr><td class='a'>	Jenis Kelamin		</td><td class='b'>   	: <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='Pria' > 	Pria
                                         							  				  <input type=radio name='jenis_kelamin' id='jenis_kelamin'	value='Wanita'> Wanita </td></tr>
		   			<tr><td class='a'>	Tanggal Lahir		</td><td class='b'>   	: <input type=text 	name='tanggal_lahir' 	id='tanggal_lahir' 	size=20> 	</td></tr>
				  	<tr><td class='a'>	Pekerjaan			</td><td class='b'>  	: <input type=text 	name='pekerjaan'    maxlength='20'  	id='pekerjaan' 		size=20>	</td></tr>	 
				   	<tr><td class='a'>	Alamat Lengkap		</td><td class='b'>  	: <textarea rows=4	cols='17' name='alamat_nasabah' id='alamat_nasabah' maxlength='100'></textarea></td></tr>
				    <tr><td class='a'>	No Identitas		</td><td class='b'>  	: <input type=text 	name='no_identitas' 		id='no_identitas' maxlength='30'>	</td></tr>
				    <tr><td class='a'>	No Tlp				</td><td class='b'>  	: <input type=text 	name='hp_nasabah' 		id='hp_nasabah' maxlength='15'>	</td></tr>
					<tr><td class='a'>						</td><td class='b'>	 	  <input type=submit value=Berikutnya 			name=sub>
          															 				  <input type=button value=Batal 			onclick=self.history.back()>	</td></tr>
          </tbodyc>
		  		</table>
		  </form>
		  </div>";
     break;
	
	case"simpanan":
	echo" <h2 align='center'>SIMPANAN</h2> 
	<br>
	<div class='nsb'>
  		<form name='nasabah' id='nasabah' method='POST' action='$proses?view=nasabah&act=input' >
      	<table class='listc'>
		<tbody>
					<input type=hidden name='rek'  		value='$no_rekening'>
					<input type=hidden name='name'  	value='$_POST[nama]'>
					<input type=hidden name='gender'  	value='$_POST[jenis_kelamin]'>
					<input type=hidden name='date'  	value='$_POST[tanggal_lahir]'>
					<input type=hidden name='job'  		value='$_POST[pekerjaan]'>
					<input type=hidden name='add'  		value='$_POST[alamat_nasabah]'>
					<input type=hidden name='id'  		value='$_POST[no_identitas]'>
					<input type=hidden name='hp'  		value='$_POST[hp_nasabah]'>
					<input type=hidden name='no_sukarela'  value='$no_sukarela'>
					
					<tr><td class='a'>	Wajib				</td><td class='b'>  	: <input type=text 	name='wajib' 	 		id='wajib'	maxlength=8	size=20></td></tr>
					<tr><td class='a'>	Pokok				</td><td class='b'> 	: <input type=text 	name='pokok' 			id=pokok	maxlength=8	size=20></td></tr>
					<tr><td class='a'>	Sukarela			</td><td class='b'>  	: <input type=text 	name='nominal' 			id=nominal 	maxlength=8	size=20></td></tr>
					<tr><td class='a'>						</td><td class='b'>	 	  <input type=submit value=Simpan 			name=sub>
          															 				  <input type=button value=Kembali 			onclick=self.history.back()>	</td></tr>
	</tbody>
	</table>
	</form>
	</div>";
	break;
	
	
  case "editnasabah":
    $edit = mysql_query("select no_rekening,nama,jenis_kelamin,tanggal_lahir,pekerjaan,alamat,no_identitas,hp from nasabah where no_rekening='$_GET[a]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 align='center'>EDIT NASABAH</h2>
	<br>
	<div class='nsb'>
          <form name='nasabah' id='nasabah' method='post'  action='$proses?view=nasabah&act=update'>
          	<table class='listc'>
		  		<tbodyc>
					<input type=hidden name='no_rekening'   value='$r[no_rekening]' readonly='true'>		   
					<tr><td class='a'>		No Rekening		</td><td class='b'>	:	$r[no_rekening]</td></tr>				
		 			<tr><td class='a'>		Nama Lengkap	</td><td class='b'> : <input type=text name='nama' id='nama' value='$r[nama]' maxlength='50' ></td></tr>";
					if ($r[jenis_kelamin]=='pria'){
      		  echo "<tr><td class='a'>Jenis Kelamin			</td><td class='b'> : <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='pria' checked> Pria   
                            			               							  <input type=radio name='jenis_kelamin' value='wanita' id='jenis_kelamin'> Wanita </td></tr>";
    				}
    		  else{	
      		  echo "<tr><td class='c'>Jenis Kelamin			</td><td class='b'> : <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='pria' > Pria  
                                        		  			<input type=radio name='jenis_kelamin' value='wanita' id='jenis_kelamin' checked> Wanita </td></tr>";
    				}
			 echo "<tr><td class='a'>Tanggal Lahir			</td><td class='b'> :<input type=text name='tanggal_lahir' id='tanggal_lahir' value='$r[tanggal_lahir]'size=20></td></tr>
				   <tr><td class='a'>Pekerjaan				</td><td class='b'> :<input type=text name='pekerjaan' id='pekerjaan' value='$r[pekerjaan]'size=20></td></tr>
				   <tr><td class='a'>Alamat Lengkap			</td><td class='b'> :<textarea rows=4	cols='17' name='alamat' id='alamat' maxlength='100' >$r[alamat]</textarea></td></tr>
				   <tr><td class='a'>No Identitas			</td><td class='b'> :<input type=text name='no_identitas' 		id='no_identitas'  value='$r[no_identitas]'size=30></td></tr>
				   <tr><td class='a'>No Tlp					</td><td class='b'> :<input type=text name='hp_nasabah' 		id='hp_nasabah'  value='$r[hp]'size=20></td></tr>
				 	<tr><td class='a'></td><td class='b'>	<input type=submit value=Simpan><input type=button value=Batal onclick=self.history.back()></td></tr>
          		</tbodyc>
		  </table>	
		  </form>
		  </div>";
    break;  
	
	case "detailnasabah":
	 $edit = mysql_query("select * from nasabah where no_rekening='$_GET[a]'");
    $r    = mysql_fetch_array($edit);
	
	echo"<div class='detailnasabah'>
	<div class='detailatas' align='center'><h2>PROFIL NASABAH<h2></div>
	<div class='detailkiri'><div class='detailkiridalam'>
	<table class='dnk'>
	<tr><td class='dkiri'>DATA NASABAH	</td><td class='dtengah'> </td><td class='dkanan'></td></tr>
	<tr><td class='dkiri'>No Rekening		</td><td class='dtengah'>: </td><td class='dkanan'> $r[no_rekening]</td></tr>
	<tr><td class='dkiri'>Nama Lengkap		</td><td class='dtengah'>: </td><td class='dkanan'>  $r[nama] </td></tr>
	<tr><td class='dkiri'>Jenis Kelamin		</td><td class='dtengah'>: </td><td class='dkanan'> $r[jenis_kelamin]</td></tr>
	<tr><td class='dkiri'>Tanggal Lahir		</td><td class='dtengah'>: </td><td class='dkanan'>  $r[tanggal_lahir]</td></tr>
	<tr><td class='dkiri'>Pekerjaan			</td><td class='dtengah'>: </td><td class='dkanan'> $r[pekerjaan]</td></tr>
	<tr><td class='dkiri'>Alamat Lengkap	</td><td class='dtengah'>: </td><td class='dkanan'> $r[alamat]</td></tr>
	<tr><td class='dkiri'>No Identitas		</td><td class='dtengah'>: </td><td class='dkanan'> $r[no_identitas]</td></tr>
	<tr><td class='dkiri'>No Tlp			</td><td class='dtengah'>: </td><td class='dkanan'> $r[hp]</td></tr>
	</table>
	
						</div></div>
	<div class='detailkanan'><div class='detailkanandalam'>
	<table class='dnk'>
	<tr><td class='dkiri'><td class='dtengah'> </td><td class='dkanan'></td></tr>
	
	</table>
	
						</div></div>
	
	
	<div class='detailbawah'  align='center'><input type=button value=Kembali onclick=location.href='?view=nasabah'></div>
	</div>";
	break;	
}
?>
