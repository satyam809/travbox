  
<div class="page-content pt-0" > 

	<div class="content-wrapper">

	<!-- Content area -->

		<div class="content">

			<div class="card">
			<div class="card-footer d-flex justify-content-between" style="position:relative;">  
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-credit-card-alt"></i> &nbsp;Topup Request (Online)</span>
			</div> 
				
				
						<div class="card-body">

			<form method="get" id="searchform">

				<div class="row">

					<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

					<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />

					
					<div class="col-xl-2">
			<div class="input-group">
			<select id="agentId" name="agentId" class="form-control" data-placeholder="All Source" autocomplete="off">   
				<option value="">All Agents</option>   
<?php  
$rs=GetPageRecord('*','sys_userMaster',' status=1 and userType="agent" order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<option value="<?php echo $rest['id']; ?>" <?php if($_REQUEST['agentId']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>    
		<?php } ?>
</select> 
			</div>
			</div>
					

				<div class="col-xl-2">

					<div class="input-group">

					<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >

					</div>

				</div>

				

				<div class="col-xl-2">

					<div class="input-group">

						<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>

					</div>

				</div>

			

			

<script>

$(function(){

    $("#fromdate").datepicker({ dateFormat: 'dd-mm-yy' });

    $("#todate").datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>

			 

				

				<div class="col-xl-2">

					<div class="input-group">

						<select id="paymentMode" name="paymentMode" class="form-control"  data-placeholder="Payment Mode" autocomplete="off">   

							<option value="">All Payment Mode</option>   

							<option value="DC" <?php if($_REQUEST["paymentMode"]=="DC"){?> selected="selected" <?php } ?>>Debit Card</option>

							<option value="CC" <?php if($_REQUEST["paymentMode"]=="CC"){?> selected="selected" <?php } ?>>Credit Card</option>

							<option value="upi" <?php if($_REQUEST["paymentMode"]=="upi"){?> selected="selected" <?php } ?>>UPI</option>

							<option value="NB" <?php if($_REQUEST["paymentMode"]=="NB"){?> selected="selected" <?php } ?>>Net Banking</option>

						</select> 

					</div>

				</div>

		

				<div class="col-xl-1">

					<div class="input-group">

					<select id="status" name="status" class="form-control"  data-placeholder="Status" autocomplete="off">   

						<option value="">All Status</option>   
						<option value="success" <?php if($_REQUEST["status"]=="success"){?> selected="selected" <?php } ?>>Success</option>
						<option value="failed" <?php if($_REQUEST["status"]=="failed"){?> selected="selected" <?php } ?>>Failed</option>
						<option value="cancelled" <?php if($_REQUEST["status"]=="cancelled"){?> selected="selected" <?php } ?>>Cancelled</option>
					</select> 

					</div>

				</div>

		

				<div class="col-xl-2">

					<div class="input-group">

						<input name="requestedAmount" type="text" class="form-control" id="requestedAmount" placeholder="Requested Amount" value="<?php echo $_REQUEST['requestedAmount']; ?>"  >

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
				

			<table class="table">
				<thead>
					<tr>
						<th>Agent Info</th>
						<th>Request Date</th>
						<th>Requested Amount</th>
						<th>Markup Amount</th>
						<th>Mode of Payment</th>
						<th>Payment Source</th> 
						<th>Easepayid</th> 
						<th>Deduction Percentage</th> 
						<th>Status</th> 
					</tr>
				</thead>
				<tbody>

<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and DATE(dateAdded)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(dateAdded)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agentId']!=''){
$search.=' and agentId="'.$_REQUEST['agentId'].'" ';
}

if($_REQUEST['paymentMode']!=''){
$search.=' and show_payment_mode="'.$_REQUEST['paymentMode'].'" ';
}


if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['requestedAmount']!=''){
$search.=' and requestedAmount="'.$_REQUEST['requestedAmount'].'" ';
}


$targetpage='display.html?ga='.$_REQUEST['ga'].'&show_payment_mode='.$_REQUEST['paymentMode'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&requestedAmount='.$_REQUEST['requestedAmount'].'&status='.$_REQUEST['requestedAmount'].'&'; 

$rs=GetRecordList('*','onlineRechargeRequest',' where 1 '.$search.' order by id desc  ','25',$page,$targetpage);


$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){

//Agent Info
$agent=GetPageRecord('*','sys_userMaster','id="'.$rest['agentId'].'" order by id asc');
$agentInfo=mysqli_fetch_array($agent);
?>

								

<tr>
	<!--
	<td align="left" valign="top"><a href="display.html?ga=topupbalanceoffline&id=<?php //echo encode($rest['id']); ?>"><strong><?php //echo stripslashes($rest['referenceNumber']); ?></strong></a></td>
	-->
	<td align="left" valign="top">Ageny Id:<strong><?php echo stripslashes($agentInfo['agentCustomId']); ?></strong><br />Agency Name:<strong><?php echo stripslashes($agentInfo['companyName']); ?></strong><br />Contact:<strong><?php echo stripslashes($agentInfo['phone']); ?></strong></td>

	<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['requestedAmount']); ?> INR</td>
	<td align="left" valign="top"><?php if(isset($rest['markup'])){echo stripslashes($rest['markup']); }else{echo 0;} ?> INR</td>
	<td align="left" valign="top"><?php echo stripslashes($rest['show_payment_mode']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['payment_source']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['easepayid']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['deduction_percentage']); ?></td>
	<td align="left" valign="top">
		<button type="button" class="btn btn-secondary btn-sm"><span style='text-transform:uppercase;'><?php echo $rest['status']; ?></span></button>
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

<script>
function exportData(){
	var agentId=$('#agentId').val();
	var fromdate=$('#fromdate').val();
	var todate=$('#todate').val();
	var paymentMode=$('#paymentMode').val();
	var status=$('#status').val();
	var requestedAmount=$('#requestedAmount').val();
	window.location.href="exporttopuponline.php?agentId="+agentId+"&fromdate="+fromdate+"&todate="+todate+"&paymentMode="+paymentMode+"&status="+status+"&requestedAmount="+requestedAmount;
}
</script>