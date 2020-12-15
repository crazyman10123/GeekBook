<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Send A Message<?php echo $notifNum; ?></title>
<?php include "header.php" ?>
<?php
date_default_timezone_set('EDT');
if($_SESSION['login'] == 1) {
	$sql = mysql_query("SELECT * FROM ".$_SESSION['username']." WHERE Confirmed = 'Yes'");
	$num = mysql_numrows($sql);
	$i = 0;
	
	echo '<form method="post" action="">';
	echo 'Send To: <select name="sendto"><option value="selectone">Select A Recipient</option>';
	while ($i < $num) {
		$option = mysql_fetch_array($sql);
		if($option['Username'] != $_SESSION['username']) {
			$select = '<option value="' . $option['Username'] . '">' . $option['Name'] . '</option>';
			echo $select;
		}
		$i++;
	}
	echo '</select></br>';
	echo '</br><textarea name="message" rows="10" cols="100" maxlength="12000" lengthcut="true" placeholder="Enter your message here."></textarea></br>';
	echo '<input type="submit" name="sendmessage" value="Send">';
	echo '</form>';
	if(isset($_POST['sendmessage']) and $_POST['sendto'] != "selectone") {
		$sendto = stripslashes($_POST['sendto']);
		$messageubreak = stripslashes($_POST['message']);
		$blah = mysql_query("SELECT * FROM ".$_SESSION['username']." WHERE Username='".$sendto."'");
		$rows = mysql_fetch_array($blah);
		$otheruser = $rows['Username'];
		$otherusername = $rows['Name'];
		$link = $_SESSION['username']."and".$otheruser;
		$mysqldate = date(c);
		$sql = mysql_query("INSERT INTO messages(Sender, Message, Recipient, Link, Sent) VALUES ('".$_SESSION['fullname']."', '".$_POST['message']."', '".$otherusername."', '".$link."', '".$mysqldate."')");
		if(!$sql) {
			die("Something went wrong, sorry!");
		}
		$getid = mysql_query("SELECT id FROM messages WHERE Sender='".$_SESSION['fullname']."' AND Recipient='".$otherusername."'");
		$msgid = mysql_fetch_array($getid);
		$msgnum = $msgid['id'];
		$direct = "messages/".$link;
		$newdir = mkdir($direct, 0777);
		if(!$newdir) {
			die("Something went wrong! Sorry!");
		}
		$filehere = $direct."/index.php";
		$newpage = fopen($filehere, "w+");
		$messagefile = fopen($direct."/message.txt", "w+");
		$themessage = "<h3>".$_SESSION['fullname']."</h3><p>".$messageubreak."</p><font size='1pt'>".date(DATE_RFC822)."</font></br></br>"."\n";
		fwrite($messagefile, $themessage);
		$dothis = '<?php include "/home/a3712987/public_html/cookiestuff.php" ?>'."\n".
		'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n".
		'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">'."\n".
		'<head><title>GeekBook</title><?php include "/home/a3712987/public_html/header.php" ?>'."\n".
		'<?php $id = "'.$msgnum.'"; if($_SESSION[\'fullname\'] == "'.$otherusername.'") { $person = "'.$_SESSION['fullname'].'"; } if($_SESSION[\'fullname\'] == "'.$_SESSION['fullname'].'") { $person = "'.$otherusername.'"; } ?>'."\n".
		'<?php include "/home/a3712987/public_html/mesgrply.php" ?>'."\n".
		'<?php include "message.txt" ?>'."\n".
		'<?php include "/home/a3712987/public_html/reply.php" ?>'."\n".
		'<?php include "/home/a3712987/public_html/footer.php" ?>';
		$make = file_put_contents($filehere, $dothis);
		echo 'Message Sent!';
	}
}
else {
	echo 'You must be logged in to send messages!';
}
?>
<script type="text/javascript" language="javascript" src="charcount.js"></script>
<?php include 'footer.php' ?>