<?php

include "include/session.php";
include "config.php"; // database connection details stored here
//////////////////////////////

$userid=$_POST['userid'];
$password=$_POST['password'];

$userid=mysql_real_escape_string($userid);
$password=mysql_real_escape_string($password);
$password=md5($password); // Encrypt the password before comparing

if($rec=mysql_fetch_array(mysql_query("SELECT * FROM plus_signup WHERE userid='$userid' AND password = '$password'"))){
	if(($rec['userid']==$userid)&&($rec['password']==$password)){
	 include "include/newsession.php";


$tm=date("Y-m-d H:i:s");

//$ip=@$REMOTE_ADDR; 
// The above line is commented and the line below is used for the servers where register_global=Off
$ip=$_SERVER['REMOTE_ADDR'];

echo $ip;
$rt=mysql_query("insert into plus_login(id,userid,ip,tm) values('$_SESSION[id]','$_SESSION[userid]','$ip','$tm')");

echo mysql_error();
            echo "<p class=data> <center>Successfully,Logged in<br><br><a href='logout.php'> Log OUT </a><br><br><a href=".$sksiteurl."index.php?nav=user>Click here if your browser is not redirecting automatically or you don't want to wait.</a><br></center>";
     print "<script>";
       print " self.location='../index.php?nav=user';"; // Comment this line if you don't want to redirect
          print "</script>";

				} else{ // Now  password is matching but userid is case sensitive so you can give message but that will help hackers to guess and try.   
echo "<font face='Verdana' size='2' color=red><br>Wrong Login. Use your correct  Userid and Password and Try <br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";

		session_unset();
}
		}	
	else {

		session_unset();
echo "<font face='Verdana' size='2' color=red>$msg<br>Wrong Login. Use your correct  Userid and Password and Try <br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
		
	}
?>