<?php
include "config/database.php";
$slash_p="-";
$cab_p= $_SESSION ['cab']; 
$kode_p="P"; 
$query_p = "SELECT substring(no_pokok, 7, 3)AS no_pokok FROM pokok  ORDER BY no_pokok  DESC LIMIT 1";
     	$hasil_p = mysql_query($query_p);	
		$p=mysql_fetch_array($hasil_p);					
		$no_p=$p['no_pokok'];
		$ambl_p = substr ($no_p,0,3);
		$next_p=$ambl_p+1;
		$next_number_p = sprintf ('%03s',$next_p);	
$no_pokok=$kode_p.$slash_p.$cab_p.$slash_p.$next_number_p;
?>