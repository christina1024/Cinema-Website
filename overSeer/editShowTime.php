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
if (isset($_GET['MovieIMDBID'])) {
	$MovieIMDBID =  $_GET['MovieIMDBID'];
	$DTime=$_GET['DTime'];
 }
// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//get account detail
	$sql =  "SELECT name FROM movie WHERE IMDBID = '$MovieIMDBID'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	$movieName= $row["name"];

	$sql =  "SELECT * FROM showtime WHERE IMDB = '$MovieIMDBID' AND DTime='$DTime'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);

 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  $DTime2=explode(" ",$row["DTime"]);

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

<form method="post" action="editUpdate.php">

	<label>Name : <?php echo $movieName;?></label><br/><br/>
	<label>Date: </label><br/>
    <input type="date" name="Date" value=<?php echo $DTime2[0];?>><br/><br/>
	<label>Time: </label><br/>
    <input type="time" name="Time" value=<?php echo $DTime2[1];?>><br/><br/>
	<label>Price:</label><br/>
	<input type="text" name="price" value=<?php echo $row["price"];?>><br/><br/>
	<label>Cinema Address :</label><br/>
    <input type="text" name="cinemaAddr" value="<?php echo $row["cinemaAddr"];?>"><br/><br/>
	<label>Room Number:</label><br/>
    <input type="text" name="roomNum" value="<?php echo $row["roomNum"];?>"><br/><br/>

	<input type="hidden" name="MovieIMDBID" value=<?php echo $MovieIMDBID;?>>
	<input type="hidden" name="tableName" value="ShowTime">
	<input type="hidden" name="OldDTime" value="<?php echo $row["DTime"];?>">
	<input type="hidden" name="OldcinemaAddr" value="<?php echo $row["cinemaAddr"];?>">
	<input type="hidden" name="OldroomNum" value="<?php echo $row["roomNum"];?>">


   <input type="submit" value="update"/>

</form>

<div style="padding: 328px 20px;
			position: absolute;
			left: 100px;">

<form method="post" action="delete.php">
    <input type="hidden" name="holdername" value=<?php echo $MovieIMDBID;?>>
	 <input type="hidden" name="holdername2" value=<?php echo $DTime;?>>
	 <input type="hidden" name="holdername3" value=<?php echo $row["cinemaAddr"];?>>
	 <input type="hidden" name="tableName" value="showtime">
	 <input type="hidden" name="columnName" value="IMDB">
	 <input type="hidden" name="columnName2" value="DTime">
	 <input type="hidden" name="returnLocation" value="searchShowTime.php">
    <input type="submit" value="delete">
</form>
</div>

<div style="padding: 400px 20px;
			position: absolute;
			left: 600px;">

</div>





</body>
</html>
