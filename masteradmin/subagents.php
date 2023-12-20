 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Sub  Agents</h4> 
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
			 
				
		<div class="col-xl-2">
			<div class="input-group">
			<select id="agentCategory" name="agentCategory" class="form-control"  data-placeholder="All Source"  autocomplete="off"  onchange="$('#searchform').submit();">   
				<option value="">All Categories</option>   
			 <?php  
$rs=GetPageRecord('*','sys_agentMarginCategory','  parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<option value="<?php echo $rest['id']; ?>" <?php if($_REQUEST['agentCategory']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>    
		<?php } ?>
</select> 
			</div>
			</div>
		
		<div class="col-xl-3">
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
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Sub Agents List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add Agent</button></a> 
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table" style="font-size:12px;">
							<thead>
								<tr>
								  <th>&nbsp;</th>
								  <th>Parent&nbsp;Agent </th>
								  <th>Company</th>
								  <th>Agent</th>
								  <th>Location</th>
									<th>Wallet</th>
									<th>Total Sale </th>
									<th>Upcoming&nbsp;Trips </th>
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
$rs=GetRecordList('*','sys_userMaster',' where userType="agent" '.$search.' and subagentId!=0  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
$totalSale=0;

$rs6=GetPageRecord('*','sys_agentMarginCategory',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['agentCategory'].'"'); 
$agentcate=mysqli_fetch_array($rs6);


$onlineFlightBooking=GetPageRecord('SUM(clientTotalFare) as TotalSale','flightBookingMaster','agentBookingType=0 and status="2" and agentId="'.$rest['id'].'"'); 
$onlineFlightBookingData=mysqli_fetch_array($onlineFlightBooking);

$onlineHotelBooking=GetPageRecord('SUM(Amount) as TotalSale','hotelBookingMaster','agentId="'.$rest['id'].'" and BookingNumber!="" and agentBookingType=0 and bookingType=0 and status=2'); 
$onlineHotelBookingData=mysqli_fetch_array($onlineHotelBooking);


$totalSale=$onlineFlightBookingData['TotalSale']+$onlineHotelBookingData['TotalSale'];

$nextDateAfter2Days=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));

$a=GetPageRecord('SUM(agentTotalFare) as finaltotalagentfare','flightBookingMaster','agentId="'.$rest['id'].'" and agentBookingType!=0 and bookingType=0 and status=2 and journeyDate>"'.$nextDateAfter2Days.'"'); 
$totalafterjurney=mysqli_fetch_array($a);




$rs67=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'"  '); 
$parentAgent=mysqli_fetch_array($rs67);
?>
								
								<tr>
								  <td align="left" valign="top">
								  <?php if($rest['companyLogo']!=''){ ?>
								  <img src="<?php echo $fullurl; ?>upload/<?php echo $rest['companyLogo']; ?>" alt="<?php echo stripslashes($rest['companyName']); ?>" style="max-width:40px; height:auto;"><?php } ?></td>
								  <td align="left" valign="top"><strong><?php echo stripslashes($parentAgent['companyName']); ?></strong></td>
								  <td align="left" valign="top"><strong><?php echo makeAgentId($parentAgent['agentId']); ?>-<?php echo $rest['subagentId']; ?></strong><br />
<a href="display.html?ga=agents&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a></td>
								  <td align="left" valign="top">
								  <strong> <?php echo stripslashes($rest['name']); ?></strong>
								  <div style="margin-bottom:2px;"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?php echo stripslashes($rest['countryCode']); ?>-<?php echo stripslashes($rest['phone']); ?></div>
								  <div style="margin-bottom:2px;"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<a href="mailto:<?php echo stripslashes($rest['email']); ?>"><?php echo stripslashes($rest['email']); ?></a></div>								  </td>
<td align="left" valign="top"><?php echo getCityName($rest['city']); ?>, <?php echo getStateName($rest['state']); ?>, <?php echo getCountryName($rest['country']); ?></td>
									<td align="left" valign="top"><?php
									
									$a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Credit" and offlineAgent=0 '); 
									$agentCreditAmt=mysqli_fetch_array($a); 
									
									$b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Debit" and offlineAgent=0 '); 
									$agentDebitAmt=mysqli_fetch_array($b); 
									
									echo $totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
									
									 ?> INR </td>
<td align="left" valign="top"><?php if($totalSale!=''){echo $totalSale;}else{echo 0;} ?> INR</td>

									<td align="left" valign="top">
									<?php if($totalafterjurney['finaltotalagentfare']>0){  echo $totalafterjurney['finaltotalagentfare']; } else { echo '0'; }?>									</td>
									<td align="left" valign="top"><?php echo getsectionstatus($rest['status']); ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></td>
<td align="right" valign="top">	

<input type="text" id="loginUrl<?php echo encode($rest['id']); ?>" value="<?php echo $agentLoginUrl; ?>?i=<?php echo base64_encode(base64_encode($rest['email'])); ?>&j=<?php echo base64_encode(base64_encode(date("Ymd"))); ?>" style="display:none;">
			
 

<a style="cursor:pointer;" onclick="copy('<?php echo encode($rest['id']); ?>');"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-link" aria-hidden="true"></i></button></a>
									
<a href="display.html?ga=agents&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
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