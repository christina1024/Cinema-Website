<?php
if(!isset($_COOKIE["Cust_User"])) {
  header("Location:Forbidden.html");
  die();
}
include("indexBase.php");
?>
<!DOCTYPE html>

<html>
<body>
  <?php
  // Create connection
  $con=mysqli_connect("localhost","root","","cinemaDB");

  // Check connection
  if (mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $prep = mysqli_prepare($con,"SELECT * FROM Ticket AS T, Movie AS M WHERE T.customer = ? AND M.IMDBID=T.IMDB ORDER BY T.DTime DESC;");
  mysqli_stmt_bind_param($prep, "s", $_COOKIE["Cust_User"]);
  mysqli_stmt_execute($prep);
  $result = mysqli_stmt_get_result($prep);
  $count = mysqli_num_rows($result);
  if($count > 0){
    echo "<p>You have purchased ". $count." Tickets:</p>";
  }else{
    echo "<p>You do not have any tickets right now</p>";
  }
  $curtime = date("Y-m-d H:i:s");
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo "<p>";
    echo "Movie: ".$row['name']."<br>";
    echo "Location: ".$row['cinemaAddr']."<br>";
    echo "Date/Time: ".$row['DTime']."<br>";
    echo "Theater#: ".$row['roomNum']."<br>";
    if($curtime < $row['DTime']){
      $gets = http_build_query(array('IMDB'=>$row['IMDB'], 'Addr'=>$row['cinemaAddr'], 'room'=>$row['roomNum'], 'DTime'=>$row['DTime']));
      echo "<a href='removeTicket.php?".$gets."'> unbook ticket </a>";
    }
    echo "</p><br>";
  }

  $prep = mysqli_prepare($con,"SELECT * FROM Purchase AS P, Food AS F WHERE P.FoodID = F.FoodID AND P.customer = ?");
  mysqli_stmt_bind_param($prep, "s", $_COOKIE["Cust_User"]);
  mysqli_stmt_execute($prep);
  $result = mysqli_stmt_get_result($prep);
  $count = mysqli_num_rows($result);
  if($count > 0){
    echo "<p>You have purchased ". $count." Food items:</p>";
  }else{
    echo "<p>You do not have any food right now</p>";
  }
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo "<p>";
    echo "Item: ".$row['name']."<br>";
    echo "Size: ".$row['size']."<br>";
    echo "</p><br>";
  }

  ?>

</body>
</html>
