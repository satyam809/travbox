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
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add User</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th>User</th>
									<th>Email</th>
									<th>Contact&nbsp;Number </th>
									<th>Branch</th>
									<th>Role&nbsp;/&nbsp;Permission</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_userMaster',' where   addBy="'.$_SESSION['userid'].'"   and (userType="admin" or userType="admin_user") order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$rs5=GetPageRecord('*','sys_branchMaster','     id="'.$rest['branchId'].'" '); 
$branchData=mysqli_fetch_array($rs5);

$rs6=GetPageRecord('*','rolePermissionProfile','     id="'.$rest['roleId'].'" '); 
$permissionData=mysqli_fetch_array($rs6);
?>
								
								<tr>
									<td align="left" valign="top"><a href="<?php if($sNo>1){ ?>display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1<?php } else { ?>#<?php } ?>"><strong><?php echo stripslashes($rest['name']); ?></strong></a></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['email']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($rest['phone']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($branchData['companyName']); ?></td>
									<td align="left" valign="top"><?php echo stripslashes($permissionData['name']); ?></td>
									<td align="left" valign="top"><?php echo getsectionstatus($rest['status']); ?></td>
									<td align="right" valign="top">
									<?php if($sNo>1){ ?>
									<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
									<?php } ?>
									
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




   