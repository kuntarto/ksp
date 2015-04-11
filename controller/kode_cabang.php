<?php
//fungsi membuat no transaksi secara urut dengan maksimal transaksi 999 kali perhari
function no_trans($no){


//logika pembuatan no urut
if(substr($no,-1) == "9" && substr($no,-2,1) != "9"){
$no3=0;
$no2=substr($no,-2,1)+1;
$no1=substr($no,-3,1);
}
elseif(substr($no,-1) == "9" && substr($no,-2,1) == "9"){
$no3=0;
$no2=0;
$no1=substr($no,-3,1) + 1;
}
else{
$no3=substr($no,-1) + 1;
$no2=substr($no,-2,1);
$no1=substr($no,-3,1);
}
$no="$no1$no2$no3";
//penggabungan atara kategori, tgl dan no urut transaksi
$notrans=$no;
return $notrans; //untuk memberikan nilai no urut saat penggunaan fungsi
}
include "config/database.php";

$q=mysql_query("select * from cabang order by no_cab desc limit 1"); //mengambil data transaksi terbaru
$hasil=mysql_fetch_array($q);
if(mysql_num_rows($q) != 0){ //jika data transaksi tidak kosong
$no_trans=no_trans($hasil['no_cab']);
}
else{
$no_trans=no_trans("000");
}
?>