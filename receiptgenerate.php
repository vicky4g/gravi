<?php session_start(); 
   if($_SESSION['expire']!=1)
  {
    header("Location:expire.php");
  }
?>
<?php require("connection.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generating Receipt</title>
</head>

<body>
	<?php
		$content="<html>
						<head>
							<title>graVITas 2011 Receipt</title>
							<style type='text/css'>
								table.sample {
									border-width: 1px;
									border-spacing: 0px;
									border-style: outset;
									border-color: gray;
									border-collapse: separate;
									background-color: white;
								}
								table.sample th {
									border-width: 1px;
									padding: 1px;
									border-style: solid;
									border-color: gray;
									background-color: white;
									-moz-border-radius: ;
								}
								table.sample td {
									border-width: 1px;
									padding: 1px;
									border-style: solid;
									border-color: gray;
									background-color: white;
									-moz-border-radius: ;
								}
								</style>
						</head>
						<body style='width:8.27 in; margin:0px; padding:0px'>
							<div style='width:100%;font-size:30px;text-align:center;height:50px;font-weight:bold;padding-top:10px'>
                                                            graVITas Receipt
                                                            <hr />
                                                        </div>
							<div style='width:90%; margin:0 auto; padding-top:10px;'>
								<table style='width:100%'>
									<tr>
										<td>
											<span style='font-weight:bold'>Receipt No : ".$_SESSION['rec_no']."</span>
										</td>
										<td style='text-align:right'>
											".date("d/m/y h:i:s")."
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											College : ". $_SESSION['col_name'] ."
										</td>
									</tr>
								</table>
								<br />
								
								<span style='font-weight:bold'>Premium Events</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<th style='width:0.8in'>
											S. No.
										</th>
										<th>
											Event Name
										</th>
										<th>
											No. of Participants
										</th>
										<th>
											No. of Teams
										</th>
										<th>
											Rate
										</th>
										<th style='width:1.3in'>
											Amount
										</th>
									</tr>
									";
		$arr = array(10,49,50,51,1,2,3,4,5,6,45,46,47,48);
		$sno=1;
		$preamt=0;
		foreach($arr as $event)
		{
			$count=0;
			if($_SESSION['male_leader']==1)
			{
				if($_SESSION["register0_".$event]=='on')
						$count++;
			}
			if($_SESSION['female_leader']==1)
			{
				$i=$_SESSION['participant']+1;
				if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			if($count>0)
			{
				$query=mysql_query("select * from events where event_id = ".$event);
				$row=mysql_fetch_array($query);
				$teams=ceil($count/$row['team_limit']);
				$charge=$teams*$row["fee"];
				$content.="<tr>
								<td style='text-align:center'>
									".$sno."
								</td>
								<td style='padding-left:5px'>
									".$row["event_name"]."
								</td>
								<td style='text-align:center'>
									".$count."
								</td>
								<td style='text-align:center'>
									".$teams."
								</td>
								<td style='text-align:center'>
									".$row['fee']."
								</td>
								<td style='text-align:center'>
									".$charge."
								</td>
						   </tr>";
				$sno++;
				$preamt+=$charge;
			}
		}
		$content.="					<tr>
										<td colspan='5' style='text-align:right; font-weight:bold'>
											Sub - Total :
										</td>
										<td style='text-align:center;font-weight:bold'>
											".$preamt."
										</td>
									</tr>
								</table>
								<br />
								
								
								
								
								<span style='font-weight:bold'>Combo Events</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<th style='width:0.8in'>
											S. No.
										</th>
										<th style='text-align:left'>
											Event Name
										</th>
										<th style='text-align:center'>
											No. of teams
										</th>
										<th style='width:1.3in'>
											No. of Participants
										</th>
									</tr>
								";
		$query=mysql_query("select * from events order by event_id asc");
		$sno=1;
		for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				$part[$i]=0;
			}
			if($_SESSION['male_leader']==1)
				{
						$part[0]=0;
				}
			if($_SESSION['female_leader']==1)
				{
				  $i=$_SESSION['participant']+1;
							$part[$i]=0;
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
					}
			}
			if($_SESSION['female_leader']==1)
			{
				$i=$_SESSION['participant']+1;
				if($_SESSION["register".$i."_".$event]=='on')
					{
						$part[$i]=1;
						$count++;
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
					}
				}
			}
			if($count>0)
			{
				$que5=mysql_query("select * from events where event_id = ".$event);
					$r5=mysql_fetch_array($que5);
					$team2=ceil($count/$r5['team_limit']);
				$content.="<tr>
								<td style='text-align:center'>
									".$sno."
								</td>
								<td style='padding-left:5px'>
									".$row["event_name"]."
								</td>
								<td align='center'>
									".$team2."
									</td>
								<td style='text-align:center'>
									".$count."
								</td>
						   </tr>";
				$sno++;
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
		$content.="					<tr>
										<td colspan='4'>
										</td>
									</tr>
									<tr>
										<td colspan='3' style='text-align:right'>
											Total no. of participants :
										</td>
										<td style='text-align:center'>
											".$totalpart."
										</td>
									</tr>
									<tr>
										<td colspan='3' style='text-align:right'>
											Amount per participant :
										</td>
										<td style='text-align:center'>
											100
										</td>
									</tr>
									<tr>
										<td colspan='3' style='text-align:right;font-weight:bold'>
											Sub - Total :
										</td>
										<td style='text-align:center;font-weight:bold'>
											". $comamt ."
										</td>
									</tr>
								</table>
								<br />
								
								
								
								
								
								
								
								<span style='font-weight:bold'>Workshops</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<th style='width:0.8in'>
											S. No.
										</th>
										<th>
											Event Name
										</th>
										<th>
											No. of Participants
										</th>
										<th>
											No. of Teams
										</th>
										<th>
											Rate
										</th>
										<th style='width:1.3in'>
											Amount
										</th>
									</tr>
									";
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
						$count++;
			}
			if($_SESSION['female_leader']==1)
			{
				$i=$_SESSION['participant']+1;
				if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			if($count>0)
			{
				$query=mysql_query("select * from events where event_id = ".$event);
				$row=mysql_fetch_array($query);
				$teams=ceil($count/$row['team_limit']);
				$charge=$teams*$row["fee"];
				$content.="<tr>
								<td style='text-align:center'>
									".$sno."
								</td>
								<td style='padding-left:5px'>
									".$row["event_name"]."
								</td>
								<td style='text-align:center'>
									".$count."
								</td>
								<td style='text-align:center'>
									".$teams."
								</td>
								<td style='text-align:center'>
									".$row['fee']."
								</td>
								<td style='text-align:center'>
									".$charge."
								</td>
						   </tr>";
				$sno++;
				$workamt+=$charge;
			}
		}
		$content.="					<tr>
										<td colspan='5' style='text-align:right; font-weight:bold'>
											Sub - Total :
										</td>
										<td style='text-align:center;font-weight:bold'>
											".$workamt."
										</td>
									</tr>
								</table>
								<br />
                                <span style='font-weight:bold'>Informal Events</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<th style='width:0.8in'>
											S. No.
										</th>
										<th>
											Event Name
										</th>
										<th>
											No. of Participants
										</th>
										<th>
											No. of Teams
										</th>
										<th>
											Rate
										</th>
										<th style='width:1.3in'>
											Amount
										</th>
									</tr>
									";
		$arr = array(58,59,60,61,62,63,64,65,67);
		$sno=1;
		$informal=0;
		foreach($arr as $event)
		{
			$count=0;
			if($_SESSION['male_leader']==1)
			{
				if($_SESSION["register0_".$event]=='on')
						$count++;
			}
			if($_SESSION['female_leader']==1)
			{
				$i=$_SESSION['participant']+1;
				if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			for($i=1;$i<=$_SESSION['participant'];$i++)
			{
				if(isset($_SESSION["register".$i."_".$event]))
					if($_SESSION["register".$i."_".$event]=='on')
						$count++;
			}
			if($count>0)
			{
				$query=mysql_query("select * from events where event_id = ".$event);
				$row=mysql_fetch_array($query);
				$teams=ceil($count/$row['team_limit']);
				$charge=$teams*$row["fee"];
				$content.="<tr>
								<td style='text-align:center'>
									".$sno."
								</td>
								<td style='padding-left:5px'>
									".$row["event_name"]."
								</td>
								<td style='text-align:center'>
									".$count."
								</td>
								<td style='text-align:center'>
									".$teams."
								</td>
								<td style='text-align:center'>
									".$row['fee']."
								</td>
								<td style='text-align:center'>
									".$charge."
								</td>
						   </tr>";
				$sno++;
				$informal+=$charge;
			}
		}
		$content.="					<tr>
										<td colspan='5' style='text-align:right; font-weight:bold'>
											Sub - Total :
										</td>
										<td style='text-align:center;font-weight:bold'>
											".$informal."
										</td>
									</tr>
								</table>
								<br />";
																$total= $preamt + $comamt + $accamt+$workamt+$informal;
								
								
								
								
								
								
					$content.="			<span style='font-weight:bold'>Accomodation</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<th style='width:0.8in'>
											S. No.
										</th>
										<th style='text-align:left'>
											Gender
										</th>
										<th style='width:1.5in'>
											No. of Members
										</th>
										<th>
											Rate
										</th>
										<th style='width:1.3in'>
											Amount
										</th>
									</tr>
									<tr>
										<td style='text-align:center'>
											1
										</td>
										<td style='padding-left:5px'>
											Male
										</td>
										<td style='text-align:center'>
											".$_SESSION['accomod_m']."
										</td>
										<td style='text-align:center'>
											300
										</td>
										<td style='text-align:center'>
											". $_SESSION['accomod_m']*300 ."
										</td>
									</tr>
									<tr>
										<td style='text-align:center'>
											2
										</td>
										<td style='padding-left:5px'>
											Female
										</td>
										<td style='text-align:center'>
											".$_SESSION['accomod_f']."
										</td>
										<td style='text-align:center'>
											300
										</td>
										<td style='text-align:center'>
											". $_SESSION['accomod_f']*300 ."
										</td>
									</tr>
									<tr>
										<td colspan='4' style='text-align:right; font-weight:bold'>
											Sub - Total :
										</td>
										<td style='text-align:center;font-weight:bold'>
											".$accamt."
										</td>
									</tr>
								</table>
								<br />
								<table style='width: 100%' class='sample'>
									<td style='text-align:right; font-weight:bold'>
										Total Amount :
									</td>
									<td style='text-align:center;font-weight:bold;width:1.3in'>
										". $total ."
									</td>
								</table>
								<br />
								<span style='font-weight:bold'>Demand Draft Details</span>
								<table style='width: 100%' class='sample'>
									<tr>
										<td style='width:15%;font-weight:bold;padding-left:5px'>
											DD Number
										</td>
										<td style='width:30%;text-align:center'>
											". $_SESSION['dd_no'] ."
										</td>
										<td style='width:15%;font-weight:bold;padding-left:5px'>
											Amount
										</td>
										<td style='width:30%;text-align:center'>
											". $_SESSION['dd_amount'] ."
										</td>
									</tr>
									<tr>
										<td style='font-weight:bold;padding-left:5px'>
											Dated
										</td>
										<td style='text-align:center'>
											". $_SESSION['dd_date'] ."
										</td>
										<td style='font-weight:bold;padding-left:5px'>
											Bank/Branch
										</td>
										<td style='text-align:center'>
											". $_SESSION['dd_bank'] ."
										</td>
									</tr>
								</table>
							</div>
							<br />
No demand draft should be posted now onwards. Please bring required amount of DD or cash along with you while coming to VIT.<br/>
The loss of  Participant ID Card has to be immediately reported to the reception desk<br/>                   
</body>
				   </html>";
		$fname="receipts/".md5($_SESSION['rec_no']).".html";
		$file=fopen($fname,"w");
		fwrite($file,$content);
		fclose($file);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: VIT graVITas <admin@vitgravitas.com>' . "\r\n";
                if($_SESSION['male_leader']==1)
		mail($_SESSION['email0'],'graVITas 2011 Event Registration Receipt',$content,$headers);
                if($_SESSION['female_leader']==1)
                {
                $p=$_SESSION['participant']+1;
		mail($_SESSION['email'.$p],'graVITas 2011 Event Registration Receipt',$content,$headers);
                }
		$_SESSION['expire']=0;
		session_destroy();
		echo "<meta http-equiv='refresh' content='0;URL=final.php' />";
		
	?>
</body>
</html>