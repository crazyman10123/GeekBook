<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Search<?php echo $notifNum; ?></title>
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] == 1) {
	if(!empty($_POST['search'])) {
		$sql = mysql_query("SELECT * FROM Users WHERE `First Name` = '".$_POST['search']."' OR `Last Name` = '".$_POST['search']."' OR `Full Name` = '".$_POST['search']."' OR `Username` = '".$_POST['search']."'");
		if(!$sql) {
			die("Something went wrong! Send this code to the webmaster. Error: S1QUSNM");
		}
		else {
			$num = mysql_num_rows($sql);
			$i = 0;
			while($i < $num) {
				$found = mysql_fetch_array($sql);
				if(!$found) {
					echo 'User not found, sorry.';
				}
				else {
					echo '<a href="/users/'.$found['Username'].'/"><img width="50" height="50" src="/users/'.$found['Username'].'/profile.jpg">  '.$found['First Name'].' '.$found['Last Name'].' ('.$found['Username'].')</a></br>';
				}
				$i++;
			}
		}
	}
	echo '<form method="post" action="">';
	echo '<input type="text" name="search" placeholder="Search for people by name or username" size="30"></br>';
	echo '<input type="submit" value="Search">';
	echo '</form>';
}
else {
	echo 'You need to be logged in, silly goose.';
}
?>
<?php include 'footer.php' ?>