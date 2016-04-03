<?php

namespace dark_horse\hw3\models;

//CONNECT TO DATABASE

$host = "localhost"; //$host = ini_get("mysql.localhost"); 
$user = "root";  //$user = ini_get("mysql.root");  
$pass = "yes";  //$pass = ini_get("mysql.yes"); 
$db = "userDB"; // $db = "userDB";

$conn = mysqli_connect($host, $user, $pass, $db) or die ("Connection Failed!");
if($db != "" and mysql_select_db($db))
	die("The database is not available!");
	
if(!isset($_POST['accept']));

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Form</title>
	<meta http-equip = "Content-Type" content = "text/html; charset = iso-8859-1"/>
<head>

<body>
	<h1><center>Sign Up Form<center></h1>

	<p><center><font color = "red" size = "+1"><tt><b>*</b></tt></font>indicates a required field<center></p>

	<form method = "post" action = "<?=$_SERVER['PHP_SELF']?>">

		<table border = "0" cellpadding = "0" cellspacing = "5">
		<tr>
			<td align = "right">
			 	<p>User ID</p>
			</td>
			<td>
				<input name = "newid" type = "type" maxlength = "100" size = "25" />

				<font color = "red" size = "+1"><tt><b>*</b></tt></font>
			</td>
		</tr>

		<tr>
			<td align = "right">
				<p>Name</p>
			</td>
			<td>
				<input name = "newname" type = "text" maxlength = "100" size = "25" />

				<font color = "red" size = "+1"><tt><b>*</b></tt></font>
			</td>
		</tr>

		<tr>
			<td align = "right" colspan = "2">
				<hr noshade = "noshade" />
				<input type = "reset" value = "Reset Form" />
				<input type = "submit" name "accept" value = "OK" />
			</td>
		</tr>
		</table>
	</form>
</body>
</html>

<?php

//PROCESS SIGN-UP SUBMISSION

if(isset($_POST['accept']));
{
	if(isset($_POST['newid']) and $_POST['newid'] == '' or isset($_POST['newname']) and $_POST['newname'] == '')
	{
		echo "Must fill in all required fields.";
	}

	else if(isset($_POST['newid']))
	{	
		$sql = "SELECT COUNT(*) FROM user WHERE id = '$_POST[newid]'";
		$result = mysqli_query($conn, $sql);
	
		if (!$result) 
		{	
			echo "A database error occurred in processing your.";	
		}
	/*
		if(@mysql_result($result,0,0)>0)
		{
				echo "A user already exists with your chosen userid.\n" .
				"Please try another.";	
		}	
		*/
	}


	if(isset($_POST['newid']) and isset($_POST['newname']))
	{
		$id = 	$_POST['newid'];
		$name = $_POST['newname'];
		mysqli_query($conn, "insert into user ('$id', '$name')");
	
	}
	}
?>
