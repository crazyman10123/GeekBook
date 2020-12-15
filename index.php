<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook<?php echo $notifNum; ?></title>
<script type="text/javascript">
var ids=new Array('a1','a2');

function switchid(id){	
	hideallids();
	showdiv(id);
}

function hideallids(){
	for (var i=0;i<ids.length;i++){
		hidediv(ids[i]);
	}		  
}

function hidediv(id) {
	if (document.getElementById) {
		document.getElementById(id).style.display = 'none';
	}
	else {
		if (document.layers) {
			document.id.display = 'none';
		}
		else {
			document.all.id.style.display = 'none';
		}
	}
}

function showdiv(id) {
	if (document.getElementById) {
		document.getElementById(id).style.display = 'block';
	}
	else {
		if (document.layers) {
			document.id.display = 'block';
		}
		else {
			document.all.id.style.display = 'block';
		}
	}
}
</script>
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] != 1) {
?>
<h2>Welcome to GeekBook.</h2>
<form method="post" action="<?php echo $urlbase ?>login.php">
<input type="email" name="email" autocomplete="off" placeholder="Email" /><br />
<input type="password" name="password" autocomplete="off" placeholder="Password" /><br />
Stay logged in? <input type="checkbox" name="stayloggedin"> <input type="submit" value="Log in">
</form>
Need to <a href="register.php">register?</a>
<?php
}
date_default_timezone_set('UDT');
if($_SESSION['login'] == 1) {
?>
<div id='a1' style="display:block;">
	<form method="post" action="">
	<textarea name="status" rows="5" cols="100" maxlength="500" lengthcut="true" placeholder="What's going on with you?"></textarea>
	</br>
	<input type="submit" value="Update Status" name="update"><input type="button" onclick="javascript:switchid('a2');" value="Upload A Picture" />
	</form>
</div>
<div id='a2' style="display:none;">
	<form name="newad" method="post" enctype="multipart/form-data" action="">
	<input type="file" name="image"></br>
	<textarea name="caption" rows="5" cols="100" maxlength="500" lengthcut="true" placeholder="Enter A Caption"></textarea>
	<input name="Submit" type="submit" value="Upload image">
	<input type="button" onclick="javascript:switchid('a1');" value="Post A Status" />
	</form>
</div>
<?php
	//define a maxim size for the uploaded images in Kb
	define ("MAX_SIZE","10000"); 

	//This function reads the extension of the file. It is used to determine if the
	// file  is an image by checking the extension.
	function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}

	//This variable is used as a flag. The value is initialized with 0 (meaning no 
	// error  found)  
	//and it will be changed to 1 if an errro occures.  
	//If the error occures the file will not be uploaded.
	$errors=0;
	//checks if the form has been submitted
	if(isset($_POST['Submit'])) 
	{
		//reads the name of the file the user submitted for uploading
		$image=$_FILES['image']['name'];
		//if it is not empty
		if ($image) 
		{
		//get the original name of the file from the clients machine
			$filename = stripslashes($_FILES['image']['name']);
		//get the extension of the file in a lower case format
			$extension = getExtension($filename);
			$extension = strtolower($extension);
		//if it is not a known extension, we will suppose it is an error and 
			// will not  upload the file,  
		//otherwise we will do more tests
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=
 "png") && ($extension != "gif")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name=time().'.'.$extension;
//the new name will be containing the full path where will be stored (images 
//folder)
$username = $_SESSION['username'];
$newname="users/".$username."/images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && $errors == 0) 
 {
	$newpic = '<a href="'. $urlbase . $newname . '" target="_blank"><center><img src="' . $urlbase . $newname . '" width="200" height="200" title="Click to see full image.(Opens in new tab.)"></center></a>';
	if(!empty($_POST['caption'])) {
		$caption = "<p>".mysql_real_escape_string(strip_tags($_POST['caption']))."</p>";
	}
	$sqlquerystuff = mysql_query("INSERT INTO statuses(Username, Status, Date, Name) VALUES ('".$_SESSION['username']."', '".$newpic.$caption."', '".date(DATE_RFC822)."', '".$_SESSION['fullname']."')");
	if(!$sqlquerystuff) {
		die('Oops! Something went wrong! Sorry!');
	}
	echo 'Picture uploaded!';
 }
	if(!empty($_POST['status']) && isset($_POST['update'])) {
		$status = $_POST['status'];
		$stripped = mysql_real_escape_string(strip_tags($status, '<p><a><object><param><h><embed><iframe>'));
		$sql = mysql_query("INSERT INTO statuses(Username, Status, Date, Name) VALUES ('".$_SESSION['username']."', '".$stripped."', '".date(DATE_RFC822)."', '".$_SESSION['fullname']."')");
		if(!$sql) {
			die("Something went wrong! Sorry!");
		}
		echo 'Status updated!!';
		}
	echo '</br>';
	echo '</br><center>';
	$statusread = mysql_query("SELECT * FROM statuses ORDER BY id DESC");
	$num = mysql_num_rows($statusread);
	$i = 0;
	while($i < $num and $i < 25) {
		$statuses = mysql_fetch_array($statusread);
		$getfriends = mysql_query("SELECT * FROM ".$_SESSION['username']." WHERE Confirmed = 'Yes' OR Follow = 'Yes'");
		if($getfriends) {
			$friendnum = mysql_num_rows($getfriends);
		}
		$friendi = 0;
		while($friendi < $friendnum) {
			$friends = mysql_fetch_array($getfriends);
			if($friends['Username'] == $statuses['Username']) {
				echo '<table border="1"><tr><th><a href="'.$urlbase.'users/'.$statuses['Username'].'/"><img src="'.$urlbase.'users/'.$statuses['Username'].'/profile.jpg" width="50" height="50"></img>'.$statuses['Name'].'</a></th></tr><tr><td>'.stripslashes($statuses['Status']).'</td></tr><tr><td><font size="1pt"><center>'.$statuses['Date']."</center></font></td></tr></table></br></br>";
			}
		$friendi++;
		}
	$i++;
	}
	echo '</center>';
}
?>
<script type="text/javascript" src="charcount.js"></script>
<?php include 'footer.php'?>
