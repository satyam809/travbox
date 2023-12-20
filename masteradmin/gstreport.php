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
?>
 
 <div class="page-header" style="margin-top: 46px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Flight GST Report </h4> 
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
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and userType="agent" order by id asc');
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
			<a href="export_gstreport.php?fromdate=<?php echo $fromdate; ?>&todate=<?php echo $todate; ?>&agent=<?php echo $_REQUEST['agent']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="margin-left:5px;">Export</button></a>
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
						<h5 class="card-title">Flight  GST Report List</h5>
						 
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Invoice Date </th>
								  <th>Invoice No. </th>
								  <th>Booking ID</th>
								  <th>Agent</th>
								  <th>GSTN</th>
								  <th><div align="center">Commission</div></th>
								  <th><div align="center">Amount</div></th>
									<th><div align="center">GST</div></th>
									<th><div align="center">GST Amount </div></th>
									<th><div align="center">TDS</div></th>
								    <th><div align="center">Invoice&nbsp;Amount </div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
$totalgst=0;
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_balanceSheet',' where 1 and amount>0 and bookingId in (select id from flightBookingMaster where status=2) and billType="flight" and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'")   group by bookingId  order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);
 
$ag=GetPageRecord('*','sys_userMaster',' id="'.$bookingdata['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="Facilitating"'); 
$totalamountres=mysqli_fetch_array($rs7);

if($totalamountres['amount']<1){

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="flight"'); 
$totalamountres=mysqli_fetch_array($rs7);

}
$totalpriceofgst=$totalamountres['amount'];


?>
								
								<tr>
								  <td height="26" align="left" valign="top"><?php echo date('d-m-Y', strtotime($bookingdata['bookingDate'])); ?></td>
								  <td align="left" valign="top"><a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($bookingdata['id']); ?>" target="_blank"><?php echo encode($bookingdata['invoiceId']); ?></a></td>
								  <td align="left" valign="top"><?php echo encode($bookingdata['id']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
								  <td align="left" valign="top"><div align="center"><?php echo  ($bookingdata['agentCommision']); $gstamount=round($bookingdata['agentCommision']*18/100); $tds=round($bookingdata['agentCommision']*5/100); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo stripslashes($totalpriceofgst); ?></div></td>
									<td align="left" valign="top"><div align="center">18%</div></td>
									<td align="left" valign="top"><div align="center"><?php if($bookingdata['agentCommision']==0){ echo stripslashes($rest['amount']); } else { echo $gstamount; }?></div></td>
									<td align="left" valign="top">
									  <div align="center"><?php echo $tds; ?></div></td>
								    <td align="left" valign="top"><div align="center"><?php echo (round($bookingdata['agentTotalFare']+$gstamount+$tds)-$bookingdata['agentCommision']); ?></div></td>
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




   