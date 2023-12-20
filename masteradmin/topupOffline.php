<div class="page-header" style="margin-top: 48px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" align="left" style="padding:10px 30px;"><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Topup Balance</td>
		</tr>
	</table>
</div>

<div class="page-content pt-0" > 
	<div class="content-wrapper">
	<!-- Content area -->
		<div class="content">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Topup Balance</h5>
					<div class="header-elements">
						<div class="list-icons">
							<a style="position:absolute; right:10px; top:10px;"><button type="button" class="btn btn-primary btn-icon btn-sm" onClick="loadpop('Upload Request',this,'650px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addpaymentrequest">+ Add New</button></a>
		                </div>
	                </div>
			  </div>
			  
				<table class="table" style="font-size:12px;">
					<thead>
						<tr>
							<th>Date</th>
							<th>Requested Amount</th>
							<th>Payment Mode</th>
							<th>Reference Number</th>
							<th>Cheque Number</th>
							<th>Draft Number</th>
							<th>Cheque Date</th>
							<th>Bank Info</th>
							<th>Attachment</th>
							<th>Notes</th>
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
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

$targetpage='display.html?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&';
$rs=GetRecordList('*','offlineRechargeRequest',' where agentId="'.$_SESSION['userid'].'" order by id desc ','100',$page,$targetpage); 
$totalentry=$rs[1];
$paging=$rs[2];
while($rest=mysqli_fetch_array($rs[0])){
?>
<tr>
	<td align="left" valign="top"><strong><?php echo date("d-m-Y",strtotime($rest['addDate'])); ?></strong></td>
	<td align="left" valign="top"><strong><?php echo number_format($rest['requestedAmount'],2); ?></strong></td>
	<td align="left" valign="top"><strong><?php echo stripslashes($rest['paymentMode']); ?></strong></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['referenceNumber']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['chequeNumber']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['draftNumber']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['chequeDate']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['bank']); ?><br /><?php echo stripslashes($rest['account_number']); ?><br />Branch:<?php echo stripslashes($rest['branch']); ?><br />TXN ID:<?php echo stripslashes($rest['bank_transaction_id']); ?></td>
	<td align="left" valign="top"><a href="<?php echo $fullurl; ?>upload/<?php echo stripslashes($rest['attachment']); ?>" target="_blank">Download</td>
	<td align="left" valign="top"><?php echo stripslashes($rest['note']); ?></td>
	<td align="left" valign="top"><strong style="text-transform:uppercase;"><?php echo stripslashes($rest['status']); ?></strong></td>
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
			</div>
		</div>