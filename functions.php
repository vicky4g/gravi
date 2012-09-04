<?php
  //This file will contain all the basic functions
   
   function mysql_prep($value)
   {
     $magic_quotes=get_magic_quotes_gpc();
	 $new_enough=function_exists("mysql_real_escape_string");
	 if($new_enough)
	 {
	   if($magic_quotes){$value=stripslashes($value);}
	   $value=mysql_real_escape_string($value);
	  }
	 else
	 {
	   if(!$magic_quotes){$value=addslashes($value);};
	  }
	  return $value;
	 }
   
 ?>