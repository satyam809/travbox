 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Bus Booking</h4> 
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
				<option value="">Select Status</option>
				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>
				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>
				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>
			</select> 
			</div>
			</div>
		
		<div class="col-xl-3">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
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
			<?php if($_REQUEST['did']!=''){ ?>
			<div class="alert alert-success alert-styled-right alert-arrow-right alert-dismissible">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
										 Bus Booking Successfully. <strong>Booking ID: <?php echo $_REQUEST['did']; if($_REQUEST['rid']!=''){ ?> - Return Bus Booking ID: <?php echo $_REQUEST['rid']; } ?></strong>								    </div>
									<?php  }?>
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Bus Booking List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=bussetting"><button type="button" class="btn btn-primary btn-sm">Bus Setting</button></a>
		                		  
		                	</div>
	                	</div>
						
						
			  </div>		 

				 
									<table class="table">
							<thead>
								<tr>
								  <th>Ticket No. </th>
								  <th>Agent</th>
								  <th>Source</th>
									<th>Time</th>
									<th>Agency</th>
									<th>Passenger</th>
									<th>Amount</th>
									<th align="left">Status</th>
								    <th align="left">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (tripid = "'.$_REQUEST['keyword'].'" or  ticket_no like "%'.$_REQUEST['keyword'].'%"  or  to_city like "%'.$_REQUEST['keyword'].'%"   ) ';
}
 
 $targetpage='bus-booking?status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
   
$rs=GetRecordList('*','busbookingMaster',' where 1 and tripid!=""   and agentUserid in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.' order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$ag=GetPageRecord('COUNT(id) as totaladult','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="adult" '); 
$totalbookungpax_adult=mysqli_fetch_array($ag);


$ag=GetPageRecord('COUNT(id) as totalchild','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="child" '); 
$totalbookungpax_child=mysqli_fetch_array($ag);
 
$ag=GetPageRecord('roomNo','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'"  order by roomNo desc '); 
$totalbookungpax_room=mysqli_fetch_array($ag);
 



 
$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentUserid'].'" '); 
$agentData=mysqli_fetch_array($ag);
$clientName='';
$clientEmail='';
$clientPhone='';

$clientName=strip($agentData['companyName']);
$clientEmail= ($agentData['email']);
$clientPhone= ($agentData['phone']);

if($rest['clientId']>0){
$ag=GetPageRecord('*','clientMaster',' id="'.$rest['clientId'].'" '); 
$clientData=mysqli_fetch_array($ag);

$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);
}

if($agentData['isAgent']==0){
$clientName= ($clientData['name']);
}




?>
								
								<tr>
								  <td align="left" valign="top">
								  <strong><?php echo $rest['ticket_no']; ?></strong>
								  <div style="font-size:11px; color:#666666;">Ref. <?php echo encode($rest['id']); ?></div>
								  <div style="width:140px; font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
								  <td><div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;font-weight:600;"> <?php if($agentData['isAgent']==0){ ?><span class="badge bg-blue">B2C Client</span><?php } else { ?><span class="badge bg-black" style="background-color:#000;">Agent</span><?php } ?></div>

	

	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><?php echo $clientName; ?></span> &nbsp;
	<?php if($agentData['isAgent']==1){ ?>
	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentUserid']); ?>" style="cursor:pointer;"></i>
	<?php } ?>
	
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientEmail; ?></div>
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientPhone; ?></div>	</td>
								  <td align="left" valign="top">From: <strong><?php echo $rest['from_city']; ?></strong><br>
To: <strong><?php echo $rest['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($rest['booking_date'])); ?></strong></td>
									<td align="left" valign="top">Dep: <strong><?php echo  $rest['dep_time']; ?></strong><br>
Arr:  <strong><?php echo  $rest['d_loc']; ?></strong></td>
									<td align="left" valign="top"><div style="width:130px;"><?php echo  $rest['t_agency_name']; ?><br>
Bus: <strong><?php echo stripslashes($rest['fare1']); ?></strong></div></td>
									<td align="left" valign="top"> 
									<?php 
		$rs6=GetPageRecord('*','bus_passenger_info',' bookingId="'.$rest['id'].'" and name!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
	  <div style="margin-bottom:2px; border-bottom:1px solid #ddd;"><strong><i class="fa fa-user" aria-hidden="true"></i> <?php echo stripslashes($paxData['title']); ?> <?php echo stripslashes($paxData['name']); ?></strong> (<?php echo stripslashes($paxData['age']); ?>) Seat: <?php echo stripslashes($paxData['seat']); ?></div>
	  <?php } ?>									</td>
									<td align="left" valign="top">Buying: <strong>&#8377;<?php echo round($rest['totalFare']-$rest['agentMarukup']); ?></strong><br />
Selling: <strong>&#8377;<?php echo round($rest['totalFare']); ?></strong><br />
Profit: <strong>&#8377;<?php echo round($rest['agentMarukup']); ?></strong></td>
									<td align="left" valign="top"><?php if($rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>									</td>
								    <td align="left" valign="top"> 
									<?php if($rest['status']==2){ ?><button type="button" class="btn btn-primary btn-sm" onClick="loadpop('View Bus Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewbusVoucher&i=<?php echo  ($rest['id']); ?>&page=">Voucher</button><?php } ?></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
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

$('#savedatasub').load('actionpage.php?action=savepickedbyhotel&id='+id+'&pickedBy='+pickedBy);

}

</script>



   