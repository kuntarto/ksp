<html>
<link rel="stylesheet" href="../../css/style.css" type="text/css" />
<body>
<?php
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}


ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$proses="view/cabang/proses_cabang.php";
include "config/database.php";
include "controller/class_paging.php";
include "controller/kode_cabang.php";

if ($_SESSION['jabatan']=='sa')
{
switch($_GET[act])
{
  default:
  if (empty($_GET['kode_cabang'])){
    echo "<h2 align=center><b>CABANG</b></h2>
	<br>
         <div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=cabang>
					&nbsp;&nbsp;&nbsp;<input type=button value='Tambah Cabang' onclick=location.href='?view=cabang&act=tambahcabang'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='kode_cabang' id='kode_cabang' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
          
        <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>Kode Cabang</td>
          <td class='left'>Nama Cabang</td>
          <td class='left'>Alamat Cabang</td>
		  <td class='left'>No Tlp</td>
          <td class='center'>aksi</td></tr></thead>
		  <tbody>";		  
	$p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT * FROM cabang ORDER BY no_cab asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_cab]</td>
				<td class='left'>$r[nama_cab]</td>
                <td class='left'>$r[alamat_cab]</td>
				 <td class='left'>$r[tlp_cab]</td>
                <td class='center' width='85'><a href=?view=cabang&act=editcabang&no_cab=$r[no_cab]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href='$proses?view=cabang&act=hapus&no_cab=$r[no_cab]'><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM cabang"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
  break;
	 }
   else{
	   echo "<h2 align=center><b>CABANG</b></h2>
	<br>
         <div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=cabang>
					
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='kode_cabang' id='kode_cabang' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
          
        <br> <br>
		  <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>Kode Cabang</td>
          <td class='left'>Nama Cabang</td>
          <td class='left'>Alamat Cabang</td>
		  <td class='left'>No Tlp</td>
          <td class='center'>aksi</td></tr></thead>
		  <tbody>";		  
	$p      = new Paging13;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT * FROM cabang  WHERE no_cab LIKE '%$_GET[kode_cabang]%' ORDER BY no_cab asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_cab]</td>
				<td class='left'>$r[nama_cab]</td>
                <td class='left'>$r[alamat_cab]</td>
				 <td class='left'>$r[tlp_cab]</td>
                <td class='center' width='85'><a href=?view=cabang&act=editcabang&no_cab=$r[no_cab]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href='$proses?view=cabang&act=hapus&no_cab=$r[no_cab]'><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT no_cab FROM cabang WHERE no_cab LIKE '%$_GET[kode_cabang]%' "));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
	   
	   break;  
	   }
  
  case "tambahcabang":
      	echo "<h2 align=center>TAMBAH CABANG</h2>
		<br>
		<div class='nsb'>
         <form name='nasabah' id='nasabah' method=POST action='$proses?view=cabang&act=input' >
		   <table class='listc'>
		     <tbodyc>
		   <input type=hidden name='no_cab'	value='$no_trans'  readonly='true'>
           <tr><td class='a'>No Cabang			</td><td td class='b'>  : <b>$no_trans</b></td></tr>
		   <tr><td class='a'>Nama Cabang		</td><td td class='b'>  : <input type=text name='nama_cab'		id='nama_cab'  maxlength='30'	size=20></td></tr>
		   <tr><td class='a'>Alamat Cabang		</td><td td class='b'>  : <textarea rows=4	cols='17' name='alamat_cab'	id='alamat_cab' maxlength='100'></textarea></td></tr>
		   <tr><td class='a'>No Tlp Cabang		</td><td td class='b'>  : <input type=text name='tlp_cab'		id='tlp_cab' 	maxlength='15'	size=20></td></tr>
           <tr><td></td><td><input type=submit value=Simpan>
           <input type=button value=Batal onclick=self.history.back()></td></tr>
             </tbodyc>
		   </table>
		 </form>
		 </div>";
     break;
    
  case "editcabang":
    $edit = mysql_query("SELECT * FROM cabang WHERE no_cab='$_GET[no_cab]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 align='center'>EDIT CABANG</h2>
	<br>
	<div class='nsb'>
          <form name='nasabah' id='nasabah' method=POST action=$proses?view=cabang&act=update>
          	<table class='listc'>
		  		<tbodyc>
					<input type=hidden name='no_cab' value='$r[no_cab]'>
		  			<tr><td class='a'>No Cabang			</td><td class='b'>	:	$r[no_cab]	</td></tr>
		  			<tr><td class='a'>Nama Cabang		</td><td class='b'>	:	<input type=text name='nama_cab' id='nama_cab'  value='$r[nama_cab]'></td></tr>
          			<tr><td class='a'>Alamat			</td><td class='b'>	:	<textarea rows=4	cols='17' name='alamat_cab'	id='alamat_cab' maxlength='50'>$r[alamat_cab]</textarea></td></tr>
					<tr><td class='a'>No Tlp Cabang		</td><td class='b'>	:	<input type=text name='tlp_cab'  id='tlp_cab'  value='$r[tlp_cab]'</td></tr>
         			<tr>
          			<td></td>
					<td>
					<input type=submit value=Update>
          			<input type=button value=Batal onclick=self.history.back()>
					</td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
    break;  
}
}///if
else {
	echo "<script>window.alert('Halaman Tidak Di Temukan')</script>	
	 					  <meta http-equiv='refresh' content='0; url=main.php?view=home'>";
	}
?>
