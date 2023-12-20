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
								 <span onclick="loadpop('Add SMS Template',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsmstemplate" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add SMS Template</span> 
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th width="20%">Title</th>
									<th width="60%">Content</th>
									<th width="10%">Status</th>
									<th width="10%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_smsTemplate','where addBy="'.$_SESSION['userid'].'" order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
	<td align="left" valign="top"><?php echo stripslashes($rest['title']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['content']); ?></td>
	<td align="left" valign="top"><?php if($rest['status']==1){echo "Active";}else{echo "In-active";} ?></td>
	<td align="left" valign="top">
		<div align="center"><a style="cursor:pointer;" onclick="loadpop('Edit SMS Template',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsmstemplate&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button></a></div>
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




   