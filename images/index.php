<?php
session_start();
if (empty($_SESSION['nip']) AND empty($_SESSION['password'])){
 header('location:../index.php');
}
else{
	header('location:../main.php?view=home');
	}
?>
