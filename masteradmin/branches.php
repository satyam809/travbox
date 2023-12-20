<?php  
include "settingheader.php";  
?>


<div class="page-content pt-0" > 
		
<?php  
include "settingleft.php"; 
?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo stripslashes($moduleDataName['name']); ?></h5>
						<!--<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add Branch</button></a>
		                	</div>
	                	</div>-->
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th>Branch</th>
									<th>Contact Person</th>
									<th>Address</th>
									<th>Billing</th>
									<th>Time Zone</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
//$rs=GetRecordList('*','sys_branchMaster',' where parentId="'.$LoginUserDetails['parentId'].'" order by id desc  ','100',$page,$targetpage); 
$rs=GetRecordList('*','sys_branchMaster',' where userId="'.$_SESSION['userid'].'" order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>
								
								<tr>
									<td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['contactPerson']); ?><br /><?php echo stripslashes($rest['email']); ?><br /><?php echo stripslashes($rest['phone']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['address']); ?><br /><?php echo getCityName($rest['city']); ?> <?php echo getStateName($rest['state']); ?> <?php echo getCountryName($rest['country']); ?></td>
									<td align="left" valign="top"><?php echo getCurrencyName($rest['currency']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['userTimeZone']); ?></td>
									<td align="right" valign="top">
									
									<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
								</tr>
								 <?php } ?>
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




   