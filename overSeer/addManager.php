<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if(!isset($_SESSION['admName'])) {
		header("Location:Forbidden.html");
		die();
	}
	include("identify.php");
	if( $flag==0){
		header("Location:Forbidden.html");
		die();
	}
?>
<html>
<style>
form {
	padding: 60px 20px;
	position: absolute;
	left: 600px;
	front-size: 30px;}


	</style>
	<body>
		<div class="container">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<h1>Create Manager Account</h1><br/>
				<label>Username :</label><br/>
				<input type="text" name="username"/><br/><br/>
				<label>Password :</label><br>
				<input type="password" name="password"/><br/><br/>
				<label>Name :</label><br>
				<input type="text" name="name"/><br/><br/>
				<label>PhoneNumber :</label><br>
				<input type="text" name="phoneNumber"/><br/><br/>

				<input type="submit" value="create"/>
			</form>
		</div>

		<?php
		include("adminPage.php");
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//echo"h";
			$userName = $_POST["username"];
			$passwd = $_POST["password"];
			$name = $_POST["name"];
			$phoneNumber = $_POST["phoneNumber"];
			$mFlag = true;
			$admFlag=false;


			// Create connection
			$con=mysqli_connect("localhost","root","","cinemaDB");

			// Check connection
			if (mysqli_connect_errno($con))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$sql = "INSERT INTO overseer (userName, passwd, name, phoneNumber,adminFlag , manFlag) VALUES ('". $userName ."','". $passwd ."','". $name ."','". $phoneNumber ."' ,'".$admFlag."','".$mFlag."')";

			if (!mysqli_query($con,$sql))
			{
				if($userName==""){echo"<p align='center' style='color:red'>username field cannot be emplty</p>";}
				if($passwd==""){echo"<p align='center' style='color:red'>password field cannot be empty</p>";}
				if($name==""){echo"<p align='center' style='color:red'>name field cannot be empty</p>";}
				if($phoneNumber==""){echo"<p align='center' style='color:red'>phoneNumber field cannot be empty</p>";}
				else if(strlen($phoneNumber)<10){echo"<p align='center' style='color:red'>must be a valid phoneNumber</p>";}
				else{
					echo"<p align='center' style='color:red'>username is already registered</p>";}
					die();
				}
				else{
					echo"<p align='center' style='color:blue'>create success!</p>";
					die();
				}

				mysqli_close($con);}
				?>
			</body>
			</html>
