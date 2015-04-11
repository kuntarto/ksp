<?php

include "config/database.php";
$slash_pj="-";
$cab_pj= $_SESSION ['cab'];
$kode_pj="L"; 
$query_pj = "SELECT substring(no_pinjam, 7, 3)AS no_pinjam FROM pinjam ORDER BY no_pinjam  DESC LIMIT 1";
     	$hasil_pj = mysql_query($query_pj);	
		$pj=mysql_fetch_array($hasil_pj);					
		$no_pj=$pj['no_pinjam'];
		$ambl_pj = substr ($no_pj,0,3);
		$next_pj=$ambl_pj+1;
		$next_number_pj = sprintf ('%03s',$next_pj);	
		$no_pinjam=$kode_pj.$slash_pj.$cab_pj.$slash_pj.$next_number_pj;

?>