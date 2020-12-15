<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>GeekBook - Register</title>
<?php include 'header.php' ?>
It is suggested that you get either <a href="http://www.google.com/chrome">Google Chrome</a> or <a href="http://www.mozilla.com/firefox">Mozilla Firefox</a> to view this website.</br>
<form method="post" action="">
<input type="text" name="registernamefirst" autocomplete="off" placeholder="First Name" /></br>
<input type="text" name="registernamelast" autocomplete="off" placeholder="Last Name" /></br>
<input type="text" name="registername" autocomplete="off" placeholder="Username" /></br>
<input type="password" name="registerpassword" autocomplete="off" placeholder="Password" /></br>
<input type="email" name="registeremail" autocomplete="off" placeholder="Email" /></br>
<select name="usertype"><option value="User">User</option><option value="Gamer">Gamer</option><option value="Hacker">Hacker</option><option value="Developer">Developer</option></select></br>
Do you agree to the <a href="tos.php" target="_blank">Terms Of Service</a>? <input type="checkbox" name="terms" /></br>
<input type="submit" value="Register" name="register">
</form>
<strong><p>If you select Developer, people will be able to follow you. This means they can see your posts but they cannot message you.</p></strong>
<?php
if(!empty($_POST['registername']) and !empty($_POST['registerpassword']) and !empty($_POST['registeremail']) && !empty($_POST['registernamefirst']) && !empty($_POST['registernamelast']) && isset($_POST['terms']) && isset($_POST['register'])) {
	$mysql_host = "mysql6.000webhost.com";
	$mysql_database = "a3712987_users";
	$mysql_user = "a3712987_dmaci";
	$mysql_password = "sasuke123";
	$con = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	mysql_select_db($mysql_database, $con);
	$username = mysql_real_escape_string($_POST['registername']);
	$password = sha1($_POST['registerpassword']);
	$usertype = $_POST['usertype'];
	$email = mysql_real_escape_string($_POST['registeremail']);
	$result = mysql_query("SELECT * FROM Users WHERE Username = '$username'");
	$result2 = mysql_query("SELECT * FROM Users WHERE Email = '$email'");
	$check = mysql_fetch_assoc($result);
	$check2 = mysql_fetch_assoc($result2);
	if(!$check and !$check2) {
		$password = sha1($_POST['registerpassword']);
		$username = $_POST['registername'];
		$tablemake = mysql_query("CREATE TABLE ".$username." ( Username varchar(255) , Name varchar(255) , Confirmed varchar(255) , Received varchar(255) , Follow varchar(255))");
		if(!$tablemake) {
			die("Oh man, something went wrong! Please email this error code to the webmaster. Error Code: RP0MKTB");
		}
		$justforlulz = mysql_query("INSERT INTO ".$username." (Username, Name, Confirmed, Received) VALUES ('".$username."', '".$fullname."' , 'Yes', 'No')");
		if(!$justforlulz) {
			die("Well, something went wrong. Sorry. Try again in a little bit!".mysql_error());
		}
		$newuserdirect = mkdir("users/" . $username, 0777);
		if(!$newuserdirect) {
			die("Something went wrong! Sorry! Please email this error code to the webmaster. Error Code: RP1MKDIR");
		}
		$newimagedirect = mkdir("users/" . $username . "/images", 0777);
		if(!$newimagedirect) {
			die("Something went wrong! Sorry! Please email this error code to the webmaster. Error Code: RP2MKDIRIMG");
		}
		$newviddirect = mkdir("users/" . $username . "/videos", 0777);
		if(!$newviddirect) {
			die("Something went wrong! Sorry! Please email this to the webmaster. Error: RP4MKDIRVID");
		}
		$direct = "users/" . $username . "/";
		$personalpage = fopen($direct . "index.php", "w+");
		$bio = fopen($direct . "bio.txt", "w+");
		$entry = '$entry';
		$first = mysql_real_escape_string($_POST['registernamefirst']);
		$last = mysql_real_escape_string($_POST['registernamelast']);
		$fullname = $first . " " . $last;
		$forentry = "<a href='images/$entry'><img width='100' height='100' src='images/$entry'></a> - ";
		if($_POST['usertype'] != "Developer") {
			$newpage = '<?php $pageusername = "'.$username.'"; $pagefullname = "'.$fullname.'"; $pagefollow = "No"; ?> <?php include \'/home/a3712987/public_html/userstuff.php\'; ?>';
		}
		if($_POST['usertype'] == "Developer") {
			$newpage = '<?php $pageusername = "'.$username.'"; $pagefullname = "'.$fullname.'"; $pagefollow = "Yes"; ?> <?php include \'/home/a3712987/public_html/userstuff.php\'; ?>';
		}
		$makepage = fwrite($personalpage, $newpage);
		$sql = mysql_query("INSERT INTO Users (`Username`, `Password`, `Email`, `First Name`, `Last Name`, `Full Name`, `UserType`)
		VALUES ('$username', '$password', '$email', '$first', '$last', '$fullname', '$usertype')");
		if(!$sql) {
			die("Something went wrong! Sorry! Please email this error code to the webmaster. Error Code: RP0SQIN");
		}
		echo 'You have successfully registered. You can now log in.';
	}
	else {
		echo 'That username or email is already registered.';
	}
}
else {
	echo 'Please fill out all of the forms!</br>';
	if(!isset($_POST['tos']) and isset($_POST['register'])) {
		echo 'You must accept the Terms of Service before registering for GeekBook.';
	}
}
?>
<?php include 'footer.php' ?>
