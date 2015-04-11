<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
<link rel="icon" href="favicon.gif " type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/login_style.css" type="text/css" rel="stylesheet"/>
<title>Log In</title>

<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/login.js"></script>



</head>

<body OnLoad="document.login.username.focus();">
<!--Awal Main--><div id="main">

<!-- Header -->
<div id="header"><h3 align="center"></h3></div>


<!-- Middle -->
<div id="middle">
<form id="form-login" name="login" method="post"  action="controller/bypas.php" onSubmit="return validasi(this)">
  
  <img src="images/images_login/img_login_user.png" align="absmiddle" class="img_user" />
  <input type="text" name="username" size="30" id="username" maxlength="5" />
  <br />
  <br />
  <br />
	
  <img src="images/images_login/img_login_pass.png" align="absmiddle" class="img_pass" />
  <input type="password" name="password" size="30" id="password"   maxlength="15" />
  
  <br />
  <br />
  <br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input  name="Submit" type="image" src="images/front/login.png" id="submit" align="absmiddle" />
</form>
</div>

<div class="clear"></div>








<!--Ahkir Main--></div>

</body>
</html>
