

<?php

$user		= 'root';
$password	= '';
$database	= 'artha_mandiri';
$host		= 'localhost';

mysql_connect($host,$user,$password) or exit("Tidak Bisa Terhubung Dengan Server");
mysql_select_db($database) or exit("Database Tidak Ditemukan.");

?>