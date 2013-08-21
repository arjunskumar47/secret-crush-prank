<?php

$q=mysql_query("update plus_login set status='OFF' where id='$_SESSION[id]'");

session_unset();
session_destroy();

?>

