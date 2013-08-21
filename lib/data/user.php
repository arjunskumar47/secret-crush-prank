<div class="post">

	<?php
	require "lib/check.php";
	$user = $_SESSION['userid'];
	echo '<h2>Welcome '.$user.'!</h2>';
	echo '<div class="entry">';
	$uid_code = md5($user);
	echo '<br /><div id="codewrap">Tracking code is <br /><code>'.$sksiteurl.'index.php?nav=test&id='.$uid_code.'</code></div>';
	echo '<h3>People you have fooled so far!</h3>';
	echo '<table class="sofT"><tr><td class="helpHed">Name</td><td class="helpHed">Lover 1</td><td class="helpHed">Lover 2</td><td class="helpHed">Lover 3</td></tr>';

	$query = sprintf("SELECT * FROM fools WHERE `by`='%s'",mysql_real_escape_string($uid_code));

	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {	
	$no = $row['id'];
    	$fool = $row['fool'];
	$l1 = $row['l1'];
	$l2 = $row['l2'];
	$l3 = $row['l3'];
	echo '<tr> <td class="helpBod">'.$fool.'</td> <td class="helpBod">'.$l1.'</td><td class="helpBod">'.$l2.'</td><td class="helpBod">'.$l3.'</td></tr>';
	}
	echo '</table>';
	echo ' <br /><br />Total number of peoples fooled : '.$no.' !!';
	mysql_free_result($result);
?>
    </div>
    <p class="meta">&nbsp;  </p>
    </div>
