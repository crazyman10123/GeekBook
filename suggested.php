<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook<?php echo $notifNum; ?></title>
<?php include 'header.php' ?>
<?php if($_SESSION['login'] != 1) {
	echo '<strong>Sorry, you need to <a href="index.php">log in</a> to see this page.</strong>';
}
if($_SESSION['login'] == 1) {
	$usertype = $_SESSION['usertype'];
	echo 'Showing '.$usertype.' suggestions.</br>';
	$getSug = mysql_query("SELECT * FROM Users WHERE UserType = '$usertype' ORDER BY Username asc");
	while($sug = mysql_fetch_array($getSug)) {
		if($sug['Username'] != $_SESSION['username'] && $sug['Username'] != $row['Username']) {
			echo '<a href="/users/'.$sug['Username'].'"><img src="/users/'.$sug['Username'].'/profile.jpg" width="50" height="50" />'.$sug['Full Name'].'('.$sug['Username'].')</a></br>';
		}
	}
}
?>
<?php include 'footer.php' ?>