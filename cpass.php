<?php
session_start();
if(isset($_POST["s1"]))
{
	define("hname","localhost:3307");
    define("uname","root");
    define("password","");
    define("dbname","vishal");
	
	$oldpass=$_POST["oldpass"];
	$newpass=$_POST["newpass"];
	$cnewpass=$_POST["cnewpass"];
	if($newpass==$cnewpass)
	{
		$email=$_SESSION["email"];
	
$connection= mysqli_connect(hname,uname,password,dbname) or die("Error in connection" . mysqli_connect_error());

$q= "update signup set password='$newpass' where email='$email' and password='$oldpass' ";

		$res=mysqli_query($connection,$q) or die ("Error in query". mysqli_error($connection));
		
		$count= mysqli_affected_rows($connection);//1 or 0
		mysqli_close($connection);
		
		if($count==1)
		{
			$x=mysqli_fetch_array($res);
			$_SESSiON["name"]=$x[0];			
			$msg="Password changed successfully";
			header("location:login.php");
			session_destroy();
		}
		else
		{
			$msg= "Incorrect Current password";
		}
	}
		else
		{
			$msg= "New password mismatch";
		}
}
?>
<html>
<head>
<title>Login page</title>
</head>
<body>
<h1>Welcome <?php echo $_SESSION["n"];?></h1>
<form name="form1" method="post" enctype="multipart/form-data" >
<input type="password" name="oldpass" value="" placeholder="Old password"><br><br>
<input type="password" name="newpass" value="" placeholder="New Password"><br><br>
<input type="password" name="cnewpass" value="" placeholder="Confirm New Password"><br><br>
<input type="submit" name="s1" Value="submit"><br>
<?php
	if(isset($msg))
	{
		print $msg;
	}	
?>
</form>
</body>
</html>