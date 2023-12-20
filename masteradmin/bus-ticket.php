<?php  
include "busapi/SSAPICaller.php";
include "busapi/BlockRequest.php";

$busrs=GetPageRecord('*','busbookingMaster','id="'.base64_decode($_REQUEST['i']).'" '); 
$busResult=mysqli_fetch_array($busrs);   



 
$urs=GetPageRecord('*','sys_userMaster',' id="'.$busResult['agentUserid'].'" '); 
$agentData=mysqli_fetch_array($urs); 

$ticketDetails = getTicketDetails($busResult['ticket_no']);
$ticketresults=json_decode($ticketDetails);

/*echo "<pre>";
print_r($ticketresults);
die;
*/

$travels ="{$ticketresults->travels}";

$busType ="{$ticketresults->busType}";

$doj ="{$ticketresults->doj}";

$pickUpLocationAddress ="{$ticketresults->pickUpLocationAddress}";

$pickupLocationLandmark ="{$ticketresults->pickupLocationLandmark}";

$pnr ="{$ticketresults->pnr}";

$tin ="{$ticketresults->tin}";

$pickUpContactNo ="{$ticketresults->pickUpContactNo}";

$pickupTime ="{$ticketresults->pickupTime}";

$phour = floor($pickupTime/60);

$pmin = ($pickupTime %60);

$phrmin = $phour .":".$pmin; 

$pickuptime  = date ("g:i A", strtotime($phrmin));


$nop = count($ticketresults->inventoryItems);

?>

<div id="DivIdToPrint">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page  
{ 
    size: auto;   /* auto is the initial value */ 

    /* this affects the margin in the printer settings */ 
    margin: 0mm 0mm 0mm 0mm;  
}
</style>
<style>
td, tr, th{
padding : 8px; font-size:13px !important; text-align:left !important;
}
th{ background-color:#F4F4F4; font-weight:600 !important;}
}

</style>

<div id="content">
   
<div class="container">

