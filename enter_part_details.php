<?php
  session_start();
   if($_SESSION['expire']!=1)
  {
    header("Location:expire.php");
  }
  
       require("constants.php");
  $connection=mysql_connect(DB_SERVER,DB_USER,DB_PASS);  
  if(!$connection)
  {
     die("Database connection failed ".mysql_error());
  }
  $db=mysql_select_db(DB_NAME,$connection);
  if(!$db)
  {
    die("Database selection failed ".mysql_error());
  }
  require_once("functions.php"); 
  for($i=1;$i<=$_SESSION['participant'];$i++)
         {

            $_SESSION['name'.$i]=mysql_prep($_POST['name'.$i]);
	    $_SESSION['phone'.$i]=mysql_prep($_POST['phone'.$i]);
	    $_SESSION['email'.$i]=mysql_prep($_POST['email'.$i]);
	    $_SESSION['gender'.$i]=mysql_prep($_POST['gender'.$i]);
	 }
     header("Location:event_detail.php");
 ?>
 