<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}

ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$proses="view/petugas/proses_petugas.php";
include "config/database.php";
include "controller/class_paging.php";
include "controller/nip.php";

if ($_SESSION['jabatan']=='sa')
{

switch($_GET[act])
{
	
  default:
   if (empty($_GET['nip'])){
    echo "<h2 align='center'>PETUGAS</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=petugas>
					&nbsp;&nbsp;&nbsp;<input type=button value='Tambah Petugas' onclick=location.href='?view=petugas&act=tambahpetugas'>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='nip' id='nip' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
          
        <br> <br>
          <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>NIP</td>
          <td class='left'>Cabang</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>No Tlp</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query(" SELECT nip,cab,nama,alamat,tlp FROM petugas order by nip asc LIMIT $posisi,$batas ");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[nip]</td>
				<td class='left'>$r[cab]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
                <td class='left'>$r[tlp]</td>
                <td class='center' width='85'>";
				if($_SESSION['nip']==$r['nip']) {
				echo"<a href=?view=petugas&act=editpetugas&nip=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>";
				}else { echo "<a href=?view=petugas&act=editpetugas&nip=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>
								<a href='$proses?view=petugas&act=hapus&nip=$r[nip]'><img src='images/del.png' border='0' title='hapus' /></a>";}
		       	echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT nip FROM petugas"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
   break;
	 }
   else{
	   
	    echo "<h2 align='center'>PETUGAS</h2>
			<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=petugas>
				
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='nip' id='nip' maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	
          
        <br> <br>
          <table class='list'><thead>
          <tr><td class='center'>No</td>
          <td class='left'>NIP</td>
          <td class='left'>Cabang</td>
          <td class='left'>Nama</td>
		  <td class='left'>Alamat</td>
		  <td class='left'>No Tlp</td>
          <td class='center'>aksi</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging12;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query(" SELECT nip,cab,nama,alamat,tlp FROM petugas WHERE nip LIKE '%$_GET[nip]%' order by nip asc LIMIT $posisi,$batas ");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[nip]</td>
				<td class='left'>$r[cab]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[alamat]</td>
                <td class='left'>$r[tlp]</td>
				<td class='center' width='85'>";
				if($_SESSION['nip']==$r['nip']) {
				echo"<a href=?view=petugas&act=editpetugas&nip=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>";
				}else { echo "<a href=?view=petugas&act=editpetugas&nip=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>
								<a href='$proses?view=petugas&act=hapus&nip=$r[nip]'><img src='images/del.png' border='0' title='hapus' /></a>";}
		       	echo"</tr>";
    $no++;
	}
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT nip FROM petugas WHERE nip LIKE '%$_GET[nip]%'"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    
	echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
	    break;  
	 }
  
  case "tambahpetugas":
      echo "<h2 align='center'> Petugas Baru</h2>
	  <div class='nsb'>
          <form name='nasabah' id='nasabah' method='POST' action='$proses?view=petugas&act=input' enctype='multipart/form-data' >
          <table class='listc'>
		  <tbodyc>
		  <input type='hidden' name='nipp' value='$nip' readonly='true' >
          <tr><td class='a'>	NIP				</td><td class='b'>	:	$nip </td></tr>
		  <tr><td class='a'>	Cabang			</td><td class='b'> :  <select name='cab' id='cab'><option  value=a selected>- Pilih Cabang -</option>";
          $tampil=mysql_query("SELECT * from cabang ORDER BY no_cab");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[no_cab]>$r[nama_cab]</option>";
          }
		  echo" 
		  <tr><td class='a'>	Nama Lengkap	</td><td class='b'> : <input type=text 	name='nama'  			id='nama'	maxlength=50></td></tr>
		  <tr><td class='a'>	Jenis Kelamin	</td><td class='b'> : <input type=radio name='jenis_kelamin' 	id=jenis_kelamin value='Pria'> Pria  
                                         					   		  <input type=radio name='jenis_kelamin' 	id=jenis_kelamin value='Wanita'> Wanita </td></tr>
		  <tr><td class='a'>	Tanggal Lahir	</td><td class='b'> : <input type=text 	name='tanggal_lahir' 	id='tanggal_lahir' size=20></td></tr>
   `	  <tr><td class='a'>	Alamat Lengkap	</td><td class='b'>	: <input type=text 	name='alamat' 			id='alamat' maxlength=100></td></tr>
		  <tr><td class='a'>	Jabatan			</td><td class='b'> : <input type=radio name='jabatan' 			id='jabatan' value='SA' > Super Admin  
                                         							  <input type=radio name='jabatan' 			id='jabatan' value='A' > Admin </td></tr>
		  <tr><td class='a'>	No Tlp			</td><td class='b'> : <input type=text 	name='tlp' 				id='tlp' maxlength=20></td></tr>
		  <tr><td class='a'>	Email			</td><td class='b'> : <input type=text 	name='email' 			id='email' size=20></td></tr>
		  <tr><td class='a'>	Photo			</td><td class='b'> : <input type=file 	name='fupload' size=40> </td></tr>				 
          <tr><td>								</td><td class='b'>		<input type=submit value=Simpan>
		  																<input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
     break;
    
  case "editpetugas":
    $edit = mysql_query("select * from petugas where nip='$_GET[nip]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 align='center'> EDIT PETUGAS</h2>
	  <div class='nsb'>
      		<form name='nasabah' id='nasabah' method=POST action=$proses?view=petugas&act=update enctype='multipart/form-data'>
          	<table class='listc'>
		  	<tbodyc>
		  	<input type=hidden name='nipp'   value=$r[nip] readonly='true'  size=20 >
          	<tr><td class='a'>		NIP			</td><td>	: $r[nip]	</td></tr>
		  	<tr><td class='a'>		Cabang		</td><td class='b'> : <select name='cab' id='cab' ><option value=$r[cab] selected>- $r[cab] -</option>";
            $tampil=mysql_query("SELECT * from cabang ORDER BY no_cab");
            while($a=mysql_fetch_array($tampil)){
            echo "<option value=$a[no_cab]>&nbsp;$a[no_cab]  &nbsp; &nbsp; $a[nama_cab]</option>";
            }  
		  	echo "
			<tr><td class='a'>		Nama Lengkap</td><td class='b'>  : <input type=text name='nama' id='nama' value='$r[nama]'  maxlength='50' ></td></tr>";
			if ($r[jenis_kelamin]=='pria'){
      		echo "<tr><td class='a'>Jenis Kelamin</td><td class='b'> : <input type=radio id='jenis_kelamin' name='jenis_kelamin' value='pria' checked> Pria   
            			                			  		           <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='wanita' > Wanita </td></tr>";
    		}
    		else{
      		echo "<tr><td class='a'>Jenis Kelamin</td><td class='b'> : <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='pria' > Pria  
                                        		  					   <input type=radio name='jenis_kelamin' id='jenis_kelamin' value='wanita' checked> Wanita </td></tr>";
    		}
			echo "<tr><td class='a'>Tanggal Lahir</td><td class='b'>  : <input type=text name='tanggal_lahir' id='tanggal_lahir' value='$r[tanggal_lahir]'size=20></td></tr>";		
			if ($r[jabatan]=='sa'){
      		echo "<tr><td class='a'>Jabatan		 </td><td class='b'>  : <input type=radio name='jabatan' id='jabatan' value='sa' checked> Super Admin   
         					                                    		<input type=radio name='jabatan' id='jabatan' value='a' > Admin </td></tr>";
    		}
    		else{
      		echo "<tr><td class='a'>Jabatan		</td><td class='b'>   : <input type=radio name='jabatan' id='jabatan' value='sa' > Super Admin  
         				                                 				<input type=radio name='jabatan' id='jabatan' value='a' checked> Admin </td></tr>";
   			}	
			echo"<tr><td class='a'>Alamat Lengkap</td><td class='b'>  : <input type=text name='alamat' id='alamat' value='$r[alamat]' maxlength='100' size=20></td></tr>
				 <tr><td class='a'>No Tlp		</td><td class='b'>   : <input type=text name='tlp' value='$r[tlp]' id='tlp'size=20></td></tr>
				 <tr><td  class='a'>Email		</td><td class='b'>   : <input type=text name='email' value='$r[email]' id='email'size=20></td></tr>
			     <input type=hidden name='password' value='$r[password]' size=20>
				 <tr><td class='a'>Photo</td>   <td class='b'>		  : <input type=file name='fupload' size=40> ";                        
			if ($r[blokir]=='N'){
      		echo "<tr><td class='a'>Blokir		</td><td class='b'>	  : <input type=radio name='blokir' id='blokir' value='N' checked> No   
         					                               				<input type=radio name='blokir' id='blokir' value='Y' > Yes </td></tr>";
    		}
    		else{
      		echo "<tr><td class='a'>Blokir		</td><td class='b'>   : <input type=radio name='blokir' id='blokir' value='N' > No  
         				                                 				<input type=radio name='blokir' value='Y' id='blokir' checked> Yes </td></tr>";
   			}
								 
         	echo"
		 		  <tr><td>					</td><td><input type=submit value=Update>
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
