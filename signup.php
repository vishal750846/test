<html>
<head>
<title>Signup page</title>
</head>
<body>
<h1>Signup form</h1>
<form name="form1" method="post" enctype="multipart/form-data" >
<input type="text" name="fname" value="" placeholder="Firstname">
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
<?php
	if(isset($_POST["s1"]))
{
            $fn=$_POST["fname"];
            $ln=$_POST["lname"];
            $age=$_POST["age"];
            $ph=$_POST["phone"];
            $email=$_POST["email"];
            $pass=$_POST["pass"];
            $img=$_FILES["imgname"]["error"];
            $gen=$_POST["gen"];
            $hob=$_POST["hob"];
            $hobbies=implode($hob);
            $state=$_POST["state"];
            $country=$_POST["country"];
if($img==0)
	{
		$date = date_create();
		$tstamp=date_timestamp_get($date);
		$tname=$_FILES["imgname"]["tmp_name"];
		$f=$tstamp.$_FILES["imgname"]["name"];
		move_uploaded_file($tname,"uploads/$f");
	}
else
	{
		$f="defaultpic.jpg";
	}

define("hname","localhost:3307");
define("uname","root");
define("password","");
define("dbname","vishal");
				

$connection=mysqli_connect(hname,uname,password,dbname) or die("Error in connection" . mysqli_connect_error());

$q="insert into signup values('$fn','$ln','$age','$ph','$email','$pass','$f','$gen','$hobbies   ','$state','$country')";

		mysqli_query($connection,$q) or die ("Error in query". mysqli_error($connection));
		
		$count= mysqli_affected_rows($connection);//1 or 0
		mysqli_close($connection);
		
		if ($count==1)
		{
                print "Thanks for signing up";
                header ('location:login.php');
		}
		else
		{
			print "Problem while signing up,try again";
        }
}
?>
</form>
</body>
</html>