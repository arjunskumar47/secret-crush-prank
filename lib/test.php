<?php
$track_id=$_GET['id'];
if($_POST['submit']=='Calculate')
{
$query = sprintf("SELECT `name`, `userid`, `email`, `track` FROM plus_signup WHERE track='%s'",
    mysql_real_escape_string($track_id));

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    $fooled_by = $row['name'];
    $email_to = $row['email'];
    $user_id = $row['userid'];
}
mysql_free_result($result);

		$_POST['fool'] = mysql_real_escape_string($_POST['fool']);
		$_POST['l1'] = mysql_real_escape_string($_POST['l1']);
		$_POST['l2'] = mysql_real_escape_string($_POST['l2']);
		$_POST['l3'] = mysql_real_escape_string($_POST['l3']);
		// Escape the input data
		$fool = $_POST['fool'];
		$l1 = $_POST['l1'];
		$l2 = $_POST['l2'];
		$l3 = $_POST['l3'];
		$id = $_GET['id'];
		
		mysql_query("INSERT INTO fools(fool,l1,l2,l3,`by`) VALUES('$fool','$l1','$l2','$l3','$id')");
		
		// Sending mails body and its variables
		$sub = 'You have fooled '.$fool. '!';
		$mail_msg = 'The answer by '.$fool. 'are '.$l1.'<br />'.$l2.'<br />' .$l3;
		send_mail($admin_email,$email_to,$sub,$mail_msg);
		echo 'You have been fooled by '.$fooled_by.' and the names you entered have been sent to '.$email_to. '!<br /><br /> <a href='.$sksiteurl.'index.php?nav=signup>Click here to register</a> and start fooling your friends!';
		
		
	
	
}
else {
echo '<h2>Who is your one and only?</h2>
Butterflies in your stomach when you catch sight of that special someone? Is it an never ending love story ? Will it work out or will it be just another futile attempt? Before you pop the all important "I love you", use our Crush Calculator to find out if he or she is The One! 
<br /><br />
<form action="" method="post">		
<label for="name">Your Name</label>
<input type="text" name="fool" id="skform" value=""/>
<label for="lover1">Lover 1</label>
<input type="text" name="l1" id="skform" value="" />
<label for="lover2">Lover 2</label>
<input type="text" name="l2" id="skform" value=""/><
<label for="lover3">Lover 3</label>
<input type="text" name="l3" id="skform" value=""  /><br />
					
					<input type="submit" name="submit" value="Calculate"  id="click" />
				</form>';
}
?>

