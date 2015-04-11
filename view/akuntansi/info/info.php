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
echo
        <!-- Page Content -->
                        
<div class="post">
<div class="entry">
                        
     <div class="logo span2"><h3><center> <img src="../images/logo.jpg" width="1000" height="150" /></center></h3></div>
                       
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
			
                        
                            <table class="table table-striped">
                                <caption><h1>Panduan</h1></caption>
                            <tr>
                                
                                <td width="120" border="3" bgcolor="#c6fc91"><strong><center>Jenis Rekening</center></strong></td>
                                <td width="110" border="3" bgcolor="#c6fc91"><strong><center>Saldo</center></strong></td>
                                <td width="120" border="3" bgcolor="#c6fc91"><strong><center>Penambahan</center></strong></td>
                                <td width="110" border="3" bgcolor="#c6fc91"><strong><center>Pengurangan</center></strong></td>
                                
                            </tr>
                            <tr>
                                <td><center>Aktiva</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Kredit</center></td>
                            </tr>
                            <tr>
                                <td><center>Hutang</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Debet</center></td>
                            </tr>
                            <tr>
                                <td><center>Modal</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Debet</center></td>
                            </tr>
                            <tr>
                                <td><center>Penghasilan</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Kredit</center></td>
                                <td><center>Debet</center></td>
                            </tr>
                            <tr>
                                <td><center>Biaya</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Kredit</center></td>
                            </tr>
                            <tr>
                                <td><center>Prive</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Debet</center></td>
                                <td><center>Kredit</center></td>
                            </tr>
                            </table>
                    <div class="col-lg-12">
                        <p><h1>Terdapat 6 Kategori</h1> </p>
                        <p>Aktiva kode rekening = 111</p>
                        <p>Pasiva kode rekening = 211</p>
                        <p>Pendapatan operasional kode rekening = 311</p>
                        <p>Beban Operasional kode rekening = 411</p>
                        <p>Pendapatan Non Operasional kode rekening = 511</p>
                        <p>Beban Non Operasional kode rekening = 611</p>
                    <div class="col-lg-13">
                        <h1>Akuntansi</h1>
                        <p>Neraca adalah laporan yang menunjukkan posisi keuangan perusahaan pada suatu saat tertentu. </p>
                        <p>Dalam neraca ditunjukkan kekayaan atau aktiva (asset) dan sumber kekayaan atau passiva.</p>
                        <p>Laporan Rugi-laba adalah laporan yang menunjukkan hasil kegiatan operasi perusahaan selama satu periode.</p>
                        <p>Pada laporan Laba-rugi terdapat tiga unsur utama yakni: penghasilan,Biaya,Laba(atau Rugi).</p>
                    </div>



                    

                    </div>
                </div>
            </div>
        </div>
</div>
</div>
        <!-- /#page-content-wrapper -->
	break;


}


?>