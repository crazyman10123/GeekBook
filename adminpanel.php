<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Admin Panel<?php echo $notifNum; ?></title>
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] == 1 and $_SESSION['username'] == "crazyman") {
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
	if(file_exists("news.txt")) {
		$filenews = "news.txt";
		$filereadnews = file_get_contents($filenews);
		echo '<form method="post" action="">';
		echo '<textarea name="news" rows="10" cols="100" placeholder="Update News"></textarea></br>';
		echo '<input type="submit" value="Save Changes">';
		echo '</form>';
		echo 'Delete News:</br>';
		echo '<form method="post" action="">';
		echo '<textarea name="deletenews" rows="10" cols="100">' . $filereadnews . '</textarea></br>';
		echo '<input type="submit" value="Save Changes" name="deletenewssave">';
		echo '</form>';
		echo 'Current news:</br>' . $filereadnews . '</br>';
		if(!empty($_POST['news'])) {
			$write = file_put_contents($filenews, "<p>" . stripslashes($_POST['news']) . "</br>\n<font size='2pt'>Posted on " . date(DATE_RFC822) . "</font></p></br>\n" . $filereadnews);
			if(!$write) {
				die("Something went wrong! Try again later.");
				}
			echo 'Changes saved!';
		}
		if(isset($_POST['deletenewssave']) and !empty($_POST['deletenews'])) {
			$write = file_put_contents($filenews, stripslashes($_POST['deletenews']));
			if(!$write) {
				die("Something went wrong! OH SHIT. RUN.");
			}
		}
	}
	$motd = file_get_contents("motd.txt");
	echo '<form method="post" action="">';
	echo '<textarea name="motd" cols="100" rows="10">'.$motd.'</textarea></br>';
	echo '<input type="submit" action="" value="Save MotD" name="setmotd">';
	echo '</form>';
	if(isset($_POST['setmotd'])) {
		file_put_contents("motd.txt", $_POST['motd']);
	}
	echo '<form method="post" action="">';
	echo 'Name of who you\'re deleting: <input type="text" name="queryname"></br>';
	echo '<input type="submit" value="Submit Query"></br>';
	echo '</form>';
	$sql = mysql_query("SELECT Username FROM Users");
	$result = $sql;
	echo "<table border='1'><tr>";
	echo "<td>Username</td></tr><tr>";
	$i=0;
	while($row = mysql_fetch_array($result)) {
		echo '<td>'.$row['Username'].'</td>';
		$i++;
		if($i >= 10) {
			echo "</tr><tr>";
			$i = 0;
		}
	}
	echo "</table>";
	if(!empty($_POST['queryname'])) {
		$userquery = "DELETE FROM Users WHERE Username = '$_POST[queryname]'";
		$senduserquery = mysql_query($userquery);
		if(!$senduserquery) {
			die("There seems to be a problem! Error: " . mysql_error());
		}
		$usertabledel = "DROP TABLE ".$_POST['queryname'];
		$deltable = mysql_query($usertabledel);
		if(!$deltable) {
			die("Er, Problem! ".mysql_error());
		}
		rrmdir("users/".$_POST['queryname']);
		echo 'User deleted.';
	}
}
else {
	echo 'No access to this page! Sorry!';
}
?>
<?php include 'footer.php' ?>