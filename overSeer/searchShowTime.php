<html>
<style>
	form{padding: 30px 20px;
			position: fixed;
			left: 400px;
	front-size: 30px;}
</style>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<h1>Modify Search</h1>
	<label>IMDBID :</label><br/>
    <input type="text" name="IMDB"/><br/><br/>
	<label>Date/Time:</label><br/>
    <input type="text" name="DTime"/><br/><br/>
	<label>Price:</label><br/>
	<input type="text" name="price"/><br/><br/>
	<label>Cinema Address :</label><br/>
    <select name="cinemaAddr">
		<option value="-">ANY</option>
		<option value="Crowfoot Crossing">Crowfoot Crossing</option>
		<option value="Sunridge Spectrum">Sunridge Spectrum</option>
		<option value="East Hills">East Hills</option>
		<option value="Westhills">Westhills</option>
	</select> <br/><br/>
	<label>Room Number:</label><br/>
    <select name="roomNum">
		<option value="-">ANY</option>
		<option value="101">101</option>
		<option value="102">102</option>
		<option value="103">103</option>
		<option value="104">104</option>
	</select> <br/><br/>

   <input type="submit" value="search"/>

</form>


 <?php
 include("identify.php");

 if( $flag==0){
 include("manPage.php");}
 else{include("adminPage.php");}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$IMDB= $_POST["IMDB"];
	$DTime = $_POST["DTime"];
	$price = $_POST["price"];
	$cinemaAddr = $_POST["cinemaAddr"];
	$roomNum = $_POST["roomNum"];
	if($cinemaAddr=="-" and $roomNum=="-"){
		$sql = "SELECT S.IMDB, S.DTime, M.name From showtime AS S, movie AS M  WHERE IMDB LIKE '%$IMDB%' AND DTime LIKE '%$DTime%' AND price LIKE '%$price%' AND IMDB = IMDBID";
	}
	else if($cinemaAddr=="-"){
		$sql = "SELECT S.IMDB, S.DTime, M.name From showtime AS S, movie AS M WHERE IMDB LIKE '%$IMDB%' AND DTime LIKE '%$DTime%' AND price LIKE '%$price%'AND roomNum LIKE '$roomNum' AND IMDB = IMDBID";
	}
	else if($roomNum=="-"){
		$sql = "SELECT S.IMDB, S.DTime, M.name From showtime AS S, movie AS M WHERE IMDB LIKE '%$IMDB%' AND DTime LIKE '%$DTime%' AND price LIKE '%$price%' AND cinemaAddr LIKE '%$cinemaAddr%' AND IMDB = IMDBID";
	}
	else{ $sql = "SELECT S.IMDB, S.DTime, M.name From showtime AS S, movie AS M WHERE IMDB LIKE '%$IMDB%' AND DTime LIKE '%$DTime%' AND price LIKE '%$price%' AND cinemaAddr LIKE '%$cinemaAddr%' AND roomNum LIKE '$roomNum' AND IMDB = IMDBID";}

  $result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo '<div style="
  width: 300px;
  height: 500px;
  background: rgba(236, 255, 179, 0.3);
  padding: 10px;
  margin: 20px;
  opacity: 1;
  position: absolute;
  top: 50px;
			left: 800px;">';


	echo"<h1 style='font-size:150%; color: green;'>Display</h1>";
    while($row = mysqli_fetch_assoc($result)) {
		echo '<div style="padding: 20px 0px" >';
        echo "<a href='editShowTime.php?MovieIMDBID=".$row["IMDB"]." & DTime=".$row["DTime"]."'>".$row["name"]." ---> ".$row["DTime"]."</a>";
    }
	}
else {
    echo"<p align='center' style='color:red'>no match find </p>";
}

mysqli_close($con);}
?>
</body>
</html>
