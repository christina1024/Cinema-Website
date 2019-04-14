<?php
include("indexBase.php");
if (isset($_GET["movieIMDBID"])) {
	$IMDBID =  $_GET['movieIMDBID'];
 }

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//get account detail
	$sql =  "SELECT * FROM movie WHERE IMDBID = '$IMDBID'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);

 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  else{
	  echo '<div style="position:absolute; top:250px; left: 600px"><b>Name: </b> '.$row["name"].' </div>';
	  echo '<div style="position:absolute; top:290px; left: 600px"> <b>Runtime </b> '.$row["runTime"].' </div>';
	  echo '<div style="position:absolute; top:330px; left: 600px"> <b>Release Date:</b> '.$row["releaseDate"].' </div>';
	   echo '<div style="position:absolute; top:370px; left: 600px"> <b>Producer: </b>'.$row["producer"].' </div>';
	    echo '<div style="position:absolute; top:410px; left: 600px"> <b>Director: </b>'.$row["director"].' </div>';
		echo '<div style="position:absolute; top:450px; left: 600px"> <b>Synopsis:</b> '.$row["synopsis"].' </div>';
  }


?>
<html>
<body>
<img src="<?php echo $row["image"];?>"style="padding: 30px 20px;
							position: absolute;
							left: 200px;
							width:320px;
							height:400px;">
</body>
</html>
<?php
 $sql =  "SELECT cinemaAddr FROM playin WHERE movieIMDB = '$IMDBID'";
  $result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<div style="position:absolute; top:250px; left: 900px" > <b>Play In:</b>';
		while($row = mysqli_fetch_assoc($result)) {
			if (isset($_GET["movieIMDBID"])) {
				$gets = http_build_query(array('movieIMDBID'=>$_GET['movieIMDBID'], 'movieLoc'=>$row['cinemaAddr']));
				echo '<div><a href="getShowTime.php?'.$gets.'">'.$row["cinemaAddr"].'</a></div>';
			}
			else{
				echo '<div>'.$row["cinemaAddr"].'</div>';
			}
		}
		echo "</div>";
	}
	?>
