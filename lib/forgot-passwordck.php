<?php

include "include/session.php";

include "config.php"; // database connection details stored here
//////////////////////////////
$email=$_POST['email'];
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
$email=mysql_real_escape_string($email);
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
if (!stristr($email,"@") OR !stristr($email,".")) {
$msg="Your email address is not correct<BR>"; 
$status= "NOTOK";}


echo "<br><br>";
if($status=="OK"){  $query="SELECT email,userid FROM plus_signup WHERE plus_signup.email = '$email'";
$st=mysql_query($query);
 $recs=mysql_num_rows($st);
$row=mysql_fetch_object($st);
$em=$row->email;// email is stored to a variable
 if ($recs == 0) {  echo "<center><font face='Verdana' size='2' color=red><b>No Password</b><br> Sorry Your address is not there in our database . You can signup and login to use our site. <BR><BR><a href='signup.php'> Sign UP </a> </center>"; exit;}

/// check if activation is pending /////
$tm=time() - 86400;
if(mysql_num_rows(mysql_query("SELECT userid FROM plus_key WHERE userid = '$row->userid' and time > $tm and status='pending'"))){
echo "<center><font face='Verdana' size='2' color=red><b>Your password activation Key is already posted to your email address, please check your Email address & bulk mail folder. "; 
exit;
}

/////////////// Let us send the email with key /////////////
/// function to generate random number ///////////////
function random_generator($digits){
srand ((double) microtime() * 10000000);
//Array of alphabets
$input = array ("A", "B", "C", "D", "E","F","G","H","I","J","K","L","M","N","O","P","Q",
"R","S","T","U","V","W","X","Y","Z");

$random_generator="";// Initialize the string to store random numbers
for($i=1;$i<$digits+1;$i++){ // Loop the number of times of required digits

if(rand(1,2) == 1){// to decide the digit should be numeric or alphabet
// Add one random alphabet 
$rand_index = array_rand($input);
$random_generator .=$input[$rand_index]; // One char is added

}else{

// Add one numeric digit between 1 and 10
$random_generator .=rand(1,10); // one number is added
} // end of if else

} // end of for loop 

return $random_generator;
} // end of function


$key=random_generator(10);
$key=md5($key);
$tm=time();
$rt=mysql_query("insert into plus_key(userid, pkey,time,status) values('$row->userid','$key','$tm','pending')");
echo mysql_error();


$headers4="admin@sitename.com";         ///// Change this address within quotes to your address ///
$headers.="Reply-to: $headers4\n";
$headers .= "From: $headers4\n"; 
$headers .= "Errors-to: $headers4\n"; 
//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
$site_url=$site_url."activepassword.php?ak=$key&userid=$row->userid";
 
if(mail("$em","Your Request for login details","This is in response to your request for login detailst at site_name \n \nLogin ID: $row->userid \n To reset your password, please visit this link( or copy and paste this link in your browser window )\n\n
\n\n
$site_url
\n\n
<a href='$site_url'>$site_url</a>

 \n\n Thank You \n \n siteadmin","$headers")){echo "<center><font face='Verdana' size='2' ><b>THANK YOU</b> <br>Your password is posted to your emil address . Please check your mail after some time. </center>";}
else{ echo " <center><font face='Verdana' size='2' color=red >There is some system problem in sending login details to your address. Please contact site-admin. <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";}


	} 

	else {echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";}
?>
<center>
<br><br><a href='http://www.plus2net.com'>PHP SQL HTML free tutorials and scripts</a></center> 

</body>

</html>
