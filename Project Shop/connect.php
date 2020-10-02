<?php
$con= mysqli_connect("localhost","root","","projectshop")
    or die ("Error:".mysqli_error($con));
mysqli_query($con,"SET NAME 'utf8'");
date_default_timezone_set('Asia/Bangkok');
?>