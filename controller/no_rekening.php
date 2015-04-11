<?php
$slash_rek="-";
$cab_rek	= $_SESSION ['cab']; 
$year_rek=date("Y"); 
$tahun_rek = substr ($year_rek,2,3);
$cek = "SELECT substring(no_rekening, 8, 3)AS no FROM nasabah  ORDER BY no  DESC LIMIT 1";
     	$hasil_rek = mysql_query($cek);	
		$r=mysql_fetch_array($hasil_rek);					
		$no=$r['no'];
		$ambil_rek = substr ($no,0,3);
		$next_rek=$ambil_rek+1;
		$next_number_rek = sprintf ('%03s',$next_rek);	
$no_rekening=$cab_rek.$slash_rek.$tahun_rek.$slash_rek.$next_number_rek;

?>