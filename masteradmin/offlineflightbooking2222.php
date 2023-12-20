 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Offline Flight Booking</h4> 
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
			<select id="status" name="status" class="form-control"  data-placeholder="Select Status"  autocomplete="off">   
				<option value="">Select Status</option>
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
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Offline Flight Booking List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=flightquery"><button type="button" class="btn btn-success btn-sm">Flight Query</button></a>
		                		 <a href="display.html?ga=blockflights"><button type="button" class="btn btn-primary btn-sm">Flight Setting</button></a>
		                		 <a href="getFlightTicket.php" target="actoinfrm" onclick="$('#getpnrptn').html('Fetching PNR Data...');"><button type="button" class="btn btn-primary btn-sm  bg-teal-400" id="getpnrptn" style="background-color:#26a69a;">Get PNR</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Booking Date </th>
								  <th>Agent</th>
								  <th>Trip&nbsp;Type </th>
								  <th>ID</th>
								  <th>Flight</th>
									<th>From</th>
									<th>To</th>
									<th>Departure Date </th>
									<th>PNR</th>
									<th>Update Date-Time </th>
									<th>Total Fare</th>
									<th>Insurance</th>
									<th>Donate</th>
									<th>Comm </th>
									<th align="center">Picked By </th>
									<th align="left">Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
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
$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentBookingType=0 and bookingType=1 and status!=0 '.$search.'  order by id desc','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);


?>
								
								<tr>
								  <td align="left" valign="top"><?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?></td>
								  <td align="left" valign="top"><a href="#" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"><?php echo strip($agentData['companyName']); ?></a></td>
								  <td align="left" valign="top"><?php if($cont>1){ ?> 
<span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span><?php }else{ ?><span class="badge bg-blue" style="background-color: #42af35;">Oneway</span><?php } ?></td>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?><br />
<?php echo stripslashes($rest['bookingNumber']); ?><?php if($rest['fixedDeparture']==1){ ?><br />
<span class="badge bg-blue" >Fixed Departure</span><?php } ?></td>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)</strong><div style="font-size:11px; color:#666666;"><?php echo stripslashes($rest['pcc']); ?></div></td>
									<td align="left" valign="top"><?php $arr = explode('-',$rest['source']); echo $arr[1]; ?></td>
									<td align="left" valign="top"><?php $arr2 = explode('-',$rest['destination']); echo $arr2[1]; ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['pnrNo']); ?></td>
									<td align="left" valign="top"><?php if($rest['updateDatePNR']!=""){ echo date('d-m-Y H:i a', strtotime($rest['updateDatePNR'])); } ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['agentTotalFare']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['insuranceAmount']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['donateAmount']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['agentCommision']); ?></td>
									<td align="center" valign="top"><?php if($rest['pickedBy']>0){ 
$se=GetPageRecord('*','sys_userMaster',"id='".$rest['pickedBy']."' "); 
$userinfo=mysqli_fetch_array($se); echo $userinfo['name'];  }else{ ?><input type="checkbox" id="pickedBy<?php echo encode($rest['id']); ?>" onclick="pickedbyfun('<?php echo encode($rest['id']); ?>');" /><?php } ?></td>
									<td align="left" valign="top"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?></td>
									
									<td align="right" valign="top"> 
									<button type="button" class="btn btn-primary btn-sm" onclick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>">Ticket</button>
<?php if($rest['status']!=4){ ?>
									<button type="button" class="btn btn-secondary btn-sm" onclick="loadpop('Update PNR',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=updatePNR&id=<?php echo encode($rest['id']); ?>">Update PNR</button>
<?php } ?>									 								</td>
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
	window.location.href="exportofflineflightbooking.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&status="+status;
}
</script>