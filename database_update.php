<?php
  session_start();
 ?>
<?php
  require("connection.php");
  $col_name=$_SESSION['col_name'];
  $col_address=$_SESSION['col_address'];
  $male_staff_name=$_SESSION['male_staff_name'];
  $male_staff_no=$_SESSION['male_staff_no'];
  $female_staff_name=$_SESSION['female_staff_name'];
  $female_staff_no=$_SESSION['female_staff_no'];
  $acc_staff=$_SESSION['acc_staff'];
  $accomod_m=$_SESSION['accomod_m'];
  $accomod_f=$_SESSION['accomod_f'];
  $staff_accomod_m=$_SESSION['staff_accomod_m'];
  $staff_accomod_f=$_SESSION['staff_accomod_f'];
  $participant=$_SESSION['participant'];
  if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
	  $par=$participant+2;
  else
  $par=$participant+1;
  $payment_mode=$_POST['mode'];
  $dd_no=$_POST['dd_no'];
  $dd_amount=$_POST['dd_amount'];
  $dd_bank=$_POST['dd_bank'];
  $dd_date=$_POST['dd_date'].'-'.$_POST['dd_month'].'-'.$_POST['dd_year'];
  $_SESSION['dd_no']=$dd_no;
  $_SESSION['dd_amount']=$dd_amount;
  $_SESSION['dd_bank']=$dd_bank;
  $_SESSION['dd_date']=$dd_date;
  $query=mysql_query("select *from colg_details;");
  					$rec_no=0;
  					for($i=0;$i<mysql_num_rows($query);$i++)
  					{
   						if($row = mysql_fetch_array($query))
    					{
    					if($rec_no<$row['rec_no'])
	  						{
	   						$rec_no=$row['rec_no'];
	  						}
    					}	
  					}
  $rec_no+=1;
  $_SESSION['rec_no']=$rec_no;
  mysql_query("insert into colg_details(rec_no,
                                         col_name,
										 col_address,
										 male_staff_name,
										 male_staff_no,
										 female_staff_name,
										 female_staff_no,
										 acc_staff,
										 accomod_m,
										 accomod_f,
										 staff_accomod_m,
										 staff_accomod_f,
										 participant,
										 dd_no,
										 dd_amount,
										 dd_bank,
										 dd_date,
										 payment_mode
										 )
								 values('{$rec_no}',
								         '{$col_name}',
										 '{$col_address}',
										 '{$male_staff_name}',
										 '{$male_staff_no}',
										 '{$female_staff_name}',
										 '{$female_staff_no}',
										 '{$acc_staff}',
										 '{$accomod_m}',
										 '{$accomod_f}',
										 '{$staff_accomod_m}',
										 '{$staff_accomod_f}',
										 '{$par}',
										 '{$dd_no}',
										 '{$dd_amount}',
										 '{$dd_bank}',
										 '{$dd_date}',
										 '{$payment_mode}'
									   );
             ");  
	if($_SESSION['male_leader']==1)
	{
    $lead_name=$_SESSION['name0'];
	$lead_phone=$_SESSION['phone0'];
	$lead_email=$_SESSION['email0'];
	$lead_gender=$_SESSION['gender0'];
	mysql_query("insert into student_info(stu_id,
	                                      rec_no,
	                                      tl_flag,
	                                      name,
										  phone,
										  email,
										  gender
			                              )
								    values( '1',
									        '{$rec_no}',
									        '1',
									       '{$lead_name}',
										   '{$lead_phone}',
										   '{$lead_email}',
										   '{$lead_gender}'
									     );
				");
	}
	
   if($_SESSION['female_leader']==1)
	{
	  if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
		 $j=2;
		 else
		 $j=1;
     $i=$_SESSION['participant']+1;
    $lead_name=$_SESSION['name'.$i];
	$lead_phone=$_SESSION['phone'.$i];
	$lead_email=$_SESSION['email'.$i];
	$lead_gender=$_SESSION['gender'.$i];
	mysql_query("insert into student_info(stu_id,
	                                      rec_no,
	                                      tl_flag,
	                                      name,
										  phone,
										  email,
										  gender
			                              )
								    values( '{$j}',
									        '{$rec_no}',
									        '2',
									       '{$lead_name}',
										   '{$lead_phone}',
										   '{$lead_email}',
										   '{$lead_gender}'
									     );
				");
	}
	
	for($i=1;$i<=$_SESSION['participant'];$i++)
         {
		 if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
		 $j=$i+2;
		 else
		 $j=$i+1;
		 $name[$i]=$_SESSION['name'.$i];
		 $phone[$i]=$_SESSION['phone'.$i];
		 $email[$i]=$_SESSION['email'.$i];
		 $gender[$i]=$_SESSION['gender'.$i];
		 mysql_query("insert into student_info(stu_id,
		                                   rec_no,
	                                      tl_flag,
	                                      name,
										  phone,
										  email,
										  gender
			                              )
								    values( '{$j}',
									        '{$rec_no}',
									        '0',
									       '{$name[$i]}',
										   '{$phone[$i]}',
										   '{$email[$i]}',
										   '{$gender[$i]}'
									     );
				");
		 
		 }
		 
		 $query=mysql_query("select *from events;");
		  for($i=1;$i<=mysql_num_rows($query);$i++)
             {
				if($_SESSION['male_leader']==1)
	            {
					 if($_SESSION['register0'.'_'.$i]=='on')
				   {
				     mysql_query("insert into registrations values('{$rec_no}','1','{$i}');");
				   }  
				}
				if($_SESSION['female_leader']==1)
	            {
					$s=$_SESSION['participant']+1;
					if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
		            $k=2;
		           else
		           $k=1;
					 if($_SESSION['register'.$s.'_'.$i]=='on')
				   {
				     mysql_query("insert into registrations values('{$rec_no}','{$k}','{$i}');");
				   }  
				}
				
			   for($j=1;$j<=$_SESSION['participant'];$j++)
                 {
					 if($_SESSION['male_leader']==1&&$_SESSION['female_leader']==1)
		            $k=$j+2;
		           else
		           $k=$j+1; 
				   if(isset($_SESSION['register'.$j._.$i]))
				   {
				   if($_SESSION['register'.$j._.$i]=='on')
				   {
				     mysql_query("insert into registrations values('{$rec_no}','{$k}','{$i}');");
				   }
				   }
			     }
		      }
			 $events=mysql_query("select *from events;");
  	for($i=0;$i<mysql_num_rows($events);$i++)
			{
				if(isset($_SESSION["event".$i]))
				if($_SESSION["event".$i]>0)
				{
				$teams=$_SESSION["event".$i];
			    mysql_query("insert into teams(
	                                      rec_no,
	                                      event_id,
										  no_of_teams
			                              )
								    values( 
									        '{$rec_no}',
									        '{$i}',
									       '{$teams}'
									     );
						  ");
				}
			}
		 mysql_query("update colg_details set successful='1' where rec_no=".$rec_no.";");
		 //mail function
                 echo "<script>window.open('receiptgenerate.php','_parent','location=no,menubar=no, height=600, width=817, scrollbars=yes')</script>";
		 echo "<meta http-equiv='refresh' content='5;URL=final.php' />";


 ?>			
			
			
