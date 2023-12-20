 <div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Bus Invoice </h4> 
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
								  <?php if($_SESSION['agentUserid']==1){ ?>
								  <?php } ?>
								  <th>Ticket No. </th>
								  <th>Source </th>
								  <th><div align="left">Bus Agency</div></th>
								  <th><div align="center">Pax</div></th>
								  <th>Invoice ID</th>
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
$search.=' and  DATE(booking_date)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(booking_date)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentUserid="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
//$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentUserid in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','busbookingMaster',' where   status=2  and agentUserid  in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

 
 

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$ag=GetPageRecord('COUNT(id) as totaladult','bus_passenger_info',' order_id="'.$rest['tripid'].'"'); 
$totalbookungpax_adult=mysqli_fetch_array($ag);



$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentUserid'].'" '); 
$agentData=mysqli_fetch_array($ag);
 
?>							
								<tr>
								  <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['addDate'])); ?></td>
								  <td align="left" valign="top"><strong><?php echo strip($agentData['companyName']); ?></strong><br />
GSTN: <?php echo strip($agentData['gstin']); ?><br />
Pan: <?php echo strip($agentData['pan']); ?></td>
								  <?php if($_SESSION['agentUserid']==1){ ?>
<?php } ?>
								  <td align="left" valign="top"><a style="cursor:pointer;" onClick="loadpop('View Bus Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewbusVoucher&i=<?php echo  ($rest['id']); ?>&page="><?php echo  ($rest['ticket_no']); ?></a></td>
								  <td align="left" valign="top">From: <strong><?php echo $rest['from_city']; ?></strong><br>
To: <strong><?php echo $rest['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($rest['booking_date'])); ?></strong></td>
								  <td align="left" valign="top"><div style="width:130px;"><?php echo  $rest['t_agency_name']; ?><br>
Bus: <strong><?php echo stripslashes($rest['fare1']); ?></strong></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?></div></td>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?></td>
									<td align="left" valign="top" ><div align="center"><strong><?php echo stripslashes($rest['totalFare']-$rest['agentMarukup']); ?></strong></div></td>
								    <td align="left" valign="top" style="font-size:11px;">
	<a href="<?php echo $fullurl; ?>businvoiceview.php?id=<?php echo encode($rest['id']); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true" style="font-size:16px; color:#FFFFFF;"></i></a></td>
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
	window.location.href="exportbusinvoice.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&agent="+agent;
}
</script>