<?php
require "lib/check.php";
?>
<form action='lib/change-passwordck.php' method='post'>
<input type='hidden' name='todo' value='change-password' />
<label for="password">New Password</label>
<input type ='password' id="skform" name='password' >
<label for="password">Re-enter New Password</label>
<input type ='password' id="skform" name='password2' />
<br />
<input type='submit' id="click" value='Change Password' /><input type='reset' value='Reset' id="click" />



