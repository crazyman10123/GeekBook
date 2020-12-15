<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Chat<?php echo $notifNum; ?></title>
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] == 1) {
	echo '<strong>This is the '.$_SESSION['usertype'].' chat room.</strong></br>';
	if($_SESSION['usertype'] == "User") {
		$file = "chat.txt";
		$fileread = file_get_contents($file);
		$motd = file_get_contents("motd.txt");
		echo '<iframe src="http://www.geekbook.comyr.com/chatread.php#bottom" width="99%"></iframe></br>';
		echo '<form method="post" action="">';
		echo '<input type="text" size="100" name="message" autocomplete="off" placeholder="Message" /></br>';
		echo '<input type="submit" value="Send">';
		echo '</form>';
		echo 'To see the message of the day, type "/motd".</br>';
		echo 'Please note that this chat box is Site-Wide.</br>';
		echo 'Anything posted in this chat box can be seen by all registered users.</br>';
		echo 'For your own safety, I recommend that you share no personal information in this chat box.';
		if(!empty($_POST['message'])) {
			$message = $_POST['message'];
			$write = file_put_contents($file, $fileread . "</br>\n" . $_SESSION['username'] . ": " .stripslashes($message). '   <font size="1pt">Sent: '.date(DATE_RFC822)."</font>");
			if(!$write) {
				die("Something went wrong! Sorry!");
			}
			if($_POST['message'] == "/motd") {
				file_put_contents($file, $fileread . "</br>\n" . $motd);
			}
			if($_POST['message'] == "/clear" && $_SESSION['username'] == "crazyman") {
				file_Put_contents($file, $motd);
			}
		}
	}
	if($_SESSION['usertype'] == "Gamer") {
		$file = "chatgamer.txt";
		$fileread = file_get_contents($file);
		$motd = file_get_contents("motd.txt");
		echo '<iframe src="http://www.geekbook.comyr.com/chatgamer.php#bottom" width="99%"></iframe></br>';
		echo '<form method="post" action="">';
		echo '<input type="text" size="100" name="message" autocomplete="off" placeholder="Message" /></br>';
		echo '<input type="submit" value="Send">';
		echo '</form>';
		echo 'To see the message of the day, type "/motd".</br>';
		echo 'Please note that this chat box is Site-Wide.</br>';
		echo 'Anything posted in this chat box can be seen by all registered users.</br>';
		echo 'For your own safety, I recommend that you share no personal information in this chat box.';
		if(!empty($_POST['message'])) {
			$message = $_POST['message'];
			$write = file_put_contents($file, $fileread . "</br>\n" . $_SESSION['username'] . ": " .stripslashes($message). '   <font size="1pt">Sent: '.date(DATE_RFC822)."</font>");
			if(!$write) {
				die("Something went wrong! Sorry!");
			}
			if($_POST['message'] == "/motd") {
				file_put_contents($file, $fileread . "</br>\n" . $motd);
			}
			if($_POST['message'] == "/clear" && $_SESSION['username'] == "crazyman") {
				file_Put_contents($file, $motd);
			}
		}
	}
	if($_SESSION['usertype'] == "Hacker") {
		$file = "chathacker.txt";
		$fileread = file_get_contents($file);
		$motd = file_get_contents("motd.txt");
		echo '<iframe src="http://www.geekbook.comyr.com/chathacker.php#bottom" width="99%"></iframe></br>';
		echo '<form method="post" action="">';
		echo '<input type="text" size="100" name="message" autocomplete="off" placeholder="Message" /></br>';
		echo '<input type="submit" value="Send">';
		echo '</form>';
		echo 'To see the message of the day, type "/motd".</br>';
		echo 'Please note that this chat box is Site-Wide.</br>';
		echo 'Anything posted in this chat box can be seen by all registered users.</br>';
		echo 'For your own safety, I recommend that you share no personal information in this chat box.';
		if(!empty($_POST['message'])) {
			$message = $_POST['message'];
			$write = file_put_contents($file, $fileread . "</br>\n" . $_SESSION['username'] . ": " .stripslashes($message). '   <font size="1pt">Sent: '.date(DATE_RFC822)."</font>");
			if(!$write) {
				die("Something went wrong! Sorry!");
			}
			if($_POST['message'] == "/motd") {
				file_put_contents($file, $fileread . "</br>\n" . $motd);
			}
			if($_POST['message'] == "/clear" && $_SESSION['username'] == "crazyman") {
				file_Put_contents($file, $motd);
			}
		}
	}
	if($_SESSION['usertype'] == "Developer") {
		$file = "chatdeveloper.txt";
		$fileread = file_get_contents($file);
		$motd = file_get_contents("motd.txt");
		echo '<iframe src="http://www.geekbook.comyr.com/chatdeveloper.php#bottom" width="99%"></iframe></br>';
		echo '<form method="post" action="">';
		echo '<input type="text" size="100" name="message" autocomplete="off" placeholder="Message" /></br>';
		echo '<input type="submit" value="Send">';
		echo '</form>';
		echo 'To see the message of the day, type "/motd".</br>';
		echo 'Please note that this chat box is Site-Wide.</br>';
		echo 'Anything posted in this chat box can be seen by all registered users.</br>';
		echo 'For your own safety, I recommend that you share no personal information in this chat box.';
		if(!empty($_POST['message'])) {
			$message = $_POST['message'];
			$write = file_put_contents($file, $fileread . "</br>\n" . $_SESSION['username'] . ": " .stripslashes($message). '   <font size="1pt">Sent: '.date(DATE_RFC822)."</font>");
			if(!$write) {
				die("Something went wrong! Sorry!");
			}
			if($_POST['message'] == "/motd") {
				file_put_contents($file, $fileread . "</br>\n" . $motd);
			}
			if($_POST['message'] == "/clear" && $_SESSION['username'] == "crazyman") {
				file_Put_contents($file, $motd);
			}
		}
	}
}
else {
	echo 'Sorry, you must be logged in to view this page.';
}
?>
<?php include 'footer.php' ?>