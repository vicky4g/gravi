<?php
set_time_limit(20000);
  session_start();
   if($_SESSION['expire']!=1)
  {
    header("Location:expire.php");
  }
 ?>
<?php  require("constants.php");
  $connection=mysql_connect(DB_SERVER,DB_USER,DB_PASS);  
  if(!$connection)
  {
     die("Database connection failed ".mysql_error());
  }
  $db=mysql_select_db(DB_NAME,$connection);
  if(!$db)
  {
    die("Database selection failed ".mysql_error());
  } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>	
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" type="text/css" href="css/common.css" />
    	<title>Event Details</title>
	 <link rel="stylesheet" type="text/css" href="css/shadowbox.css">
   <script type="text/javascript" src="js/shadowbox.js"></script>
   <script type="text/javascript">
  Shadowbox.init({
     handleOversize: "drag",
    modal: true
});

function moveCloseLink(){
	var cb=document.getElementById('sb-nav-close');
	var tb=document.getElementById('sb-title');
	if(tb) tb.appendChild(cb);
}
function register(event_id)
{
        

  	Shadowbox.init({
	handleOversize:"drag",
	modal:true,
	player:"html",
	displayCounter:false,
	showMovieControls:false,
	overlayOpacity : 0.5,
	onOpen: moveCloseLink
});
   Shadowbox.open({
		content: 'registering.php?event_id='+event_id+'',
		player: "iframe",
		title: "Registration Details",
		height: 400,
		width: 400,
		onClose: function() {
					window.location.reload();
				}
	        
	});

 
}



</script>
<script>
  function block(id)
  {
	   if(id==51)
	   alert("Registration will be open after results");
	   else
	   alert("The registration is currently closed. Please check in for further details. Contact-9566810725");
  }
</script>

 	</head>
  	<body>
        <div class="main">
            <img class="top" src="images/logo.png" />
            <div class="info">
                graVITas Event Registration
            </div>
            <br />
            <div class="pageinfo">
                EVENT DETAILS
            </div>
            <br />
            <div class="form">
	        
                <table style="text-align:center">
		
      				<tr>
				        <th style="width:200px;" align="left">Category of Events</th>
        				<th style="width:360px;" align="left">Event name</th>
						<th style="width:100px">Team limit</th>
                        <th style="width:100px:">Availability</th>
      				</tr>
		
                    <tr>
                    	<td colspan="3" style="font-size:5px">
                        	<br />
                        </td>
	        
		
                    </tr>
				<?php 
				
				$categories=array('Premium','graVITas Special','RoboTIX','Applied Engineering','BioxSYN','EnviroVision','Management','BuiltriX','ElectroVIT','Bits and Bytes','Quizzes','Workshops','Informals');
				foreach($categories as $b)
			        {
          				if($query=mysql_query("select *from events where category='$b'"))
					 
					  {
						
				 ?>
				 <tr>
				        
                                        <td align="left"><?php echo $b;?></td>				 
					
			        <?php
				        $flag=true;
          					for($x = 0,$numrows = mysql_num_rows($query);$x<$numrows;$x++) 
	  						{  
							
             					if($row = mysql_fetch_array($query))
	     						{
							  
					if($flag==true)
                                          $flag=false;
				        else
					{
				?>
				          <td></td>
					  
					
				<?php
					 }
					?>
					
        				<td style="text-align:left"><?php echo $row["event_name"];?></td>
						<td><?php echo $row["team_limit"];?></td>
                        <?php 
						  $participant=$_SESSION['participant'];
                  if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
          	  $par=$participant+2;
  else
  $par=$participant+1;
                 $event=$row["event_id"];

            		
		$sql2=mysql_query("select * from registrations where event_id='$event_id' order by rec_no desc");
		$k=0;
		while($row1=mysql_fetch_array($sql2))
		{
			$rec_no=$row1['rec_no'];
			$stu_id=$row1['stu_id'];
			$sql3=mysql_query("select confirm,col_name from colg_details where rec_no='$rec_no'");
			if($row2=mysql_fetch_array($sql3))
			{
				$confirm=$row2['confirm'];
				$col_name=$row2['col_name'];
			}
			if($confirm==1)
			{
				$sql4=mysql_query("select * from student_info where stu_id='$stu_id' and rec_no='$rec_no'");
				if($row3=mysql_fetch_array($sql4))
				{
				$k++;
				}
			}
		}
		


                          

						        if($row["active"]==1&&$par<=$row["available"])
								{
							?>
                                  <td>
                                 <?php
								    echo $row["available"]*$row["team_limit"];
								 ?>
                                 </td>
						             <td>
                                        <input class="blue" type="button" value="Register" onclick="register(<?php echo $row['event_id'];?>)">
	                                </td>
					<?php			
					             }
								else
								{
					?>
                                        <td>
                                 <?php
								    echo '0';
								 ?>
                                 </td>
                                       <td>
                                      <input class="blue" type="button" value="Register" onclick="block(<?php echo $row['event_id'];?>)">        
                                      </td>
                    <?php
							    }
						 ?>
								
      				</tr>
      				<?php 
         						}
        					}
						}
				}
       				?>
				
      				
				
				
       			</table>
			
                <div style="text-align:right; width:100%"><input class="blue" type="button" onClick="location.href='receipt.php';" value="Next"></div>
            
        </div>
   </body>
 </html>
      