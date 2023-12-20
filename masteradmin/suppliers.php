<div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Suppliers</h4> 
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
			 
				
		 
		
		<div class="col-xl-6">
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
						<h5 class="card-title">Suppliers List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add Supplier</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Company</th>
									<th>Contact Person</th>
									<th>Email</th>
									<th>Contact&nbsp;Number </th>
									<th>Location</th>
									<th>Description</th>
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

 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (companyName like "%'.$_REQUEST['keyword'].'%" or  name like "%'.$_REQUEST['keyword'].'%" or  phone like "%'.$_REQUEST['keyword'].'%" or  email like "%'.$_REQUEST['keyword'].'%") ';
}


 $targetpage='display.html?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_userMaster',' where parentId="'.$_SESSION['userid'].'"  and  userType="suppliers" '.$search.' order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


 
?>
								
								<tr>
								  <td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['name']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['email']); ?></td>
									<td align="left" valign="top">+<?php echo stripslashes($rest['countryCode']); ?>-<?php echo stripslashes($rest['phone']); ?></td>
									<td align="left" valign="top"><?php echo getCityName($rest['city']); ?>, <?php echo getStateName($rest['state']); ?>, <?php echo getCountryName($rest['country']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['description']); ?></td>
									<td align="left" valign="top"><?php echo getsectionstatus($rest['status']); ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></td>
									<td align="right" valign="top">
									 
									<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
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




   