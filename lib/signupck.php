<?php


include "config.php"; // database connection details stored here
// Collect the data from post method of form submission // 
$name=$_POST['name'];
$userid=$_POST['userid'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$agree=$_POST['agree'];
$todo=$_POST['todo'];
$email=$_POST['email'];
$signup_success ="<script language='javascript' type='text/javascript'>
alert('You have successfully registered. You will be redirected to login page now.');</script>";
$signup_fail="<script language='javascript' type='text/javascript'>
alert('Registration failed. Try again.');</script>";

if(isset($todo) and $todo=="post"){

$status = "OK";
$msg="";

// if userid is less than 3 char then status is not ok
if(!isset($userid) or strlen($userid) <3){
$msg=$msg."User id should be =3 or more than 3 char length<BR>";
$status= "NOTOK";}					

if(!ctype_alnum($userid)){
$msg=$msg."User id should contain alphanumeric  chars only<BR>";
$status= "NOTOK";}					


if(mysql_num_rows(mysql_query("SELECT userid FROM plus_signup WHERE userid = '$userid'"))){
$msg=$msg."Userid already exists. Please try another one<BR>";
$status= "NOTOK";}					

if(mysql_num_rows(mysql_query("SELECT email FROM plus_signup WHERE email = '$email'"))){
$msg=$msg."This email address is there with us. If you forgot your password you can activate it by using forgot password link. Or Please try another one<BR>";
$status= "NOTOK";}					

if ( strlen($password) < 3 ){
$msg=$msg."Password must be more than 3 char legth<BR>";
$status= "NOTOK";}					

if ( $password <> $password2 ){
$msg=$msg."Both passwords are not matching<BR>";
$status= "NOTOK";}					



if($status<>"OK"){ 
echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";
}else{ // if all validations are passed.
$password=md5($password); // Encrypt the password before storing
$track = md5($userid);// generates a tracking code
if(mysql_query("insert into plus_signup(name,userid,password,email,track) values('$name','$userid','$password','$email','$track')")){

echo $signup_success;
print "<script>";
       print " self.location='../index.php?nav=login';"; // Comment this line if you don't want to redirect
          print "</script>";

exit;
}else{
echo $signup_fail;
print "<script>";
       print " self.location='../index.php?nav=signup';"; // Comment this line if you don't want to redirect
          print "</script>";

exit;
}
}
}
?>
