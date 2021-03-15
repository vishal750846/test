<?php
ob_start ();
session_start();
if(isset($_POST["s1"]))
{
            $email=$_POST["email"];
            $pass=$_POST["pass"];

define("hname","localhost:3307");
define("uname","root");
define("password","");
define("dbname","vishal");
				

$connection=mysqli_connect(hname,uname,password,dbname) or die("Error in connection" . mysqli_connect_error());

$q="select * from signup where email='$email' and password='$pass' ";

		$res=mysqli_query($connection,$q) or die ("Error in query". mysqli_error($connection));
		
		$count= mysqli_affected_rows($connection);//1 or 0
		mysqli_close($connection);
		
            if($count==1)
            {
                $x=mysqli_fetch_array($res);
                $_SESSION["n"]=$x[0];
                $_SESSION["email"]=$x[4];
                header("location:index.php");         
            }
            else
            {
                $msg= "Incorrect Username/password";
            }		
}

?>
<html>
<head>
<title>Login page</title>
</head>
<body>
<h1>Login form</h1>
<form name="form1" method="post" enctype="multipart/form-data" >
<input type="email" name="email" value="" placeholder="Email"><br><br>
<input type="password" name="pass" value="" placeholder="Password"><br><br>
<input type="submit" name="s1" Value="submit">
<?php
	if(isset($msg))
	{
		print $msg;
	}	
?>
</form>
</body>
</html>