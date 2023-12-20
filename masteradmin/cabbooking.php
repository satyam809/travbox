 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline"  style="    margin-top:50px;">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> -  Flight Booking</h4> 
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
			 
				
		<div class="col-xl-3" style="display:none;">
			<div class="input-group">
			<select id="status" name="status" class="form-control" data-placeholder="Select Status" autocomplete="off">   
				<option value="">Show All</option>
				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>
				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>
				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>
				<option value="4" <?php if($_REQUEST['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>
			</select> 
			</div>
			</div>
		
		<div class="col-xl-5">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
			</div>
			
			<div class="col-xl-1">
			<a href="display.html?ga=cabpackage"><button class="btn btn-light bg-primary border-primary text-white" type="button"  >Setting</button></a>
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
						 
					<table class="table table-hover mb-0" style="font-size:12px;">

	<thead>

		<tr>
		  <th>ID </th>

			<th>Pickup  </th>
			<th>Drop</th>
			<th>Time / KM </th>
			<th> Status</th>
			<th>Payment</th>
			<th>Traveller Info</th>
            <th>Vehicle</th>
            <th>Amount </th>
            <th>Paid</th>
            <th>Action</th>
            </tr>
	</thead>

    <tbody>

<?php

$where4='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']==''){
	$where4.=' and fromdate="'.date("Y-m-d",strtotime($_REQUEST["fromdate"])).'"';
}

if($_REQUEST['fromdate']=='' && $_REQUEST['todate']!=''){
	$where4.=' and todate="'.date("Y-m-d",strtotime($_REQUEST["todate"])).'"';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
	$where4.=' and fromdate>"'.date("Y-m-d",strtotime($_REQUEST["fromdate"])).'" and todate<"'.date("Y-m-d",strtotime($_REQUEST["todate"])).'"';
}


if($_REQUEST['keyword']!=''){
$where4.=' and ( name like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile or pickup_address like "%'.$_REQUEST['keyword'].'%" or fromlocation like "%'.$_REQUEST['keyword'].'%" or tolocation like "%'.$_REQUEST['keyword'].'%" )';
}


if($_REQUEST['client_info']!=''){
$where4.=' and userid IN (select id from sys_userMaster where firstName like "%'.$_REQUEST['client_info'].'%" or email like "%'.$_REQUEST['client_info'].'%" or phone like "%'.$_REQUEST['client_info'].'%" or mobile like "%'.$_REQUEST['client_info'].'%")';

}

if($_REQUEST['payment_status']!=''){
	$where4.=' and payment_status="'.$_REQUEST["payment_status"].'"';
}


if($_REQUEST['booking_status']!=''){
	$where4.=' and booking_status="'.$_REQUEST["booking_status"].'"';
}


$totalno='1';

$select='';

$where='';

$rs=''; 

$select='*'; 

$wheremain=''; 

$where=' where 1 '.$where4.'  order by id desc'; 

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 

$rs=GetRecordList('*','cab_package_booking',' '.$where.' ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];

while($rest=mysqli_fetch_array($rs[0])){

$rs33=GetPageRecord($select,'sys_userMaster','id="'.$rest['addedBy'].'" '); 

$packagecreator=mysqli_fetch_array($rs33);

$cab=GetPageRecord('*','vehicle_category','id="'.$rest["vehicle_category"].'"'); 
$cabData=mysqli_fetch_array($cab);

?>



<tr>
  <td><?php echo encode($rest['id']); ?><div style="width:140px;"><?php if($rest['wayselection']==1){echo "<strong>Round Trip</strong>";} if($rest['wayselection']==2){echo "<strong>Round Trip</strong>";} ?></div>

  <?php if($rest['category']==1){echo "Local";} if($rest['category']==2){echo "Airport Transfer";} if($rest['category']==3){echo "Out Station";} ?><div style="font-size:11px; margin-top:2px;"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $rest['created_at']; ?></div></td>

	<td><div style="margin-bottom:2px; color:#000000; font-weight:600; width:120px; font-size:12px;"><?php echo date("d-m-Y",strtotime($rest['fromdate']))." ".date("h:i A",strtotime($rest['fromtime'])); ?></div>
	<?php echo $rest['fromlocation']; ?> </td>
<td><div style="margin-bottom:2px; color:#000000; font-weight:600; width:120px; font-size:12px;"><?php if($rest['todate']>'1970-01-01'){echo date("d-m-Y",strtotime($rest['todate']))." ".date("h:i A",strtotime($rest['totime'])); } ?></div><?php echo $rest['tolocation']; ?></td>
	<td><div style="margin-bottom:2px; color:#000000; font-weight:600; font-size:12px;"><?php echo $rest['distance']; ?></div><?php echo $rest['duration']; ?></td>


<td>
<?php if($rest['booking_status']==0){ ?><span class="badge badge-warning">Pending</span><?php }else{ ?><span class="badge badge-success">Confirmed</span><?php } ?></td><td> 
<?php if($rest['payment_status']==0){ ?><span class="badge badge-warning">Pending</span><?php }else if($rest['payment_status']==1){ ?><span class="badge badge-success">Paid</span><?php }else if($rest['payment_status']==2){ ?><span class="badge badge-danger">Cancelled</span><?php }else if($rest['payment_status']==3){ ?><span class="badge badge-danger">COD/Partial</span><?php } ?></td>


	<td><?php echo $rest['name']; ?><br /><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $rest['country_code'].$rest['mobile']; ?><br /><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $rest['email']; ?></td>

	<td><div style=" "><strong><?php echo $cabData["name"]; ?></strong></div>	  
	  <?php echo $cabData["pax"]; ?> passengers</td>
	<td><strong>&#8377;<?php echo number_format($rest['final_charges'],2); ?>
	  </strong>
<?php if($rest['partial_payment']>0){ ?>
	  <div style="color:#FF0000; font-size:11px; margin-top:2px;">Partial Payment</div>
<?php } ?>
	</td>

	<td><strong>&#8377;<?php echo number_format($rest['partial_payment'],2); ?></strong></td>

	<td>
<?php if($rest['partial_payment']>=$rest['final_charges']){ ?>
	<a target="_blank" href="<?php echo $websiteurl."invoice.php?id=".encode($rest["id"]); ?>" style="display:block; margin-bottom:10px;"><i class="fa fa-file-text" aria-hidden="true"></i> Invoice</a>
<?php } ?>

<?php if ($LoginUserDetails["id"]==1 || (strpos($LoginUserDetails["permissionAddEdit"], 'cab_bookings')) !== false) { ?>
	<a href="<?php echo $fullurl; ?>display.html?ga=cabbooking&view=1&id=<?php echo encode($rest['id']); ?>"  style="display:block;">
	<button type="button" class="btn btn-secondary btn-sm" >Details</button>
	 </a>
<?php } ?>
	</td>
	</tr>



<?php $totalno++; } ?>
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
<div style=" display:none;" id="savedatasub"></div>
<script>
function pickedbyfun(id){
var pickedBy=0;
if($("#pickedBy"+id).prop('checked') == true){
    pickedBy=1;
}
$('#savedatasub').load('actionpage.php?action=savepickedby&id='+id+'&pickedBy='+pickedBy);
}
</script>



 <script>
function exportData(){
	var fromdate=$('#fromdate').val();
	var todate=$('#todate').val();
	var keyword=$('#keyword').val();
	var status=$('#status').val();
	var requestedAmount=$('#requestedAmount').val();
	window.location.href="exportonlineflightbooking.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&status="+status;
}
</script>