<html><title>Real-time view allotment data</title>
   
        <script type="text/javascript">
               function getLinks(){
                    //use ajax to get the links
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {   
                          document.getElementById("link_wrapper").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "studentinfo.php", true);
                    xhttp.send();
                }

                setInterval( function(){
                    //call getLinks every 5000 milliseconds
                    getLinks();
                },5000);

                //call getLinks on page load
                window.onload = getLinks;
        </script>
   
    <body>

<div id="link_wrapper"></div>

</html>
