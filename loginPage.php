<!DOCTYPE html>

<html>
<head>
	<title>User Login</title>
	<style>
		form{padding-top: 120px;
			text-align: center;
			front-size: 30px;}

		input[type=text]{width: 200px;
			height: 40px;
			front-size: 30px;}

		input[type=password]{width: 200px;
			height: 40px;
			front-size: 30px;}

		input[name=login]{
			width: 150px;
			position: absolute;
			margin-left:-10%;
			//padding:30px 16px;
			top: 354px;
			height: 20px;
			front-size: 15px;}

		input[name=return]{
			width: 150px;
			position: absolute;
			margin-left:4%;
			//padding:30px 16px;
			top: 354px;
			height: 20px;
			front-size: 15px;}

		a{
			width: 150px;
			position: absolute;
			left:47%;
			top: 400px;
			height: 20px;
			front-size: 15px;}

		body {
  background-image: url("image/images.jpg");

}

	</style>

</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<h1>User Login Page</h1><br/>
   Username: <input type="text" name="username"/><br/><br/>
   Password: <input type="password" name="password"/><br/><br/>

   <input type="submit" name= "login" value="login"/>
</form>
<form>
<input type="button"8 name="return" value="Back" onclick="window.location.href='index.php'" />
</form>

<a href="register.php">Need an account?</a>

<?php
//remove cookie (just in case)
setcookie("Cust_User", "", time()+(86400 * -1), "/");
//run only if user clicked login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo "hi";

	$userName = $_POST["username"];
	$passwd = $_POST["password"];

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

//authenticate user
//store username and password in row if authentication is suucessfule
	$prep = mysqli_prepare($con,"SELECT userName FROM customer WHERE userName = ? and passwd = ?");
	mysqli_stmt_bind_param($prep, "ss", $userName, $passwd);
	mysqli_stmt_execute($prep);
	$result = mysqli_stmt_get_result($prep);

 if (!$result)
  {
  die('Error: ' . mysqli_error($con));
  }
	$count = mysqli_num_rows($result);

 //authentication is suucessfule
  if($count == 1){
	  mysqli_close($con);
		setcookie("Cust_User", $userName, time()+(86400 * 1), "/"); // 86400 = 1 day
	  header("Location:index.php");
	  die();
	 }
//authentication faild
  else{
	echo"<p align='center' style='color:red'>Your Login Name or Password is invalid</p>";
	mysqli_close($con);
  }
}
?>

 </body>
</html>
