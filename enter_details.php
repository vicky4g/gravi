<?php 
  session_start(); 
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
  $_SESSION["col_name"]=mysql_prep($_GET['col_name']);
  $_SESSION["col_address"]=mysql_prep($_GET['add_1']);
  $_SESSION["male_staff_name"]=mysql_prep($_GET['male_staff_name']);
  $_SESSION["male_staff_no"]=mysql_prep($_GET['male_staff_no']);
  $_SESSION["female_staff_name"]=mysql_prep($_GET['female_staff_name']);
  $_SESSION["female_staff_no"]=mysql_prep($_GET['female_staff_no']);
  $_SESSION["acc_staff"]=mysql_prep($_GET['acc_staff']);
  $_SESSION["accomod_m"]=mysql_prep($_GET['accomod_m']);
  if($_GET['accom_invalid']!=1)
  {
  $_SESSION["accomod_f"]=mysql_prep($_GET['accomod_f']);
  }
  $_SESSION["participant"]=mysql_prep($_GET['participant']);
  $part=$_SESSION["participant"]+1;
  if($_GET['male_leader']==1)
  {
  $_SESSION['male_leader']=1;
  $_SESSION["participant"]-=1;
  $_SESSION["name0"]=mysql_prep($_GET['lead_name']);
  $_SESSION["phone0"]=mysql_prep($_GET['lead_phone']);
  $_SESSION["email0"]=mysql_prep($_GET['lead_email']);
  $_SESSION["gender0"]="Male";
  }
  if($_GET['female_leader']==1)
  {
  $_SESSION['female_leader']=1;
  $_SESSION["participant"]-=1;
  $part=$_SESSION["participant"]+1;
  $_SESSION["name".$part]=mysql_prep($_GET['lead_name_f']);
  $_SESSION["phone".$part]=mysql_prep($_GET['lead_phone_f']);
  $_SESSION["email".$part]=mysql_prep($_GET['lead_email_f']);
  $_SESSION["gender".$part]="Female";
  }
  $_SESSION["staff_accomod_m"]=mysql_prep($_GET['staff_accomod_m']);
  $_SESSION["staff_accomod_f"]=mysql_prep($_GET['staff_accomod_f']);
  $_SESSION["expire"]='1';
  if($_GET['female_leader']==1&&$_GET['male_leader']!=1)
  {
	  $_SESSION['male_leader']=0;
  }
  if($_GET['female_leader']!=1&&$_GET['male_leader']==1)
  {
	  $_SESSION['female_leader']=0;
  }
  header("Location:participant_detail.php");
?>

