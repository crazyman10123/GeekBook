<?php
if(isset($_POST['sendmessage']) && !empty($_POST['themessage'])) {
	$message = "message.txt";
	$current = file_get_contents($message);
	$stripped1 = strip_tags($_POST['themessage'], '<p><a><object><param><h><embed><iframe>');
	$stripped = stripslashes($stripped1);
	$now = "<h3>".$_SESSION['fullname']."</h3><p>".$stripped."</p><font size='1pt'>".date(DATE_RFC822)."</font></br></br>"."\n";
	$new = file_put_contents($message, $current.$now);
	$newdate = date(c);
	$sql = "UPDATE messages SET Sender='".$_SESSION['fullname']."', Message='".$stripped."', Recipient='".$person."', Sent='".$newdate."' WHERE id='".$id."'";
	$newsql = mysql_query($sql);
	if(!$newsql) {
		echo mysql_error();
	}
}
?>