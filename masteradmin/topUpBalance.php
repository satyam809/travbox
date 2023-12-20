<div class="page-header" style="    margin-top: 48px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="2" align="left" style="padding:10px 30px;"><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Top Up</td>
		<td align="right" style="padding:10px;"><div style="float:right; p " class="searchbox">
<form method="get" id="searchform">
	<div class="row">
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		<div class="col-xl-12">
			<div class="d-flex my-xl-auto right-content">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td align="left">
							<div class="row">
								<div class="col-xl-3">
									<div class="input-group">
										<input type="text" id="fromdate" name="fromDate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly>
									</div>
								</div>
								<div class="col-xl-3">
									<div class="input-group">
										<input type="text" id="todate" name="toDate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
									</div>
								</div>
			
<script>
	$( function() {
		$( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
</script>

								<div class="col-xl-6">
									<div class="input-group">
										<select name="agentId"  class="form-control">
											<option value="">Select Agent</option>
<?php
$a=GetPageRecord('*','sys_userMaster','userType="agent" and parentId="'.$_SESSION['userid'].'" and status=1 order by id desc'); 
while($supplierData=mysqli_fetch_array($a)){
?>
<option value="<?php echo $supplierData['id']; ?>" <?php if($supplierData['id']==$_REQUEST['agentId']){ ?> selected="selected" <?php } ?>><?php echo $supplierData['name']." ".$supplierData['lastName']; ?></option>
<?php } ?> 
										</select>
										<span class="input-group-append">
											<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
										</span>
									</div>
								</div>
							</div>
					</form>
				</td>
			</tr>
		</table>
	</div>
</div>
		 	  </div>									
	 	  </div></td>
  </tr>
</table>
	
	</div>

<div class="page-content pt-0"> 	
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">

				<div class="card-header header-elements-inline">
					<h5 class="card-title">Top Up List</h5>
					<div class="header-elements">
						<div class="list-icons">
							<button type="button" class="btn btn-primary btn-sm" onclick="loadpop('Add Payment',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addNewTransactionAll">Add Payment</button>
		                </div>
	                </div>
				</div>		 

				 
						<table class="table" style="font-size:12px;">
							<thead>
								<tr>
									<th align="left">Agent Info</th>
									<th align="left">Date</th>
									<th align="left">Reference No.</th>
									<th align="left">Description</th>
									<th align="left"><div align="center">Method</div></th>
									<th align="right"><div align="right">Amount</div></th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']);
$search='';
$sNo=1;

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
	$search.=' and DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['agentId']!=''){
	$search.=' and agentId="'.$_REQUEST['agentId'].'" ';
}
  
$targetpage='display.html?ga=topUpBalance&id='.$_REQUEST['id'].'&agentId='.$_REQUEST['agentId'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';


 
$rs=GetRecordList('*','sys_balanceSheet',' where 1 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.' order by id desc ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];

while($rest=mysqli_fetch_array($rs[0])){
$agent=GetPageRecord('*','sys_userMaster','1 and id="'.trim($rest['agentId']).'" order by id desc');
$agentData=mysqli_fetch_array($agent);

if($rest['paymentType']=="Credit"){
?>

<tr>
	<td align="left" valign="top">
<div><?php echo stripslashes($agentData["companyName"]); ?></div>
<div><strong>Name: </strong><?php echo stripslashes($agentData['name'])." ".stripslashes($agentData['lastName']); ?></div>
<div><strong>Email: </strong><?php echo stripslashes($agentData['email']); ?></div>
<div><strong>Phone: </strong><?php echo stripslashes($agentData['phone']); ?></div>
	</td>
	
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($rest['addDate'])); ?></td>
	<td align="left" valign="top"><?php echo $rest['transactionId']; ?></td>
	<td align="left" valign="top"><?php echo $rest['remarks']; ?></td>
	<td align="left" valign="top"><?php echo $rest['paymentMethod']; ?></td>
	<td align="right" valign="top"><?php echo $rest['amount']; ?> INR</td>
</tr>

<?php $sNo++; } } ?>
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
