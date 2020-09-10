<?php 
   session_start();
   if( !isset($_SESSION['mem_id']) ){
      header('Location: ../../../../index.php');  
   }
   if( $_SESSION['mem_status'] <> "admin" ){
      header('Location: ../../../../index.php');  
   }   
?>