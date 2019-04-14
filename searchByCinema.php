<?php
include("indexBase.php");
?>
<!DOCTYPE html>

<html>
<body>
<form method="get" action="searchByCinema.php">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
  // Create connection
  $con=mysqli_connect("localhost","root","","cinemaDB");

  // Check connection
  if (mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if(isset($_GET['IMDB'])){
    $prep = mysqli_prepare($con,"SELECT address FROM Cinema AS C WHERE EXISTS(SELECT * FROM PlayIn as P WHERE P.cinemaAddr=C.address AND P.movieIMDB = ?)");
    mysqli_stmt_bind_param($prep, "s", $_GET['IMDB']);
    mysqli_stmt_execute($prep);
    $result = mysqli_stmt_get_result($prep);
    $count = mysqli_num_rows($result);
    echo "<a>"."The movie is played at ". $count." locations: "."</a>";
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
      echo "<a href='searchByMovieName.php?Addr=".$row["address"]."'>".$row["address"]."</a>";
    }
  }

}
if(!isset($_GET['IMDB'])){
  $prep = mysqli_prepare($con,"SELECT address FROM cinema WHERE address <> ?");
  $filer = "";
  mysqli_stmt_bind_param($prep, "s", $filer);
  mysqli_stmt_execute($prep);
  $result = mysqli_stmt_get_result($prep);
  $count = mysqli_num_rows($result);
  echo "<h1>"."We have ". $count." locations: "."</h1>";
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo '<div style="padding: 20px 0px" >';
    echo "<a href='searchByMovieName.php?Addr=".$row["address"]."'>".$row["address"]."</a>";
  }
}
?>

</body>
</html>
