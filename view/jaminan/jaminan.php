<?php
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$proses="view/jaminan/proses_jaminan.php";
include "config/database.php";
include "controller/class_paging.php";


switch($_GET['act'])
{
  default:
    echo "<h2 align='center'>JAMINAN</h2>
	<br>
          <table class='list'><thead>
          <tr><td class='center'>No</td>
		  <td class='left'>No Rekening</td>
		  <td class='left'>No Pinjam</td>
          <td class='left'>Nama Jaminan</td>
         
          <td class='left'>Status Jaminan</td>
          <td class='center'>Menu</td></tr></thead>
		  
		  
		  <tbody>";
		  $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT cabang,no_rek,no_pinjam,nama_jaminan,status_jaminan  from nasabah n inner join pinjam p on n.no_rekening=p.no_rek where cabang='$_SESSION[cab]' ORDER BY no_pinjam asc LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='left'>$r[no_rek]</td>
				<td class='left'>$r[no_pinjam]</td>
                <td class='left'>$r[nama_jaminan]</td>";
				
				  
				  if ($r['status_jaminan']=='T')
				  {echo" <td class='left'>Ditahan</td>";}
				  
				  if ($r['status_jaminan']=='A')
				  {echo" <td class='left'>Sudah Diambil</td>";}
				  
				  if ($r['status_jaminan']=='B')
				  {echo" <td class='left'>Dalam Proses</td>";}
				  
				  
				    if ($r['status_jaminan']=='T')
				  {
		echo"<td class='center' width='85'><a href=?view=jaminan&act=editjaminan&no_pinjam=$r[no_pinjam]><img src='images/edit.png' border='0' title='edit jaminan' /></a>
		        </tr>";}
				 if ($r['status_jaminan']=='B')
				  {
		echo"<td class='center' width='85'><a href=?view=jaminan&act=editjaminan&no_pinjam=$r[no_pinjam]><img src='images/edit.png' border='0' title='edit jaminan' /></a>
		        </tr>";}
				if ($r['status_jaminan']=='A')
				  {
		echo"<td class='center' width='85'></tr>";}
    $no++;
	}
    echo "</table>";
	
	$jmlhalaman  = $p->jumlahHalaman($tampil, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    
	echo "<div  align='center' class=\"pagination\"> $linkHalaman</div>";
    break;

    
  case "editjaminan":
    $edit = mysql_query("SELECT no_pinjam,nama_jaminan,jenis,nama_pemilik,alamat_pemilik,status_jaminan FROM pinjam WHERE no_pinjam='$_GET[no_pinjam]'");
    $r    = mysql_fetch_array($edit);


  $nasabah = mysql_query("select no_rekening,nama,no_pinjam,jumlah,jenis,nama_jaminan,nama_pemilik,alamat_pemilik,status_jaminan from
nasabah n inner join pinjam p
on n.no_rekening=p.no_rek where no_pinjam='$_GET[no_pinjam]'");
    $n    = mysql_fetch_array($nasabah);


    echo "<h2 align='center'>JAMINAN</h2>
	<br>
	<div class='nsb'>
          <form name='nasabah' id='nasabah' method=POST action=$proses?view=jaminan&act=update>
          	<table class='listc'>
		  		<tbodyc>
					<input type=hidden name='no_jaminan' id='no_jaminan'  value='$r[no_pinjam]'>
					<tr><td class='a'>No Rekening		</td><td class='b'>	:	$n[no_rekening]</td></tr>
					<tr><td class='a'>Nama		</td><td class='b'>	:	$n[nama]</td></tr>
					<tr><td class='a'>Jumlah Pinjam		</td><td class='b'>	: Rp	 $n[jumlah]</td></tr>";

					
					if ($r['jenis']=='Surat'){
      	echo "<tr><td class='a'>Jenis</td>     <td class='b'> : <input type=radio name='jenis' value='Surat' id='jenis' checked> Surat   
         					                                    <input type=radio name='jenis' id='jenis' value='Barang' > Barang/Kendaraan </td></tr>";
    							}
    else{
      	echo "<tr><td class='a'>Jenis</td>     <td class='b'> : <input type=radio name='jenis' id='jenis' value='Surat' > Surat 
         				                                 <input type=radio name='jenis' id='jenis' value='Barang' checked> Barang/Kendaraan </td></tr>";
   								 }	
			
        echo" 	
					
					<tr><td class='a'>Jaminan		</td><td class='b'>	:	<input type=text name='nama_jaminan' id='nama_jaminan' maxlength='30' value='$r[nama_jaminan]'></td></tr>
					<tr><td class='a'>Nama pemilik		</td><td class='b'>	:	<input type=text name='nama_pemilik' id='nama_pemilik' maxlength='30' value='$r[nama_pemilik]'></td></tr>
					<tr><td class='a'>Alamat pemilik		</td><td class='b'>	:<textarea rows=4	cols='17' name='alamat_pemilik' id='alamat_pemilik' maxlength='100' >$r[alamat_pemilik]</textarea></td></tr>";
						
			
	if ($r['status_jaminan']=='B'){
      	echo "<tr><td class='a'>Status Jaminan</td>     <td class='b'> : <input type=radio name='status' id='status' value='B' checked> Dalam Proses Pengajuan </td></tr>";
    							}
    if ($r['status_jaminan']=='T'){
      	echo "<tr><td class='a'>Status Jaminan</td>     <td class='b'> :   
         					                                    <input type=radio name='status' id='status' value='T' checked> Di Tahan
																<input type=radio name='status' id='status' value='A' > Di Ambil </td></tr>";
   								 }	
	if ($r['status_jaminan']=='A'){
      	echo "<tr><td class='a'>Status Jaminan</td>     <td class='b'> :
         					                                   
																<input type=radio name='status' id='status' value='A' checked > Telah Di Ambil </td></tr>";
   								 }
			
        echo" 			<tr>
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
?>
