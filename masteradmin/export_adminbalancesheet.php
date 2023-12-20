<?php include "inc.php"; 
$file="Agent-Statement.xls"; 
header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
header("Content-Disposition: attachment; filename=$file");
 
?>
 



   <table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="table table-bordered table-striped" style=" margin-bottom:0px;">
							<thead>
								<tr>
								  <th align="left">Date</th>
								  <th align="left">Agent</th>
								  <th align="left">Reference No.</th>
								  <th align="left">Description</th>
								  <th align="center"><div align="center">Method</div></th>
								  <th align="right"><div align="right">Credit</div></th>
								  <th align="right"><div align="right">Debit</div></th>
								  <th align="right"><div align="right">Running Balance</div></th>
								</tr>
							</thead>
							<tbody> 
<?php
$search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
$search.=' and ( (bookingId="'.decode($_REQUEST['keyword']).'" ) or bookingId in (select BookingNumber from hotelBookingMaster where id="'.decode($_REQUEST['keyword']).'" ) ) ';
}
		
							
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
  
$targetpage='display.html?ga=adminbalancesheet&agentCategory='.$_REQUEST['agentCategory'].'&id='.$_REQUEST['id'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and  agentId in (select id from sys_userMaster where id="'.$_SESSION['userid'].'")  order by id desc  ','25000',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
if($agentWebsitePages['amount']>0){
	
//Opening Balance Debit Amount
$openBalDebited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalDebitedData=mysqli_fetch_array($openBalDebited);
$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];


//Opening Balance Credit Amount
$openBalCredited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalCreditedData=mysqli_fetch_array($openBalCredited);
$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];
$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	
	

$totalDebit+=$openBalDebitedAmount;

$totalCredit+=$openBalCreditedAmount;

 





if($agentWebsitePages['billType']=='flight'){ 

$ag=GetPageRecord('*','sys_userMaster',' id in (select agentId from flightBookingMaster where id="'.$agentWebsitePages['bookingId'].'")   '); 
$agentData=mysqli_fetch_array($ag);

}

if($agentWebsitePages['billType']=='bus'){ 

$ag=GetPageRecord('*','sys_userMaster',' id in (select agentUserid from busbookingMaster where id="'.$agentWebsitePages['bookingId'].'")   '); 
$agentData=mysqli_fetch_array($ag);

}


if($agentWebsitePages['billType']=='hotel'){ 

$ag=GetPageRecord('*','sys_userMaster',' id in (select agentId from hotelBookingMaster where BookingNumber="'.$agentWebsitePages['bookingId'].'")   '); 
$agentData=mysqli_fetch_array($ag);

}

if($agentWebsitePages['bookingId']==0){
$ag=GetPageRecord('*','sys_userMaster','  id="'.$agentWebsitePages['agentId'].'"  '); 
$agentData=mysqli_fetch_array($ag);
}
?>
<tr>
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	<td align="left" valign="top">
	 
 <strong><?php echo strip($agentData['companyName']); ?></strong> 
  <div style="font-size:12px;"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo strip($agentData['phone']); ?><br />
