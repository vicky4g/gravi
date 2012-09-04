<?php session_start();
      if($_SESSION['expire']!=1)
      {
         header("Location:expire.php");
      }      
?>
<?php include("connection.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/common.css"  />
<title>Confirmation</title>
<style type='text/css'>
	table.sample 
	{
		border-width: 1px;
		border-spacing: 0px;
		border-style: solid;
		border-color: #777;
		border-collapse: separate;
	}
	table.sample th 
	{
		border-width: 1px;
		padding: 1px;
		border-style: solid;
		border-color: #777;
		-moz-border-radius: ;
	}
	table.sample td 
	{
		vertical-align:top;
		border-width: 1px;
		padding-top:10px;
		padding-bottom:10px;
		padding-left:10px;
		border-style: solid;
		border-color: #777;
		-moz-border-radius: ;
	}
	span.error {			
    display:inline-block;
    font-size:11px;
    background:transparent url("images/erroricon.png") no-repeat left center;
    padding-left:20px;
    margin-left:10px;
    margin-top:3px;
	}
	span.success 
	{
    display:inline-block;
    font-size:11px;
    background:transparent url("images/checkicon.png") no-repeat left center;
    padding-left:20px;
    color:#200701;
	}
	input.error, select.error {
	border:1px solid #FF0000;
	}
	.field{
    float:left;
    width:auto;
    padding-top:3px;
	}
</style>
<script src="js/jquery-1.4.3.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>
  	<script>   
		$().ready(function() {
			
			$("#ddreg").validate({ 
				errorElement: "span", 
				errorPlacement: function(error, element) {
					error.insertAfter(element);
				},
				success: function(label) {
						label.html("&nbsp;").addClass("success");
						
				},
				rules: { 
				  
				  dd_no: { 
					number : true,
					minlength : 6 
				  },
				  dd_date: { 
					number: true,
					minlength : 1,
					maxlength : 2, 
					min : 1,
					max : 31
				  },
				  dd_month: { 
					number: true,
					minlength : 1,
					maxlength : 2, 
					min : 1,
					max : 12
					
				  },
				  
				  dd_year: {
					number: true,
					min :  2010
				  },
				   
				   dd_amount: { 
					number : true 
				  }
				
				
				  
				 },
		  
				messages: { 
				  dd_no: "&nbsp;",
				  dd_date: "&nbsp;",
				  dd_month: "&nbsp;",
				  dd_year: "&nbsp;",
				  dd_amount: "&nbsp;"
				 
				  
				 } 
				
		  });
		});
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
        	Registration Confirmation
       	</div>
       	<br />
       	<div class="form">
		<table align="center" border="0" style="width:100%">
   				<tr>
     				<td width="10%"> 
                          Registrations
                          </td>
                          <td></td>
                		<td align="center">
       					College name : <?php echo $_SESSION['col_name'];?>
    				</td>
              		<td align="right">
              		<?php
					echo date("d/m/y h:i:s");
					?>
             		</td>
  				</tr>
			</table>
       		<br />
          	<div>
           		Details of Registered Students :
        	</div>
          	<br />
            
            
            
			<?php
			$arr = array(10,49,50,51,1,2,3,4,5,6,45,46,47,48);
			$sno=1;
			$preamt=0;
			$name=0;
			$flag2=false;
			foreach($arr as $event)
			{
				$count=0;
				if($_SESSION['male_leader']==1)
				{
					if($_SESSION["register0_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
			        }
				if($_SESSION['female_leader']==1)
				{
					$i=$_SESSION['participant']+1;
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				for($i=1;$i<=$_SESSION['participant'];$i++)
				{
					if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				if($count>0)
				{
					if($flag2==true)
					{
					 	$flag=false;
					}
					else
					{
					echo'	<div style="color:#fff; font-family:tahoma; font-weight:bold;">
                    		Premium Events :
                    		</div>
                    		<br />
                    		<table align="center" width="100%" class="sample">
  							<tr style="line-height:30px">
    						<th>Events Registered</th>
                       		<th>No. of teams</th>
    				    	<th>Participants registered</th>
                        	<th>Rate</th>
    						<th>Amount Payable</th>
  							</tr>';
					$flag2=true;
					}
					$query=mysql_query("select * from events where event_id = ".$event);
					$row=mysql_fetch_array($query);
                                        $event=$row['event_id'];
					$teams=ceil($count/$row['team_limit']);
					$registered[$event]=$count;
					$_SESSION["event".$event]=$teams;
					$charge=$teams*$row["fee"];
					echo 	'		<tr>
				     	     		<td>		
					       			'.$row['event_name'].'  
                    	   			</td>
									<td align="center">
									'.$teams.'
									</td>
									<td>';
									

                                                                         if($_SESSION['male_leader']==1)
				{
				   if($_SESSION["register0_".$event]=='on')
						{
							echo $_SESSION['name0'].'<br/>';
						}
				}
				if($_SESSION['female_leader']==1)
				{
				   $m=$_SESSION['participant']+1;
				   if($_SESSION['register'.$m.'_'.$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
				}
				for($m=1;$m<=$_SESSION['participant'];$m++)
				{
					if(isset($_SESSION["register".$m."_".$event]))
					{
						if($_SESSION["register".$m."_".$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
					}
				} 



					echo'			</td>
									<td align="center"> '.$row['fee'].'</td>
									<td align="center">'.$charge.'</td>
									</tr>
									';
					$preamt+=$charge;
				}
			}
			?>
                	<?php
			if($confrm==true)
			{
			echo'
			<td colspan="4" align="right">
             		Sub Total :
           			</td>
           			<td align="center">
             		         '.$preamt.'
					</td>	 
				</tr>';
		        }
			?>		
            </table>
            
            
            
            
            
        	<br />
            <div style="color:#fff; font-family:tahoma; font-weight:bold;">
        		Combo Events :
        	</div>
        	<br /> 
			<table style='width: 100%' align="center" class="sample">
				<tr>
					<th>
						Event Name
					</th>
                	<th>
                		Participant Registered
                	</th>
                    <th>
                       No. of teams
                    </th>
					<th style='width:1.3in'>
						No. of Participants
					</th>
				</tr>
			<?php
			$query=mysql_query("select * from events order by event_id asc");
			$sno=1;
			for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				$part[$i]=0;
				for($j=1;$j<=57;$j++)
					$partevent[$i.'_'.$j]=0;
			}
			if($_SESSION['male_leader']==1)
				{
						$part[0]=0;
				for($j=1;$j<=57;$j++)
					$partevent['0_'.$j]=0;
				}
			if($_SESSION['female_leader']==1)
				{
				  $i=$_SESSION['participant']+1;
							$part[$i]=0;
				for($j=1;$j<=57;$j++)
					$partevent[$i.'_'.$j]=0;
				}
			for($event=1;$event<=mysql_num_rows($query);$event++)
			{
				$row=mysql_fetch_array($query);
				if(($event>44 && $event<52) ||($event>=1 && $event<7)||($event==10)||($event>66 && $event<83)||($event>57 && $event<66))
					continue;
				$count=0;
				if($_SESSION['male_leader']==1)
				{
				   if($_SESSION["register0_".$event]=='on')
						{
							$part[0]=1;
							$count++;
							$partevent['0_'.$event]=1;
						}
				}
				if($_SESSION['female_leader']==1)
				{
				   $i=$_SESSION['participant']+1;
				   if($_SESSION['register'.$i.'_'.$event]=='on')
						{
							$part[$i]=1;
							$count++;
							$partevent[$i.'_'.$event]=1;
						}
				}
				for($i=1;$i<=$_SESSION['participant'];$i++)
				{
					if(isset($_SESSION["register".$i."_".$event]))
					{
						if($_SESSION["register".$i."_".$event]=='on')
						{
							$part[$i]=1;
							$count++;
							$partevent[$i.'_'.$event]=1;
						}
					}
				}
				if($count>0)
				{
					$que5=mysql_query("select * from events where event_id = ".$event);
					$r5=mysql_fetch_array($que5);
					$team2=ceil($count/$r5['team_limit']);
					$registered[$event]=$count;
					$_SESSION["event".$event]=$team2;
					echo '<tr>
								<td style=\'padding-left:5px\'>
									'.$row["event_name"].'
								</td>
								<td align="left">';
								
								
				if($_SESSION['male_leader']==1)
				{
				   if($_SESSION["register0_".$event]=='on')
						{
							echo $_SESSION['name0'].'<br/>';
						}
				}
				if($_SESSION['female_leader']==1)
				{
				   $m=$_SESSION['participant']+1;
				   if($_SESSION['register'.$m.'_'.$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
				}
				for($m=1;$m<=$_SESSION['participant'];$m++)
				{
					if(isset($_SESSION["register".$m."_".$event]))
					{
						if($_SESSION["register".$m."_".$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
					}
				}
								
								
								echo'</td>
								    <td align="center">
									'.$team2.'
									</td>
									<td style=\'text-align:center\'>
										'.$count.'
									</td>
						   			</tr>';
				}
			}
			$totalpart=0;
			for($i=1;$i<=$_SESSION['participant'];$i++)
			$totalpart+=$part[$i];
			if($part[0]==1)
			$totalpart+=1;
			$s=$_SESSION['participant']+1;
			if($part[$s]==1)
			$totalpart+=1;
			$comamt=$totalpart*100;
			$accamt=$_SESSION['accomod_m']*300 + $_SESSION['accomod_f']*300;
			echo'<tr>
										<td colspan=\'4\' style="padding:0px">
										</td>
									</tr>
									<tr>
										<td colspan=\'3\' style=\'text-align:right\'>
											Total no. of partcipants :
										</td>
										<td style=\'text-align:center\'>
											'.$totalpart.'
										</td>
									</tr>
									<tr>
										<td colspan=\'3\' style=\'text-align:right\'>
											Amount per participant :
										</td>
										<td style=\'text-align:center\'>
											100
										</td>
									</tr>
									<tr>
										<td colspan=\'3\' style=\'text-align:right;font-weight:bold\'>
											Sub - Total :
										</td>
										<td style=\'text-align:center;font-weight:bold\'>
											'. $comamt .'
										</td>
									</tr>
								</table>
								<br />
				';	
			?>
            
            
            
            
            
            
            
            
            
            			<?php
			$arr = array(68,69,70,71,72,73,74,75,76,77,78,79,80,81,82);
			$sno=1;
			$workamt=0;
			$confrm=false;
			$name=0;
			$flag2=false;
			foreach($arr as $event)
			{
				$count=0;
				if($_SESSION['male_leader']==1)
				{
					if($_SESSION["register0_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
			        }
				if($_SESSION['female_leader']==1)
				{
					$i=$_SESSION['participant']+1;
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				for($i=1;$i<=$_SESSION['participant'];$i++)
				{
					if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				if($count>0)
				{
					if($flag2==true)
					{
					 	$flag=false;
					}
					else
					{
					echo'	<div style="color:#fff; font-family:tahoma; font-weight:bold;">
                    		Workshops :
                    		</div>
                    		<br />
                    		<table align="center" width="100%" class="sample">
  							<tr style="line-height:30px">
    						<th>Events Registered</th>
                       		<th>No. of teams</th>
    				    	<th>Participants registered</th>
                        	<th>Rate</th>
    						<th>Amount Payable</th>
  							</tr>';
					$flag2=true;
					}
					$query=mysql_query("select * from events where event_id = ".$event);
					$row=mysql_fetch_array($query);
                                        $event=$row['event_id'];
					$teams=ceil($count/$row['team_limit']);
					$registered[$event]=$count;
					$_SESSION["event".$event]=$teams;
					$charge=$teams*$row["fee"];
					echo 	'		<tr>
				     	     		<td>		
					       			'.$row['event_name'].'  
                    	   			</td>
									<td align="center">
									'.$teams.'
									</td>
									<td>';
									

                                                                         if($_SESSION['male_leader']==1)
				{
				   if($_SESSION["register0_".$event]=='on')
						{
							echo $_SESSION['name0'].'<br/>';
						}
				}
				if($_SESSION['female_leader']==1)
				{
				   $m=$_SESSION['participant']+1;
				   if($_SESSION['register'.$m.'_'.$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
				}
				for($m=1;$m<=$_SESSION['participant'];$m++)
				{
					if(isset($_SESSION["register".$m."_".$event]))
					{
						if($_SESSION["register".$m."_".$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
					}
				} 



					echo'			</td>
									<td align="center"> '.$row['fee'].'</td>
									<td align="center">'.$charge.'</td>
									</tr>
									';
					$workamt+=$charge;
				}
			}
			?>
                	<?php
			if($confrm==true)
			{
			echo'
			<td colspan="4" align="right">
             		Sub Total :
           			</td>
           			<td align="center">
             		         '.$workamt.'
					</td>	 
				</tr>';
		        }
			?>		
            </table>
            
            
            
            
            
            
            
            
            <br/>
            <?php
			$arr = array(58,59,60,61,62,63,64,65,67);
			$sno=1;
			$informal=0;
			$name=0;
			$flag2=false;
			foreach($arr as $event)
			{
				$count=0;
				if($_SESSION['male_leader']==1)
				{
					if($_SESSION["register0_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
			        }
				if($_SESSION['female_leader']==1)
				{
					$i=$_SESSION['participant']+1;
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				for($i=1;$i<=$_SESSION['participant'];$i++)
				{
					if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
					{
					$confrm=true;
					$count++;
					}
				}
				if($count>0)
				{
					if($flag2==true)
					{
					 	$flag=false;
					}
					else
					{
					echo'	<div style="color:#fff; font-family:tahoma; font-weight:bold;">
                    		Informal Events :
                    		</div>
                    		<br />
                    		<table align="center" width="100%" class="sample">
  							<tr style="line-height:30px">
    						<th>Events Registered</th>
                       		<th>No. of teams</th>
    				    	<th>Participants registered</th>
                        	<th>Rate</th>
    						<th>Amount Payable</th>
  							</tr>';
					$flag2=true;
					}
					$query=mysql_query("select * from events where event_id = ".$event);
					$row=mysql_fetch_array($query);
                                        $event=$row['event_id'];
					$teams=ceil($count/$row['team_limit']);
					$registered[$event]=$count;
					$_SESSION["event".$event]=$teams;
					$charge=$teams*$row["fee"];
					echo 	'		<tr>
				     	     		<td>		
					       			'.$row['event_name'].'  
                    	   			</td>
									<td align="center">
									'.$teams.'
									</td>
									<td>';
									

                                                                         if($_SESSION['male_leader']==1)
				{
				   if($_SESSION["register0_".$event]=='on')
						{
							echo $_SESSION['name0'].'<br/>';
						}
				}
				if($_SESSION['female_leader']==1)
				{
				   $m=$_SESSION['participant']+1;
				   if($_SESSION['register'.$m.'_'.$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
				}
				for($m=1;$m<=$_SESSION['participant'];$m++)
				{
					if(isset($_SESSION["register".$m."_".$event]))
					{
						if($_SESSION["register".$m."_".$event]=='on')
						{
							echo $_SESSION['name'.$m].'<br/>';
						}
					}
				} 



					echo'			</td>
									<td align="center"> '.$row['fee'].'</td>
									<td align="center">'.$charge.'</td>
									</tr>
									';
					$informal+=$charge;
				}
			}
			?>
                	<?php
			if($confrm==true)
			{
			echo'
			<td colspan="4" align="right">
             		Sub Total :
           			</td>
           			<td align="center">
             		         '.$informal.'
					</td>	 
				</tr>';
		        }
				$total= $preamt + $comamt + $accamt+$workamt+$informal;
			?>		
            </table>
            
            
            
            
            
            
            
            
            
            
            
            
           	<br />
        	<div style="color:#fff; font-family:tahoma; font-weight:bold;">
        		Accomodation:
        	</div>
        	<br /> 
			<?php		
			echo'<table style=\'width: 100%\' align="center" border="2" class="sample" >
									<tr>
										<th style=\'width:0.8in\'>
											S. No.
										</th>
										<th>
											Gender
										</th>
										<th style=\'width:1.5in\'>
											No. of Members
										</th>
										<th>
											Rate
										</th>
										<th style=\'width:1.3in\'>
											Amount
										</th>
									</tr>
									<tr>
										<td style=\'text-align:center\'>
											1
										</td>
										<td style=\'padding-left:5px\'>
											Male
										</td>
										<td style=\'text-align:center\'>
											'.$_SESSION['accomod_m'].'
										</td>
										<td style=\'text-align:center\'>
											300
										</td>
										<td style=\'text-align:center\'>
											'. $_SESSION['accomod_m']*300 .'
										</td>
									</tr>
									<tr>
										<td style=\'text-align:center\'>
											2
										</td>
										<td style=\'padding-left:5px\'>
											Female
										</td>
										<td style=\'text-align:center\'>
											'.$_SESSION['accomod_f'].'
										</td>
										<td style=\'text-align:center\'>
											300
										</td>
										<td style=\'text-align:center\'>
											'. $_SESSION['accomod_f']*300 .'
										</td>
									</tr>
									<tr>
										<td colspan=\'4\' style=\'text-align:right; font-weight:bold\'>
											Sub - Total :
										</td>
										<td style=\'text-align:center;font-weight:bold\'>
											'.$accamt.'
										</td>
									</tr>
								</table>
								<br />
								<table style=\'width: 100%\'>
									<td style=\'text-align:right; font-weight:bold\'>
										Total Amount :
									</td>
									<td style=\'text-align:center;font-weight:bold;width:1.3in\'>
										'. $total .'
									</td>
								</table>
			';
			?>
            <br />
            <br />
        	<form action="database_update.php" method="post" id="ddreg" name="ddreg">
        	<div style="float:left;">
        	Payment Mode &nbsp; &nbsp; &nbsp; &nbsp;
        	</div>
        	<div style="float:left">
        	:  &nbsp; &nbsp; &nbsp; &nbsp;
        	</div>
        	<div>
        	<select name="mode">
		  				<option value="dd">By Demand draft</option>
		  				
			</select>
        	</div>
            <div>
            	<table width="100%" align="center">
                     <tr style="visibility:hidden">
                    	<td>
                        DD Number
                        </td>
                        <td>
                        Date/Month/Year
                        </td>
                        <td>
                        Amount
                        </td>
                        <td>
                        Bank Name
                        </td>
                    </tr>
                    <tr  style="visibility:hidden">
                    	<td align="left" width="25%">
                        <input type="text" name="dd_no"  />
                        </td>
                        <td align="left" width="35%">
                       <input type="text" name="dd_date" size="1" />&nbsp;/&nbsp; 
                        <input type="text" name="dd_month"  size="1"  />&nbsp;/&nbsp; 
                         <input type="text" name="dd_year"  size="2"  />
                        </td>
                        <td align="left" width="20%">
                        <input type="text" name="dd_amount" style="color:#666"  value="<?php echo $total;?>" readonly="readonly" "size="6"/>
                        </td>
                        <td align="left" width="25%">
                         <input type="text" name="dd_bank"  />
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="4">
                        	<div id="error" style="display:none;color:red;text-align:justify">
                            	<br />
                            	Some participants have registered for more than 10 combo events. Please go back to event registration page and remove some events.
                            </div>
                        </td>
                    </tr>
              	 	<tr>
                                        <tr>
                    	<td colspan="4">
                        	<div id="error2" style="display:none;color:red;text-align:justify">
                            	<br />
                            	Required number of registrations are not available for some events. Please check the availability.
                            </div>
                        </td>
                    </tr>
                    	<td colspan="4" >
                        <br />
                        <div style="width:100%;text-align:right">
                        	<input class="blue" type="button" value="Go Back" id="back" onclick="window.location='event_detail.php'" />
                        	<input class="blue" type="submit" value="Confirm" id="confirm" />
                        </div>
                        </td>
                    </tr>
                    
                 </table>
            
            </div>
      		</form>
		</table>
       </div>
	</div>     
    <?php
	    if($_SESSION['male_leader']==1)
		{
			for($j=1;$j<=57;$j++)
					$parttotal[0]+=$partevent['0_'.$j];
				 if($parttotal[0]>10)
				{
					echo "<script>\n";
					echo "document.getElementById('error').style.display='block';\n";
					echo "document.getElementById('confirm').disabled='disabled';\n </script>\n";
				}
		}
		
		if($_SESSION['female_leader']==1)
		{
			$i=$_SESSION['participant']+1;
			for($j=1;$j<=57;$j++)
					$parttotal[$i]+=$partevent[$i.'_'.$j];
				 if($parttotal[$i]>10)
				{
					echo "<script>\n";
					echo "document.getElementById('error').style.display='block';\n";
					echo "document.getElementById('confirm').disabled='disabled';\n </script>\n";
				}
		}
		for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				$parttotal[$i]=0;
				for($j=1;$j<=57;$j++)
					$parttotal[$i]+=$partevent[$i.'_'.$j];
				 if($parttotal[$i]>10)
				{
					echo "<script>\n";
					echo "document.getElementById('error').style.display='block';\n";
					echo "document.getElementById('confirm').disabled='disabled';\n </script>\n";
					break;
				}
			}
		$reg=mysql_query("select *from events;");
		for($i=0;$i<mysql_num_rows($reg);$i++)
		{
		   $row=mysql_fetch_array($reg);
		   $left=$row['available']*$row['team_limit'];
		   $id=$row['event_id'];
		   if($left<$registered[$id])
		   {
			   		   echo $left." ".$registered[$id];
			   echo "<script>\n";
					echo "document.getElementById('error2').style.display='block';\n";
					echo "document.getElementById('confirm').disabled='disabled';\n </script>\n";
					break;
		    }
		}
			
			
	?>          	
</body>
</html>