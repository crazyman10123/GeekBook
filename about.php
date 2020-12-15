<?php include 'cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook<?php echo $notifNumber; ?></title>
<?php include 'header.php' ?>
</br>
<h2>ABOUT</h2>
<p>GeekBook is a project that was brought about completely unexpectedly. It all started
when I made a website to test PHP and HTML5 on. The PHP test was actually only picture uploading.
I decided to try to make a site that would allow people to make accounts and host pictures on the site,
but then I took it to the next level and it became a social network. I have put a lot of work into this 
site and I hope you enjoy using it. I give you all my greetings and a great big welcome to GeekBook.</p>
<strong><h3>Contact Me</h3></strong>
<strong>Please explain your problem in as much detail as possible.</strong>
<form method="post" action="">
Your Name: <input type="text" name="sender"></br>
Subject: <input type="text" name="subject"></br>
<textarea name="sendmail" cols="70" rows="5"></textarea></br>
<input type="submit" value="Send" name="confirmsend">
</form>
<?php
if(isset($_POST['confirmsend']) && !empty($_POST['sendmail']) && !empty($_POST['sendmail'])) {
	$sender = $_POST['sender'];
	$subject = $_POST['subject'];
	if($_SESSION['login'] == 1) {
		$username = "Username: ".$_SESSION['username'];
	}
	$stripped = stripslashes($_POST['sendmail']);
	$wrapped = wordwrap($stripped, 70, "\n");
	$message = "From: ".$sender."\n".$username."\n"."Message: ".$wrapped;
	$sendto = "dmaciel@geekbook.comyr.com";
	$send = mail($sendto, $subject, $message);
	if(!$send) {
		echo "Oh no! Something went wrong!</br></br>";
	}
	else {
		echo "Sent.</br></br>";
	}
}
?>
David Maciel Jr. (or GeekBook, Inc.)</br>
120 Deerfield Ave.</br>
Waterbury, CT. 06708-1328</br>
<strong>ONLY SEND MAIL FOR BUSINESS INQUIRIES. OTHER THAN THAT, PLEASE SEND AN EMAIL.</strong>
<?php include 'footer.php' ?>