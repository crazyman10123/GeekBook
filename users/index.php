<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Friends<?php echo $notifNum; ?></title>
<?php include '/home/a3712987/public_html/header.php' ?>
<?php
if ($_SESSION['login'] == 1) {
	$i = 0;
	if($friendRequestNum > 0) {
		echo '<form method="post" action="">';
		echo 'Who do you want to accept? (Username)<input type="text" name="acceptthisguy" autocomplete="off"></br>';
		echo '<input type="submit" value="Accept"></br>';
		echo '</form>';
	}
	while($i < $friendRequestNum) {
		$friendRequestArray = mysql_fetch_array($friendRequest);
		echo '<a href="'.$urlbase.'users/'.$friendRequestArray['Username'].'">'.$friendRequestArray['Name'].'('.$friendRequestArray['Username'].')</a></br>';
		$i++;
	}
	echo '<form method="post" action="">';
	echo 'Who do you want to delete? (Username)<input type="text" name="deletethisguy" autocomplete="off"></br>';
	echo '<input type="submit" value="Delete"></br>';
	echo '</form>';
	$mysql_host = "mysql6.000webhost.com";
	$mysql_database = "a3712987_users";
	$mysql_user = "a3712987_dmaci";
	$mysql_password = "sasuke123";
	$username = $_SESSION['username'];
	$con = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	mysql_select_db($mysql_database, $con);
	$query = mysql_query("SELECT * FROM " . $username . " WHERE Confirmed = 'Yes' ORDER BY Name asc");
	if(!$query) {
		echo 'Sorry, your friends list is empty.'.mysql_error();
	}
	else {
		while($row = mysql_fetch_array($query)){
			if($row['Username'] != $_SESSION['username']) {
				echo "<a href='http://www.geekbook.comyr.com/users/".$row['Username']."'>".$row['Name']." (".$row['Username'].")</a>";
				echo "<br />";
			}
		}
	}
	if(!empty($_POST['deletethisguy'])) {
		$sql = mysql_query("DELETE FROM ".$_SESSION['username']." WHERE Username = '".$_POST['deletethisguy']."'");
		if(!$sql) {
			die("Something went wrong! Sorry!");
		}
		echo 'Friend removed.';
	}
	if(!empty($_POST['acceptthisguy'])) {
		$sql = mysql_query("UPDATE ".$_SESSION['username']." SET Confirmed = 'Yes' WHERE Username = '".$_POST['acceptthisguy']."'");
		if(!$sql) {
			die("Something went wrong! Sorry!".mysql_error());
		}
		$othersql = mysql_query("UPDATE ".$_POST['acceptthisguy']." SET Confirmed = 'Yes' WHERE Username = '".$_SESSION['username']."'");
		if(!$othersql) {
			die("Something went wrong! Sorry!".mysql_error());
		}
		echo 'Friend accepted.';
	}
}
else {
	echo 'You aren\'t logged in, silly goose.';
}
?>
<?php include '/home/a3712987/public_html/footer.php' ?>