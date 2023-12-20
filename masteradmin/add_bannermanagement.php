<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_bannerMaster','  id="'.decode($_REQUEST['id']).'" '); 
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
					<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Banner</h5>
				</div>
					
				<div class="card-body">
					<div class=" ">
						<div class=" ">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Upload Image<!--<span class="text-danger"> &nbsp;Recommended Size (PX): 130 X 30</span>--></label>
										<input name="companyLogo" type="file" class="form-control" id="companyLogo" style="padding: 4px;">
									</div>
								</div>
						
								<div class="col-md-6">
									<div class="form-group">
										<label>Url<span class="text-danger">*</span></label>
										<input name="url" type="text" class="form-control" id="url" value="<?php echo stripslashes($editresult['url']); ?>">
									</div>
								</div>
						
								<div class="col-md-6">
									<div class="form-group">
										<label>Sequence<span class="text-danger">*</span></label>
										<input name="sequence" type="number" class="form-control" id="sequence" value="<?php echo stripslashes($editresult['sequence']); ?>">
									</div>
								</div>
						
	
								<div class="col-md-6">
									<div class="form-group">
										<label>Status<span class="text-danger">*</span></label>
										<select id="status" name="status" class="form-control select-clear">  
											<option value="1" <?php if($rest['status']==1){ ?>selected="selected"<?php } ?>>Active</option>  
											<option value="0" <?php if($rest['status']==2){ ?>selected="selected"<?php } ?>>Inactive</option>  
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<div class="card-footer text-right">
					<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius"><span class="ladda-label">Cancel</span></button></a>
								
					<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					<input name="action" type="hidden" id="action" value="addbannermanagement" />
					<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				</div>
			</div>
		</form>
	</div>
</div>
</div>