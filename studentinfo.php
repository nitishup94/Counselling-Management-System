<?php
error_reporting(0);
include'conn.php';

// SQL query to count general student data from database
$gen = mysqli_query($conn,"SELECT sid FROM student where cat=1");
$gencount= mysqli_num_rows($gen);
// SQL query to count OBC student data from database
$obc = mysqli_query($conn, "SELECT sid FROM student where cat=2");
$obccount= mysqli_num_rows($obc);
// SQL query to count sc student data from database
$sc = mysqli_query($conn, "SELECT sid FROM student where cat=3");
$sccount= mysqli_num_rows($sc);
// SQL query to count st student data from database
$st = mysqli_query($conn, "SELECT sid FROM student where cat=4");
$stcount= mysqli_num_rows($st);
// SQL query to count total student data from database
$total = mysqli_query($conn, "SELECT sid FROM student");
$tcount= mysqli_num_rows($total);

//Seat info Category wise

//SQL query to count general seat data from database
$gens = mysqli_query($conn,"SELECT sum(clgseat) as tcount FROM seat where clgcat=1");
$gensum= mysqli_fetch_assoc($gens);
$gencounts=$gensum['tcount'];
// SQL query to count OBC student data from database
$obcs = mysqli_query($conn, "SELECT sum(clgseat) as tcount FROM seat where clgcat=2");
$obcsum= mysqli_fetch_assoc($obcs);
$obccounts=$obcsum['tcount'];
// SQL query to count sc student data from database
$scs = mysqli_query($conn, "SELECT sum(clgseat) as tcount FROM seat where clgcat=3");
$scsum= mysqli_fetch_assoc($scs);
$sccounts=$scsum['tcount'];

// SQL query to count st student data from database
$sts = mysqli_query($conn, "SELECT sum(clgseat) as tcount FROM seat where clgcat=4");
$stsum= mysqli_fetch_assoc($sts);
$stcounts=$stsum['tcount'];

// SQL query to count st student data from database
$totals = mysqli_query($conn, "SELECT sum(clgseat) as tcount FROM seat");
$tsum= mysqli_fetch_assoc($totals);
$tseat=$tsum['tcount'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Seat Details</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		table {
			width: 100%;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			
		}

		td {
			background-color: #E4F5D4;
			border: 1px solid black;
		}
		th {
			background-color: #28B463;
		
		}
		th,
		td {
			
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>

<body>
	<section>
		<h1>Student Info</h1>
		<!-- TABLE CONSTRUCTION-->
		<table>
			<thead>
    <th>GEN</th>
    <th>OBC</th>
    <th >SC</th>
    <th>ST</th><th>Total</th>
  </tr>
</thead>
<tr><td><?php echo $gencount;?></td><td><?php echo $obccount;?></td><td><?php echo $sccount;?></td><td><?php echo $stcount;?></td><td><?php echo $tcount;?></td></tr>
		</table>
	</section>

	<section>
		<h1>Seat Info</h1>
		<!-- TABLE CONSTRUCTION-->
		<table>
			<thead>
    <th>GEN</th>
    <th>OBC</th>
    <th >SC</th>
    <th>ST</th><th>Total</th>
  </tr>
</thead>
<tr><td><?php echo $gencounts;?></td><td><?php echo $obccounts;?></td><td><?php echo $sccounts;?></td><td><?php echo $stcounts;?></td><td><?php echo $tseat;?></td></tr>
		</table>
	</section>
</body>

</html>
