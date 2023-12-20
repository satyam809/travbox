 <div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Flight Booking Error Log </h4> 
			</div>
			
			<div style="float:right; width:60%; display:none;" class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >
		
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
						 
					

			 		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Ref. No:</th>
								  <th>API&nbsp;Booking&nbsp;ID</th>
								  <th>Airline</th>
								  <th>Agent</th>
								  <th>Error Log</th>
							    </tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['fromdate']!=''){
$search=' DATE(addDate)="'.$_REQUEST['addDate'].'" ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flightBookingMaster',' where 1  and ErrorMessage!=""  order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'"'); 
$agentData=mysqli_fetch_array($rs6);
?>
								
								<tr>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?></td>
								  <td align="left" valign="top"><?php echo stripslashes($rest['bookingNumber']); ?></td>
								  <td align="left" valign="top"><div style="width:150px;"><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br />
<strong>From:</strong> <?php $arr = explode('-',$rest['source']); echo $arr[1]; ?> <strong>To:</strong><?php $arr2 = explode('-',$rest['destination']); echo $arr2[1]; ?><br />
<?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?></div></td>
								  <td align="left" valign="top"> <?php if($agentData['isAgent']==0){ ?><span class="badge bg-blue">B2C Client</span><?php } else { ?><span class="badge bg-black" style="background-color:#000;">Agent</span><?php } ?></td>
								  <td align="left" valign="top"><div style="border:2px dashed #FFCC66; background-color:#FFFADD; padding:10px; color:#000000;"><?php echo stripslashes($rest['ErrorMessage']); ?></div>  </td>
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
</script>


   