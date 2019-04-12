<?php
  if(!isset($_SESSION)) {
    session_start();
  }
  session_unset();
  session_destroy();
  header('Refresh: 3; URL=index.php');
?>

<!DOCTYPE html>
<html>
Ye Have Been Loged Out, if ye do not wish to wait the 3 seconds, ye may click this handy <a href="index.php">word</a>.
</html>
