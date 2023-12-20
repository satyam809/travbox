 <?php

 $limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['agent']!=''){
$search.=' and  agentId="'.$_REQUEST['agent'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
$fromdate=date('d-m-Y',strtotime($_REQUEST['fromdate']));
$todate=date('d-m-Y',strtotime($_REQUEST['todate']));
} else {
$search.=' and  DATE(bookingDate)>="'.date('Y-m-'.'1').'" and  DATE(bookingDate)<="'.date('Y-m-t').'" ';
$fromdate=date('1-m-Y');
$todate=date('t-m-Y');
}


if($_REQUEST['keyword']!=''){
$search.=' and  (invoiceId like "%'.$_REQUEST['keyword'].'%" or  pnrNo like "%'.$_REQUEST['keyword'].'%"   ) ';
}



$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet',' agentId="'.$_SESSION['userid'].'" and paymentType="Credit" and offlineAgent=0 '); 
$agentCreditAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','  agentId="'.$_SESSION['userid'].'"  and paymentType="Debit" and offlineAgent=0 '); 
$agentDebitAmt=mysqli_fetch_array($rs8); 

$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
?>
 
 <div class="page-header" style="margin-top: 46px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Agent Statement </h4> 
			</div>
			
			<div style="float:right; width:60%;" class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $fromdate; ?>"  readonly >
		
			</div>
		  </div>
				
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $todate; ?>" readonly>
		
			</div>
		  </div>
			
			
			<script>
		$( function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  </script>
			 
				
		<div class="col-xl-3">
			<div class="input-group">
			<select id="agent" name="agent" class="form-control"  data-placeholder="All Source"  autocomplete="off"  onchange="$('#searchform').submit();">   
				<option value="">All Agents</option>   
			 <?php  
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['id'].'" and userType="agent" order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<option value="<?php echo $rest['id']; ?>" <?php if($_REQUEST['agent']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>    
		<?php } ?>
</select> 
			</div>
		  </div> 
		
		<div class="col-xl-3">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			<a href="export_agentstatement.php?fromdate=<?php echo $fromdate; ?>&todate=<?php echo $todate; ?>&agent=<?php echo $_REQUEST['agent']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="margin-left:5px;">Export</button></a>
			</span>
			</div>
		  </div>
				
				
		 	  </div>
		</form>										
	 	  </div> 
		</div>
		
				
</div>

<div class="page-content pt-0" > 
		
 	
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Agent Statement List</h5>
						 
			  </div>		 

				 
						<table class="table table-bordered table-striped" style=" margin-bottom:0px;">
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
			 

if($_REQUEST['agent']>0){
$search.=' and  bookingId in(select id from flightBookingMaster where agentId="'.$_REQUEST['agent'].'")  ';
}
		
	 
							
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
  
$targetpage='display.html?ga=agentstatement&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_balanceSheet',' where  agentId="'.$_SESSION['userid'].'" and bookingType!="hotel_GST" '.$search.' and 1  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
if($agentWebsitePages['amount']>0){
	
//Opening Balance Debit Amount
$openBalDebited=GetPageRecord('SUM(amount),agentId','sys_balanceSheet','    agentId="'.$_SESSION['userid'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalDebitedData=mysqli_fetch_array($openBalDebited);
$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];


//Opening Balance Credit Amount
$openBalCredited=GetPageRecord('SUM(amount),agentId','sys_balanceSheet','    agentId="'.$_SESSION['userid'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
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
?>
<tr>
  <td align="left" valign="top"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	<td align="left" valign="top"><a href="display.html?ga=agents&id=<?php echo encode($agentData['id']); ?>&view=1" target="_blank"><strong><?php echo strip($agentData['companyName']); ?></strong></a>
  <div style="font-size:12px;"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo strip($agentData['phone']); ?><br />
<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo strip($agentData['email']); ?></div></td>
	<td align="left" valign="top"> 
	
	
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
	<?php } ?></td>
	<td align="left" valign="top">
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
	<?php } else { ?>
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
 } ?><?php } ?><?php } ?>

<?php if($agentWebsitePages['bookingType']=='Markup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Flight Markup'; ?></span><?php } ?>
<?php if($agentWebsitePages['bookingType']=='hotelMarkup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Hotel Markup'; ?></span><?php } ?>
<?php } ?>

<?php if($agentWebsitePages['bookingType']=='RejectBankRefund'){ ?> <strong><?php echo $agentWebsitePages['remarks']; ?></strong> <?php }  ?></td>
	<td align="center" valign="top"><div align="center">
	
	
	<?php if($agentWebsitePages['paymentType']=='Credit'){ ?> 
	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>
	<?php } ?>
	<?php if($agentWebsitePages['bookingId']!=""){ ?>
	<span class="badge badge-primary">Wallet</span>
	<?php } ?>		
	
	
							  
	</div></td>
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
					  
			  </div>
					
					
		  </div>
			<!-- Icons alignment -->

			 
  </div>
			
</div>




   