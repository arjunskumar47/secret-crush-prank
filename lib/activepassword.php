<?php


include "config.php"; // database connection details stored here
//////////////////////////////
$ak=$_GET['ak'];
$userid=$_GET['userid'];

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


echo "<form action='activepasswordck.php' method=post><input type=hidden name=todo value=new-password>
<input type=hidden name=ak value=$ak>
<input type=hidden name=userid value=$userid>
<table border='0' cellspacing='0' cellpadding='0' align=center>
 <tr bgcolor='#f1f1f1' > <td colspan='2' align='center'><font face='verdana, arial, helvetica' size='2' align='center'>&nbsp;<b>New  Password</b> </font></td> </tr>

<tr bgcolor='#ffffff' > <td ><font face='verdana, arial, helvetica' size='2' align='center'>  &nbsp;New Password  
</font></td> <td  align='center'><font face='verdana, arial, helvetica' size='2' >
<input type ='password' class='bginput' name='password' ></font></td></tr>

<tr bgcolor='#f1f1f1' > <td ><font face='verdana, arial, helvetica' size='2' align='center'>  &nbsp;Re-enter New Password  
</font></td> <td  align='center'><font face='verdana, arial, helvetica' size='2' >
<input type ='password' class='bginput' name='password2' ></font></td></tr>

<tr bgcolor='#ffffff' > <td colspan=2 align=center><input type=submit value='Change Password'><input type=reset value=Reset></form></font></td></tr>

";


echo "</table>";



?>
<center>
<br><br><a href='http://www.plus2net.com'>PHP SQL HTML free tutorials and scripts</a></center> 

</body>

</html>
