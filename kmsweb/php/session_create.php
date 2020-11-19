<?php 
@session_start();
switch($_POST['mode']){
	case "inv":
      $_SESSION['inv_rid'] = ($_POST['inv_rid'])?$_POST['inv_rid']:'01';
	  $_SESSION['inv_sid'] = ($_POST['inv_sid'])?$_POST['inv_sid']:'01';
	  $_SESSION['inv_date'] = ($_POST['inv_date'])?$_POST['inv_date']:date('Y-m-d');
    break;
	case "bo":
      $_SESSION['bo_rid'] = ($_POST['bo_rid'])?$_POST['bo_rid']:'01';
	  $_SESSION['bo_sid'] = ($_POST['bo_sid'])?$_POST['bo_sid']:'01';
	  $_SESSION['bo_date'] = ($_POST['bo_date'])?$_POST['bo_date']:date('Y-m-d');
    break;
}
header('location: ../'.$_POST['mode'].'_gen_create.php');
?>