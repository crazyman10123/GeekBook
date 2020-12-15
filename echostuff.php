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
if($_SESSION['login'] == 1) {
	$friendRequest = mysql_query("SELECT * FROM ".$_SESSION['username']." WHERE Confirmed = 'No' AND Received = 'Yes'");
	if($friendRequest) {
		$friendRequestNum = mysql_num_rows($friendRequest);
	}
	if($friendRequestNum) {
		$friendRequestEcho = "(".$friendRequestNum.")";
	}
	if(!$friendRequestNum) {
		$friendRequestEcho = "";
	}
	$messages = mysql_query("SELECT * FROM messages WHERE Recipient='".$_SESSION['fullname']."'");
	$messageNumber = mysql_numrows($messages);
	if($messageNumber) {
		$messageNumberEcho = "(".$messageNumber.")";
	}
	if(!$messageNumber) {
		$messageNumberEcho = "";
	}
	if($messageNumber > 0 or $friendRequestNum > 0) {
		$addedNum = $messageNumber + $friendRequestNum;
		$notifNum = "(".$addedNum.")";
	}
}
?>