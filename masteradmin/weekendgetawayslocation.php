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
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add New</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
								  <th>Icon</th>
									<th>Name</th>
									<th>Status</th>
									<th>Add By </th>
									<th>Update By </th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
 
$rs=GetRecordList('*','weekendGatewayLocationMaster',' where parentId="'.$LoginUserDetails['parentId'].'" order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>
								
								<tr>
								  <td align="left" valign="top"><?php if($rest['img']!=''){ ?><img src="<?php echo $fullurl; ?>upload/<?php echo $rest['img']; ?>" style="width:80px;" /><?php } ?></td>
									<td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1&id=<?php echo encode($rest['id']); ?>"><strong><?php echo stripslashes($rest['name']); ?></strong></a></td>
									<td align="left" valign="top"><?php echo getsectionstatus($rest['status']); ?></td>
									<td align="left" valign="top"><?php echo getUserName($rest['addBy']); ?><div style="font-size:11px; margin-top:2px; color:#666666;"><?php if($rest['addDate']>0){ echo date('d/m/Y - h:i A',$rest['addDate']); } ?></div></td>
									<td align="left" valign="top"><?php if($rest['editBy']>0){  echo getUserName($rest['editBy']); ?><div style="font-size:11px; margin-top:2px; color:#666666;"><?php if($rest['editDate']>0){  echo date('d/m/Y - h:i A',$rest['editDate']); } ?></div><?php } ?></td>
									<td align="right" valign="top">
									
									<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
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




   