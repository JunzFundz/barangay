<?php include "../connection.php";


?>

<script>
	Morris.Bar({
		element: 'morris-bar-chart2',
		data: [
			<?php

				$start = 0;
				while($start!=100){
					$qry = mysqli_query($con,"select * from tblresident where age like '%$start%'");
					$cnt = mysqli_num_rows($qry);
					echo "{y:'$start',a:$cnt},";
					$start = $start+1;
				}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Age'],
		hideHover: 'auto'
	});

	Morris.Bar({
		element: 'morris-bar-chart3',
		data: [
			<?php

					$qry = mysqli_query($con,"SELECT *,count(*) as cnt FROM tblresident r group by r.zone ");
					while($row=mysqli_fetch_array($qry)){
					echo "{y:'".$row['zone']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Resident per Zone'],
		hideHover: 'auto'
	});

	Morris.Bar({
		element: 'morris-bar-chart4',
		data: [
			<?php

					$qry = mysqli_query($con,"SELECT count(*) as cnt, round(monthlyincome,-1) as income FROM tblresident group by monthlyincome");
					while($row=mysqli_fetch_array($qry)){
					echo "{y:'".$row['income']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Resident with this Income'],
		hideHover: 'auto'
	});
</script>