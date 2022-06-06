<?php
error_reporting(0);
//connect to database
include'conn.php';
if(isset($_POST['loopcn']))
{  
 $lp=$_POST['loopcn'];
 $nextlp=$_POST['nlp'];
  $point_s=$nextlp;
for($i=0; $i<$lp; $i++){  
   
    $point_s++;
//select student who has top of rank 
	$rankselect = mysqli_query($conn,"SELECT rollno,cat,rank FROM student where status NOT IN (1,2) order by rank asc limit 1");
$rankst= mysqli_fetch_assoc($rankselect);
$roll=$rankst['rollno'];
$cat=$rankst['cat'];
$rankofst=$rankst['rank'];

//check student preference
$pselect = mysqli_query($conn,"SELECT * FROM pref  where rollno=$roll order by pno asc");

//store student's preference in array
$pref=array();

while($prow= mysqli_fetch_assoc($pselect)){

	$pref[]=$prow;
}

//count array length
$plength=count($pref);
//counter
$c=0;
//extract value from preference array
foreach ($pref as $value) {
$ccode=$value['clgcode'];
$bcode=$value['bcode'];
$pn=$value['pno'];

//select seat table for preference
//SQL query to select general seat data from database
$checkp = mysqli_query($conn,"SELECT clgseat FROM seat where clgcode=$ccode and clgbcode=$bcode and clgcat=1");
$chpref= mysqli_fetch_assoc($checkp);
$prefseat=$chpref['clgseat'];
if($prefseat>0){
//insert into allotment table
	$altsql = "INSERT INTO `allotment`(`roll`, `acat`, `aclgcode`, `aclgbcode`, `arank`, `prefno`)
VALUES ('$roll','1','$ccode','$bcode','$rankofst','$pn')";
$nk=mysqli_query($conn,$altsql);
//if intertion is done the flag to student database
if($nk){
$altstatus = "UPDATE `student` SET `status`='1' WHERE rollno=$roll";
$altflag=mysqli_query($conn,$altstatus);

//update student seat after allotment
$newseat=$prefseat-1;
$altseat = "UPDATE `seat` SET `clgseat`='$newseat' WHERE clgcode=$ccode and clgbcode=$bcode and clgcat=1";
$upseat=mysqli_query($conn,$altseat);

}
//break here
unset($pref);
break;
}
$c++;

}
//if general category null for this student then allotement special category
if($plength-$c==0){
	
$pylength=count($pref);
$p=0;
foreach ($pref as $pvalue) {
$pccode=$pvalue['clgcode'];
$pbcode=$pvalue['bcode'];
$ppn=$pvalue['pno'];

//select seat table for preference
//SQL query to select general seat data from database
$pcheckp = mysqli_query($conn,"SELECT clgseat FROM seat where clgcode=$pccode and clgbcode=$pbcode and clgcat=$cat");
$pchpref= mysqli_fetch_assoc($pcheckp);
$pprefseat=$pchpref['clgseat'];

if($pprefseat==0 and $cat==1){

$genstatus = "UPDATE `student` SET `status`='2' WHERE rollno=$roll";
$genflag=mysqli_query($conn,$genstatus);

}

if($pprefseat>0){

//insert into allotment table
	$paltsql = "INSERT INTO `allotment`(`roll`, `acat`, `aclgcode`, `aclgbcode`, `arank`, `prefno`)
VALUES ('$roll','$cat','$pccode','$pbcode','$rankofst','$ppn')";
$pnk=mysqli_query($conn,$paltsql);

//if intertion is done the flag to student database
if($pnk){
	
$paltstatus = "UPDATE `student` SET `status`='1' WHERE rollno=$roll";
$paltflag=mysqli_query($conn,$paltstatus);
if($paltflag){  
//update student seat after allotment
$pnewseat=$pprefseat-1;
$paltseat = "UPDATE `seat` SET `clgseat`='$pnewseat' WHERE clgcode=$pccode and clgbcode=$pbcode and clgcat=$cat";
$pupseat=mysqli_query($conn,$paltseat);

//unset all variable
unset($pprefseat,$pnewseat,$cat,$pccode,$pbcode);
}

}
unset($pref);
//break here
break;

}
$p++;
}
if($pylength-$p==0){

	$catstatus = "UPDATE `student` SET `status`='2' WHERE rollno=$roll";
$catflag=mysqli_query($conn,$catstatus); 
}

}




}
echo $point_s;
}
 
	?>