<div class="row">
<table class="scaleUp" width="100%" style=" margin-top: 15px;border-radius: 5px;background: #fff;">
<tbody><tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td align="center">
		<table>
		</table><div class="gap"></div><table width="98%" align="center" style="font-family: arial;color:#2e2d2d;">

	<tbody>

	<tr>
	  <td valign="bottom" height="40"  ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
         <td width="50%" align="left" valign="top" style="border-bottom:1px solid #ddd;" class="hcompanyinfo"><img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="44"></td>
    <td width="50%" style="border-bottom:1px solid #ddd;" class="hcompanyinfo">
		<strong><?php echo stripslashes($agentData['companyName']); ?></strong> <br> 
		<strong>Phone:</strong> <?php echo stripslashes($agentData['phone']); ?><br>
		<strong>Email:</strong> <?php echo stripslashes($agentData['email']); ?><br>
		<strong>Address:</strong> <?php echo stripslashes($agentData['address']); ?></td>
          </tr>
        
      </table></td>
	  </tr>
	<tr>
		<td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Booking Details:</td>
	</tr>
	
	<tr>
		<td align="center">
			<table width="100%" cellspacing="0" cellpadding="10" style="font-size:15px;border-collapse:collapse;color:#2e2d2d;">
				<tbody><tr>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Bus Id</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['ticket_no']; ?></td>
					<td width="6%">&nbsp;</td>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">PNR</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['ticket_no']; ?></td>
				</tr>
				<tr>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">e-Ticket No.</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['ticket_no']; ?></td>
					<td width="6%">&nbsp;</td>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">No. of Passengers</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $nop; ?></td>
				</tr>
				<tr>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Source</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['from_city']; ?></td>
					<td width="6%">&nbsp;</td>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Destination</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['to_city']; ?></td>
				</tr>
				<tr>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Bus Operator</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['t_agency_name']; ?> </td>
					<td width="6%">&nbsp;</td>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Bus Type</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['fare1']; ?></td>
				</tr>				
				<tr>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Bus Departure</td>
					<td width="27%" style="border:2px solid #2e2d2d;"><?php echo $busResult['dep_time']; ?></td>
					<td width="6%">&nbsp;</td>
					<td width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;">Total Fare</td>
					<td width="27%" style="border:2px solid #2e2d2d;">Rs. <span  id="displayhtotalamount" ><?php echo round($busResult['ticket_cost']); ?></span><input  id="htotalamount" type="hidden" value="<?php echo round($busResult['ticket_cost']); ?>" /></td>
				</tr>
			</tbody></table>		</td>
	</tr>
	<tr>
		<td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Passenger Details:</td>
	</tr>
	<tr>
		<td valign="bottom" style="font-size:15px;">
			<table width="100%" cellspacing="0" cellpadding="10" style="border-collapse: collapse;color: #2e2d2d;">
				<tbody><tr>
					
					<th width="40%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Name</th>
					<th width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Seat</th>
					<th width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Ladies Seat</th>
					<th width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">ID Number</th>
				</tr>
				<?php 

				$pasengerQ=GetPageRecord('*','bus_passenger_info','bookingId="'.base64_decode($_REQUEST['i']).'" '); 
				while($passengerDetailArr=mysqli_fetch_array($pasengerQ))
				{ 
				
				?>
								
				<tr>
				<td align="center" style="border:2px solid #2e2d2d;"><?php echo $passengerDetailArr['title']." ".$passengerDetailArr['name']; ?>  </td>
				<td align="center" style="border:2px solid #2e2d2d;"><?php echo $passengerDetailArr['seat']; ?></td>
				<td align="center" style="border:2px solid #2e2d2d;"><?php echo $passengerDetailArr['ladies']; ?></td>
				<td align="center" style="border:2px solid #2e2d2d;"><?php echo $passengerDetailArr['idType']." - ". $passengerDetailArr['idNumber']; ?></td>
				</tr>
				
				<?php } ?>				
							</tbody></table>		</td>
	</tr>
	<tr>
		<td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Boarding Point Details:</td>
	</tr>
	<tr>
		<td valign="bottom" style="font-size:15px;">
			<table width="100%" cellspacing="0" cellpadding="10" style="border-collapse: collapse;color: #2e2d2d;">
				<tbody><tr>
					<th width="35%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Boarding Point</th>
					<th width="35%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Land Mark</th>
					<th width="15%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Boarding Date</th>
					<th width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Boarding Time</th>
				</tr>
			
				<tr>
					<td align="center" style="border:2px solid #2e2d2d;"><?= $pickUpLocationAddress ?></td>
					<td align="center" style="border:2px solid #2e2d2d;"><?php echo $pickupLocationLandmark; ?></td>
					<td align="center" style="border:2px solid #2e2d2d;"><?php echo date('j F Y',strtotime($busResult['booking_date'])); ?></td>
					<td align="center" style="border:2px solid #2e2d2d;"><?= $pickuptime ?></td>
				</tr>
			</tbody></table>
			<span style="line-height:25px;"><span style="color:#FF0000;">*</span> Please reach your boarding point 15 minutes before the scheduled time</span>		</td>
	</tr>
	
	<tr>
	  <td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Bus Operator Details:</td>
	  </tr>
	<tr>
	  <td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;"><table width="100%" cellspacing="0" cellpadding="10" style="border-collapse: collapse;color: #696969;">
        <tr>
          <th width="45%" style="border:2px solid #696969;font-size: 17px;background:;font-weight:normal;">Bus Operator Name</th>
          <th width="35%" style="border:2px solid #696969;font-size: 17px;background:;font-weight:normal;">Bus Type</th>
          <th width="20%" style="border:2px solid #696969;font-size: 17px;background:;font-weight:normal;">Contact Number</th>
        </tr>
        <tr>
          <td align="center" style="border:2px solid #696969;"><?= $travels ?></td>
          <td align="center" style="border:2px solid #696969;"><?= $busType ?></td>
          <td align="center" style="border:2px solid #696969;"><?= $pickUpContactNo ?></td>
        </tr>
      </table></td>
	  </tr>
	<tr>
		<td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Dropping Point Details:</td>
	</tr>
	<tr>
		<td valign="bottom" style="font-size:15px;">
			<table width="100%" cellspacing="0" cellpadding="10" style="border-collapse: collapse;color: #2e2d2d;">
				<tbody><tr>
					<th width="35%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Dropping Point</th>
					<th width="35%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Land Mark</th>
					<th width="15%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Dropping Date</th>
					<th width="20%" style="border:2px solid #2e2d2d;font-size: 17px;background:;font-weight:normal;  text-align:center;">Dropping Time</th>
				</tr>
			
				<tr>
					<td align="center" style="border:2px solid #2e2d2d;"><?php echo $busResult['b_time']; ?></td>
					<td align="center" style="border:2px solid #2e2d2d;">&nbsp;</td>
					<td align="center" style="border:2px solid #2e2d2d;">&nbsp;</td>
					<td align="center" style="border:2px solid #2e2d2d;"></td>
				</tr>
			</tbody></table>
			<span style="line-height:25px;"><span style="color:#FF0000;">*</span> Please reach your boarding point 15 minutes before the scheduled time</span>		</td>
	</tr>
	

	<tr>
	  <td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Cancellation Policy :</td>
	  </tr>
	<tr>
	  <td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;"> 
	  <table width="100%" class="table table-hover table-bordered bg-light">
                                  <thead class="thmscolor" style="color: #fff;">
                                  </thead>
                                  
                                     
                			     <tbody>
                			          <?php
									   $cancelpolicy=stripslashes($busResult['cancelationPolicy']);
                                        $cancelarray = explode(";",$cancelpolicy); 
                                        foreach($cancelarray as $val){
                                            $arrc=explode(":",$val);
                                           if($arrc[0] != ""){
                                            if($arrc[1] < 0){
                                                $strhour = $arrc[0]." hours before journey time";
                                            }else {
                                                $strhour = "Between ".$arrc[1]." hours and ".$arrc[0]." hours before journey time";
                                            }
                                    ?>
                                    <tr>
                                     
                                      <td class="text-center">
                                          <div align="left"><span class="contval"><?php echo $strhour;?> </span> </div></td>
                                      <td class="text-center">
                                          <div align="center"><span class="contval"><?php echo $arrc[2].".0";?> %</span> </div></td>
                                    </tr>
                                   <?php } } ?>
                          </tbody>
                        </table>
	   </td>
	  </tr>
	<tr>
		<td valign="bottom" height="40" style="font-size: 20px; padding-bottom: 1%;">Terms &amp; Conditions:</td>
	</tr>	
	<tr>
		<td valign="bottom" style="border:2px solid #2e2d2d;padding:2%;">
			<ul style="padding: 0px 0px 0px 10px; font-size: 14px; text-align: justify; margin: 0px; list-style: square outside none;">
				<li style="margin-bottom:10px;">https://www.flyshop.in/ is only providing the services as an agent of various tour operators. https://www.flyshop.in/ obligations are limited to issuance of ticket, providing information as made available to it and processing refunds. https://www.flyshop.in/ is not responsible for the provision of services by the respective operator. https://www.flyshop.in/ assumes no responsibility or liability for the actions or omissions of the operators including nonadherence of the scheduled timings, behavior of the operator's staff, conditions inside the buses, loss of life or property, delay, breakdown or inconvenience suffered by the user or passenger.</li>
				<li style="margin-bottom:10px;">The bus e-ticket booked is non transferable.</li>
				<li style="margin-bottom:10px;">The bus operator reserves the right to change the seat number(s) of the passenger(s).</li>
				<li style="margin-bottom:10px;">The bus operator reserves the right to change the boarding point and/or use a pick-up vehicle at the boarding point to take customers to the bus departure point.</li>
				<li style="margin-bottom:10px;">The departure and arrival timings mentioned on the e-ticket are only tentative timings. The same are subject to change.</li>
				<li style="margin-bottom:10px;">The bus trips may be delayed, postponed or cancelled due to unavoidable reasons.</li>
				<li>Provision of video, air conditioning or any such other services is the responsibility of the bus operator. Any refunds/claims due to non-functioning or unavailability of these services needs to be settled directly with the service provider (the bus operator).</li>
				<li>Contact Number: Ahmedabad : 079-39412345, Bangalore : 080-39412345, Hyderabad : 040-39412345, Chennai : 044-39412345, Mumbai : 022-39412345, Pune : 020-39412345, Delhi : 011-39412345</li>
			</ul>		</td>
	</tr>
	<tr>
		<td valign="bottom" height="20">&nbsp;</td>
	</tr>
	<tr>
		<td valign="middle" align="right" height="40" style="font-size: 17px;padding-right:1%;background:;color:#FFFFFF;font-size:16px;">https://www.flyshop.in/</td>
	</tr>
	        
  
		
            
                    
                
            
                
       





  <!-- Content end -->
 </tbody></table></td></tr></tbody></table></div></div></div>



</div>
 <?php //if($_REQUEST['sm']==''){ ?>
<div style="text-align: right; width: 100%;"><button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();'>Print / Download</button></div>
<?php //} ?>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>