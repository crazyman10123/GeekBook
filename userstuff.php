<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<?php if(!empty($pageusername) && !empty($pagefullname)) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - <?php echo $pagefullname; echo $notifNum; ?></title>
<?php include '/home/a3712987/public_html/header.php';
if($_SESSION['login'] == 1) {
$result = mysql_query("SELECT * FROM ".$_SESSION['username']." WHERE Username = '$pageusername' OR Follow = '$pageusername'"); 
$check = mysql_fetch_assoc($result); 
if($pageusername != $_SESSION['username'] and $_SESSION['login'] == 1 and !$check) { 
?> 
	<form method="post" action="">
	<input type="submit" value="Add Friend" name="add"></form>
	<?php if($pagefollow = "Yes") { ?>
	<form method="post" action="">
	<input type="submit" value="Follow" name="follow"></form>
	<?php } ?>
	<?php if(isset($_POST['add'])) { 
		$sql = mysql_query("INSERT INTO ".$_SESSION['username']."(Username, Name, Confirmed, Received) VALUES ('$pageusername', '$pagefullname', 'No', 'No')"); 
		if(!$sql) { 
			die("Oops! Something went wrong!"); 
		} 
		$othersql = mysql_query("INSERT INTO ".$pageusername."(Username, Name, Confirmed, Received) VALUES ('".$_SESSION['username']."', '".$_SESSION['fullname']."', 'No', 'Yes')");
		if(!$othersql) {
			die("Oops! Something went wrong!");
		}
		echo 'Friend Added!';
	}
	if(isset($_POST['follow'])) {
		$sql = mysql_query("INSERT INTO ".$_SESSION['username']."(Username, Name, Follow) VALUES ('$pageusername', '$pagefullname', 'Yes')");
		if(!$sql) {
			die("Oops! Something went wrong!");
		}
	}
	}
}
?>
<h2><?php echo $pagefullname; ?></h2></br>
<img src="profile.jpg" width="200" height="200"></br>
<h3>Biography</h3>
<p><?php echo file_get_contents('bio.txt'); ?></p>
<?php
echo '<p>';
if($_SESSION['login'] == 1 and $_SESSION['username'] == $pageusername) {
	if ($handle = opendir("images/")) {
		echo "<h1>Uploaded pictures:</h1></br>";	
		while (false !== ($entry = readdir($handle))) {
			if($entry != ".." and $entry != "." and $entry != "cursor.png" and $entry != "cursor.gif") {
				echo "<a href='images/$entry' target='_blank' title='Click to see Full Image.(Opens in new tab)'><img width='100' height='100' src='images/$entry'></a> - ";
			}
		}
		closedir($handle);
	}
}
if($_SESSION['login'] == 1 and $_SESSION['username'] != $pageusername) {
	$checkif = mysql_query("SELECT * FROM $pageusername WHERE Username = '".$_SESSION['username']."' AND Confirmed = 'Yes'");
	$checkifArray = mysql_fetch_array($checkif);
	$row = $checkifArray;
	if($row['Username'] == $_SESSION['username']) {
		if ($handle = opendir("images/")) {
			echo "<h2>Uploaded pictures:</h2></br>";	
			while (false !== ($entry = readdir($handle))) {
				if($entry != ".." and $entry != "." and $entry != "cursor.png" and $entry != "cursor.gif") {
					echo "<a href='images/$entry'><img width='100' height='100' src='images/$entry'></a> - ";
				}
			}
		closedir($handle);
		}
	}
}
echo '</p>';
echo '<h2>Statuses</h2>';
$getStat = "SELECT * FROM statuses WHERE Username = '$pageusername' ORDER BY id DESC";
$getStat2 = mysql_query($getStat);
$num = mysql_num_rows($getStat2);
$i = 0;
while($i < $num and $i < 25) {
        $statuses = mysql_fetch_array($getStat2);
        echo '<table border="1"><tr><th><a href="'.$urlbase.'users/'.$statuses['Username'].'/"><img src="'.$urlbase.'users/'.$statuses['Username'].'/profile.jpg" width="50" height="50"></img>'.$statuses['Name'].'</a></th></tr><tr><td>'.stripslashes($statuses['Status']).'</td></tr><tr><td><font size="1pt"><center>'.$statuses['Date']."</center></font></td></tr></table></br></br>";
        $i++;
}
?>
<?php include '/home/a3712987/public_html/footer.php'?>
<?php }
else {
	echo 'You don\'t have access to this page! Sorry!';
}
?>	