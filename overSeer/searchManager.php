<html>
<body>
<div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<div style="padding: 30px 20px;
			position: absolute;
			left: 400px;
			front-size: 30px;">
	<h1>Modify Search</h1>
	<label>Username :</label><br/>
    <input type="text" name="username"/><br/><br/>
	<label>name :</label><br/>
    <input type="text" name="name"/><br/><br/>
	<label>phoneNumber :</label><br/>
	<input type="text" name="phoneNumber"/><br/><br/>
	</div>

	<div style="padding: 300px 20px;
			position: absolute;
			left: 400px;">
   <input type="submit" value="search"/>
   </div>
</form>
 </div>

 <?php
 include("adminPage.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo"h";
	$userName = $_POST["username"];
	$name = $_POST["name"];
	$phoneNumber = $_POST["phoneNumber"];
	$admFlag=false;

// Create connection
	$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
	if (mysqli_connect_errno($con))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT username From OverSeer  WHERE username LIKE '%$userName%' AND adminFlag='$admFlag' AND name LIKE '%$name%' AND phoneNumber LIKE '%$phoneNumber%'";
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
        echo "<a href='editManager.php?holdername=".$row["username"]."'>".$row["username"]."</a>";
    }
	}
else {
    echo"<p align='center' style='color:red'>no match find</p>";
}

mysqli_close($con);}
?>
</body>
</html>
