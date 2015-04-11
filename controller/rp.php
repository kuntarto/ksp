<?php
function num($rp){
if($rp!=0){
	$hasil = number_format ($rp, 2, ',', '.');
	}
	else{
	$hasil=0;
	}
return $hasil;
}
?>