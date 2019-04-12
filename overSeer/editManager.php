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

 include("adminPage.php");
if (isset($_GET['holdername'])) {
	$holdername =  $_GET['holdername'];
 }

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//get account detail
	$sql =  "SELECT name, phoneNumber, passwd, username FROM OverSeer WHERE userName = '$holdername'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);

//if the account holder is manager, then include manPage.php (manager account setting)
//else display admin setting
 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

?>
<html>
	<style>
		form {
			padding: 80px 20px;
			position: absolute;
			left: 600px;
			front-size: 30px;}

	</style>
<body>
<div class="container">
<form method="post" action="editUpdate.php">

	<label>username : <?php echo $holdername;?></label><br/><br/>
	<label>name: </label><br/>
    <input type="text" name="name" value=<?php echo $row["name"];?>><br/><br/>
	<label>Password :</label><br/>
    <input type="password" name="password" value=<?php echo $row["passwd"];?>><br/><br/>
	<label>PhoneNumber :</label><br/>
    <input type="text" name="phoneNumber" value=<?php echo $row["phoneNumber"];?>><br/><br/>
	<label>Position : Manager</label><br/><br/>
	<input type="hidden" name="holdername" value=<?php echo $holdername;?>>
	<input type="hidden" name="tableName" value="OverSeer">

   <input type="submit" value="update"/>
</form>
 </div>


<div style="padding: 243px 20px;
			position: absolute;
			left: 100px;">

<form method="post" action="delete.php">
    <input type="hidden" name="holdername" value=<?php echo $holdername;?>>
	 <input type="hidden" name="tableName" value="OverSeer">
	 <input type="hidden" name="columnName" value="username">
	 <input type="hidden" name="returnLocation" value="searchPeople.php">
    <input type="submit" value="delete">
</form>
</div>





</body>
</html>
