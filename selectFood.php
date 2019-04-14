<?php
include("indexBase.php");
//if (!isset($_GET["foodID"])) {
	$foodID =  $_GET['foodID'];
 //}

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//get account detail
	$sql =  "SELECT * FROM food WHERE foodID =".$foodID;
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);

 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  else{
	  echo '<div style="position:absolute; top:250px; left: 600px"><b>Name: </b> '.$row["name"].' </div>';
	  echo '<div style="position:absolute; top:290px; left: 600px"> <b>Price</b> '.$row["price"].' </div>';
	  echo '<div style="position:absolute; top:330px; left: 600px"> <b>Size:</b> '.$row["size"].' </div>';
	  echo '<div style="position:absolute; top:370px; left: 600px"> <b>Description:</b> '.$row["description"].' </div>';

  }


?>
<html>
<style>
	form{
		position: absolute;
		padding: 250px 600px;
	}
</style>
<body>
<img src="<?php echo $row["image"];?>"style="padding: 0px 20px;
							position: absolute;
							left: 200px;
							width:320px;
							height:400px;">
<?php
if(isset($_COOKIE['Cust_User'])){
	echo '<form method="post" action="purchaseFood.php">';
	echo '<input type="hidden" name="foodID" value='.$row["foodID"].'>';
	echo '<input type="submit" value="purchase">';
	echo '</form>';
}
?>
</body>
</html>
