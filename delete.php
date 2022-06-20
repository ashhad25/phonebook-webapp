<?php
require 'db.php';
$getid = $_GET['deleteid'];
$query = "DELETE FROM contactdetails WHERE contact_id = '$getid'";
$query_run = mysqli_query($dbcon,$query);
$que = "SELECT * FROM contactdetails";
$que_run = mysqli_query($dbcon,$que);
$rowcount=mysqli_num_rows($que_run);
if ($rowcount < 1) {
	$qu = "TRUNCATE TABLE contactdetails";
	$qu_run = mysqli_query($dbcon,$qu);
}
if($query_run){
	header('Location:view_user2.php');
}else{
	echo 'Error while deleting user record';
}

?>