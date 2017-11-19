<?php
$check = '';
$q = $_GET['q'];

$con = mysqli_connect('localhost','root','','shilpakaladb');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"shilpakaladb");


 $sql="SELECT * FROM `hallbooking` WHERE `start_date` ='".$q."'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)==0) { 
	echo "f";
	$check = false;
}else{
	$check = true;
	echo "t";
}


mysqli_close($con);
?>
