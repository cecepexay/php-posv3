<!DOCTYPE HTML>
<html lang="en">
<head>
<title>DISTRIK NAVIGASI KELAS III CILACAP KEMENTRIAN PERHUBUNGAN</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="administrator/css/style.css">
<link rel="shortcut icon" type="image/x-icon" href="administrator/images/favicon.png">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="administrator/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="administrator/js/cufon-yui.js"></script>
<script type="text/javascript" src="administrator/js/Delicious_500.font.js"></script>
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
      document.getElementById('eroruser').innerHTML = "<div class='error msg'>Username is empty, click to close</div>";
      form.username.focus();
      $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
      });
    return (false);
  }

  if (form.password.value == ""){
    document.getElementById('erorpass').innerHTML = "<div class='error msg'>Password is empty, click to close</div>";
    form.password.focus();
    $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
    });
    return (false);
  }
  return (true);
}
</script>

</head>
<body>

<header id="top"></header>

<div id="login" class="box">
	<h2>Login Pegawai</h2>
	<section>
		
                <p id="eroruser"></p>
                <p id="erorpass"></p>
		<form method="POST"action="administrator/cek_login.php" onSubmit="return validasi(this)">
			<dl>
				<dt><label>Username</label></dt>
                                <dd><input id="username" type="text"  name="username"/></dd>

				<dt><label>Password</label></dt>
				<dd><input id="adminpassword" type="password" name="password"/></dd>
			</dl>
			<p>
				<input type="submit" class="button white" value="Login"></input>
                                <input type="reset" class="button white" value="Reset"></input>
			</p>
		</form><div align="center"><a href="#" target="_blank">-DISTRIK NAVIGASI KELAS III CILACAP KEMENTRIAN PERHUBUNGAN-</a></div>
	</section>
</div>

</body>
</html>