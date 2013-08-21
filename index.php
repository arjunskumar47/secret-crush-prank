<?php
include "lib/include/session.php";
include "lib/config.php";

$nav = $_GET['nav'];
if ($nav=="logout")
{
	$q=mysql_query("update plus_login set status='OFF' where id='$_SESSION[id]'");
	session_unset();
	session_destroy();
	header("Location: index.php?nav=home");
	exit;
}
$title = $sksitename;
if($nav=="signup"){ 
$title = 'Register &raquo;'.$sksitename; 
}
else if($nav=="login"){
$title = 'Login &raquo;'.$sksitename; 
}
else if($nav=="change-password"){
$title = 'Change Password &raquo;'.$sksitename; 
}

else if($nav=="forgot"){
$title = 'Forgot your password? Reset your Password &raquo;'.$sksitename; 
}
else if($nav=="about"){
$title = 'About us &raquo;'.$sksitename; 
}
else if($nav=="user"){
$title = 'Welcome &raquo;'.$sksitename; 
}
else if($nav=="test"){
$title = 'Test your love compatibility with your lover! &raquo; ' .$sksitename; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Language" content="English" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>

<div id="header">
	<div id="logo">
		<h1><a href="<?php echo $sksiteurl; ?>"><?php echo $sksitename; ?></a></h1>
		<h2>Tag Line</h2>
	</div>
	<div id="menu">
    	 <ul>
			<li><a href="<?php echo $sksiteurl; ?>index.php?nav=home">Home</a></li> 
			<li><a href="<?php echo $sksiteurl; ?>index.php?nav=about">About Us</a></li> 
			<li><a href="<?php echo $sksiteurl; ?>index.php?nav=signup">Register</a></li> 
			<li><a href="<?php echo $sksiteurl; ?>index.php?nav=login">Login</a></li>
		</ul>
    </div></div>
<hr />
<div id="page">
	<!-- start content -->
	<div id="content">
			<?php
if($nav=="signup"){ 
include('lib/signup.php');
}
else if($nav=="login"){
include('lib/login.php');
}
else if($nav=="test"){
include('lib/test.php');
}
else if($nav=="signupover"){
include('lib/signupck.php');
}
else if($nav=="change-password"){
include('lib/change-password.php');
}
else if($nav=="forgot"){
include('lib/forgot-password.php');
}
else if($nav=="about"){
include('lib/data/about.php');
}
else if($nav=="user"){
	include('lib/data/user.php');
}
else{
include('lib/data/home.php');	
}
?>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
        	<?php
            if(!isset($_SESSION['userid'])){
				echo '<li><h2>Register</h2>';
				echo '<form name="form1" method="post" action="lib/signupck.php">
<input type="hidden" name="todo" value="post" />
<label for="name">Name</label>
<input type="text" name="name" id="skform" />
<label for="username">Username</label>
<input type="text" name="userid" id="skform" />
<label for="password">Password</label>
<input type="password" name="password" id="skform" />
<label for="password2">Re-type password</label>
<input type="password" name="password2" id="skform" />
<label for="email">Email</label>
<input type="text" name="email"  id="skform" /><br />
<input type="submit" value="Signup" id="click" />
</form>';
				echo '</li>';
			}
			else if(isset($_SESSION['userid']))	
			{
				echo '<li><h2>Howdy!</h2>';
				include('lib/bottom.php');
				echo '</li>';
			}
			?>	
         </ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">Copyright &copy; <?php echo $sksitename; ?>. All rights reserved.</p>
	<p class="credit">Designed and Developed by <a href="http://www.arjunsk.in">Arjun S Kumar</a>.</p>
</div>
</body>
</html>