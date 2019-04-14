<!DOCTYPE html>

<html>
<head>
	<style>
		form{padding-top: 120px;
			text-align: center;
			front-size: 30px;}

		label{
			position: absolute;
			left: 600px;
			front-size: 30px;
			}

		input[name=login]{
			width: 150px;
			position: absolute;
			left: 530px;
			top: 354px;
			height: 20px;
			front-size: 15px;}

		input[name=return]{
			width: 150px;
			position: absolute;
			left: 720px;
			top: 354px;
			height: 20px;
			front-size: 15px;}

		p{position: absolute;
			left: 550px;
			top: 374px;}

		body {
			background-image: url("image/images.jpg");
		}
	</style>

</head>
<body>


<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<h1>Login As Employee</h1><br/>
	<label>Username :</label><br/>
	<input type="text" name="username"/><br/><br/>
	<label>Password :</label><br/>
	<input type="password" name="password"/><br/><br/>

   <input type="submit" name= "login" value="login"/>
</form>

<?php
//run only if user clicked login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
	$prep = mysqli_prepare($con, "SELECT userName FROM overseer WHERE userName = ? and passwd = ?");
	mysqli_stmt_bind_param($prep, "ss", $userName, $passwd);
	mysqli_stmt_execute($prep);
	$result = mysqli_stmt_get_result($prep);

 if (!$result)
  {
  die('Error: ' . mysqli_error($con));
  }
	$count = mysqli_num_rows($result);

  //authentication is suucessfule
  //pass userName as a varible to the adminAccount.php
  if($count == 1){
	  session_start();
	  $_SESSION['admName'] = $userName;
		header("Location:overSeer/adminAccount.php");
		die();
	 }

//authentication faild
  else{
	echo"<p align='center' style='color:red'>Your Login Name or Password is invalid</p>";
  }

mysqli_close($con);
}
?>
<form>
    <input type="button" name="return" value="return" onclick="window.location.href='index.php'" />
</form>
 </body>
</html>
