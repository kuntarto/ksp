<?PHP 
 session_start();
if ($_SESSION['jabatan']=='a') {
echo"
  <div id='content-kiri'>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/beranda.png' onclick=location.href='?view=home' /></div>
     <div class='button-row'><input class='nv' type='image'  src='images/menu/nasabah.png' onclick=location.href='?view=nasabah' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/transaksi.png' onclick=location.href='?view=transaksi' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/pinjaman.png' onclick=location.href='?view=pinjam' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/jaminan.png' onclick=location.href='?view=jaminan' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/laporan.png' onclick=location.href='?view=laporan' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/log_out.png' onclick=location.href='controller/logout.php' /></div>
   </div>
   ";
}
else{
  echo"
  <div id='content-kiri'>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/beranda.png' onclick=location.href='?view=home' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/cabang.png' onclick=location.href='?view=cabang' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/petugas.png' onclick=location.href='?view=petugas' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/nasabah.png' onclick=location.href='?view=nasabah' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/transaksi.png' onclick=location.href='?view=transaksi' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/pinjaman.png' onclick=location.href='?view=pinjam' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/jaminan.png' onclick=location.href='?view=jaminan' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/laporan.png' onclick=location.href='?view=laporan' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/akuntansi.png' onclick=location.href='../akuntansi' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/backup.png' onclick=location.href='?view=backup' /></div>
    <div class='button-row'><input class='nv' type='image'  src='images/menu/log_out.png' onclick=location.href='controller/logout.php' /></div>
   </div>
   ";
  }
 
  
 ?>