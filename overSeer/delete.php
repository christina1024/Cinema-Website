<?php

$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

//restore the original setting if the name is null
	$holdername = $_POST['holdername'];
	$tableName = $_POST['tableName'];
	$returnLocation = $_POST['returnLocation'];
	$columnName = $_POST['columnName'];
	if($tableName=="Movie"){
		$sql = "DELETE FROM genre WHERE movieIMDB='$holdername'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		$sql = "DELETE FROM actin WHERE movieIMDB='$holdername'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		$sql = "DELETE FROM playin WHERE movieIMDB='$holdername'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		$sql = "DELETE FROM showtime WHERE IMDB='$holdername'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		$sql = "DELETE FROM $tableName WHERE $columnName='$holdername'";
		}
	if (isset($_POST['columnName2'])) {
		$holdername2 = $_POST['holdername2'];
		$columnName2 = $_POST['columnName2'];
		$holdername3 = $_POST['holdername3'];
		$sql = "DELETE FROM playin WHERE MovieIMDB='$holdername' AND cinemaAddr LIKE '%$holdername3%'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		$sql = "DELETE FROM $tableName WHERE $columnName='$holdername' AND $columnName2 = '$holdername2'";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
	}
	else{
	$sql = "DELETE FROM $tableName WHERE $columnName='$holdername'";}
	 if (!mysqli_query($con,$sql))
	{
		echo '<script language="javascript">';
		echo 'alert("unsuccessful cannot find match")';
		echo '</script>';
		header( "refresh:0;url=$returnLocation" );
		die('Error: ' . mysqli_error($con));
	}
else{
	echo '<script language="javascript">';
	echo 'alert("delete successful")';
	echo '</script>';
	header( "refresh:0;url=$returnLocation" );}
	mysqli_close($con);

?>
