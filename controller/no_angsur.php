<?php
include "config/database.php";
$slash_a="-";
$cab_a= $_SESSION ['cab'];
$kode_a="A"; 
$query_a = "SELECT substring(no_angsur, 7, 3)AS no_angsur FROM angsur  ORDER BY no_angsur  DESC LIMIT 1";
     	$hasil_a = mysql_query($query_a);	
		$a=mysql_fetch_array($hasil_a);					
		$no_a=$a['no_angsur'];
		$ambl_a = substr ($no_a,0,3);
		$next_a=$ambl_a+1;
		$next_number_a = sprintf ('%03s',$next_a);	
		$no_angsur=$kode_a.$slash_a.$cab_a.$slash_a.$next_number_a;

?>