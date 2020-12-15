<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta name="description" content="GeekBook - The Social Network For Gamers, Hackers, and Developers." />
<link rel="stylesheet" type="text/css" href="http://www.geekbook.comyr.com/css/style.css" />
<link rel="stylesheet" type="text/css" href="http://www.geekbook.comyr.com/css/blue.css" />
<link rel="shortcut icon" href="http://geekbook.comyr.com/favicon.ico" />
<!--   ________                 __    __________                  __     -->
<!--  /  _____/   ____   ____  |  | __\______   \  ____    ____  |  | __ -->
<!-- /   \  ___ _/ __ \_/ __ \ |  |/ / |    |  _/ /  _ \  /  _ \ |  |/ / -->
<!-- \    \_\  \\  ___/\  ___/ |    <  |    |   \(  <_> )(  <_> )|    <  -->
<!--  \______  / \___  >\___  >|__|_ \ |______  / \____/  \____/ |__|_ \ -->
<!--         \/      \/     \/      \/        \/                      \/ -->
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
$urlbase = "http://www.geekbook.comyr.com/";
?>
</head>

<body>
<!-- 
I'm guessing you're an extension developer? That or you're just curious. Either way,
I'm making a page specially for extension developers in case anyone wants to make
an extension for GeekBook. Also, if you have any questions, feel free to email me at
dmaciel@davidmaciel.tk and I'll answer it for you. Enjoy!
-->
<div id="outline">
	
<div id="wrapper">
	
<!-- START HEADER -->

<div id="header">

<?php
if($_SESSION['login'] == 1 and !empty($_SESSION['username'])) {
	if(file_exists("/home/a3712987/public_html/users/".$_SESSION['username']."/profile.jpg")) {
		$picture = '<img src="'.$urlbase.'users/'.$_SESSION['username'].'/profile.jpg" width="30" height="30" />';
	}
	echo '<div id="headerBoxBG"><div id="headerBox">';
	echo '<a href="'.$urlbase.'users/' . $_SESSION['username'] . '">'.$picture . $_SESSION['fullname'] . '</br>';
	echo '<a href="http://www.geekbook.comyr.com/logout.php">Log out.</a>';
?>
	<ul><li>Navigation<?php echo $notifNum; ?><ul>
	<li><a href="<?php echo $urlbase; ?>">Home</a></li>
	<li><a href="<?php echo $urlbase; ?>search.php">Search</a></li>
	<li><a href="<?php echo $urlbase; ?>chat.php">Chat</a></li>
	<li><a href="<?php echo $urlbase; ?>options.php">Options</a></li>
	<li><a href="<?php echo $urlbase; ?>messages/">Inbox<?php echo $messageNumberEcho; ?></a>
	<?php 
	if($messageNumber != 0) {
		echo '<ul>';
		$i = 0;
		while($i < $messageNumber) {
			$row = mysql_fetch_array($messages);
			echo '<li><a href="'.$urlbase.'messages/'.$row['Link'].'">'.$row['Sender'].': '.$row['Message'].'</a></li>';
			$i++;
		}
		echo '</ul>';
	}
	?></li>
	<li><a href="<?php echo $urlbase; ?>users">Friends<?php echo $friendRequestEcho; ?></a></li>
	<li><a href="<?php echo $urlbase; ?>news.php">News</a></li>
	<?php if($_SESSION['login'] == 1 and $_SESSION['username'] == "crazyman") { ?><li><a href="<?php echo $urlbase; ?>adminpanel.php">Admin Panel</a></li><?php } ?>
	</ul></li></ul></div></div>
<?php
	if($_SESSION['usertype'] == "Developer") {
		$gisthub = '<div>Developers can use <a href="https://gist.github.com/" target="_blank">GitHub\'s Gist</a> to share code snippets. It is suggested you set up a repo to share full code.</br></div>';
	}
}
?>
<h1><a href="<?php echo $urlbase; ?>">GeekBook</a></h1></div>
<?php if($_SESSION['login'] != 1) { ?>
<div id="navTop">
<ul>
<li><a href="<?php echo $urlbase; ?>">Home</a></li>
<li><a href="<?php echo $urlbase; ?>news.php">News</a></li>
<li><a href="<?php echo $urlbase; ?>register.php">Register</a></li>
</ul>
</div>
<?php } ?>
<div id="mainColumn-layout4">
<?php
if($_SESSION['login'] == 1) {
	echo $gisthub;
}
?>
