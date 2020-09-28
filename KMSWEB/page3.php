<?php
  session_start();
  echo 'Welcome to page #3 <p>';
  echo $_SESSION['color'] .'<br>';
  echo $_SESSION['animal'] .'<br>';
  echo $_SESSION['food'] .'<br>';
  echo $_SESSION['drink'] .'<br>';
  echo $_SESSION['hobby'] .'<br>';
  echo date('Y m d H:i:s', $_SESSION['time']);
  //echo '<br /><a href="page3.php">page3</a>';
?>