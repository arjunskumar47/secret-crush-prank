<?php
include "include/session.php";
// check the login details of the user and stop execution if not logged in
require "check.php";
//////////Collect the form data ////////////////////

$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];
/////////////////////////

if(isset($todo) and $todo=="change-password"){
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
if(mysql_query("update plus_signup set password='$password' where userid='$_SESSION[userid]'")){
echo "<font face='Verdana' size='2' ><center>Thanks <br> Your password changed successfully. Please keep changing your password for better security</font></center>";
}else{echo "<font face='Verdana' size='2' color=red><center>Sorry <br> Failed to change password Contact Site Admin</font></center>";
}
}
}
require "bottom.php";

?>
