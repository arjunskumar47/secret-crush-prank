<?php
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
$dbservertype='mysql';
$servername='db4free.net:3306'; //db4free.net:3306
$dbusername='arjunskumar47'; //arjunskumar47
$dbpassword='arjunsk';
$dbname='sklove';
$sksitename='Site Name!';
$sksiteurl='http://localhost/love_1/';
$site_url="http://localhost/love_1/";
$admin_email ="demo@example.com";


////////////////////////////////////////
////// DONOT EDIT BELOW  /////////
///////////////////////////////////////

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}


//Send Mail Function

function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}

?>