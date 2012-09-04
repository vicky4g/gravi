<?php 
session_start();
 if($_SESSION['agree']!=1)
      {
         header("Location:expire.php");
      }
  
require("connection.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
<html xmlns="http://www.w3.org/1999/xhtml">
  <html>
  <head>
    <title>College Details</title>
	<script src="js/jquery-1.4.3.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>
  	<script>   
		$().ready(function() {
			
			$("#coldetail").validate({ 
				errorElement: "span", 
				errorPlacement: function(error, element) {
					error.insertAfter(element);
				},
				success: function(label) {
						label.html("&nbsp;").addClass("success");
						
				},
				rules: { 
				  
				  acc_staff: { 
					number: true,
					min:0
				  },
				  accomod_m: { 
					
					number: true,
				  },
				  accomod_f: { 
					
					number: true
					
				  },
				  participant: {
					required:true,		  
					number: true,
					min : 1 
				  },
				  lead_phone: { 
					number: true,
					minlength : 10,
					maxlength :11
					
				  },
				  lead_email: {
					email: true
				  },
				  lead_phone_f: { 
					number: true,
					minlength : 10,
					maxlength :11
					
				  },
				  lead_email_f: {
					email: true
				  },
				 col_name: { 
					required: true
				  },
				 add_1: { 
					required: true
				  },
				  male_staff_no: { 
					number: true,
					minlength : 10,
					maxlength :11
				  },
				  female_staff_no: { 
					number: true,
					minlength : 10,
					maxlength :11
				  },
				  staff_accomod_m: { 
					number: true
				  },
				   staff_accomod_f: { 
					number: true
				  }
				  
				 
			   },
		  
				messages: { 
				  col_name: "&nbsp;",
				  acc_staff: "&nbsp;",
				  add_1: "&nbsp;",
				  staff_name: "&nbsp;",
				  accomod_m: "&nbsp;",
				  accomod_f: "&nbsp;",
				  participant: "&nbsp;",
				  male_staff_no:"&nbsp;",
				  female_staff_no:"&nbsp;",
				  staff_accomod_f:"&nbsp;",
				  staff_accomod_m:"&nbsp;",
				  lead_name:"&nbsp;",
				  lead_phone:"&nbsp;",
				  lead_phone_f:"&nbsp;",
				  lead_name_f:"&nbsp;",
				 } 
				
		  });
		});
	</script>
<style>
span.error {			
    display:inline-block;
    font-size:11px;
    background:transparent url("images/erroricon.png") no-repeat left center;
    padding-left:20px;
    margin-left:10px;
    margin-top:3px;
}
span.success {
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
<link rel="stylesheet" type="text/css" href="css/common.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
	function textfocus()
	{
		document.getElementById('name').focus();
	}
	function tl_check()
	{
		var leader_name_f=document.getElementById('lead_name_f').value;
	  var leader_phone_f=document.getElementById('lead_phone_f').value;
	  var leader_email_f=document.getElementById('lead_email_f').value;
	  var leader_name=document.getElementById('lead_name').value;
	  var leader_phone=document.getElementById('lead_phone').value;
	  var leader_email=document.getElementById('lead_email').value;
	  if(!((leader_name!=""&&leader_phone!=""&&leader_email!="")||(leader_name_f!=""&&leader_phone_f!=""&&leader_email_f!="")))
	  {
		   document.getElementById('participant').value="";
		   alert("Enter the details of at least one team leader");
		   return false;
	  }
	  if(leader_name!=""&&leader_phone!=""&&leader_email!="")
	  {
	    document.getElementById('male_leader').value=1;
	  }
	  if(leader_name_f!=""&&leader_phone_f!=""&&leader_email_f!="")
	  {
	    document.getElementById('female_leader').value=1;
	  }
	  return true;
	}
	function uncheck()
	{
          if(document.getElementById('acc_staff').value==""||document.getElementById('acc_staff').value==0)
          {
            return true;
          }
	  var male_staff_name=document.getElementById('male_staff_name').value;
	  var female_staff_name=document.getElementById('female_staff_name').value;
	  var female_staff_no=document.getElementById('female_staff_no').value;
	  var male_staff_no=document.getElementById('male_staff_no').value;	 
	  if(!((male_staff_name!=""&&male_staff_no!="")||(female_staff_name!=""&&female_staff_no!="")))
	  {
		   document.getElementById('acc_staff').value="";
		   alert("Enter the details of at least one staff member");
		   return false;
	  }
	  return true;
	}
    function check()
	{
	  var accomod=document.getElementById('accomod_f').value;
	  var part=document.getElementById('participant').value;
	  var staff=document.getElementById('acc_staff').value;
	  var tot=Number(document.getElementById('accomod_m').value)+Number(accomod);
	  var check=Number(part);
	  var left;
	  <?php
	     $accom=0;
	     $query=mysql_query("select* from colg_details where validate_accomod='1';");
	     for($i=0;$i<mysql_num_rows($query);$i++)
	     {
	       if($row=mysql_fetch_array($query))
	       {
	       $accom+=$row['accomod_f'];
	       
	       }
	      }
	      ?>
	      var left=200-<?php echo $accom;?>;
		   if(tot>check)
	      {
		   document.getElementById('participant').value="";
		   document.getElementById("accom_invalid").value=1;
	       alert("Number of accomodations for the participants should not be more than the number of participants")
	       return false;
	      }
	      if(<?php echo $accom;?>>=200)
	      {
			document.getElementById('').value="";
			document.getElementById("accom_invalid").value=1;
	        alert("Sorry,no more accomodations for female participants are available....You can find guest houses in Vellore on this link-www.sample.com");
		return true;
	      }
	      if(<?php echo $accom;?>+Number(accomod)>200)
	      {
	          alert("Sorry,only "+left+" accomodations for female participants are available..You can find guest houses in Vellore on this link-www.sample.com");
		  return true;
	      }
	        return true;
			}
</script>
</head>
<body onload="textfocus()">
	<div class="main" >
    	<img class="top" src="images/logo.png" />
		<div class="info">
        	graVITas Event Registration
        </div>

        <br />
        <div class="pageinfo">
        	COLLEGE DETAILS
        </div>
        <br />
        <div class="form">
        	<form action="enter_details.php" method="get" id="coldetail" name="codetail" onsubmit="return uncheck()&&check()&&tl_check();">
            <table style="width:100%;">
            	<tr>

                	<td class="col1">
                    	College name
                    </td>
                    <td class="col2">
                    	:
                    </td>
                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" id="name"  name="col_name" />
                    </td>
                </tr>

                <tr>
                	<td class="col1">
                    	Address 
                    </td>
                    <td class="col2">
                    	:
                    </td>
                    <td class="col3">
                    	<textarea cols="50" rows="4" class="textbox" name="add_1" ></textarea>

                    </td>
                </tr>
                  <tr>
                    <td colspan="3" style="padding-top:0px" >
                    <hr style="" />
                    </td>
                </tr>
              	<tr>
               		<td class="col1">
            			Accompanying staff (no.)
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="acc_staff" id="acc_staff"/>
                    </td>
                </tr>
                <tr> 
                     <td colspan="2" align="left">
            			Male
                     </td>
                </tr>
                <tr>
                     <td align="right">
            			 Name
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="male_staff_name" id="male_staff_name"/>
                    </td>
                </tr>
                 <tr>
                     <td align="right">
                         Contact no.
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="male_staff_no" id="male_staff_no"/>
                    </td>
                </tr>
                <tr> 
                     <td colspan="2" align="left">
            			Female
                     </td>
                </tr>
                <tr>
                     <td align="right">
            			 Name
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="female_staff_name" id="female_staff_name"/>
                    </td>
                </tr>
                 <tr>
                     <td align="right">
                         Contact no.
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="female_staff_no" id="female_staff_no"/>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3" style="padding-top:0px" >
                    <hr style="" />
                    </td>
                </tr>
                <tr>
                  	<td class="col1">
            			No. of participants
                    </td>
                    <td class="col2">
                    	:
                    </td>
                    <td class="col3">
                    	<input type="text" width="100px" class="textbox"  name="participant" id="participant"/>
                    </td>
                </tr>
                 <tr>
                    <td colspan="3" style="padding:5px 0px">
                    <hr style="" />
                    </td>
                </tr>
                 <tr> 
                     <td colspan="2" align="left">
            			Accomodation for participants
                     </td>
                </tr>
                <tr>
                	<td class="col1" align="right">
            		    Male(no.) 
                    </td>
                    <td class="col2">

                    	:
                    </td>
                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="accomod_m" id="accomod_m" />
                    </td>
               	</tr>
              	<tr>
         			<td class="col1"  align="right">
	   				  Female(no.) 
	 				</td>

	 				<td class="col2">
                    	:
                    </td>
                    <td class="col3">
	   					<input type="text" size="10" name="accomod_f" class="textbox" id="accomod_f" />
	   					
	 				</td>
       			</tr>
                <tr>
                    <td colspan="3" style="padding:5px 0px">
                    <hr style="" />
                    </td>
                </tr>
                 <tr> 
                     <td colspan="2" align="left">
            			Accomodation for staff members
                     </td>
                </tr>
                <tr>
                	<td class="col1" align="right">
            		    Male(no.) 
                    </td>
                    <td class="col2">

                    	:
                    </td>
                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="staff_accomod_m" id="staff_accomod_m" />
                    </td>
               	</tr>
              	<tr>
         			<td class="col1"  align="right">
	   				  Female(no.) 
	 				</td>

	 				<td class="col2">
                    	:
                    </td>
                    <td class="col3">
	   					<input type="text" size="10" name="staff_accomod_f" class="textbox" id="staff_accomod_f">
	   					<div id="coldetail_accomod_f_errorloc"></div>
	 				</td>
       			</tr>
                 <tr>
                    <td colspan="3" style="padding:5px 0px">
                    <hr style="" />
                    </td>
                </tr>
		<tr style="line-height:40px" > 
                     <td colspan="2" align="left">
            			Team Leader details
                     </td>
                </tr>
		 <tr> 
                     <td align="left">
            			Male
                     </td>
                </tr>
                <tr>
                     <td align="right">
            			 Name
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="lead_name" id="lead_name"/>
                    </td>
                </tr>
              	<tr>
                     <td align="right">
            			 Contact no.
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="lead_phone" id="lead_phone"/>
                    </td>
                </tr>
                <tr>
                  	<td align="right">
            			E-mail
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" name="lead_email" id="lead_email"  class="textbox"/>
                    </td>
                </tr>                
                 <tr> 
                     <td align="left">
            			Female
                     </td>
                </tr>
                <tr>
                     <td align="right">
            			 Name
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="lead_name_f" id="lead_name_f"/>
                    </td>
                </tr>
              	<tr>
                     <td align="right">
            			 Contact no.
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" class="textbox" name="lead_phone_f" id="lead_phone_f"/>
                    </td>
                </tr>
                <tr>
                  	<td align="right">
            			E-mail
                    </td>
                    <td class="col2">
                    	:
                    </td>

                    <td class="col3">
                    	<input type="text" width="100px" name="lead_email_f" id="lead_email_f"  class="textbox" />
                    </td>
                </tr>
                 <tr>
                  	<td class="col1">
            			
                    </td>
                    <td class="col2">
                    	
                    </td>
                    <td class="col3" style="text-align:right">
                    	<input class="blue" type="submit" value="NEXT"/>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="male_leader" name="male_leader" value="0" />
            <input type="hidden" id="female_leader" name="female_leader" value="0" />
            <input type="hidden" id="accom_invalid" name="accom_invalid" value="0" />
            </form>
        </div>
    </div>
</body>
</html>
