<?php
session_start();
$name =$_SESSION["n"];
?>
<html>
<head>
<title>Home page</title>
</head>
<body>

<h1>Welcome <?php echo $_SESSION["n"];?></h1>
<?php

define("hname","localhost:3307");
define("uname","root");
define("password","");
define("dbname","vishal");
				

$connection=mysqli_connect(hname,uname,password,dbname) or die("Error in connection" . mysqli_connect_error());

$q="select * from signup where fname='$name'";

$res=mysqli_query($connection,$q) or die ("Error in query". mysqli_error($connection));

$x=mysqli_fetch_array($res);

echo "First Name:-$x[0]<br>";
echo "Last Name:-$x[1]<br>";
echo "$x[2]<br>";
echo "$x[3]<br>";
echo "$x[4]<br>";
echo "$x[5]<br>";
echo "<img src='uploads/$x[6]' width='100px' <br><br>"; 
echo "$x[7]<br>";
echo "$x[8]<br>";
echo "$x[9]<br>";
echo "$x[10]<br>";
		
?>
<a href='update.php?email=$x[4]'>Change Personal details</a>
<a href="cpass.php" >Change Password</a>
<a href="logout.php" >Logout</a>
</body>
</html>