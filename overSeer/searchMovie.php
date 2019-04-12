<html>
<body>
<div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<div style="padding: 30px 20px;
			position: absolute;
			left: 400px;
			front-size: 30px;">
	<h1>Modify Search</h1>
	<label>IMDBID :</label><br/>
    <input type="text" name="IMDBID"/><br/><br/>
	<label>Movie Name :</label><br/>
    <input type="text" name="name"/><br/><br/>
	<label>Run Time:</label><br/>
	<input type="text" name="runTime"/><br/><br/>
	<label>Release Date :</label><br/>
    <input type="date" name="releaseDate" /><br/><br/>
	</div>

	<div style="padding: 350px 20px;
			position: absolute;
			left: 400px;">
   <input type="submit" value="search"/>
   </div>
</form>
 </div>

 <?php
 include("identify.php");

 if( $flag==0){
 include("manPage.php");}
 else{include("adminPage.php");}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo"h";
	$IMDBID = $_POST["IMDBID"];
	$name = $_POST["name"];
	$runTime = $_POST["runTime"];
	$releaseDate = $_POST["releaseDate"];


  $sql = "SELECT IMDBID, name From movie  WHERE IMDBID LIKE '%$IMDBID%' AND name LIKE '%$name%' AND runTime LIKE '%$runTime%' AND releaseDate LIKE '%$releaseDate%'";
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
		if($flag==1){
        echo "<a href='editMovie.php?MovieIMDBID=".$row["IMDBID"]."'>".$row["IMDBID"]." --- ".$row["name"]."</a>";}
		else{
			echo "<a href='addShowtime.php?MovieIMDBID=".$row["IMDBID"]."'>".$row["IMDBID"]." --- ".$row["name"]."</a>";}
    }
	}
else {
    echo"<p align='center' style='color:red'>no match find</p>";
}

mysqli_close($con);}
?>
</body>
</html>
