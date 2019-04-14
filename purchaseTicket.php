<?php

	$IMDB =  $_GET['MovieIMDBID'];
	$DTime =  $_GET['DTime'];
	$roomNum =  $_GET['roomNum'];
	$cinemaAddr =  $_GET['cinemaAddr'];
	// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql = "INSERT INTO ticket (DTime, cinemaAddr, roomNum, IMDB, customer)VALUES ('". $DTime ."','". $cinemaAddr ."','". $roomNum ."','". $IMDB ."','". $_COOKIE["Cust_User"] ."');";
  if (!mysqli_query($con,$sql)){die();}
  else{
	  header("Location:customerAccount.php");
  }

  mysqli_close($con);
?>
