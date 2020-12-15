<?php include '/home/a3712987/public_html/cookiestuff.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<?php include '/home/a3712987/public_html/echostuff.php' ?>
<title>GeekBook - Options<?php echo $notifNum; ?></title>
<?php include 'header.php' ?>
<?php
if($_SESSION['login'] == 1) {
	session_start();
	if(file_exists("users/" . $_SESSION['username'] . "/bio.txt")) {
		$file = "users/" . $_SESSION['username'] . "/bio.txt";
		if(!empty($_POST['bio'])) {
			$write = file_put_contents($file,stripslashes($_POST['bio']));
			if(!$write) {
				die("Something went wrong! Try again later.");
			}
			echo 'Changes saved!';
		}
		$fileread = file_get_contents($file);
		echo '<form method="post" action="">';
		echo '<textarea rows="10" cols="100" name="bio">' . $fileread . '</textarea></br>';
		echo '<input type="submit" value="Save Changes">';
		echo '</form>';
		echo 'Current bio:</br>' . $fileread . '</br>';
	}
 define ("MAX_SIZE","1000"); 

 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 $errors=0;

 if(isset($_POST['Submitprofile'])) 
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
$image_name='profile.jpg';
//the new name will be containing the full path where will be stored (images 
//folder)
$username = $_SESSION['username'];
$newname="users/".$username."/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}

//If no errors registred, print the success message
 if(isset($_POST['Submitprofile']) && $errors == 0) 
 {
 	echo "<h1>File Uploaded Successfully!</h1>";
	echo '<img src="' . $newname . '">';
 }
if($_SESSION['login'] == 1) {
echo '<form name="newad" method="post" enctype="multipart/form-data" action="">';
echo '<table>';
echo '<tr><td>Select a profile picture: <input type="file" name="image"></td></tr>';
echo '<tr><td><input name="Submitprofile" type="submit" value="Upload image">';
echo '</td></tr>';
echo '</table>';
echo '</form>';
}
}
else {
	echo 'You must be logged in to view this page.';
}
?>
<?php include 'footer.php' ?>