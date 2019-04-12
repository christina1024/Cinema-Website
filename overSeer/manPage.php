<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if(!isset($_SESSION['admName'])) {
		header("Location:Forbidden.html");
		die();
	}
	include("identify.php");
	if( $flag==1){
		header("Location:Forbidden.html");
		die();
	}

$username = $_SESSION['admName'];

?>
<!DOCTYPE html>
<html>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 20%;
  background: rgba(135, 211, 124, 0.5);
  position: fixed;
  height: 97%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 15px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #4CAF50;
  color: white;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}

body {

  background-image: url("../image/image3.jpg");
  background-repeat:repeat;
	background-attachment:fixed;
	overflow:scroll;
  background-size: cover;
}
</style>

<body>

<ul>
  <li><a class="active" href="adminAccount.php">Home</a></li>
  <li><a href="searchPeople.php">Search Customer</a></li>
  <li><a href="searchShowTime.php">Search ShowTime</a></li>
  <li><a href="searchMovie.php">Add ShowTime</a></li>
  <li><a href="editAccount.php">Manage Account</a></li>
  <li><a href="../EmployeeLogout.php">Logout</a></li>
</ul>

</body>
</html>
