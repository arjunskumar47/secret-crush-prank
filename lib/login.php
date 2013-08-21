<div class="post">
<h2>Log in!</h2>
<div class="entry">

<?php
if(!isset($_SESSION['userid']))	{
echo '<form action="lib/loginck.php" method=post>
<label for="username">Username</label>
<input type ="text" id="skform" name="userid" />
<label for="password">Password</label>
<input type ="password" id="skform" name="password"  /><br />
<input type="submit" value="Submit" id="click">
<input type="reset" value="Reset" id="click">
</form>
<a href='.$sksiteurl.'index.php?nav=signup">Sign Up</a><br />
<a href='.$sksiteurl.'index.php?nav=forgot">Forgot Password?</a>';
}
else {
	echo 'You are already logged in!<br />';
	include 'lib/bottom.php';
}
?>
</div>
<p class="meta"> &nbsp; </p>
</div>