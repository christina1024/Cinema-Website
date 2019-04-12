<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Cinema</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {background-image: url("image/images.jpg");
		background-repeat:repeat;
		background-attachment:fixed;
		overflow:scroll;
					font-family:Arial}

		/*{box-sizing: border-box;}*/

		.header{
			background-color: #364247;
			padding: 15px;
		}

		.header a{
			text-decoration: none;
			color: white;
		}

		.topnav{
			overflow: hidden;
			background-color: #5bcfef;
		}

		.topnav a {
			float: left;
			display: block;
			color: white;
			text-align: center;
			padding: 15px 25px;
			text-decoration: none;
			font-size: 17px;
		}

		.dropdown {
			float: left;
			overflow: hidden;
		}

		.dropdown .dropbtn {
			font-size: 17px;
		  cursor: pointer;
		  border: none;
			color: white;
		  outline: none;
		  padding: 15px 25px;
		  background-color: inherit;
			font-family: inherit;
		  margin: 0;
		}

		.topnav a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {background-color: #3d97af}

		.active {background-color: #3d97af}

		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f9f9f9;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		.dropdown-content a {
			float: none;
		  color: black;
		  padding: 15px 25px;
		  text-decoration: none;
		  display: block;
		  text-align: left;
		}

		.dropdown-content a:hover {background-color: #f1f1f1}

		.show {
  		display: block;
		}


	</style>
</head>
<script>

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<body>

<div class="header">
	<a href="index.php"><h1>Fancy Cinema</h1></a>
</div>

<div class="topnav">
	<a href="searchByCinema.php">Show Time</a>
	<a href="searchByMovieName.php">Movie</a>

	<a href="searchFood.php">Food</a>
	<?php
		if(!isset($_COOKIE["Cust_User"])){
			echo "<a style='float:right' href='loginPage.php'>Login as Customer</a>";
		}else{
			echo "<a style='float:right' href='logout.php'>Log Out</a>";
			echo "<a style='float:right' href='customerAccount.php'>Loged in as ". $_COOKIE["Cust_User"]."</a>";
		}

		if(!isset($_SESSION['admName'])){
			echo "<a style='float:right' href='EmployeeLogin.php'>Login as Employee</a>";
		}else {
			echo "<a style='float:right' href='overSeer/adminAccount.php'>Loged in as an Employee</a>";
		}

	?>
</div>


</body>
</html>
