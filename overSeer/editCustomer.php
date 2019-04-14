<?php

	if(!isset($_SESSION)) {
		session_start();
	}
	if(!isset($_SESSION['admName'])) {
		header("Location:Forbidden.html");
		die();
	}
	include("identify.php");
	if( $flag==1){
		header("Location:Forbidden.html");
		die();
	}


 include("manPage.php");
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
	$sql =  "SELECT name, phoneNumber, passwd, username, age FROM customer WHERE userName = '$holdername'";
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
    <input type="text" name="name" value="<?php echo $row["name"];?>"><br/><br/>
	<label>Password :</label><br/>
    <input type="password" name="password" value="<?php echo $row["passwd"];?>"><br/><br/>
	<label>age: </label><br/>
    <input type="text" name="age" value="<?php echo $row["age"];?>"><br/><br/>
	<label>PhoneNumber :</label><br/>
    <input type="text" name="phoneNumber" value="<?php echo $row["phoneNumber"];?>"><br/><br/>
	<label>Position : Customer</label><br/><br/>
	<input type="hidden" name="holdername" value="<?php echo $holdername;?>">
	<input type="hidden" name="tableName" value="Customer">

   <input type="submit" value="update"/>
</form>
 </div>


<div style="padding: 300px 20px;
			position: absolute;
			left: 100px;">

<form method="post" action="delete.php">
    <input type="hidden" name="holdername" value=<?php echo $holdername;?>>
	 <input type="hidden" name="tableName" value="customer">
	 <input type="hidden" name="columnName" value="userName">
	 <input type="hidden" name="returnLocation" value="searchPeople.php">
    <input type="submit" value="delete">
</form>
</div>





</body>
</html>
