 <div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Hotel Invoice </h4> 
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
								  <?php if($_SESSION['agentUserid']==1){ ?>
								  <?php } ?>
								  <th>Booking No. </th>
								  <th>Hotel Name </th>
								  <th><div align="center">Room</div></th>
								  <th><div align="center">Adult</div></th>
								  <th><div align="center">Child</div></th>
								  <th>Invoice ID</th>
									<th align="center"><div align="center">Commission</div></th>
									 
								  <th align="center" style="text-align:center;"><div align="center">GST</div></th>
						 
								    <th align="center"><div align="center">TDS</div></th>
								    <th align="center"><div align="center">Inv&nbsp;Amt </div></th>
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
$rs=GetRecordList('*','hotelBookingMaster',' where   status=2  and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

 
 

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$ag=GetPageRecord('COUNT(id) as totaladult','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="adult" '); 
$totalbookungpax_adult=mysqli_fetch_array($ag);


$ag=GetPageRecord('COUNT(id) as totalchild','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="child" '); 
$totalbookungpax_child=mysqli_fetch_array($ag);
 
$ag=GetPageRecord('roomNo','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'"  order by roomNo desc '); 
$totalbookungpax_room=mysqli_fetch_array($ag);
 


$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotel_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

$cd=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotelTDS"'); 
$balanceSheetDataTDS=mysqli_fetch_array($cd); 


$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>							
								<tr>
								  <td align="left" valign="top"><div style="color:#999999; font-size:12px;"><?php echo date('d-m-Y', strtotime($rest['addDate'])); ?></div></td>
								  <td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['pan']); ?></td>
								  <?php if($_SESSION['agentUserid']==1){ ?>
<?php } ?>
								  <td align="left" valign="top"><a style="cursor:pointer;" onClick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo  encode($rest['id']); ?>&page=hotelBookings&page="><?php echo  ($rest['BookingNumber']); ?></a></td>
								  <td align="left" valign="top"><?php echo  stripslashes($rest['HotelName']); ?></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_room['roomNo']); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_child['totalchild']); ?></div></td>
								  <td align="left" valign="top"><a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($rest['id']); ?>" target="_blank"><?php echo encode($rest['id']); ?></a></td>
									<td align="center" valign="top" style="font-size:11px;"><?php echo round($rest['agentCommision']); ?></td>
									
									
 
<td align="center" valign="top"> 

<?php echo round($rest['agentCommision']*18/100); $totalgst=($totalgst+round($rest['agentCommision']*18/100)); ?></td>							  
 
									
									
									
								    <td align="center" valign="top" style="font-size:11px;"><?php echo  round($rest['agentCommision']*5/100); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><div align="center"><?php echo round($rest['agentTotalFare']-$rest['agentMarukup']); ?></div></td>
								    <td align="left" valign="top" style="font-size:11px;"><a href="<?php echo $fullurl; ?>hotelinvoice_display.php?id=<?php echo encode($rest['id']); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true" style="font-size:16px; color:#FFFFFF;"></i></a></td>
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
	window.location.href="exporthotelinvoice.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&agent="+agent;
}
</script>