<?php
if(!isset($_SESSION)) {
 session_start();
}
 $username = $_SESSION['admName'];
 // Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql =  "SELECT name, phoneNumber,adminFlag FROM overseer WHERE userName = '$username'";
  $result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  $flag=$row["adminFlag"];
  ?>
