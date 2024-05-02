<?php include "../connection.php";?>
<script>
	Morris.Donut({
		element: 'morris-donut-chart',
		data: [{
			label: "No schooling completed",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'No schooling completed' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Elementary",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'Elementary' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "High school, undergrad",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'High school, undergrad' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "High school graduate",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'High school graduate' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "College, undergrad",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'College, undergrad' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Vocational",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'Vocational' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Bachelor's degree",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'Bachelor''s degree' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Master's degree",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'Master''s degree' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Doctorate degree",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblresident where highestEducationalAttainment = 'Doctorate degree' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}],
		resize: true
	});
</script>