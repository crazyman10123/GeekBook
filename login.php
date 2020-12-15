<?php
$mysql_host = "mysql6.000webhost.com";
$mysql_database = "a3712987_users";
$mysql_user = "a3712987_dmaci";
$mysql_password = "sasuke123";
$con = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if(!$con) {
	die("Sorry, the database seems to be having a problem. Try again later!");
}
$selectdb = mysql_select_db($mysql_database, $con);
if(!$selectdb) {
	die("Sorry, the database seems to be having a problem. Try again later!");
}
?>
<?php
session_start();
if(!empty($_POST['email']) and !empty($_POST['password'])) {
	$email = mysql_real_escape_string($_POST['email']);
	$password = sha1($_POST['password']);
	$result = mysql_query("SELECT * FROM Users WHERE Email = '$email'");
	$check = mysql_fetch_assoc($result);
	if($email == $check['Email'] and $password == $check['Password']) {
		$_SESSION['username'] = $check['Username'];
		$_SESSION['fullname'] = $check['First Name'] . " " . $check['Last Name'];
		$_SESSION['login'] = 1;
		$_SESSION['usertype'] = $check['UserType'];
		if(isset($_POST['stayloggedin'])) {
			$expire = time() + (20 * 365 * 24 * 60 * 60);
			setcookie("geekbookuser", $_SESSION['username'], $expire);
			setcookie("geekbookname", $_SESSION['fullname'], $expire);
			setcookie("usertype", $_SESSION['usertype'], $expire);
		}
	}
	else {
		session_destroy();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>GeekBook - Login</title>
<meta http-equiv="refresh" content="5; url=http://www.geekbook.comyr.com/" />
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] == 1) {
	echo 'Login successful! You will be redirected to the home page in 5 seconds.';
}
else {
	echo 'Sorry, wrong username/password. Please try again.';
}
?>
<?php include 'footer.php' ?>