<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo strip($agentData['email']); ?></div> </td>

	<td align="left" valign="top">
	
	
	
	
	<?php if($agentWebsitePages['paymentMethod']!=''){ ?>
	<strong><?php echo $agentWebsitePages['transactionId']; ?><?php echo $agentWebsitePages['remark']; ?></strong>
	<?php } else {  ?>
	
	<?php  if($agentWebsitePages['billType']=='flight'){ 
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b); 
	?>
	<strong><?php echo encode($getflightbookingdata['id']); ?></strong>  
	<?php } ?>
	 
	
	<?php if($agentWebsitePages['billType']=='hotel'){ 
	
	$b=GetPageRecord('*','hotelBookingMaster','BookingNumber="'.$agentWebsitePages['bookingId'].'" '); 
	$gethotelbookingdata=mysqli_fetch_array($b); 
	?>
		<strong><?php echo encode($gethotelbookingdata['id']); ?></strong>  
 	<?php } ?>
 
	
	
	<?php if($agentWebsitePages['billType']=='bus'){ 
	
	$b=GetPageRecord('*','busbookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$busdata=mysqli_fetch_array($b);
	?>
	<strong><?php echo encode($busdata['id']); ?></strong>
	<?php } ?>
	<?php } ?>	</td>
	<td align="left" valign="top">
	<?php if($agentWebsitePages['paymentMethod']!=''){ ?>
	<strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Wallet Recharge</strong>
	<?php } else { ?>
 
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating' || $agentWebsitePages['bookingType']=='Facilitating_GST'){?>
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating'){ ?>
	<strong style="color:#CC0000;">Facilitating Charges</strong>
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='Facilitating_GST'){ ?>
	<strong style="color:#CC0000;">18% GST on Facilitating Charges</strong>
	<?php } ?>
	
	
	<?php } else { ?>
	
	
	
	<?php if( $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='flight_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='hotelTDS' || $agentWebsitePages['bookingType']=='hotelMarkup'){ ?>
	
		
	<?php if($agentWebsitePages['bookingType']=='flight_commision'){ echo '<strong>Flight commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='TDS'){ echo '<strong>Flight TDS dedection 5%</strong>'; } ?>
	
	
	 
	 
	<?php if($agentWebsitePages['bookingType']=='hotel_commision'){ echo '<strong>Hotel commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='hotelTDS'){ echo '<strong>Hotel TDS dedection 5%</strong>'; } ?>
	
	
	
	
	<?php  } else { ?>
	
	
		<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b);
	?>
	Flight: <strong><?php echo stripslashes($getflightbookingdata['flightName']); ?> <?php echo stripslashes($getflightbookingdata['flightNo']); ?></strong><br>
	Destination: <strong><?php echo stripslashes($getflightbookingdata['source']); ?> > <?php echo stripslashes($getflightbookingdata['destination']); ?></strong><br>
	Fare Type: <strong><?php  echo getfaretypedisplayname(stripslashes($getflightbookingdata['flightName']),stripslashes($getflightbookingdata['pcc']));  ?></strong></strong><br>
	Class: <strong><?php echo stripslashes($getflightbookingdata['flightClass']); ?></strong>
	<?php } else { 
	
	if($agentWebsitePages['billType']=='hotel'){
	?>
	Hotel: <strong><?php echo $gethotelbookingdata['HotelName']; ?></strong> <br>
City: <strong><?php echo $gethotelbookingdata['Destination']; ?></strong><br>
Check-In: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckIn'])); ?></strong><br>
Check-Out: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckOutDate'])); ?></strong>
 
 							   
<?php }
if($agentWebsitePages['billType']=='bus'){

 
if($busdata['ticket_no']!=''){
 ?>
Ticket No.: <strong><?php echo $busdata['ticket_no']; ?></strong><br>
From: <strong><?php echo $busdata['from_city']; ?></strong><br>
To: <strong><?php echo $busdata['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($busdata['booking_date'])); ?></strong>
	 
 
 
 							   
<?php
} 
}
 } ?>



<?php } ?>

<?php if($agentWebsitePages['bookingType']=='Markup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Flight Markup'; ?></span><?php } ?>
<?php if($agentWebsitePages['bookingType']=='hotelMarkup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Hotel Markup'; ?></span><?php } ?>
<?php } ?>

<?php if($agentWebsitePages['bookingType']=='RejectBankRefund'){ ?> <strong><?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></strong> <?php }  ?>
 
<?php } ?>
<?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></td>
	<td align="center" valign="top"><div align="center">
	
	
	
	<?php if($agentWebsitePages['paymentType']=='Credit'){ ?> 
	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>
	<?php } else { ?>
	<?php if($agentWebsitePages['bookingId']!=""){ ?>
	<span class="badge badge-primary">Wallet</span>
	<?php } } ?>	
	
	<?php if($agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='flight_commision'){ ?>
	<span class="badge badge-primary">Wallet</span>
	<?php }  ?>	
								  
	</div>	</td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Credit'){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Debit'){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	
	<td align="right" valign="top"><div align="right"><?php echo strip($balance); ?> INR</div></td>
						      </tr>
								
								<?php } } ?>
								 
								<tr>
								  <td colspan="8" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div></td>
							  </tr>
							</tbody>
</table>
