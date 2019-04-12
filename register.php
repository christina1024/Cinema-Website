<html>
<title>Registration</title>
	<style>
		form {
			padding-top: 80px;
			text-align: center;
			front-size: 30px;}

		label{
			position: absolute;
			left: 600px;
			}

		body {
			background-image: url("images.jpg");
		}
	</style>
<body>
<div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<h1>User Registration</h1><br/>
	<label>Username :</label><br/>
    <input type="text" name="username"/><br/><br/>
	<label>Password :</label><br>
    <input type="password" name="password"/><br/><br/>
	<label>CCInfo :</label><br>
	<input type="text" name="CCInfo"/><br/><br/>
	<label>Age :</label><br>
	<input type="text" name="age"/><br/><br/>
	<label>Name :</label><br>
	<input type="text" name="name"/><br/><br/>
	<label>PhoneNumber :</label><br>
    <input type="text" name="phoneNumber"/><br/><br/>

   <input type="submit" value="create"/>
</form>
 </div>

 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo"h";
	$userName = $_POST["username"];
	$passwd = $_POST["password"];
	$CCInfo = $_POST["CCInfo"];
	$age = $_POST["age"];
	$name = $_POST["name"];
	$phoneNumber = $_POST["phoneNumber"];


// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "INSERT INTO Customer (userName, passwd, CCInfo, age, name, phoneNumber) VALUES ('". $userName ."','". $passwd ."','". $CCInfo ."','". $age ."','". $name ."','". $phoneNumber ."')";
	$prep = mysqli_prepare($con, "INSERT INTO Customer (userName, passwd, CCInfo, age, name, phoneNumber) VALUES (?,?,?,?,?,?)");
	mysqli_stmt_bind_param($prep, "ssssss", $userName, $passwd,$CCInfo,$age,$name,$phoneNumber);

	if (!mysqli_stmt_execute($prep))
	{
		if($userName==""){echo"<p align='center' style='color:red'>username field cannot be emplty</p>";}
		if($passwd==""){echo"<p align='center' style='color:red'>password field cannot be empty</p>";}
		if($CCInfo==""){echo"<p align='center' style='color:red'>credit card field cannot be empty</p>";}
		if($phoneNumber==""){echo"<p align='center' style='color:red'>phoneNumber field cannot be empty</p>";}
		else{
		echo"<p align='center' style='color:red'>username is already registered</p>";}
	}
	else{
		header("Location:index.php");
		die();
	}

mysqli_close($con);}
?>
</body>
</html>
