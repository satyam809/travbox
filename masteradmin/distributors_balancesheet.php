<?php

$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

// if($_REQUEST['agent']!=''){
// $search.=' and  from_agent_id="'.$_REQUEST['agent'].'" || to_agent_id="'.$_REQUEST['agent'].'"';
// }

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']==''){

$search.=' and  DATE(addDate)>="'.date('Y-m-'.'1').'" and  DATE(addDate)<="'.date('Y-m-t').'" ';
$fromdate=date('1-m-Y');
$todate=date('t-m-Y');
}
// else
// {
// 	$search.=' and  DATE(addDate)>="'.date('Y-m-'.'1').'" and  DATE(addDate)<="'.date('Y-m-t').'" ';
// 	$fromdate=date('1-m-Y');
// 	$todate=date('t-m-Y');
// }


// if($_REQUEST['keyword']!=''){
// $search.=' and  (invoiceId like "%'.$_REQUEST['keyword'].'%" or  pnrNo like "%'.$_REQUEST['keyword'].'%"   ) ';
// }



// $rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet',' agentId="'.$_SESSION['userid'].'" and paymentType="Credit" and offlineAgent=0 '); 
// $agentCreditAmt=mysqli_fetch_array($rs8); 

// $rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','  agentId="'.$_SESSION['userid'].'"  and paymentType="Debit" and offlineAgent=0 '); 
// $agentDebitAmt=mysqli_fetch_array($rs8); 

// $totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
?>

<div class="page-header" style="margin-top: 46px;">
	

	   <div class="page-header-content header-elements-md-inline">
		   <div class="page-title d-flex">
			   <h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Admin Balance Sheet </h4> 
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
		   <a href="export_adminbalancesheet.php?fromdate=<?php echo $fromdate; ?>&todate=<?php echo $todate; ?>&agent=<?php echo $_REQUEST['agent']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="margin-left:5px;">Export</button></a>
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
					   <h5 class="card-title">Admin Balance Sheet List</h5>
						
			 </div>		 

				
					   <table class="table table-bordered table-striped" style=" margin-bottom:0px;">
						   <thead>
							   <tr>
								 <th align="left">Date</th>
								 <th align="left">Agent</th>
								 <th align="left">Reference No.</th>
								 <th align="left">Description</th>
								 <th align="center"><div align="center">Method</div></th>
								 <th align="right"><div align="right">Credit</div></th>
								 <th align="right"><div align="right">Debit</div></th>
								 <th align="right"><div align="right">Running Balance</div></th>
							   </tr>
						   </thead>
						   <tbody> 
<?php
// $search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

// if($_REQUEST['keyword']!=''){
// $search.=' and ( (bookingId="'.decode($_REQUEST['keyword']).'" ) or bookingId in (select BookingNumber from hotelBookingMaster where id="'.decode($_REQUEST['keyword']).'" ) ) ';
// }
	   
						   
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
							   
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
 
$targetpage='display.html?ga=distributors_balancesheet&agentCategory='.$_REQUEST['agentCategory'].'&id='.$_REQUEST['id'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

if($_REQUEST['agent']!='')
{
    $rs=GetRecordList('*','sys_transfer_balance',' where  1 '.$search.' and from_agent_id="'.$_REQUEST['agent'].'" || to_agent_id="'.$_REQUEST['agent'].'" order by id desc  ','25',$page,$targetpage);
}
else
{
	$rs=GetRecordList('*','sys_transfer_balance',' where 1 '.$search.' and  from_agent_id="'.$_SESSION['userid'].'" || to_agent_id="'.$_SESSION['userid'].'"  order by id desc  ','25',$page,$targetpage);
}



$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
	//print_r($agentWebsitePages);
if($agentWebsitePages['amount']>0){

//Opening Balance Debit Amount
if($_REQUEST['agent']!='')
{
	$openBalDebited=GetPageRecord('SUM(amount)','sys_transfer_balance','from_agent_id="'.$_REQUEST['agent'].'"  and id<="'.$agentWebsitePages["id"].'"   order by id asc'); 
}
else
{
	$openBalDebited=GetPageRecord('SUM(amount)','sys_transfer_balance','from_agent_id="'.$_SESSION['userid'].'"  and id<="'.$agentWebsitePages["id"].'"   order by id asc'); 
}


$openBalDebitedData=mysqli_fetch_array($openBalDebited);


$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];


//Opening Balance Credit Amount
if($_REQUEST['agent']!='')
{
$openBalCredited=GetPageRecord('SUM(amount)','sys_transfer_balance',' to_agent_id="'.$_REQUEST['agent'].'" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
}
else
{
	$openBalCredited=GetPageRecord('SUM(amount)','sys_transfer_balance',' to_agent_id="'.$_SESSION['userid'].'" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
}
$openBalCreditedData=mysqli_fetch_array($openBalCredited);
$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];
$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	
   

$totalDebit+=$openBalDebitedAmount;

$totalCredit+=$openBalCreditedAmount;


	$ag=GetPageRecord('*','sys_userMaster','  id="'.$agentWebsitePages['to_agent_id'].'"  '); 
	$agentData=mysqli_fetch_array($ag);
	


?>
<tr>
   <td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
   <td align="left" valign="top">
	
   <!-- <a href="display.html?ga=agents&id=<?php echo encode($agentData['id']); ?>&view=1" target="_blank"> -->
   <strong><?php echo strip($agentData['companyName']); ?></strong>
  <!-- </a> -->
 <div style="font-size:12px;"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo strip($agentData['phone']); ?><br />
<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo strip($agentData['email']); ?></div> </td>
<td align="center" valign="top"><div align="center">
  
   
   	</td>
   <td align="left" valign="top">

<?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></td>

   <td align="center" valign="top"><div align="center">
  <?php echo "wallet"  ?>
   
   	</td>
   <td align="right" valign="top"><div align="right">
   <?php if($agentWebsitePages['from_agent_id']!=$_SESSION['userid']){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>
   <?php echo strip($agentWebsitePages['amount']); ?> INR
   <?php } ?>
   </div></td>
   <td align="right" valign="top"><div align="right">
   <?php if($agentWebsitePages['from_agent_id']==$_SESSION['userid']){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>
   <?php echo strip($agentWebsitePages['amount']); ?> INR
   <?php } ?>
   </div></td>
   
   <td align="right" valign="top"><div align="right"><?php echo strip($balance); ?> INR</div></td>
							 </tr>
							   
							   <?php } } ?>
								
							   <tr>
								 <td colspan="8" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
		
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




  