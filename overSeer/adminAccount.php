<?php
if(!isset($_SESSION)) {
	session_start();
}
if(!isset($_SESSION['admName'])) {
  header("Location:Forbidden.html");
  die();
}
?>
<html>
<body>
<img src="../image/image2.gif" style="padding: 50px 20px;
							position: absolute;
							left: 300px;
							width:180px;
							height:200px;">


<div style="padding: 250px 20px;
			position: absolute;
			left: 700px;">
<form>
<input type="button" value="update account info" onclick="window.location.href='editAccount.php'" />
</form>
</div>
</form>
</body>
</html>

 <?php
 //this file display account detail for user and also act as an default page
 //username is passed as parameter
 include("identify.php");
 if( $flag==0){
 include("manPage.php");}
 else{include("adminPage.php");}
//display account detail
  if($count == 1){
	  echo '<div style="position:absolute; top:100px; left: 600px"> username:  '.$username.' </div>';
	  echo '<div style="position:absolute; top:130px; left: 600px"> name:  '.$row["name"].' </div>';
	  echo '<div style="position:absolute; top:160px; left: 600px"> phoneNumber: '.$row["phoneNumber"].' </div>';

//if the account holder is manager, then include manPage.php (manager account setting)
	  if( $flag==0){
		  include("manPage.php");
		  echo '<div style="position:absolute; top:190px; left: 600px"> position: manager </div>';}

//if the account holder is administration, then include adminPage.php (admin account setting)
	  else{
		  include("adminPage.php");
		  echo '<div style="position:absolute; top:190px; left: 600px"> position: administration  </div>';}

	 }
 ?>

