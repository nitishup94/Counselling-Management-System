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
			background-color: #FDEBD0;
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
    h1{
  color: orange; 
  text-align: center;
  text-decoration: solid;
  font-size: 30px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}
	</style>
  <title>College Allotment List</title>
  <h1>College Allotment List</h1><center><b>(This list can print or export in excel.)</b></center><br>
<?php
include'conn.php';
//select student who has top of rank 
$pref=array();
	$rankselect = mysqli_query($conn,"SELECT * FROM allotment LEFT JOIN student ON  allotment.roll=student.rollno order by student.rank asc");
while($rankst= mysqli_fetch_assoc($rankselect)){
$pref[]=$rankst;
}

$n=count($pref);
echo"<table class='tg'>
<thead>
  <tr>
    <th class='tg-0lax'>Sno.</th>
    <th class='tg-0lax'>Alloted College</th>
    <th class='tg-0lax'>Alloted Branch</th>
    <th class='tg-0lax'>Name</th>
    <th class='tg-0lax'>Roll No.</th>
    <th class='tg-0lax'>Rank</th>
    <th class='tg-0lax'>Alloted Category</th><th class='tg-0lax'>Category</th>
  </tr>
</thead>
<tbody>";
 $i=1;
foreach ($pref as $key => $value) {
	// code...
  // select student name
  $roll=$value['roll'];
  $stnamefull = mysqli_query($conn,"SELECT student.name FROM allotment LEFT JOIN student ON  allotment.roll=student.rollno  where student.rollno='$roll'");
  $stnamep= mysqli_fetch_assoc($stnamefull);
  $stname=$stnamep['name'];
//main category

$maincat=$value['cat'];
$stcat= mysqli_query($conn,"SELECT catname FROM category where catcode='$maincat'");
  $stcatp= mysqli_fetch_assoc($stcat);
  $stcategory=$stcatp['catname'];
  //alloted  category

  $cat=$value['acat'];
  $staltcat= mysqli_query($conn,"SELECT catname FROM category where catcode='$cat'");
    $staltcatp= mysqli_fetch_assoc($staltcat);
    $altcategory=$staltcatp['catname'];
  
//alloted college
$clg=$value['aclgcode'];
$qclg= mysqli_query($conn,"SELECT clname FROM college where clcode='$clg'");
$qclgfetch= mysqli_fetch_assoc($qclg);
$clgname=$qclgfetch['clname'];


$bcode=$value['aclgbcode'];
$qclgb= mysqli_query($conn,"SELECT bname FROM branch where bcode='$bcode'");
$qclgbfetch= mysqli_fetch_assoc($qclgb);
$clgbname=$qclgbfetch['bname'];
$rankofst=$value['arank'];
echo"<tr><td class='tg-0lax'>$i</td><td class='tg-0lax'>$clgname</td><td class='tg-0lax'>$clgbname</td><td class='tg-0lax'>$stname</td><td class='tg-0lax'>$roll</td><td class='tg-0lax'>$rankofst</td><td class='tg-0lax'>$altcategory</td><td class='tg-0lax'> $stcategory</td></tr>";

$i++;

}


echo"</tbody></table>";







?>