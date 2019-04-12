<?php
if(!isset($_COOKIE["Cust_User"])) {
  header("Location:Forbidden.html");
  die();
}

// Create connection
$con=mysqli_connect("localhost","root","","cinemaDB");

// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$prep = mysqli_prepare($con,"DELETE FROM Ticket WHERE customer = ? AND IMDB = ? AND roomNum = ? AND DTime = ? AND cinemaAddr = ?;");
mysqli_stmt_bind_param($prep, "siiss", $_COOKIE["Cust_User"], $_GET['IMDB'], $_GET['room'], $_GET['DTime'], $_GET['Addr']);
mysqli_stmt_execute($prep);

header("Location:customerAccount.php");
die();
?>
