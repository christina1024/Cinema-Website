<?php
include("indexBase.php");
// Create connection
$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>

<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Movie Name: <input type="text" name="Mname">

	Genre:	<select name="Genre">
		<option value="-">ANY</option>
    <?php
    $sql =  "SELECT DISTINCT genre FROM Genre";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result)) {
      echo "<option value='".$row['genre']."'>";
      echo $row['genre'];
      echo "</option>";
    }
    ?>
	</select>

  actor: <input type="text" name="actor">
  <input type="submit" value='Search'>
</form>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$actor = "%".$_POST['actor']."%";
		$filer = "%".$_POST['Mname']."%";
		$Genre = $_POST['Genre'];
   if($Genre=="-"){
	   $prep = mysqli_prepare($con,"SELECT IMDBID, name ,image FROM Movie as M WHERE EXISTS (SELECT * FROM ActIn as I WHERE EXISTS(SELECT * FROM Actor as A WHERE A.name LIKE? AND M.name LIKE ? AND A.IMDBID=I.actorIMDB AND I.movieIMDB=M.IMDBID))");
		if ( !$prep ) {
		die('mysqli error: '.mysqli_error($con));
		}
		mysqli_stmt_bind_param($prep, "ss",$actor, $filer);
	}
	else{
    $prep = mysqli_prepare($con,"SELECT IMDBID, name, image From Movie as M WHERE EXISTS (SELECT * FROM Genre as G WHERE EXISTS (SELECT * FROM ActIn as I WHERE EXISTS(SELECT * FROM Actor as A WHERE A.name LIKE ? AND G.genre LIKE ?
	AND M.name LIKE ? AND A.IMDBID=I.actorIMDB AND I.movieIMDB=G.movieIMDB AND G.movieIMDB=M.IMDBID)))");
		mysqli_stmt_bind_param($prep, "sss",$actor,$Genre, $filer);
	}

	mysqli_stmt_execute($prep);
    $result = mysqli_stmt_get_result($prep);
    $count = mysqli_num_rows($result);
    echo $count." results:";
	echo '<div style="padding: 20px 0px" >';
    while($row = mysqli_fetch_assoc($result)){
      echo "<a href='displayMovie.php?movieIMDBID=".$row["IMDBID"]."'><img src=".$row["image"]." height='300' width='210'/></a> ";
		echo str_repeat('&nbsp;', 10);
		}
 }
  if (isset($_GET['Addr'])){
    $prep = mysqli_prepare($con,"SELECT IMDBID, name, image FROM Movie as M WHERE EXISTS(SELECT * FROM PlayIn as P WHERE P.cinemaAddr = ? AND P.movieIMDB = M.IMDBID)");
    $pram = "".$_GET['Addr'];
	 $pass = $_GET['Addr'];
    mysqli_stmt_bind_param($prep, "s", $pram);
    mysqli_stmt_execute($prep);
    $result = mysqli_stmt_get_result($prep);
    $count = mysqli_num_rows($result);
    echo $count." movies play at this location: ";
	echo '<div style="padding: 20px 0px" >';
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		echo "<a href='getShowTime.php?movieIMDBID=".$row["IMDBID"]."& movieLoc=".$_GET['Addr']."'><img src=".$row["image"]." height='300' width='210'/></a> ";
		echo str_repeat('&nbsp;', 10);
		}
  }

  else{
    $prep = mysqli_prepare($con,"SELECT IMDBID, name, image FROM Movie WHERE name LIKE ?");
    $filer = "%";
    mysqli_stmt_bind_param($prep, "s", $filer);
    mysqli_stmt_execute($prep);
    $result = mysqli_stmt_get_result($prep);
    $count = mysqli_num_rows($result);
    echo "<h1>We have ". $count." movies:</h1>";
	echo '<div style="padding: 20px 0px" >';
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		echo "<a href='displayMovie.php?movieIMDBID=".$row["IMDBID"]."'><img src=".$row["image"]." height='300' width='210'/></a> ";
		echo str_repeat('&nbsp;', 10);
	}
  }


?>

</body>
</html>
