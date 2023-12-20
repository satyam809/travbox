 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline" >
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Hotel Booking</h4> 
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
										 Hotel Booked Successfully. <strong>Booking ID: <?php echo $_REQUEST['did']; if($_REQUEST['rid']!=''){ ?> - Return Hotel Booking ID: <?php echo $_REQUEST['rid']; } ?></strong>
								    </div>
									<?php  }?>
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Hotel Booking List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=hotellibrary"><button type="button" class="btn btn-primary btn-sm">Hotel Setting</button></a>
		                		  
		                	</div>
	                	</div>
						
						
			  </div>		 

				 
									
									
						<table class="table">
							<thead>
								<tr>
								  <th>Booking&nbsp;Date</th>
								  <th>Agent </th>
								  <th>Booking&nbsp;ID</th>
								  <th>Hotel</th>
									<th>City</th>
									<th>Date</th>
									<th>Meal&nbsp;Plan</th>
									<th>Pax  </th>
									<th>Amount</th>
									<th align="left">Markup</th>
									<th align="left">Status</th>
								    <th align="left">Payment</th>
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
$search.=' and  DATE(CheckIn)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(CheckIn)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
  
$rs=GetRecordList('*','hotelBookingMaster',' where 1 and BookingNumber!="" and agentBookingType=0 and bookingType=1 and status!=0 '.$search.' order by id desc','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$rest['id'].'" order by roomNo desc '); 
$roomData=mysqli_fetch_array($rs6);

$rs7=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$rest['id'].'" and paxType="CH"  order by id desc ');  

$rs8=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$rest['id'].'" and paxType="AD"  order by id desc ');  
$paxData=mysqli_fetch_array($rs8);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotel" '); 
 

?>
								
								<tr>
								  <td align="left" valign="top"><div style="width:140px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
								  <td align="left" valign="top"><?php if($rest['agentId']==2){ ?>Website<?php }else{ ?><a href="#" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"><?php echo strip($agentData['companyName']); ?></a><?php } ?></td>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?><div><?php echo $paxData['title']; ?> <?php echo $paxData['firstName']; ?></div></td>
								  <td align="left" valign="top"><div class="green-lighter" >
								  				<div>
								  				<?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?></div>  
												  <strong><?php echo stripslashes($rest['HotelName']); ?></strong></div>												  </td>
									<td align="left" valign="top"><?php echo stripslashes($rest['Destination']); ?></td>
									<td align="left" valign="top"><div style="width:130px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br />
<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></div></td>
									<td align="left" valign="top"><div style="width:150px; font-size:11px;"><?php echo stripslashes($rest['RoomType']); ?></div></td>
									<td align="left" valign="top"><div style="width:60px;"><strong>Room: </strong><?php echo $roomData['roomNo']; ?><br />
<strong>Adult: </strong><?php echo mysqli_num_rows($rs8); ?><br />
<strong>Child: </strong><?php echo mysqli_num_rows($rs7); ?> </div></td>
									<td align="left" valign="top">&#8377;<?php echo round($rest['Amount']); ?></td>
									<td align="left" valign="top">&#8377;<?php echo round($rest['clientTax']); ?></td>
									<td align="left" valign="top"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>									</td>
								    <td align="left" valign="top"><?php if(mysqli_num_rows($ba)>0){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Paid</span><?php }else{ if($rest['paymentStatus']==''){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php }else{  ?><span class="badge bg-blue" style="background-color:#46cd93;">Paid</span><?php } } ?></td>
								    <td align="left" valign="top"><?php if($rest['status']==1 || $rest['status']==2){ ?><button type="button" class="btn btn-secondary btn-sm" onclick="loadpop('Confirm Voucher',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">Confirm Voucher</button><?php } ?>
									<button type="button" class="btn btn-primary btn-sm" onclick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">Voucher</button></td>
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



   