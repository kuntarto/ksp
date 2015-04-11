
<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$proses="view/transaksi/proses_transaksi.php";
include "config/database.php";
include "controller/class_paging.php";
include "controller/no_sukarela.php";
include "controller/rp.php";


switch($_GET[act])
{

default:
    echo "<h2 align='center'>TRANSAKSI</h2>
	
	
	<div>
		  			<form name='nasabah' id='nasabah' method='get' action='$_SERVER[PHP_SELF]'>
          			<input type=hidden name=view value=transaksi>
					<div class='pencarian'>
					<div class='btnsch'><input type=submit value=Cari ></div>
          			<div class='sch'><input type=text name='rekening' id='rekening'maxlength='10'></div>
					</div>	
					<br>
			  		</form>
			  </div> 
	<br> <br>";
			  
    if (empty($_GET['rekening'])){
		
    echo "<table class='list'><thead>  
          <tr><td class='center'>no</td>
          <td class='left'>No Rekening</td>
          <td class='left'>Nama </td>
		  <td class='left'>Wajib </td>
		  <td class='left'>Pokok </td>
		  <td class='left'>Manasuka </td>
          <td class='center'>Menu</td>
          </tr></thead>";

    $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT no_rekening,nama,wajib,pokok,sukarela, substring(no_rekening, 8, 3)AS urut FROM nasabah ORDER BY urut asc LIMIT $posisi,$batas");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
	  
                <td class='left'>$r[no_rekening]</td>
                <td class='left'>$r[nama]</td>
				<td class='left'>".num($r[wajib])."</td>
				<td class='left'>".num($r[pokok])."</td>
				<td class='left'>".num($r[sukarela])."</td>
		        <td class='center' width='100'><a href=?view=transaksi&act=transaksi&no_rekening=$r[no_rekening]><img src='images/trans.png' border='0' title='Transaksi' /></a>
				<a href=?view=transaksi&act=struk&no_rekening=$r[no_rekening]><img src='images/struk.png' border='0' title='Struk' /></a>
				
				
		        </tr>"; ///////<a href=?view=transaksi&act=transfer&no_rekening=$r[no_rekening]><img src='images/tranfer.png' border='0' title='Transfer' /></a></td>
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
    echo "<table class='list'><thead>  
          <tr><td class='left'>no</td>
          <td class='left'>No Rekening</td>
           <td class='left'>Nama </td>
		   <td class='left'>Wajib </td>
		  <td class='left'>Pokok </td>
		  <td class='left'>Manasuka </td>
          <td class='center'>Menu</td>
          </tr></thead>";

    $p      = new Paging9;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);


      $tampil = mysql_query("SELECT * FROM nasabah WHERE no_rekening LIKE '%$_GET[rekening]%' ORDER BY cabang DESC LIMIT $posisi,$batas");
   
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
     
      echo "<tr><td class='left'>$no</td>
                <td class='left'>$r[no_rekening]</td>
                <td class='left'>$r[nama]</td>
				<td class='left'>".num($r[wajib])."</td>
				<td class='left'>".num($r[pokok])."</td>
				<td class='left'>".num($r[sukarela])."</td>
		       	<td class='center' width='120'><a href=?view=transaksi&act=transaksi&no_rekening=$r[no_rekening]><img src='images/trans.png' border='0' title='Transaksi' /></a>
				<a href=?view=transaksi&act=struk&no_rekening=$r[no_rekening]><img src='images/struk.png' border='0' title='Struk' /></a></td></tr>";
      $no++;
	  //<a href=?view=transaksi&act=transfer&no_rekening=$r[no_rekening]><img src='images/tranfer.png' border='0' title='Transfer' /></a>
    }
    echo "</table>";

    
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM nasabah WHERE no_rekening LIKE '%$_GET[rekening]%'"));
   
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
 
    break;    
	}
	
	case "transaksi":
	$tanggal= date("Y-m");
	$cek_pokok = mysql_query("select tanggal from simpanan where no_rek='$_GET[no_rekening]' and jenis='P' and tanggal LIKE '%$tanggal%'");
	
	
	if (mysql_num_rows($cek_pokok) == 0) 
	echo "<script>window.alert('Anda Belum Membayar Simpanan Pokok')</script>	
	<meta http-equiv='refresh' content='0; url=?view=transaksi&act=simpanan_pokok&no_rekening=$_GET[no_rekening]'>";	
	else{
		
    $setoran = mysql_query("select * from nasabah  where no_rekening='$_GET[no_rekening]'");
    $r    = mysql_fetch_array($setoran);

    echo "<h2 align='center'>SIMPANAN MANASUKA</h2>
	<br>
	<div class='nsb'>
          <form name='nasabah' id='nasabah' method=post action=$proses?view=transaksi&act=transaksi>
          	 <table class='listc'>
		 <tbodyc>	
		 
<input type=hidden name='no_transaksi'   	value='$no_sukarela' 	readonly='true' size=20 >
<input type=hidden name='no_rekening'		value='$r[no_rekening]' readonly='true' size=20 >
<input type=hidden name='saldo_terahkir'   	value='$r[sukarela]' 		readonly='true' size=20 >
		<tr><td class='a'>No Rekening			</td><td class='b'> 	: $r[no_rekening]</td></tr>		 											
		<tr><td class='a'>Nama Lengkap		</td><td class='b'>  	: $r[nama]</td></tr>
		<tr><td class='a'></td><td class='b'><b>SIMPANAN</b></td></tr>
		<tr><td class='a'>Wajib				</td><td class='b'> 	: ".num($r[wajib])."</td></tr>
		<tr><td class='a'>Pokok				</td><td class='b'> 	: ".num($r[pokok])."</td></tr>
		<tr><td class='a'>Manasuka			</td><td class='b'>		: ".num($r[sukarela])."</td></tr>
		<tr><td class='a'></td><td class='b'><b>TRANSAKSI</b>			</td></tr>
		<tr><td class='a'>Nominal 			</td><td class='b'> 	: <input type=text name='ambil' id='ambil' maxlength='8'></td></tr>
		<tr><td class='a'>Tindakan			</td><td class='b'> 	:  <select name='kode' id='kode'><option value='0' selected>- Pilih Tindakan -</option>
																									<option value='D' >- Setoran -</option>
																									<option value='K' >- Penarikan -</option>
																									</select>
		<tr><td class=left></td><td class='left'><input type=submit value=Simpan>
        <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody>
		  </table>
		
		  </form>
		  </div>";
		  
		  }
    break;  
	
	case"simpanan_pokok":
	$setoran = mysql_query("select no_rekening,nama,pokok,tanggal from nasabah n inner join simpanan s on n.no_rekening=s.no_rek  where no_rekening='$_GET[no_rekening]' and jenis='P'");
    $r    = mysql_fetch_array($setoran);
	
	$sekarang= date("Y-m");
	
	$tahun_sekarang=substr($sekarang,0,4);
	$bulan_sekarang=substr($sekarang,5,2);
	$saatini=$tahun_sekarang.$bulan_sekarang;
	$tanggal_terahkir_bayar=$r['tanggal'];
	$tahun_bayar=substr($tanggal_terahkir_bayar,0,4);
	$bulan_bayar=substr($tanggal_terahkir_bayar,5,2);
	$kemarin=$tahun_bayar.$bulan_bayar;
	$tunggakan=$saatini-$kemarin;
	 echo "<h2 align='center'>SIMPANAN POKOK</h2>
	 <br>
	 <div class='nsb'>
          <form name='nasabah' id='nasabah' method=POST action=$proses?view=transaksi&act=pokok >
          <table class='listc'>
		  <tbodyc>
		  <input type=hidden name=no_rekening value=$_GET[no_rekening] size=20>
		  <input type=hidden name=no_pokok value=$no_sukarela size=20>
          <tr><td class='a'>	No Rekening			</td><td class='b'>  : $r[no_rekening] </td></tr>
		  <tr><td class='a'>	Nama				</td><td class='b'>  : $r[nama] </td></tr>
		  <tr><td class='a'>	Saldo Simpanan Pokok</td><td class='b'>  : $r[pokok] </td></tr>
		  <tr><td class='a'>	Nominal				</td><td class='b'>  : <input type=text id=nominal name=nominal maxlength=8></td></tr>";
		  if ($tunggakan=="1")
		  {
		  echo"
		   <tr><td class='a'>	Catatan				</td><td class='b'>  : Simpanan Pokok Bulan Sekarang Harus Dibayar </td></tr>";
		   }
		   else { 
		   echo "<tr><td class='a'>	Catatan				</td><td class='b'>  : Simpanan Pokok Selama $tunggakan Bulan Belum dibayar,
		   																		<br>&nbsp; Besar Nominal Harap dikalikan jumlah tunggakan</td></tr>";}
		  
		  echo"
          <tr><td class='a'></td><td class='b'><input type=submit value=Simpan><input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
	
	
	break;
	
	
	
case "struk":
echo "<h2 align='center'>BUKU TABUNGAN</h2> <br>";

    $struk = mysql_query("select @Urut:=@Urut+1 Urut, tanggal,kode,jenis,
case when kode='D' then nominal else 0 end as Debit,
case when kode='K' then nominal else 0 end as Kredit,
(@LB := @LB + if (kode='D', nominal, -nominal)) as Saldo
from (SELECT @Urut := 0) as Urut,(select @LB := 0) as Awal, simpanan where jenis ='S'
AND no_rek = '$_GET[no_rekening]' order by tanggal asc");
    $s    = mysql_fetch_array($struk);
	
	echo "<table class='list'><thead>  
    
		<td class='left'>No</td>
		  <td class='left'>Tanggal</td>
		  <td class='left'>Debet</td>
		  <td class='left'>Kredit</td>
          <td class='center'>Saldo</td>
          </tr></thead>";

    $p      = new Paging8;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);


      $tampil = mysql_query("select @Urut:=@Urut+1 Urut, tanggal,kode,jenis,
case when kode='D' then nominal else 0 end as Debit,
case when kode='K' then nominal else 0 end as Kredit,
(@LB := @LB + if (kode='D', nominal, -nominal)) as Saldo
from (SELECT @Urut := 0) as Urut,(select @LB := 0) as Awal, simpanan where jenis ='S'
AND no_rek = '$_GET[no_rekening]' group by no_rek, tanggal
order by tanggal asc LIMIT $posisi,$batas");
   
  
    while($s=mysql_fetch_array($tampil)){
     
      echo "<tr>
	  			<td class='left'>$s[Urut]</td>
                <td class='left'>$s[tanggal]</td>
				<td class='left'>".num($s['Debit'])."</td>
				<td class='left'>".num($s['Kredit'])."</td>
				<td class='left'>".num($s['Saldo'])."</td>
						        </tr>";
      
    }
    echo "</table>";

    echo"  <div align='center'>
			<form action='view/transaksi/cetak.php' method='post'>
			<input type='hidden' name='no_rek' value='$_GET[no_rekening]'/>
			<input type=button value='Kembali' onclick=location.href='?view=transaksi&rekening=$_GET[no_rekening]'>
			<input type='submit' value='Preview'></form></div>";
	
	
      $jmldata = mysql_num_rows(mysql_query("select @Urut:=@Urut+1 Urut, tanggal,kode,jenis,
case when kode='D' then nominal else 0 end as Debit,
case when kode='K' then nominal else 0 end as Kredit,
(@LB := @LB + if (kode='D', nominal, -nominal)) as Saldo
from (SELECT @Urut := 0) as Urut,(select @LB := 0) as Awal, simpanan where jenis ='S'
AND no_rek = '$_GET[no_rekening]' order by tanggal asc"));
   
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div align='center' class=\"pagination\"> $linkHalaman</div>";
 
    break;    
	
	
	
	
	case "transfer":
    $tf = mysql_query("select * from nasabah  where no_rekening='$_GET[no_rekening]'");
    $r    = mysql_fetch_array($tf);
    echo "<h2 align='center'>TRANSFER</h2>
	<br>
	<div class='nsb'>
<form name='nasabah' id='nasabah' method=post action=?view=transaksi&act=proses>
        <table class='listc'>
		<tbodyc>
		<input type=hidden name='no_rekening'   value='$r[no_rekening]' 	readonly='true' size=20 >
		<input type=hidden name='no_transaksi'  value='$no_sukarela' 		readonly='true' size=20 >
		<tr><td class='a'>No Rekening		</td><td class='b'>			: $r[no_rekening]	</td></tr>		 											
		<tr><td> class='a'Nama Lengkap	</td><td class='b'>			: $r[nama] </td></tr>
		<tr><td class='a'>Alamat Lengkap	</td><td class='b'> 			: $r[alamat]</td></tr>				
		<tr><td class='a'>Tabungan		</td></tr>
		<tr><td class='a'>Saldo Terahkir	</td><td class='b'> 		  	: ".num($r[sukarela])."</td></tr>
		<tr><td class='a'>Masukan Nominal	</td><td class='b'>  			: <input type=text name='ambil' id='ambil'  maxlength=8></td></tr>
		<tr><td class='a'>Tujuan			</td></tr class='b'>
		<tr><td class='a'>Masukan No Rekening Tujuan</td><td class='b'>  : <input type=text name='tujuan' id='tujuan' maxlength=12></td></tr> 
        <tr><td></td><td><input type=submit value=Proses>
        <input type=button value=Batal onclick=self.history.back()></td></tr>
        </tbodyc>
		</table>
</form>
</div>";
    break;  
	
	
	
	case "proses":
	if (empty($_POST['ambil']) or empty($_POST['tujuan'])) echo "<script>window.alert('Pastikan Nominal Dan Rekening Tujuan Terisi')</script>	
									<meta http-equiv='refresh' content='0; url=?view=transaksi&act=transfer&no_rekening=$_POST[no_rekening]'>";									
			else{
    			$cek1= mysql_query("select * from nasabah  where no_rekening='$_POST[no_rekening]'");
    			$r1  = mysql_fetch_array($cek1);
				
						$sql  = "select * from nasabah  where no_rekening='$_POST[tujuan]'";
    					$cek2 = mysql_query($sql);
     					if (mysql_num_rows($cek2) == 0)  $tujuan = "Rekening Tujuan Tidak Ditemukan";							
   		  		else{
					$r2 = mysql_fetch_array($cek2);
						$tujuan = $r2['no_rekening'];
						$nama = $r2['nama'];
						$alamat = $r2['alamat'];
					}
			echo "<h2 align='center'>VALIDASI TRANSFER</h2>
	<br>
	<div class='nsb'>
<form method=post action=$proses?view=transaksi&act=transfer>
       <table class='listc'>
		<tbodyc>
		<input type=hidden name='no_transaksi'   value='$no_sukarela' readonly='true' size=20 >
		<input type=hidden name='no_rekening'   value='$r1[no_rekening]' readonly='true' size=20 >
		<input type=hidden name='nominal' value='$_POST[ambil]'  readonly='true'  size=20>
		<input type=hidden name='tujuan' value='$tujuan' size=20>
		<input type=hidden name='saldo' value='$r1[sukarela]' size=20>
        <tr><td class='a'>No Transaksi</td><td class='b'>		: $no_sukarela	</td></tr>
		<tr><td class='a'>No Rekening	</td><td class='b'>		: $r1[no_rekening]	</td></tr>		 											
		<tr><td class='a'>Nama Lengkap</td><td class='b'>		: $r1[nama] </td></tr>
		<tr><td class='a'>Alamat Lengkap</td><td class='b'> 	: $r1[alamat]</td></tr>				
		<tr><td class='a'>Nominal</td><td class='b'>  : $_POST[ambil]  </td></tr>
		<tr><td class='a'>Tujuan</td></tr>
		<tr><td class='a'>Rekening Tujuan</td><td class='b'>  : $tujuan</td></tr>
		<tr><td class='a'>Nama</td><td class='b'>  : $nama</td></tr>
		<tr><td class='a'>Alamat</td><td class='b'>  : $alamat</td></tr>		 			 
        <tr><td class='a'></td><td class='b'><input type=submit value=Proses>
        <input type=button value=Batal onclick=self.history.back()></td></tr>
        </tbodyc>
		</table>
</form>
</div>";					  			
    break; 
			}
	
}
	
	?>
