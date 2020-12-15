<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Inbox<?php echo $notifNum; ?></title>
<?php include '/home/a3712987/public_html/header.php' ?>
<?php
if ($_SESSION['login'] == 1) {
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
				foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
				}
			reset($objects);
			rmdir($dir);
		}
	}
	echo 'Want to <a href="'.$urlbase.'messages.php">send a message?</a>';
	echo '<form method="post" action="">';
	echo '<input type="text" name="deletemsg" placeholder="Message id to delete" autocomplete="off" /></br>';
	echo '<input type="submit" value="Delete Message">';
	echo '</form></br>';
	if(!empty($_POST['deletemsg'])) {
		$sqlselect = mysql_query("SELECT * FROM messages WHERE id='".$_POST['deletemsg']."'");
		$sqlselectrow = mysql_fetch_array($sqlselect);
		rrmdir($sqlselectrow['Link']."/");
		$sqldel = mysql_query("DELETE FROM messages WHERE id='".$_POST['deletemsg']."'");
		if(!$sqldel) {
			die("Error, unable to delete message.");
		}
		echo 'Message deleted!';
	}
	$sql = mysql_query("SELECT * FROM messages WHERE Recipient='".$_SESSION['fullname']."' OR Sender='".$_SESSION['fullname']."' ORDER BY Sent DESC");
	$num = mysql_numrows($sql);
	$i = 0;
	
	while ($i < $num) {
		$message = mysql_fetch_array($sql);
		echo '<table border="1"><tr><td><a href="'.$message['Link'].'">'.$message['Sender'].': '.$message['Message'].'</a></td></tr><tr><td><font size="1pt">ID: '.$message['id'].'(Type this in the box above to delete this message)</font></td></tr></table></br>';
		$i++;
	}
}
else {
	echo 'Sorry but you must be logged in to see your inbox.';
}
?>
<?php include '/home/a3712987/public_html/footer.php' ?>