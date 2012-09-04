<?php session_start(); 
    if($_SESSION['expire']!=1)
  {
    header("Location:expire.php");
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Participant Details</title>
        <script src="js/jquery-1.4.3.js" type="text/javascript"></script>
		<script src="js/jquery.validate.js" type="text/javascript"></script>
        <script>   
            $().ready(function() {
                
                $("#partdet").validate({ 
                    errorElement: "span", 
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    },
                    success: function(label) {
                            label.html("&nbsp;").addClass("success");
                            
                    },
                    rules: { 
                      <?php
                        for($i=1;$i<=$_SESSION['participant'];$i++)
                        {
                            echo "name".$i.": { 
                            required:true
                          }, 
                          ";
                            echo "phone".$i.": { 
                            required:true,
                            number:true,
                            minlength: 10,
                            maxlength:11
                          }, 
                          ";
                          echo "gender".$i.": { 
                            required:true
                          }, 
                          ";
                          echo "email".$i.": { 
                            required:true,
                            email:true
                          } 
                          ";
                          if($i<$_SESSION['participant'])
                            echo ", ";
                        }
                    ?>
                    },
                    messages: { 
                        <?php
                            for($i=1;$i<=$_SESSION['participant'];$i++)
                            {
                                echo "name".$i." : \"&nbsp;\",";
                                echo "phone".$i." : \"&nbsp;\",";
                                echo "gender".$i." : \"&nbsp;\",";
                                echo "email".$i." : \"&nbsp;\"";
                                if($i<$_SESSION['participant'])
                                    echo ", ";
                            }
                        ?>
                     } 
                    
              });
            });
        </script>
        <link rel="stylesheet" type="text/css" href="css/common.css" />
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
        <script>
		 function check()
		 {
			 var male=<?Php echo $_SESSION['accomod_m'];?>;
			 var female=<?Php echo $_SESSION['accomod_f'];?>;
			 var part=<?php echo $_SESSION['participant'];?>;
			 var flag_m=<?php echo $_SESSION['male_leader'];?>;
			 var flag_f=<?php echo $_SESSION['female_leader'];?>;
			 var tot=part;
			 var entered_m=0;
			 var entered_f=0;
			 if(flag_m==1)
			 {
				 entered_m++;
				 tot++;
			 }
			 for(var i=1;i<=part;i++)
			   {
				  
				 if(document.getElementById("gender"+i).selectedIndex==1)
				 {
				   entered_m++; 
				 }
			   }
			 if(flag_f==1)
			 {
				 entered_f++;
				 tot++;
			 }
			 if(tot>male+female)
			 {
				 return true;
		     }
			 for(var i=1;i<=part;i++)
			      {  
				    if(document.getElementById("gender"+i).selectedIndex==2)
				    {
				       entered_f++; 
				    }
			      }
			 if((male!=entered_m)||(female!=entered_f))
			 {
				 document.getElementById("gender1").options[0].selected=true;
				alert("Number of male participants or number of female participants do not match");
				return false; 
			 }
			 return true;
		 }
		</script>
	</head>
	<body>
    	<div class="main">
        	<img src="images/logo.png" />
        	<div class="info">
        		graVITas Event Registration 
        	</div>
            <br />
        	<div class="pageinfo">
        		Participant Details
        	</div>
   			<br />
        	<div class="form">
            	<form action="enter_part_details.php" method="post" name="details" id="partdet" onsubmit="return check();">
                	<table width="100%" border="0" style="color:#fff;">
                        <tr>
                            <td><div style="margin-left:70px; font-weight:bold;"> Name</div> </td>
                            <td><div style="margin-left:55px; font-weight:bold;"> Phone No.</div> </td>
                            <td><div style="margin-left:70px; font-weight:bold;"> E-mail</div> </td>
                            <td><div style="margin-left:45px; font-weight:bold;"> Gender </div></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                            <br>
                            </td>
                        </tr>
                        <?php 
						if($_SESSION['male_leader']==1) { ?>
                        <tr style="font-size:20px;">
                            <td style="width:27%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['name0'];?></div></td>
                            <td style="width:26%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['phone0'];?></div></td>
                            <td style="width:26%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['email0'];?></div></td>
                            <td style="width:26%; text-align:left;"><div style="margin-left:40px;">Male</div></td>
                        </tr>
                        <?php }?>
                        <?php if($_SESSION['female_leader']==1) 
						{
							$part=$_SESSION["participant"]+1; 
						?>
                        <tr style="font-size:20px;">
                            <td style="width:27%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['name'.$part];?></div></td>
                           <td style="width:26%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['phone'.$part];?></div></td>
                           <td style="width:26%; text-align:left;"><div style="margin-left:40px;"><?php echo $_SESSION['email'.$part];?></div></td>
                           <td style="width:26%; text-align:left;"><div style="margin-left:40px;">Female</div></td>
                        </tr>
                        <?php }?>
                        <?php
                            for($i=1;$i<=$_SESSION['participant'];$i++)
                            {
                        ?>
                        <tr>
                            <td><div style="width:100%; text-align:left;">
                                <input type="text" name="name<?php echo $i;?>" style="width:200px;" />
                                <div id="details_name<?php echo $i;?>_errorloc"></div>
                                </div>
                            </td>
                        <td><div style="width:100%; text-align:left;"><input type="text" name="phone<?php echo $i;?>" style="width:200px;" /></div></td>
                        <td><div style="width:100%; text-align:left;"><input type="text" name="email<?php echo $i;?>" style="width:200px;" /></div></td>
                        <td><div style="width:100%; text-align:left;"><select name="gender<?php echo $i;?>" id="gender<?php echo $i;?>">
                           <option disabled="disabled" value="0" selected="selected">[Select gender]</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                            </div>
                        </td>
                   </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <div style="text-align:right">
                                <br />
                                <input class="blue" type ="submit" value="Next" />
                            </div>    
                        </td>
                    </tr>
                 </table>
                </form>
            </div>
        </div>
	</body>
</html>