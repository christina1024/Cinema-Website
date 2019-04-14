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
?>
<html>
 <?php
 include("manPage.php");
 if($_GET){
       $MovieIMDBID =  $_GET['MovieIMDBID'];
		$IMDB=$MovieIMDBID;
    }
	else{$IMDB= $_POST["IMDB"];}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$IMDB= $_POST["IMDB"];
	$Date=$_POST["Date"];
	$Time=$_POST["Time"];
	$DTime = $Date." ".$Time;
	$price = $_POST["price"];
	$cinemaAddr = $_POST["cinemaAddr"];
	$roomNum = $_POST["roomNum"];

	// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "INSERT INTO showtime (manUsr, IMDB, DTime, price,cinemaAddr , roomNum) VALUES ('". $username ."','". $IMDB ."','". $DTime ."','". $price ."' ,'".$cinemaAddr."','".$roomNum."')";

	if (!mysqli_query($con,$sql))
	{
		echo '<script language="javascript">';
		echo 'alert("creation deny, ShowTime already exists")';
		echo '</script>';
		header( "refresh:0;url=searchMovie.php" );
		die();
	}
	else{
		$sql = "INSERT INTO playin (movieIMDB, cinemaAddr) VALUES ('". $IMDB ."','".$cinemaAddr."')";
		if (!mysqli_query($con,$sql)){echo mysqli_error($con);}
		echo '<script language="javascript">';
		echo 'alert("creation successful")';
		echo '</script>';
		header( "refresh:0;url=searchMovie.php" );
		die();
	}

mysqli_close($con);}
?>
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

	<label>IMDB : <?php echo $IMDB;?></label><br/><br/>
	<label>Date: </label><br/>
    <input type="date" name="Date"><br/><br/>
	<label>Time: </label><br/>
    <input type="time" name="Time"><br/><br/>
	<label>Price:</label><br/>
	<input type="text" name="price"/><br/><br/>
	<label>Cinema Address :</label><br/>
    <select name="cinemaAddr">
		<option value="Crowfoot Crossing">Crowfoot Crossing</option>
		<option value="Sunridge Spectrum">Sunridge Spectrum</option>
		<option value="East Hills">East Hills</option>
		<option value="Westhills">Westhills</option>
	</select> <br/><br/>
	<label>Room Number:</label><br/>
    <select name="roomNum">
		<option value="101">101</option>
		<option value="102">102</option>
		<option value="103">103</option>
		<option value="104">104</option>
	</select> <br/><br/>
	<input type="hidden" name="IMDB" value=<?php echo $IMDB;?>>
   <input type="submit" value="create"/>
</form>
 </div>
 </body>
</html>
