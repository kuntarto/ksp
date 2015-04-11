<?php

include "config/database.php";
$slash_t="-";
$cab_t= $_SESSION ['cab'];
$kode_t="T"; 
$query_t = "SELECT substring(no_simpanan, 7, 3)AS no_simpanan FROM simpanan  ORDER BY no_simpanan  DESC LIMIT 1";
     	$hasil_t = mysql_query($query_t);	
		$t=mysql_fetch_array($hasil_t);					
		$no_t=$t['no_simpanan'];
		$ambl_t = substr ($no_t,0,3);
		$next_t=$ambl_t+1;
		$next_number_t = sprintf ('%03s',$next_t);	
		$no_sukarela=$kode_t.$slash_t.$cab_t.$slash_t.$next_number_t;

?>