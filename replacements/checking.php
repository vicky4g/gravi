<html>
 <head>
 </head>
 <body>
<?php
  require("connection.php");
   $teams=mysql_query("select *from teams where no_of_teams>10;");
   for($i=0;$i<mysql_num_rows($teams);$i++)
   {
	   $row=mysql_fetch_array($teams);
	   echo $row['rec_no']." ".$row['event_id']." ".$row['no_of_teams'].'<br/>';
	  
	}
?>
   
  </body>
 </html>