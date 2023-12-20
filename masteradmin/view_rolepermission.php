<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','rolePermissionProfile',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($rs5);
}


?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
				<div class="card">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title"><?php echo stripslashes($editresult['name']); ?> Permissions</h5>
				  </div>
					 
			 
					
					<table class="table table-hover">
							<thead>
								<tr>
									<th>Module</th>
									<th>View</th>
									<th>Add</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							 <?php  
$rs=GetPageRecord('*','sys_moduleMaster','   pageUrl!="#" and (parentId=0 or parentId=1000) order by id asc');
while($rest=mysqli_fetch_array($rs)){ 


$rs6=GetPageRecord('*','permissionMaster',' parentId="'.$LoginUserDetails['parentId'].'" and profileId="'.decode($_REQUEST['id']).'" and moduleId="'.($rest['id']).'" '); 
$selectlistingcheck=mysqli_fetch_array($rs6);
?>
							
								<tr>
									<td><?php echo stripslashes($rest['name']); ?>
								    <input name="moduleId[]" type="hidden" value="<?php echo stripslashes($rest['id']); ?>"/></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionView<?php echo stripslashes($rest['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionView" <?php if($selectlistingcheck['permissionView']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionAdd<?php echo stripslashes($rest['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionAdd" <?php if($selectlistingcheck['permissionAdd']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionEdit<?php echo stripslashes($rest['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionEdit" <?php if($selectlistingcheck['permissionEdit']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionDelete<?php echo stripslashes($rest['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionDelete" <?php if($selectlistingcheck['permissionDelete']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
								</tr>
								
								 <?php  
$rs2=GetPageRecord('*','sys_moduleMaster','  parentId="'.$rest['id'].'" order by id asc');
while($restsub=mysqli_fetch_array($rs2)){ 

$rs6=GetPageRecord('*','permissionMaster',' parentId="'.$LoginUserDetails['parentId'].'" and profileId="'.decode($_REQUEST['id']).'" and moduleId="'.($restsub['id']).'" '); 
$selectlistingcheck=mysqli_fetch_array($rs6);
?>
									<tr<?php if($restsub['pageUrl']=='#'){ ?> style="background-color:#F0F0F0; font-weight:500;"<?php }?>>
									<td><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($restsub['name']); ?><input name="moduleId[]" type="hidden" value="<?php echo stripslashes($restsub['id']); ?>"/></td>
									<td><?php if($restsub['pageUrl']!='#'){ ?><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionView<?php echo stripslashes($restsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionView" <?php if($selectlistingcheck['permissionView']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div><?php } ?></td>
									<td><?php if($restsub['pageUrl']!='#'){ ?><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionAdd<?php echo stripslashes($restsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionAdd" <?php if($selectlistingcheck['permissionAdd']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div><?php } ?></td>
									<td><?php if($restsub['pageUrl']!='#'){ ?><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionEdit<?php echo stripslashes($restsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionEdit" <?php if($selectlistingcheck['permissionEdit']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div><?php } ?></td>
									<td><?php if($restsub['pageUrl']!='#'){ ?><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionDelete<?php echo stripslashes($restsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionDelete" <?php if($selectlistingcheck['permissionDelete']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div><?php } ?></td>
								</tr>
								
									 <?php  
$rs3=GetPageRecord('*','sys_moduleMaster','  parentId="'.$restsub['id'].'" order by id asc');
while($restsubsub=mysqli_fetch_array($rs3)){ 


$rs6=GetPageRecord('*','permissionMaster',' parentId="'.$LoginUserDetails['parentId'].'" and profileId="'.decode($_REQUEST['id']).'" and moduleId="'.($restsubsub['id']).'" '); 
$selectlistingcheck=mysqli_fetch_array($rs6);
?>
									<tr>
									<td style="padding-left:40px;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($restsubsub['name']); ?><input name="moduleId[]" type="hidden" value="<?php echo stripslashes($restsubsub['id']); ?>"/></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionView<?php echo stripslashes($restsubsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionView" <?php if($selectlistingcheck['permissionView']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionAdd<?php echo stripslashes($restsubsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionAdd" <?php if($selectlistingcheck['permissionAdd']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionEdit<?php echo stripslashes($restsubsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionEdit" <?php if($selectlistingcheck['permissionEdit']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
									<td><div class="form-check form-check-switchery">
									<label class="form-check-label">
										<input name="permissionDelete<?php echo stripslashes($restsubsub['id']); ?>" type="checkbox" class="form-check-input-switchery" value="1" id="permissionDelete" <?php if($selectlistingcheck['permissionDelete']==1){ ?>checked<?php } ?> data-fouc> 
									</label>
								</div></td>
								</tr>
								
								<?php } } } ?>
							</tbody>
						</table>
					
					
				 
				  <div class="card-footer text-right">
								<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		                        	<span class="ladda-label">Cancel</span>
	                        	 </button></a>
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savepermission" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				  </div>
					
				</div>
				
			  </form>
		  </div>
  </div>
</div>




   