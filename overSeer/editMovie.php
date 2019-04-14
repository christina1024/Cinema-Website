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
if (isset($_GET['MovieIMDBID'])) {
	$MovieIMDBID =  $_GET['MovieIMDBID'];
 }

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//get account detail
	$sql =  "SELECT * FROM movie WHERE IMDBID = '$MovieIMDBID'";
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
	form{padding: 30px 20px;
			position: absolute;
			left: 400px;
			front-size: 30px;}
</style>
<body>

<form method="post" action="editUpdate.php">

	<label>IMDBID : <?php echo $MovieIMDBID;?></label><br/><br/>
	<label>Movie Name: </label><br/>
    <input type="text" name="name" value="<?php echo $row["name"];?>"></input><br/><br/>
	<label>Run Time:</label><br/>
	<input type="text" name="runTime" value=<?php echo $row["runTime"];?>></input><br/><br/>
	<label>Producer :</label><br/>
    <input type="text" name="producer" value="<?php echo $row["producer"];?>"></input><br/><br/>
	<label>Synopsis:</label><br/>
	<textarea name="synopsis" rows="5" cols="30" value="<?php echo $row["synopsis"];?>"></textarea><br/><br/>
	<label>Director :</label><br/>
    <input type="text" name="director" value="<?php echo $row["director"];?>"></input><br/><br/>

	<div style="top: 70px;
			position: absolute;
			left: 300px;
			front-size: 30px;">

	<label>Format:</label><br/>
	<input type="text" name="format" value= <?php echo $row["FORMAT"];?>><br/><br/>
	<label>Release Date :</label><br/>
    <input type="date" name="releaseDate" value=<?php echo $row["releaseDate"];?>><br/><br/>
	<label>Writers :</label><br/>
    <input type="text" name="writer" value=<?php echo $row["writer"];?>><br/><br/>
	<label>Image :</label><br/>
    <input type="text" name="image" value=<?php echo $row["image"];?>><br/><br/>
	<label>Genre:</label><br/>
	<select name="genre">
		<option value="-">default</option>
		<option value="romance">romance</option>
		<option value="adventure">adventure</option>
		<option value="action">action</option>
		<option value="sci-fi">sci-fi</option>
		<option value="comedy">comedy</option>
		<option value="documentary">documentary</option>
	</select> <br/><br/>
   </div>

	<input type="hidden" name="MovieIMDBID" value=<?php echo $MovieIMDBID;?>>
	<input type="hidden" name="tableName" value="Movie">

   <div style="top: 370px;
			position: absolute;
			left: 300px;">
   <input type="submit" value="update"/>
   </div>
</form>



<div style="padding: 340px 20px;
			position: absolute;
			left: 400px;">

<form method="post" action="delete.php">
    <input type="hidden" name="holdername" value=<?php echo $MovieIMDBID;?>>
	 <input type="hidden" name="tableName" value="Movie">
	 <input type="hidden" name="columnName" value="IMDBID">
	 <input type="hidden" name="returnLocation" value="searchMovie.php">
    <input type="submit" value="delete">
</form>
</div>





</body>
</html>
