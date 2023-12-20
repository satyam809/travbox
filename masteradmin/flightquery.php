 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Flight Query</h4> 
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
			<select id="agent" name="agent" class="form-control"  data-placeholder="All Source"  autocomplete="off" >   
				<option value="">All Agents</option>   
			 <?php  
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and userType="agent" order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<option value="<?php echo $rest['id']; ?>" <?php if($_REQUEST['agent']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>    
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
						<h5 class="card-title">Flight Query List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=flightbooking"><button type="button" class="btn btn-success btn-sm">Flight Booking</button></a>
		                		 <a href="display.html?ga=blockflights"><button type="button" class="btn btn-primary btn-sm">Flight Setting</button></a>
		                		 <a href="../flyshop/getFlightTicket.php" target="actoinfrm" onclick="$('#getpnrptn').html('Fetching PNR Data...');"><button type="button" class="btn btn-primary btn-sm  bg-teal-400" id="getpnrptn" style="background-color:#26a69a;">Get PNR</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th>Agent Name</th>
									<th>Travel Type</th>
									<th>From / To</th>
									<th>Booking Type</th>
									<th>Booking Date</th>
									<th>Airline Code</th>
									<th>Total Passengers</th>
									<th>Expected Fare</th>
									<th>Flexible</th>
									<th>Remark</th>
									<th>Added On</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['agent']!=''){
$search.=' and  agentId="'.$_REQUEST['agent'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (departure like "%'.$_REQUEST['keyword'].'%" or  arrival like "%'.$_REQUEST['keyword'].'%" or  remark like "%'.$_REQUEST['keyword'].'%" or  airlineCode like "%'.$_REQUEST['keyword'].'%" or  bookingType like "%'.$_REQUEST['keyword'].'%") ';
}
 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
 
$rs=GetRecordList('*','groupEnquiry',' where 1 '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
	
$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>
								
<tr>
	<td align="left" valign="top"><strong><?php echo stripslashes($agentData["name"]); ?></strong><br />Company: <?php echo stripslashes($agentData["companyName"]); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest["travelType"]); ?></td>
	<td align="left" valign="top">Departure: <?php echo stripslashes($rest["departure"]); ?><br/>
	Arrival: <?php echo stripslashes($rest["arrival"]); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest["bookingType"]); ?></td>
	<td align="left" valign="top">Dept. Date: <?php if($rest["departureDate"]!=''){echo date("m-d-Y",strtotime($rest["departureDate"]));} ?><br/>
	Arr. Date: <?php if($rest["arrivalDate"]!=''){echo date("m-d-Y",strtotime($rest["arrivalDate"]));} ?><br />Flight Time: <?php echo stripslashes($rest["flightTime"]); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest["airlineCode"]); ?></td>
	<td align="left" valign="top">Total Adult: <?php echo stripslashes($rest["totalAdult"]); ?><br />Total Child: <?php echo stripslashes($rest["totalChild"]); ?><br />Total Infant: <?php echo stripslashes($rest["totalInfant"]); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest["expectedFare"]); ?> INR</td>
	<td align="left" valign="top">Flexible Price: <?php if($rest["flexiblePrice"]==1){echo "Yes";}else{echo "No";} ?><br />Flexible Date: <?php if($rest["flexibleDate"]==1){echo "Yes";}else{echo "No";} ?><br />Flexible Flight: <?php if($rest["flexibleFlight"]==1){echo "Yes";}else{echo "No";} ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest["remark"]); ?></td>
	<td align="left" valign="top"><?php echo date("m-d-Y",strtotime($rest["addDate"])); ?></td>
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




   