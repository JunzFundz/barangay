<?php
	//mysql query to select field username if it's equal to the username that we check '  
include "../connection.php";
$result = mysqli_query($con,"select username from tblstaff where username = '".$_POST['username']."' ");
$cnt = mysqli_num_rows($result);
print($cnt);
?>