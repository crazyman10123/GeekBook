<?php
session_start();
if(empty($_SESSION['username']) && empty($_SESSION['fullname']) && ($_SESSION['login'] != 1)) {
	if(isset($_COOKIE['geekbookuser'])) {
		$_SESSION['username'] = $_COOKIE['geekbookuser'];
		$_SESSION['login'] = 1;
		$_SESSION['fullname'] = $_COOKIE['geekbookname'];
		$_SESSION['usertype'] = $_COOKIE['usertype'];
		echo '<html><head><meta http-equiv="refresh" content="1" />';
	}
}
?>