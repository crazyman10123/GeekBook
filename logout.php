<?php
$expire = time()-3600;
setcookie("geekbookuser", "", $expire);
setcookie("geekbookname", "", $expire);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>GeekBook - Log Out</title>
<meta http-equiv="refresh" content="5; url=http://www.geekbook.comyr.com/" />
<?php include 'header.php' ?>
<?php
session_unset();
session_destroy();
echo 'You have successfully logged out. You will be redirected to the home page in 5 seconds.';
?>
<?php include 'footer.php' ?>