 <div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - System Log </h4> 
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
								  <th>&nbsp;</th>
								  <th>User&nbsp;Name</th>
								  
								  <th>User ID </th>
								  <th> IP</th>
								  <th>Type</th>
									<th>Details</th>
									<th>Date</th>
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
$rs=GetRecordList('*','sys_userLogs',' where 1 and userId>0 '.$search.'  order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','sys_userMaster',' id="'.$rest['userId'].'"'); 
$agentcate=mysqli_fetch_array($rs6);
?>
								
								<tr>
								  <td align="left" valign="top">&nbsp;</td>
								  <td align="left" valign="top"><?php echo stripslashes($agentcate['companyName']); ?> (<?php echo makeAgentId($agentcate['id']); ?>)</td>
								  <td align="left" valign="top"><?php echo stripslashes($agentcate['email']); ?></td>
								  <td align="left" valign="top"><?php echo stripslashes($rest['currentIp']); ?></td>
<td align="left" valign="top"><?php echo stripslashes($rest['logType']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['details']); ?></td>
									<td align="left" valign="top"><?php echo date('d/m/Y h:i A',($rest['addDate'])); ?></td>
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


   