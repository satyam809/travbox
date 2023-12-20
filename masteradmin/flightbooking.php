 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline"  style="    margin-top:50px;">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> -  Online Flight Booking</h4> 
			</div>
			
			<div style="float:right; width:60%;" class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >
		
			</div>
			</div>
				
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
		
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
			<select id="status" name="status" class="form-control" data-placeholder="Select Status" autocomplete="off">   
				<option value="">Show All</option>
				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>
				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>
				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>
				<option value="4" <?php if($_REQUEST['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>
			</select> 
			</div>
			</div>
		
		<div class="col-xl-2">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
			</div>
			
			<div class="col-xl-1">
			<button class="btn btn-light bg-primary border-primary text-white" type="button" onclick="exportData();">Export</button>
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
						 
					

			<div class="card-header header-elements-inline" style="    padding: 0px 8px;">
						<h5 class="card-title"> 
						
						<table border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=2&keyword="><div style="background-color: #46cd93; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px; "><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1 and agentOffline=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and status=2'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></div></a></td>
    <td style="padding-left:0px;">Confirmed</td>
    <td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=3&keyword="><div style="background-color: #f9392f; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1 and agentOffline=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and status=3'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></div></a></td>
    <td style="padding-left:0px;">Cancel</td>
	
	<td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=4&keyword="><div style="background-color: #f9392f; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1 and agentOffline=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and status=4'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></div></a></td>
    <td style="padding-left:0px;">Rejected</td>
    <td>
	<a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=1&keyword="><div style="background-color: #FF6600; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1 and agentOffline=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and (status=1 or status=0)'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></div></a>
	
	</td>
    <td style="padding-left:0px;">Pending </td>
  </tr>
</table>

						
						</h5>
						<div class="header-elements">
							<div class="list-icons">
							<div style="float:left; font-size:16px; margin-right:20px;">Flight API Balance: <strong id="loadyourbalance" style="color:#CC0000;">0</strong></div>
							 <script>
				 $('#loadyourbalance').load('loadyourbalance.php');
				 </script>
							
		                		<!-- <a href="display.html?ga=flightquery"><button type="button" class="btn btn-success btn-sm">Flight Query</button></a>-->
		                		 <a href="display.html?ga=commissiontype"><button type="button" class="btn btn-primary btn-sm">Flight Setting</button></a>
		                		  
		                	</div>
	                	</div>
			  </div>		 

				 <script>
				 $('#loadapibalance').load('loadapibalance.php');
				 </script>
				 
				 </div>
			
			 
			
			
			
			
			<div class="card">
						 
					
 
				 
				 
				 <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-bordered table-striped" style="white-space: nowrap;">
  <tr>
    <td><strong>Booking Date </strong></td>
    <td><strong>Sector</strong></td>
    <td><strong>Journey Date </strong></td>
    <td><strong>Passanger </strong></td>
    <td><strong>Agent/Travller</strong></td>
    <td><strong>PNR</strong></td>
    <td><strong>Statement</strong></td>
    <td width="1%"><strong>Action</strong></td>
    </tr>
	<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and  status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(journeyDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(journeyDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" )) ';
}
 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentOffline=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and agentBookingType=0 and bookingType=0 '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
$clientName='';
$clientEmail='';
$clientPhone='';

$clientName=strip($agentData['companyName']);




$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight" '); 

 
$ag=GetPageRecord('*','clientMaster',' id="'.$rest['clientId'].'" '); 
$clientData=mysqli_fetch_array($ag);

if($agentData['isAgent']==0){
$clientName= ($clientData['name']);
}
$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);

?>
  <tr>
    <td>
	 <?php if($rest['status']==1 || $rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>	
	<div style="font-size:12px; margin:5px 0px 0px;"><span class="badge bg-black" style="background-color: #e8e8e8; font-size: 12px; color: #000;"><?php echo encode($rest['id']); ?></span></div>
	
	<?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?><div style="font-size:12px;"><?php
	$rs7=GetPageRecord('*','sys_userMaster',' 1 and id in (select parentId from sys_userMaster where id="'.$rest['agentId'].'" ) '); 
		$parentwebsiteagent=mysqli_fetch_array($rs7); ?>
		 		</div>
		
		
		<?php if($rest['status']==2){

$abc=GetPageRecord('id,addDate','ticketCancelRequest',' flightBookingId="'.$rest['id'].'"'); 
$cancelrequestdata=mysqli_fetch_array($abc);

if($cancelrequestdata['id']>0){
 ?><div style="color: #fff; background-color: #CC0000; padding: 0px 5px;font-size:12px;"><strong>Cancellation Request</strong><br /><span><?php echo date("d-m-Y H:i:s",strtotime($cancelrequestdata['addDate'])); ?></span></div><?php } } ?>		</td>
    <td>From: <?php $arr = explode('-',$rest['source']); echo $arr[1]; ?><br />
To: <?php $arr2 = explode('-',$rest['destination']); echo $arr2[1]; ?></td>
    <td>
	<span style="color:#000;"><i class="fa fa-plane" aria-hidden="true"></i> <strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br>
</span>
	<div style="color:#CC0000; margin-top:2px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></div>
	<div style="color:#0066CC; margin-top:2px;"><?php if($rest['tripType']==1){ echo 'Oneway'; } else { echo 'Round Trip'; } ?> </div>	</td>
    <td><?php 
	  $ns=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  
	  ?>
	  <div><i class="fa fa-user" aria-hidden="true"></i> <strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></div>
	  <?php } ?>	  </td>
    <td><div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;font-weight:600;"> <?php if($agentData['isAgent']==0){ ?><span class="badge bg-blue">B2C Client</span><?php } else { ?><span class="badge bg-black" style="background-color:#000;">Agent</span><?php } ?></div>

	

	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><?php echo $clientName; ?></span> &nbsp;
	<?php if($agentData['isAgent']==1){ ?>
	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>
	<?php } ?>
	
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientEmail; ?></div>
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientPhone; ?></div>	</td>
    <td> 
	<div style="font-size:12px; margin:5px 0px 0px;"><span class="badge bg-black" style="background-color: #e8e8e8; font-size: 12px; color: #000; display:none;"><?php // echo stripslashes($rest['bookingNumber']); ?></span></div>
	<?php if($rest['pnrNo']!=''){?><span class="badge bg-blue" style="color:#009900;font-size:14px;font-weight:700;background-color: #fff;"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($rest['pnrNo']); ?>  </span><?php } ?>
	 
 
	
	<div><?php 
	$rs8=GetPageRecord('*','fareTypeMaster',' flightName="'.$rest['flightName'].'"  and fareTypeName like "%'.$pnrstring[1].'%"'); 
		$parentwebsiteagent=mysqli_fetch_array($rs8);
		?>
	 <span class="badge badge-boxed  badge-soft-success" style=" background-color:<?php echo $parentwebsiteagent['displayColor']; ?> !important; color:#fff; margin-top:2px; font-size: 11px; padding:2px 6px;"><?php echo $parentwebsiteagent['displayType']; ?></span>	</div>
	<div style="font-size:12px; color:#009900; <?php if($rest['refundyes']=='REFUNDABLE'){   } else { echo 'color:#FF0000'; } ?>">
	<?php if($rest['refundyes']=='REFUNDABLE'){ echo 'Refundable'; } else { echo 'Non Refundable'; } ?>
	</div>	</td>
    <td><strong>Buying: &#8377;<?php 
	
	$totalbuying=($rest['agentTax']-$rest['clientTax']);
	
	
	echo $totalbuyingcost=(($rest['agentTotalFare']-$totalbuying)); ?> </strong>
	
	



<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#CC0000;">Selling: <strong>&#8377;<?php echo ($rest['agentTotalFare']); ?></strong></div>

<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#009900;">Profit: <strong>&#8377;<?php echo ($totalbuying); ?></strong></div>

<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#3366CC;">Comm.: <strong>&#8377;<?php echo ($rest['agentCommision']); ?></strong></div>
</td>
    <td width="1%"><div class="btn-group" role="group" aria-label="Option">

	 

  <a  onclick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i></button></a>

  
 
  <?php if($rest['pnrNo']!=''){?>
  <a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($rest['id']); ?>" target="_blank"><button type="button" class="btn btn-secondary"><i class="fa fa-info" aria-hidden="true"></i></button></a>
  	<?php } ?>

   
 

   </div></td>
    </tr>
	 <?php $sNo++; } ?>
</table>
				 
				 
				 
						 	
					 <div class="card-footer text-right">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
					
					
		  </div>
			<!-- Icons alignment -->

			 
				</div>
			
</div>
<div style=" display:none;" id="savedatasub"></div>
<script>
function pickedbyfun(id){
var pickedBy=0;
if($("#pickedBy"+id).prop('checked') == true){
    pickedBy=1;
}
$('#savedatasub').load('actionpage.php?action=savepickedby&id='+id+'&pickedBy='+pickedBy);
}
</script>



 <script>
function exportData(){
	var fromdate=$('#fromdate').val();
	var todate=$('#todate').val();
	var keyword=$('#keyword').val();
	var status=$('#status').val();
	var requestedAmount=$('#requestedAmount').val();
	window.location.href="exportonlineflightbooking.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&status="+status;
}
</script>