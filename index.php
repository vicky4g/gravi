<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
	<title>Guidelines</title>
<script type="text/javascript">
function check1()
{
  if(document.getElementById('agree').value!='on')
  {
    alert("You have to accept the terms and conditions");
  }
  else
  {
  <?php $_SESSION['agree']=1;?>
  window.location.replace("college_details.php")
  }
}
function toggle()
{
    if(document.getElementById('agree').value=='on')
        document.getElementById('agree').value='off';
    else
        document.getElementById('agree').value='on';
}
</script>
</head>

<body>
	<div class="main">
    	<img class="top" src="images/logo.png" />
		<div class="info">
        	graVITas Event Registration
        </div>
        <br />
        <div class="pageinfo">
        	GUIDELINES
        </div>
        <br />
        <div class="form">
            <ul style="line-height:1.5em">
                <li>Name, phone number and email address of each participant is required.</li>
                <li>Register according to the schedule available on the website www.vitgravitas.com. Ensure that there is  no clash in the registered events.</li>
                <li>The organizing team holds the right to cancel the event subject to the minimum no. of participants and the fee will be refunded for cancelled events/workshops.</li>
                <li>Registered fee for confirmed events is non-refundable.</li>
                <li>A confirmation e-mail will be sent only after the receipt of payment, which has to be produced upon arrival.</li>
                <li>Valid contact numbers should be provided (preferably a mobile number which the participants will be using during the fest also).</li>
                <li>Spot registrations are subject to availability.</li>
                <li>Students should compulsorily submit college ID card and Bonafide Certificate (signed by registrar if university or principal if college) specific to VIT University upon arrival. ID Cards will be returned at the time of check-out.</li>
                <li>Online registrations for accommodation are available.</li>
                <li>Accommodation will be provided at the cost of Rs.300 for 3 days, with Complimentary breakfast</li> 
                <li>As we have limited accommodation for girl participants, the accommodation will be provided on first come first serve basis.Hence any requests in this regard are not entertained.</li>
                <li>Request for individual rooms during allotment and complaints in this regard will not be entertained.</li>
                <li>Each college should appoint a team leader among themselves and only the team leader should contact the hospitality team for the accommodation.</li>
                 <li>Please note that you will have to share the accommodation facility with other participants from other colleges.</li>
                 <li>Lock & key (for your luggage) will not be provided.</li>
                 <li>Mattresses, Blankets, pillows will be provided.</li>
                 <li>Accommodation will be provided from 15th Sep '11, 6:00 pm to 19th Sep '11, 12:00 pm.</li>
                 <li>Consumption of alcohol, narcotics, smoking in the University premises is strictly prohibited. Violation of this rule will lead to severe action.</li>
                 <li>Any kind of indisciplinary actions during the fest will lead to severe action.</li>
                 <li>We are not responsible for any loss of valuables, luggage or any other.</li>
                 <li>The Demand Draft should be drawn in favor of “VIT UNIVERSITY” payable at “Vellore”.</li>
                 <li>The Demand Draft should be posted at the earliest, with the receipt number and college name written at the back.</li>
              <li> The demand draft should be posted at the earliest possible to Prof S. Sasikumar,Chief Faculty Coordinator-graVITas'11, VIT University, Vellore-632014.</li>
              <li>The loss of  Participant ID Card has to be immediately reported to the reception desk.</li>
              <li>Please get separate DD for accommodation and event registrations</li>

            </ul>
		<input type="checkbox" name="agree" id="agree" value='off' onclick='toggle()'>&nbsp;I have read the guidelines and i accept the terms and conditions
            <div style="text-align:right">
                <input class="blue" type="button" value="Continue Registration"  onclick="check1()"/>
            </div>
	    </form>
        </div>
    </div>
</body>
</html>