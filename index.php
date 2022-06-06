
<?php
error_reporting(0);
include'conn.php';

// SQL query to count general student data from database
$gen = mysqli_query($conn,"SELECT sid FROM student");
$total= mysqli_num_rows($gen);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Counselling Management System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <style type="text/css">
    body{
    background: url("bg.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
  }
  
 /* Transparent Layer */
  .a{
    background-color: rgb(250,250,250,0.2);
    width: 60%;
    border: 2px solid white;
    margin: 100px 200px 200px 200px;
    border-radius: 20px;
  }

  /* Textbox Styling */
 .b{

  width: 60%;
  padding: 12px 20px;
  margin: 8px 0;
  border: 1px solid white;
  border-radius: 4px;
 } 
 
 /* Checkbox Text Styling */
 .c{
   color: black;
   word-spacing: 2px;
   font-family: 'Courier New', Courier, monospace;
   padding-right: 275px;
 }
 
 /* Button Styling */
 .button{
   color: white;
   background-color: dodgerblue;
   width: 65%;
   padding: 12px 20px;
   margin: 8px 0;
   border: 1px solid white;
   border-radius: 4px;
 }
 
 /* Button Hover Styling */
 input[type=button]:hover {
  background-color: green;

 }
  
 /* Heading Styling */
h1{
  color: orange; 
  text-align: center;
  text-decoration: solid;
  font-size: 30px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}

h2{
  color: black;
  text-decoration: solid;
  font-size: 20px;
  letter-spacing: 2px;
  word-spacing: 2px;
}
 
/* Hyperlink Underline Disabled */
a{
  text-decoration: none;
}
  </style>
</head>
<body>
  <center>
  <div class="a">
 <form> 
   <h1>Counselling Management System </h1>
   <center>
   <input class="b" type="text" name="nextrange" placeholder="Strat From" id="nextrange"/><br>
     <br>
  <input class="b" type="number" name="pack" placeholder="No. of loops" id="pack" autocomplete="off" />
   <br>
    
  
   <input  class="button" type="button" value="Start Counselling !" id="submit"><br><br>
   <h2><a href="index.php">Home</a> || <a href="seatinfo.php" target="_blank">Seat Matrix</a> || <a href="liveseatinfo.php" target="_blank">Real-time Seat info</a> || <a href="allotment_result.php" target="_blank">Allotment Result</a>   </h2>
   </center>
   </center>
 </form>
   </div>

   <script>
    $(document).ready(function() {

      $("#submit").click(function() {


  var start = $("#nextrange").val();
var packet = $("#pack").val();
//max size for loop
        var maxsize=<?php echo $total+1;?>;
        if(maxsize-start>packet){
          var main=packet;
        }
        if(maxsize-start<=packet){
          var main=maxsize-start;
        
        }
        $.ajax({
          type: "POST",
          url: "allotment.php",
          data: {
            loopcn: main,
            nlp:start
          },
          cache: false,
          success: function(data) {
       if(data<maxsize){


       $('#nextrange').val(data);

         $("#submit").click();
       }
        else{alert("Seats have been alloted to students according to preference and cast reservation.");
          window.location.href = "allotment_result.php";
        }

          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });
        


      });

    });
  </script>
</body>
</html>