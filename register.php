<?php
  session_start();
   if($_SESSION['expire']!=1)
  {
    header("Location:expire.php");
  } 
 ?>
<html>
<head>
</head>
<body>
<?php

    if($_SESSION['male_leader']==1)
	{
	      
	      {
	       $_SESSION['register0_'.$_SESSION['event_id']]=$_GET['register0_'.$_SESSION['event_id']];		
	       }
	    
    }
	
	
	 if($_SESSION['female_leader']==1)
	{
	      $i=$_SESSION['participant']+1;
	      {
	       $_SESSION['register'.$i.'_'.$_SESSION['event_id']]=$_GET['register'.$i.'_'.$_SESSION['event_id']];		
	       }
	    
    }
	

   for($i=1;$i<=$_SESSION['participant'];$i++)
	{
	      
	      {
	       $_SESSION['register'.$i.'_'.$_SESSION['event_id']]=$_GET['register'.$i.'_'.$_SESSION['event_id']];		
	       }
	    
    }
 ?>
 <script type="text/javascript">
 window.parent.Shadowbox.close();
 </script>
 </body>
 </html>