<?php
	include "../connection.php";
	if(isset($_POST['hhold_id'])){

		$hhold_id = $_POST['hhold_id'];
		$query = mysqli_query($con,"select *,id as resID
									from tblresident  
									where householdnum = '$hhold_id' ") or die('Error: ' . mysqli_error($con));
		$rowCount = mysqli_num_rows($query);

		if($rowCount > 0){
			echo '<option value="" disabled selected>-- Select Head of Family -- </option>';
			while($row = mysqli_fetch_array($query))
			{
				echo '<option value="'.$row['resID'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
			}
		}
		else {
			echo '<option value="" disabled selected>-- No Existing Head of Family for Household # entered --</option>';
		}
	}


	if(isset($_POST['total_id'])){

		$total_id = $_POST['total_id'];
		$query = mysqli_query($con,"select *,id as resID
									from tblresident  
									where id = '$total_id' ") or die('Error: ' . mysqli_error($con));
		$rowCount = mysqli_num_rows($query);

		if($rowCount > 0){
			
			while($row = mysqli_fetch_array($query))
			{
				echo "<script>document.getElementsByName('txt_totalmembers')[0].value = ".$row['totalhousehold'].";</script>";
			}
		}
		else {
			echo '<option value="" disabled selected>-- No Existing Head of Family for Household # entered --</option>';
		}
	}



?>