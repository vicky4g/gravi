<?php session_start(); ?>
<?php
	if(!(array_key_exists('sid',$_SESSION) && !empty($_SESSION['sid'])))
		{
           echo'<meta http-equiv="refresh" content="0;URL=ntauth.php" />';
           die();
		}
		$cllgid=$_SESSION['recno'];
		include"loggedin2.php";
		$sql=mysql_query("select * from colg_details where rec_no='$cllgid'");
		if($row=mysql_fetch_array($sql))
		{
		   $confirm=$row['confirm'];
		   $dd_no=$row['dd_no'];
		   $dd_date=$row['dd_date'];
		   $dd_amount=$row['dd_amount'];
		   $dd_bank=$row['dd_bank'];
		}
		else
		{
			echo "<script>alert(\"Reciept No. Not Found\");</script>";
			echo'<meta http-equiv="refresh" content="0;URL=cllgcnfrminput.php" />';
			die();
		}
		if($confirm==1)
		{
			mysql_close($con);
			echo "<script>alert(\"Entered Reciept No. is Already confirm\");</script>";
			echo'<meta http-equiv="refresh" content="0;URL=cllgcnfrminput.php" />';
			die();
		}
		else
		{
			$c=1;
			$sql1=mysql_query("update colg_details set confirm='$c' where rec_no='$cllgid'");
			if(!$sql1)
			{
				echo"ERROR!!!";
			}
			else
			{
			$sql2=mysql_query("select distinct event_id from registrations where rec_no='$cllgid'");
			$i=0;
			while($row=mysql_fetch_array($sql2))
			{
					$event[$i++]=$row['event_id'];
			}
			foreach($event as $eve)
			{
				$count=0;
				$sql3=mysql_query("select count(*) 'cnt' from registrations where rec_no='$cllgid' and event_id='$eve'");	
				if($result=mysql_fetch_array($sql3))
				{
					$count=$result['cnt'];
				}
				$sql4=mysql_query("select * from events where event_id='$eve'");
				if($result2=mysql_fetch_array($sql4))
				{
					$tl=$result2['team_limit'];
					$available=$result2['available'];
				}
				$count=ceil($count/$tl);
				$available-=$count;
				$sql5=mysql_query("update events set available='$available' where event_id='$eve'");
			}
			$sql6=mysql_query("select email from student_info where tl_flag=1 and rec_no='$cllgid'");
			$email=mysql_fetch_array($sql6);
			$email=$email['email'];
			$to = $email;
			$subject = 'graVITas Payment Confirmation';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: VIT graVITas <admin@vitgravitas.com>' . "\r\n";
			$message="
Dear Participant<br >
Thank you for registering at graVITas 2011. Your registration has been confirmed.<br >
Your Demand Drafts with following details have been recieved by the graVITas Team :-<br >
DD Number : $dd_no <br/>
DD Date   : $dd_date <br />
DD Amount : $dd_amount <br />
DD Bank   : $dd_bank <br />
<br >
<br >
Regards<br >
graVITas";
			$mail_sent = mail( $to, $subject, $message, $headers );
			echo $mail_sent ? "<script>alert(\"Confirmation Successful.\");</script>" : "<script>alert(\"Confirmation Successful. Mailing failed\");</script>";
			echo'<meta http-equiv="refresh" content="0;URL=cllgcnfrminput.php">';
			}
		}
		unset($_SESSION['recno']);
		mysql_close($con);

?>