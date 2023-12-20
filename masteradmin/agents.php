 <div class="page-header" style="    margin-top: 48px;">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" style="padding:10px 30px;"><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Agents</td>
    <td align="right" style="padding:10px;"><div style="float:right; p " class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		 
				
		 
			
			
			 
			 
				
		 
		
		<div class="col-xl-12">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
		  </div>
			
			 
				
				
		 	  </div>
		</form>										
	 	  </div></td>
  </tr>
</table>


		 
		
				
	</div>

<div class="page-content pt-0" > 
		
 	
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Agents List</h5>
						<div class="header-elements">
							 
	                	</div>
			  </div>		 

				 
						<table class="table" style="font-size:12px;">
							<thead>
								<tr>
								  <th>&nbsp;</th>
								  <th>Company</th>
								  <th>Agent</th>
								  <th align="center"><div align="center">Agent&nbsp;Group </div></th>
								  <th>Location</th>
									<th>Wallet</th>
									<th>Total Sale </th>
									<th>Status</th>
									<th align="left">Register</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['agentCategory']!=''){
$search.=' and  agentCategory="'.$_REQUEST['agentCategory'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (companyName like "%'.$_REQUEST['keyword'].'%" or agentId like "%'.decodemakeAgentId($_REQUEST['keyword']).'%" or  name like "%'.$_REQUEST['keyword'].'%" or  phone like "%'.$_REQUEST['keyword'].'%" or  email like "%'.$_REQUEST['keyword'].'%") ';
}
 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_userMaster',' where userType="agent" and parentId="'.$LoginUserDetails['id'].'" '.$search.' and subagentId=0  order by id desc  ','25',$page,$targetpage); 
//echo 'where userType="agent" and parentId="'.$LoginUserDetails['id'].'" '.$search.' and subagentId=0  order by id desc';

$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
$totalSale=0;

$rs88=GetPageRecord('*','sys_commissionType',' id="'.$rest['commissionType'].'"'); 
$comtype=mysqli_fetch_array($rs88);

$rs6=GetPageRecord('*','sys_agentMarginCategory',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['agentCategory'].'"'); 
$agentcate=mysqli_fetch_array($rs6);


$onlineFlightBooking=GetPageRecord('SUM(clientTotalFare) as TotalSale','flightBookingMaster','agentBookingType=0 and status="2" and agentId="'.$rest['id'].'"'); 
$onlineFlightBookingData=mysqli_fetch_array($onlineFlightBooking);

$onlineHotelBooking=GetPageRecord('SUM(Amount) as TotalSale','hotelBookingMaster','agentId="'.$rest['id'].'" and BookingNumber!="" and agentBookingType=0 and bookingType=0 and status=2'); 
$onlineHotelBookingData=mysqli_fetch_array($onlineHotelBooking);


$totalSale=$onlineFlightBookingData['TotalSale']+$onlineHotelBookingData['TotalSale'];

$nextDateAfter2Days=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));

$a=GetPageRecord('SUM(agentTotalFare) as finaltotalagentfare','flightBookingMaster','agentId="'.$rest['id'].'" and agentBookingType=0 and bookingType=0 and status=2 and journeyDate>"'.$nextDateAfter2Days.'"'); 
$totalafterjurney=mysqli_fetch_array($a);
?>
								
								<tr>
								  <td align="left" valign="top">
								  <?php if($rest['companyLogo']!=''){ ?>
								  <img src="<?php echo $fullurl; ?>upload/<?php echo $rest['companyLogo']; ?>" alt="<?php echo stripslashes($rest['companyName']); ?>" style="max-width:40px; height:auto;"><?php } ?></td>
								  <td align="left" valign="top"><strong><?php echo makeAgentId($rest['agentId']); ?></strong><br />
<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a></td>
								  <td align="left" valign="top">
								  <strong> <?php echo stripslashes($rest['name']); ?> <?php echo stripslashes($rest['lastName']); ?></strong>
								  <div style="margin-bottom:2px;"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?php echo stripslashes($rest['countryCode']); ?>-<?php echo stripslashes($rest['phone']); ?></div>
								  <div style="margin-bottom:2px;"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<a href="mailto:<?php echo stripslashes($rest['email']); ?>"><?php echo stripslashes($rest['email']); ?></a></div>								  </td>
                                  <td align="center" valign="top">
								  
								  <div align="center">
								  <div style="background-color: #FFCC00;  <?php if($rest['commissionType']==2){ ?>background-color: #FFCC00;<?php } ?><?php if($rest['commissionType']==1){ ?>background-color:#e7e7e7;<?php } ?><?php if($rest['commissionType']==3){ ?>background-color:#F7F7F7;;<?php } ?>font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px;">
								  <?php echo stripslashes($comtype['name']); ?>
								  </div>
								  
								  </div>
								  
								  
								  </td>
                                  <td align="left" valign="top"><?php echo getCityName($rest['city']); ?>, <?php echo getStateName($rest['state']); ?>, <?php echo getCountryName($rest['country']); ?></td>
									<td align="left" valign="top"><?php
									
									$a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Credit" and offlineAgent=0 '); 
									$agentCreditAmt=mysqli_fetch_array($a); 
									
									$b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Debit" and offlineAgent=0 '); 
									$agentDebitAmt=mysqli_fetch_array($b); 
									
									echo $totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
									
									 ?> INR </td>
<td align="left" valign="top"><?php if($totalSale!=''){echo $totalSale;}else{echo 0;} ?> INR</td>

									<td align="left" valign="top"><?php echo getsectionstatus($rest['status']); ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></td>
<td align="right" valign="top">	

<input type="text" id="loginUrl<?php echo encode($rest['id']); ?>" value="<?php echo $agentLoginUrl; ?>?i=<?php echo base64_encode(base64_encode($rest['email'])); ?>&j=<?php echo base64_encode(base64_encode(date("Ymd"))); ?>" style="display:none;">
			
<!-- <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&view=1"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-retweet" aria-hidden="true"></i> Balance Sheet</button></a> -->

<button type="button" class="btn btn-primary btn-sm" onclick="loadpop('Add Payment',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addNewTransaction&agentId=<?php echo encode($rest['id']) ?>">Add Payment</button>



<a style="cursor:pointer; display:none;" onclick="copy('<?php echo encode($rest['id']); ?>');"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-link" aria-hidden="true"></i></button></a>
									
<!-- <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td> -->
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
function copy(id) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($("#loginUrl"+id).val()).select();
  document.execCommand("copy");
  $temp.remove();
}

function exportData(){
	var agentCategory=$('#agentCategory').val();
	var fromdate=$('#fromdate').val();
	var todate=$('#todate').val();
	var keyword=$('#keyword').val();
	window.location.href="exportAgents.php?agentCategory="+agentCategory+"&fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword;
}
</script>