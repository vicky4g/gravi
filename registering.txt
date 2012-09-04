<?php
  session_start();
  
 ?>
<?php include("connection.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Registration </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/common.css" />
		<script type="text/javascript">
			function validate()
			{
	  			<?php
	  				$check=0;
	  			?>
	  			var session_id=<?php echo $_SESSION['availability']; ?>;
	 			var participant=<?php echo $_SESSION['participant']; ?>;
	  			var i=0,set=0;
	  			for(i=1;i<=participant;i++)
	  			{
	    			var ele="<?php echo 'register'?>"+i+"<?php echo'_'.$_SESSION['event_id'];?>";
	    			if(document.getElementById(ele).checked==true)
	    			{	
	      			set++;
	    			}
	  			}
				<?php 
				   if($_SESSION['male_leader']==1)
				   {
					   ?>
					   var ele="<?php echo 'register'?>"+"0"+"<?php echo'_'.$_SESSION['event_id'];?>";
					   if(document.getElementById(ele).checked==true)
	    			{	
	      			set++;
	    			}
				<?php
				    }
				?>
				<?php 
				   if($_SESSION['female_leader']==1)
				   {
					   ?>
					   var ele="<?php echo 'register'?>"+"<?php echo $_SESSION['participant']+1;?>"+"<?php echo'_'.$_SESSION['event_id'];?>";
					   if(document.getElementById(ele).checked==true)
	    			{	
	      			set++;
	    			}
				<?php
				    }
				?>
	  			if(set>session_id)
	  			{
	  				alert("Sorry, required number of registrations not available...");
	  				return false;
	  			}
	  				return true;
			}
	</script>
 	</head>
		<body style="background-color:#ddd; font-family:Tahoma, Geneva, sans-serif">
			<table width="80%" align="center" border="0" style="margin-top:10px;">
    			 <tr style="line-height:50px;">
	   				<th style="font-size:20px;">Student name</th>
                    <th style="font-size:20px;">Register</th>
	  			</tr>
					<form action="register.php" method="GET" onsubmit="return validate()" >
	 				<?php
					      if($_SESSION['male_leader']==1)
					     {
				    	?>
                            <tr>
	  						<td align="center"><?php echo $_SESSION["name0"];?></td>
	 				 <?php
	    				 if($_GET['event_id']!=null)
		 				{
		   					$_SESSION['event_id']=$_GET['event_id'];
		   					$_GET['event_id']=null;
		 				}
		 				 if($_SESSION['register0_'.$_SESSION['event_id']]=='on')
		 				{
		 			?>
		 <td align="center"><input type="checkbox"  checked name="register<?php echo '0_'.$_SESSION['event_id'];?>" id="register<?php echo '0_'.$_SESSION['event_id'];?>" /></td>
        <?php		   
		 }
		 else
		 {
		 ?>
	  <td align="center">
      <input type="checkbox" name="register<?php echo '0_'.$_SESSION['event_id'];?>" id="register<?php echo '0_'.$_SESSION['event_id'];?>">
      </td> 
		<?php 
		}
		 ?>
	 </tr>
	<?php
	}
	                   
	                   if($_SESSION['female_leader']==1)
					   {
						   $p=$_SESSION['participant']+1;
	                   ?>
	                      
	       	 						<tr>
	  						<td align="center"><?php echo $_SESSION["name".$p];?></td>
	 				 <?php
	    				 if($_GET['event_id']!=null)
		 				{
		   					$_SESSION['event_id']=$_GET['event_id'];
		   					$_GET['event_id']=null;
		 				}
		 				 if($_SESSION['register'.$p.'_'.$_SESSION['event_id']]=='on')
		 				{
		 			?>
		 <td align="center"><input type="checkbox"  checked name="register<?php echo $p.'_'.$_SESSION['event_id'];?>" id="register<?php echo $p.'_'.$_SESSION['event_id'];?>" /></td>
        <?php		   
		 }
		 else
		 {
		 ?>
	  <td align="center">
      <input type="checkbox" name="register<?php echo $p.'_'.$_SESSION['event_id'];?>" id="register<?php echo $p.'_'.$_SESSION['event_id'];?>">
      </td> 
		<?php 
		}
		 ?>
	 </tr>
	<?php
	}
	
	
    					for($i=1;$i<=$_SESSION['participant'];$i++)
						{
	 					?>
	 						<tr>
	  						<td align="center"><?php echo $_SESSION["name".$i];?></td>
	 				 <?php
	    				 if($_GET['event_id']!=null)
		 				{
		   					$_SESSION['event_id']=$_GET['event_id'];
		   					$_GET['event_id']=null;
		 				}
		 				 if($_SESSION['register'.$i.'_'.$_SESSION['event_id']]=='on')
		 				{
		 			?>
		 <td align="center"><input type="checkbox"  checked name="register<?php echo $i.'_'.$_SESSION['event_id'];?>" id="register<?php echo $i.'_'.$_SESSION['event_id'];?>" /></td>
        <?php		   
		 }
		 else
		 {
		 ?>
	  <td align="center">
      <input type="checkbox" name="register<?php echo $i.'_'.$_SESSION['event_id'];?>" id="register<?php echo $i.'_'.$_SESSION['event_id'];?>">
      </td> 
		<?php 
		}
		 ?>
	 </tr>
	<?php
						}
	$q=mysql_query("select * from events where event_id=".$_SESSION['event_id']);
	  if($r=mysql_fetch_array($q))
	  {
	    $_SESSION['availability']=$r['available'];
	   }
	?>
	 
	 <tr style="line-height:50px">
	   <td colspan="2" align="right"><br /><input class="blue" type="submit" value="submit"></td>
	  </tr>
	  </form>
	 </table>
   </body>
 </html>
	 
    
