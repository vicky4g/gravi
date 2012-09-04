<?php
  require("connection.php");
  $rec_no=mysql_query("select *from colg_details;");
  for($i=1;$i<=mysql_num_rows($rec_no);$i++)
  {
	  $rec=mysql_fetch_array($rec_no);
	  $rec=$rec['rec_no'];
	  echo $rec." ";
      $regis=mysql_query("select *from registrations where rec_no=".$i.";");   
	  for($j=0;$j<mysql_num_rows($regis);$j++)
	  {
		  $row=mysql_fetch_array($regis);
		  $temp=$row['event_id'];
		  echo $temp." ";
		  $k[$temp]++;
	  }
	  echo '<br/>';
	  for($x=1;$x<83;$x++)
	   {
		   echo $k[$x]." ";
	   }
	  echo '<br/>';
	   for($x=1;$x<83;$x++)
	   {
		   if($k[$x]>0)
	       {
			     $teams=mysql_query("select * from events where event_id=".$x.";");
				 $teams=mysql_fetch_array($teams);
				 $teams=$teams['team_limit'];
				 if($teams>0)
				 $teams=ceil($k[$x]/$teams);
			     mysql_query("insert into teams(
	                                      rec_no,
	                                      event_id,
										  no_of_teams
			                              )
								    values( 
									        '{$rec}',
									        '{$x}',
									       '{$teams}'
									     );
						  ");
		   }
		   $k[$x]=0;
	   }
  }
	  