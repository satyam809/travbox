<div class="page-content pt-0"  style="margin-top:70px;">
	<div class="content-wrapper">
		<!-- Content area -->
		<div class="content">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Flight Cancellation Request</h5>
				</div>		 

				<table class="table">
					<thead>
						<tr>
						  <th>Agent Request </th>
							<th> Booking   </th>
							<th>PNR</th>
							<th>Flight</th>
							<th>Route</th>
							<th><strong>Buying</strong></th>
							<th><strong>Selling</strong></th>
							<th><strong>Commission</strong></th>
							<th><strong>Profit</strong></th>
							<th>Status</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','ticketCancelRequest',' where 1 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){

//Agent Info
$a=GetPageRecord('*','flightBookingMaster',' id="'.$rest['flightBookingId'].'"'); 
$bookinginfo=mysqli_fetch_array($a);

$rs7=GetPageRecord('*','sys_userMaster',' id="'.$bookinginfo['agentId'].'"'); 
$agentData=mysqli_fetch_array($rs7);
?>
								
<tr>
  <td align="left" valign="top"><?php if($rest['agentId']==2){ ?>Website<?php }else{ ?><a href="display.html?ga=agents&id=<?php echo encode($agentData['id']); ?>&add=1" target="_blank"><?php echo strip($agentData['companyName']); ?></a><?php } ?><br />
<?php echo date("d-m-Y H:i:s",strtotime($rest['addDate'])); ?></td>
	<td align="left" valign="top">  

								  Ref. No: <strong><?php echo encode($rest['id']); ?></strong><br />
								  <?php echo date('d-m-Y h:i A', strtotime($bookinginfo['bookingDate'])); ?><div style="margin-top:4px;  font-size:12px; font-weight:500; width:130px;"><?php echo $bookinginfo['clientType']; ?></div><?php if($cont>1){ ?> 
<span class="badge bg-blue" style="background-color: #5d5d5e;display:none;">Round Trip</span><?php }else{ ?><span class="badge bg-blue" style="background-color: #42af35;display:none;">Oneway</span><?php } ?></td>
	<td align="left" valign="top"><div style="border:1px dashed #ddd; padding:2px 4px; background-color:#E6FFF5; float:left; border:1px solid #88FFED; font-weight:500;"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($bookinginfo['pnrNo']); ?></div></td>
	<td align="left" valign="top">
	
	
	<i class="fa fa-plane" aria-hidden="true"></i> <strong><?php echo stripslashes($bookinginfo['flightName']); ?>&nbsp;(<?php echo stripslashes($bookinginfo['flightNo']); ?>)</strong><div style="font-size:11px; color:#666666;"><?php echo stripslashes($bookinginfo['pcc']); ?></div>
								  
								 <div style="color:#CC0000;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($bookinginfo['journeyDate'])); ?></div>	</td>
	<td align="left" valign="top"><strong>From: </strong><?php $arr = explode('-',$bookinginfo['source']); echo $arr[1]; ?><br />
									<strong>To:</strong>
									<?php $arr2 = explode('-',$bookinginfo['destination']); echo $arr2[1]; ?>									</td>
	<td align="left" valign="top"><strong>&#8377;<?php echo stripslashes($bookinginfo['totalFare']); ?> </strong></td>
	<td align="left" valign="top"><strong>&#8377;<?php echo ($bookinginfo['agentTotalFare']); ?></strong></td>
	<td align="left" valign="top"><div align="center"><strong>&#8377;<?php echo ($bookinginfo['agentCommision']); ?></strong></div></td>
	<td align="left" valign="top"><strong>&#8377;<?php echo ($bookinginfo['agentTotalFare']-$bookinginfo['totalFare']-$bookinginfo['agentCommision']); ?></strong></td>
	<td align="left" valign="top">
	<?php if($bookinginfo['journeyDate']>=date('Y-m-d')){ ?>
	<?php if($bookinginfo['status']==2){ ?><span class="badge bg-blue" style="background-color:#f9392f;">In Review</span><?php } ?>
	<?php if($bookinginfo['status']==3 || $bookinginfo['status']==4){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Completed</span><?php } ?>
	<?php } else { ?>
	<span class="badge bg-blue" style="background-color:#FF6600;">Out Dated</span>
	<?php } ?>
	
	</td>
	<td align="left" valign="top">
	<div style="width:100px;">
	<div style="border: 1px solid #ddd; padding: 5px 10px; float: left; border-radius: 4px; background-color: #e52b30; cursor:pointer; color: #fff;" title="View Ticket" onclick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($bookinginfo['id']); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></div>
	
		<?php if($bookinginfo['status']!=4){ ?>
									<?php if($bookinginfo['status']==2 && $bookinginfo['journeyDate']>=date('Y-m-d')){ ?><div style="border: 1px solid #ddd; padding: 5px 10px; float: left; border-radius: 4px; background-color: #6b6b6b; cursor: pointer; color: #fff; margin-left:8px;" title="Update PNR" onclick="loadpop('Update PNR',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=updatePNR&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></div> 
									<?php } ?>
									<?php } ?>
									</div>
	
	</td>
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