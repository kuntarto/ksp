<?php
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['password'])){
header('location:index.php');
}
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>KOPERASI ARTHA MANDIRI</title>
<link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
<link rel="icon" href="favicon.gif" type="image/x-icon">
<link rel="stylesheet" href="css/button/style.css" type="text/css" />
<link rel="stylesheet" href="css/button/reset.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/val.css" type="text/css" />
<link rel="stylesheet" href="js/js/themes/base/ui.all.css" type="text/css" />
<script type="text/javascript" src="js/js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/js/ui.corek.js"></script>
<script type="text/javascript" src="js/js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/nasabah.js"></script>
<script type="text/javascript"> 

      $(document).ready(function(){
        $("#tanggal_lahir").datepicker({
			dateFormat  : "yy-mm-dd", 
          changeMonth : true,
          changeYear  : true
        });
      });
      </script>


</head>

<body>
<div id="daddy">
	
<div id="header">
		<!--Kiri--><?php include "/view/nav-top.php";?><!--kiri-->
<div id="ticker"></div>
		<div id="ticker">
		 <tr>
    <td align="center" height="18"><marquee><b style="font-size: 18px;">Sekarang Pukul </b><span id="tick2" style="font-size: 18px;"></span></marquee></td></tr>

		</div>
		<div id="headerimage">
			<img src="images/logo_ksp.png" alt="Your Company Logo" width="990px" height="150px" /></a>
		</div>
		<!-- headerimage -->
	</div>
	<!-- header -->
	<div id="content">
  <?php include "view/nav-bottom.php";?>
    <div id="content-kanan">
    <div id="content-kanan-dalam">
    <?php include "controller/main.php";?> 

    </div>
    </div>
    		
	</div><!-- content -->
	
</div><!-- daddy -->


<!--Kiri--><!--kiri-->

<script type="text/javascript" src="js/jam.js"></script>

</body>
</html>
