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



$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet',' 1 and bookingId=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and paymentType="Credit" and offlineAgent=0 '); 
$agentCreditAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','  1 and bookingId=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'")  and paymentType="Debit" and offlineAgent=0 '); 
$agentDebitAmt=mysqli_fetch_array($rs8); 

$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
?>
 
 <div class="page-header" style="margin-top: 46px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Agent Credit/Debit </h4> 
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
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['id'].'" and userType="agent" order by id asc');
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
						<h5 class="card-title">Agent Credit/Debit</h5>
						 
			  </div>		 

				 
						<table class="table table-bordered table-striped" style=" margin-bottom:0px;">
							<thead>
								<tr>
								  <th align="left">Date</th>
								  <th align="left">Agent</th>
								  <th align="left"><div align="center">Reference No.</div></th>
								  <th align="left">Description</th>
								  <th align="center"><div align="center">Method</div></th>
								  <th align="right"><div align="right">Credit</div></th>
								  <th align="right"><div align="right">Debit</div></th>
							    </tr>
							</thead>
							<tbody> 
<?php
$search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
$search.=' and  (id like "%'.decode($_REQUEST['keyword']).'%" ) ';
}
		

if($_REQUEST['agent']>0){
$search.=' and agentId="'.$_REQUEST['agent'].'"   ';
}
		
		
							
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
  
$targetpage='display.html?ga=agentstatement&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_balanceSheet',' where  1 and bookingId=0 and paymentMethod!="" and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'")  '.$search.' and 1  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
if($agentWebsitePages['amount']>0){
	 
$ag=GetPageRecord('*','sys_userMaster',' id="'.$agentWebsitePages['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
 
?>
<tr>
  <td align="left" valign="top"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	<td align="left" valign="top"><a href="display.html?ga=agents&id=<?php echo encode($agentData['id']); ?>&view=1" target="_blank"><strong><?php echo strip($agentData['companyName']); ?></strong></a>
  <div style="font-size:12px;"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo strip($agentData['phone']); ?><br />
<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo strip($agentData['email']); ?></div></td>
	<td align="left" valign="top"> <div align="center"><?php echo  ($agentWebsitePages['transactionId']); ?></div></td>
	<td align="left" valign="top"><?php echo stripslashes($agentWebsitePages['remark']); ?></td>
	<td align="center" valign="top"><div align="center">
	<?php if($agentWebsitePages['paymentType']=='Credit'){ ?> 
	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>
	<?php } ?>
	<?php if($agentWebsitePages['bookingId']>0){ ?>
	<span class="badge badge-primary">Wallet</span>
	<?php } ?>								  
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Credit'){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Debit'){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	</tr>
								
								<?php } } ?>
								 
								<tr>
								  <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
								  <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
								  <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
							      <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
							      <td align="center" valign="top" bgcolor="#EBEBEB"><div align="center"><strong>Total</strong>:</div></td>
							      <td align="right" valign="top" bgcolor="#EBEBEB"><div align="right"><strong><?php echo round($agentCreditAmt['totalcreditAmt']); ?> INR</strong></div></td>
							      <td align="right" valign="top" bgcolor="#EBEBEB"><div align="right"><strong><?php echo round($agentDebitAmt['totaldebitAmt']); ?> INR</strong></div></td>
						      </tr>
								<tr>
								  <td colspan="7" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div></td>
							  </tr>
							</tbody>
			    </table>	
					  
			  </div>
					
					
		  </div>
			<!-- Icons alignment -->

			 
  </div>
			
</div>




   