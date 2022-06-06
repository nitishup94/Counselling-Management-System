
<?php
error_reporting(0);
include'conn.php';

// SQL query to select data from database
$sql = "SELECT * FROM clgbranch";
$res = mysqli_query($conn, $sql);

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
			color: #006600;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
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
		<h1>Seat Matrix</h1>
		<!-- TABLE CONSTRUCTION-->
		<table>
			<thead>
  <tr>
    <th rowspan="2">SrNo.</th>
    <th class="tg-0lax" rowspan="2">College Name</th>
    <th rowspan="2">Branch Code</th>
    <th colspan="5">Category wise Seat</th>
    
  </tr>
  <tr>
    <th>GEN</th>
    <th>OBC</th>
    <th >SC</th>
    <th>ST</th><th>Total</th>
  </tr>
</thead>
			<!-- PHP CODE TO FETCH DATA FROM ROWS-->
			<?php // LOOP TILL END OF DATA
			$i=1;
			
				while($rows= mysqli_fetch_array($res))
				{
$clgcode=$rows['clgcode'];
$clgbranch=$rows['clgbcode'];

$clgname = "SELECT * FROM college where clcode=$clgcode";
$resclg = mysqli_query($conn, $clgname);
$clgrow=mysqli_fetch_assoc($resclg);
$collegename=$clgrow['clname'];
//branch name
$resclgb = mysqli_query($conn, "SELECT * FROM branch where bcode=$clgbranch");
$clgrowb=mysqli_fetch_assoc($resclgb);
$branchname=$clgrowb['bname'];

?>
			<tr>
				<!--FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN-->
					<td><?php echo $i;?></td>
				<td><?php echo $collegename;?></td>
				<td><?php echo $branchname;?></td>

<?php

$seat = "SELECT *FROM seat where clgcode='$clgcode' and clgbcode='$clgbranch' order by clgcat asc";
$seatinfo = mysqli_query($conn, $seat);
$sumseat=0;
while($seatrow= mysqli_fetch_array($seatinfo)){
$clgseat=$seatrow['clgseat']; 
$sumseat=$clgseat+$sumseat;
echo"<td>$clgseat</td>";
}
echo"<td>$sumseat</td>";
$gsum=$sumseat+$gsum;

?>		</tr>
		
			
			<?php
			$i++;
				}

			?>
			<tr><td colspan="7">Grand Total</td><td><?php echo $gsum;?></td></tr>
		</table>
	</section>
</body>

</html>
