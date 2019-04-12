<?php
include("indexBase.php");
?>
<!DOCTYPE html>


<html>
<style>
  form{
  position: absolute;
  left: 50px;
  }
</style>

<body>
  <h1>Food and Drink</h1>
</body>
</html>

<?php

  // Create connection
  	$con=mysqli_connect("localhost","root","","cinemaDB");

  // Check connection
  	if (mysqli_connect_errno($con))
    {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


  $sql = "SELECT foodID, image, name, type From food";
  $result = mysqli_query($con,$sql);
	$type="";


  echo '<div style="padding: 80px 20px; font-size:130%;">';
    while($row = mysqli_fetch_array($result)){
		if($row["type"]==$type){}
		else{
			echo "<br/>".$row["type"]. "<br/><br/>";
			}
    	echo "<a href='selectFood.php?foodID=".$row["foodID"]."'><img src=".$row["image"]." height='200' width='200'/></a> ";
		$type=$row["type"];
		echo str_repeat('&nbsp;', 5);	
    }

//mysqli_close($con);
?>
