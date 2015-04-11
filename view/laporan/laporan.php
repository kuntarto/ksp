<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
header('location:index.php');	
}
else{
	header('location:../../main.php?view=home');
	}
include "config/database.php";

switch($_GET[act])
{

default:
 echo "<h2 align='center'>LAPORAN TRANSAKSI<br>SIMPAN PINJAM</h2>
 									<br>
									<br>
									<h3 align='center'>CETAK LAPORAN</h3>
	<br>
	<div class='nsb'>
          <form name='nasabah' id='nasabah' method=POST action='view/laporan/cetak.php'>
          	<table class='listc'>
		  		<tbodyc>
		  			<tr><td class='a'>Cabang	</td><td class='b'>	: <select name='cab' id='cab'><option  value=a selected>- Pilih Cabang -</option>";
          $tampil=mysql_query("SELECT * from cabang ORDER BY no_cab");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[no_cab]>$r[nama_cab]</option>";
          }
		  echo" 
					<tr><td class='a'>Bulan	</td><td class='b'>	: <select name='lama' id='lama'><option  value=a selected>- Bulan -</option>
																								  <option  value=01 >- Januari -</option>
																								  <option  value=02 >- Febuari -</option>
																								  <option  value=03 >- Maret -</option>
																								  <option  value=04 >- April -</option>
																								  <option  value=05 >- Mei -</option>
																								  <option  value=06 >- Juni -</option>
																								  <option  value=07 >- Juli -</option>
																								  <option  value=08 >- Agustus -</option>
																								  <option  value=09 >- September -</option>
																								  <option  value=10 >- Oktober -</option>
																								  <option  value=11 >- November -</option>
																								  <option  value=12 >- Desember -</option>
																								  </select>
																   								  </td></tr>
					<tr><td class='a'>Tahun	</td><td class='b'>	:								  <select name='bunga' id='bunga'><option  value=a selected>- Tahun -</option>
																								  <option  value=2007 >- 2007 -</option>
																								  <option  value=2008 >- 2008 -</option>
																								  <option  value=2009 >- 2009 -</option>
																								  <option  value=2010 >- 2010 -</option>
																								  <option  value=2011 >- 2011 -</option>
																								  <option  value=2012 >- 2012 -</option>
																								  <option  value=2013 >- 2013 -</option>
																								  <option  value=2014 >- 2014 -</option>
																								  <option  value=2015 >- 2015 -</option>
																								  <option  value=2016 >- 2016 -</option>
																								  <option  value=2017 >- 2017 -</option>
																								  <option  value=2018 >- 2018 -</option>
																								  <option  value=2019 >- 2019 -</option>
																								  <option  value=2020 >- 2020 -</option>
																								  <option  value=2021 >- 2021 -</option>
																								  <option  value=2022 >- 2022 -</option>
																								  <option  value=2023 >- 2023 -</option>
																								  <option  value=2024 >- 2024 -</option>
																								  <option  value=2025 >- 2025 -</option>
																									</select>																						  
																								  </td></tr>
					<tr><td class='a'>Jenis Transaksi		</td><td class='b'>		: <input type=radio name='jenis' id='jenis' value='simpan' > Simpanan 
                                         						  <input type=radio name='jenis' id='jenis' value='pinjam'> Pinjaman </td></tr>
					<tr><td class='a'></td><td class='b'><input type=submit value=Preview><input type=button value=Kembali onclick=self.history.back()></td></tr>
          	</tbodyc>
		 </table>
		  </form>
	</div>";
	break;


}


?>