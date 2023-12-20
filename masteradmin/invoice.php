 <div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Flight Invoice </h4> 
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
						 
					

			 		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Date</th>
								  <th>Agent</th>
								  <th>GSTIN</th>
					 
								  <th>Pan</th>
				 
								  <th>Booking No. </th>
								  <th>Inoice ID</th>
									<th>Airline</th>
									<th>Departure</th>
									<th>Arrival</th>
								    <th>PNR</th>
								    <th>Commission</th>
									
								  <th>GST</th>
							 
								    <th>TDS</th>
								    <th>Inv&nbsp;Amt </th>
								    <th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentId="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentId in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flightBookingMaster',' where invoiceId>0 and pnrNo!="" and agentBookingType=0 and status!=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);


$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

$cd=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
$balanceSheetDataTDS=mysqli_fetch_array($cd); 
?>							
								<tr>
								  <td align="left" valign="top"><div style="color:#999999; font-size:12px;"><?php echo date('d-m-Y', strtotime($rest['bookingDate'])); ?></div></td>
								  <td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
 
<td align="left" valign="top"><?php echo strip($agentData['pan']); ?></td>							  
 
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?><?php if($cont>1){ ?><br />
<span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span><?php } ?><?php if($rest['fixedDeparture']==1){ ?><br />
<span class="badge bg-blue" >Fixed Departure</span><?php } ?></td>
								  <td align="left" valign="top"><a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($rest['id']); ?>" target="_blank"><?php echo encode($rest['invoiceId']); ?></a></td>
									<td align="left" valign="top"><strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)</strong> </td>
									<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['source']); ?></td>
									<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['destination']); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['pnrNo']); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['agentCommision']); ?></td>
									
									

<td align="left" valign="top"><?php echo $totalcomm=round($rest['agentCommision']*18/100); ?></td>							  

									
									
									
								    <td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($balanceSheetDataTDS['amount']); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><?php echo round(($rest['agentTotalFare']+$totalcomm+$balanceSheetDataTDS['amount'])-$rest['agentCommision']-($rest['agentTax']-$rest['tax'])); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($rest['id']); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true" style="font-size:16px; color:#FFFFFF;"></i></a></td>
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

<script>
function exportData(){
	var fromdate=$('#fromdate').val();
	var todate=$('#todate').val();
	var keyword=$('#keyword').val();
	var agent=$('#agent').val();
	window.location.href="exportinvoice.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&agent="+agent;
}
</script>