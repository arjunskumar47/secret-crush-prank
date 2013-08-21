<?php

include "config.php"; // database connection details stored here
 // database connection details stored here
//////////////////////////////
$ak=$_POST['ak'];
$userid=$_POST['userid'];
$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];

?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>(Type a title for your page here)</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<?php
$userid=mysql_real_escape_string($userid);
$ak=mysql_real_escape_string($ak);


$tm=time()-86400;

if(!mysql_num_rows(mysql_query("SELECT userid  FROM plus_key WHERE pkey='$ak' and userid='$userid' and time > '$tm' and status='pending'"))){
echo "<center><font face='Verdana' size='2' color=red><b>Wrong activation </b></font> "; 
exit;
}

////////////////////// Show the change password form //////////////////


if(isset($todo) and $todo=="new-password"){
$password=mysql_real_escape_string($password);

//Setting flags for checking
$status = "OK";
$msg="";

			


if ( strlen($password) < 3 or strlen($password) > 8 ){
$msg=$msg."Password must be more than 3 char legth and maximum 8 char lenght<BR>";
$status= "NOTOK";}					

if ( $password <> $password2 ){
$msg=$msg."Both passwords are not matching<BR>";
$status= "NOTOK";}					



if($status<>"OK"){ 
echo "<font face='Verdana' size='2' color=red>$msg</font><br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
}else{ // if all validations are passed.
$password=md5($password); // Encrypt the password before storing
if(mysql_query("update plus_signup set password='$password' where userid='$userid'")){
$tm=time();
$tt=mysql_query("update plus_key set status='done' where pkey='$ak' and userid='$userid'  and status='pending'");
echo "<font face='Verdana' size='2' ><center>Thanks <br> Your new password is stored successfully. </font></center>";
}else{echo "<font face='Verdana' size='2' color=red><center>Sorry <br> Failed to store new password Contact Site Admin</font></center>";
}
}
}


?>
<center><a href=login.php>Login</a>
<br><br><a href='http://www.plus2net.com'>PHP SQL HTML free tutorials and scripts</a></center> 

</body>

</html>
