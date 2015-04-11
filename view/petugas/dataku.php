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




switch($_GET[act])
{
	
  default:
  
    $edit = mysql_query("select * from petugas where nip='$_SESSION[nip]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 align='center'> DATA PRIBADI</h2>
	  <div class='nsb'>
      		<form name='nasabah' id='nasabah' method='POST' action='$proses?view=petugas&act=dataku'>
          	<table class='listc'>
		  	<tbodyc>
		  	<input type=hidden name='nipp'   value=$r[nip] readonly='true'  size=20 >
          	<tr><td class='a'>		NIK			</td><td>	: $r[nip]	</td></tr>
			<tr><td class='a'>		Nama Lengkap</td><td class='b'>  : $r[nama]</td></tr>";
			if ($r[jenis_kelamin]=='pria'){
      		echo "<tr><td class='a'>Jenis Kelamin</td><td class='b'> : Pria ";  
            			                			  		               		}
    		else{
      		echo "<tr><td class='a'>Jenis Kelamin</td><td class='b'> : Wanita </td></tr>";
    		}
			echo "<tr><td class='a'>Tanggal Lahir</td><td class='b'>  : $r[tanggal_lahir]</td></tr>		
			<tr><td class='a'>Alamat Lengkap</td><td class='b'>  : <textarea rows=4	cols='17' name='alamat'	id='alamat' maxlength='100'>$r[alamat]</textarea></td></tr>
				 <tr><td class='a'>No Tlp		</td><td class='b'>   : <input type=text name='tlp' value='$r[tlp]' id='tlp'size=20></td></tr>
				 <tr><td  class='a'>Email		</td><td class='b'>   : <input type=text name='email' value='$r[email]' id='email'size=20></td></tr>
			     <tr><td  class='a'>Passwod dikosongkan jika tidak ganti	</td><td class='b'>   : <input type=password name='password1' ></td></tr>
				 <input type='hidden' name='password2' value='$r[password]'>	         
	
		 		  <tr><td>					</td><td><input type=submit value=Update>
				  									<input type=button value=Batal onclick=self.history.back()>
											</td></tr>
          </tbodyc>
		  </table>
		  </form>
		  </div>";
    break;  
	
	
	}

?>
