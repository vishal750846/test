<?php
session_start();
$a=$_GET["email"];
define("hname","localhost:3307");
define("uname","root");
define("password","");
define("dbname","vishal");
$connection = mysqli_connect(hname,uname,password,dbname) or die("Error in connection " . mysqli_connect_error());
$q="select * from signup where email='$a'";
$res=mysqli_query($connection,$q) or die("Error in query " . mysqli_error($connection));
	$profile=mysqli_fetch_array($res);
    
if(isset($_POST["s1"]))
{
	$catname=$_POST["catname"];
	$err = $_FILES["catpic"]["error"];
	
	if($err==0)
	{
		$date = date_create();
		$tstamp = date_timestamp_get($date);
		$picname=$tstamp.$_FILES["catpic"]["name"];
		$tname = $_FILES["catpic"]["tmp_name"];
		move_uploaded_file($tname,"uploads/$picname");
	}
	else
	{
		$picname="nopic.jpg";
	}
	
	require_once("vars.php");
	$connection = mysqli_connect(hname,uname,password,dbname) or die("Error in connection " . mysqli_connect_error());
	$q="update addcat set catname='$catname',catpic='$picname' where catid='$a'";
	mysqli_query($connection,$q) or die("Error in query " . mysqli_error($connection));
	$count = mysqli_affected_rows($connection);//1 or 0
	mysqli_close($connection);
	if($count==1)
	{
		header("location:viewcat.php");
	}
	else
	{
		$msg="Category not updated successfully";
	}
}
?>
<html>
<head>
<title>Signup page</title>
</head>
<body>
<h1>Signup form</h1>
<form name="form1" method="post" enctype="multipart/form-data" >
<input type="text" name="fname" value="<?php echo $profile[0]; ?>" placeholder="Firstname">
<input type="text" name="lname" value="" placeholder="Lastname"><br><br>
<input type="number" name="age" value="" placeholder="Age">
<input type="text" name="phone" value="" placeholder="Mobile No."><br><br>
<input type="email" name="email" value="" placeholder="Email">
<input type="password" name="pass" value="" placeholder="Password"><br><br>
<input type="file" name="imgname"><br><br>
<input type="radio" name="gen" value="male">Male
<input type="radio" name="gen" value="male">Female
<input type="radio" name="gen" value="male">Others<br><br>
<input type="checkbox" name="hob[]" value="cricket">Cricket
<input type="checkbox" name="hob[]" value="soccer">Soccer
<input type="checkbox" name="hob[]" value="Dancing">Dancing
<input type="checkbox" name="hob[]" value="reading">reading<br><br>
<input type="text" name="state" value="" placeholder="State">
<input type="text" name="country" value="" placeholder="Country"><br><br>
<input type="submit" name="s1" Value="submit">
</form>
</body>
</html>