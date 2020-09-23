<?php
  session_start();
  echo 'Welcome to page #1';
  $_SESSION['color'] = 'green';
  $_SESSION['animal'] = 'cat';
  $_SESSION['time'] = time();
  echo '<br /><a href="page2.php">page2</a>';
  echo '<br /><a href="page3.php">page3</a>';
?>