<?php
  session_start();
  echo 'Welcome to page #2 <p>';
  echo $_SESSION['color'] .'<br>';
  echo $_SESSION['animal'] .'<br>';
  $_SESSION['food'] = 'burger';
  $_SESSION['drink'] = 'pepsi';
  $_SESSION['hobby'] = 'skert';
  echo date('Y m d H:i:s', $_SESSION['time']);
  echo '<br /><a href="page3.php">page3</a>';
?>