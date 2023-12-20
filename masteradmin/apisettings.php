<?php  
include "settingheader.php"; 

$rs5=GetPageRecord('*','sys_companyMaster',' userId="'.$LoginUserDetails['parentId'].'" '); 
$editresult=mysqli_fetch_array($rs5);
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 
?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
				<div class="card">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Flight API Settings</h5>
					</div>
					
					<div class="card-body">
					<div class="row">
						 <div class="col-md-3">
						<div class="form-group">
									<label>Hit Source<span class="text-danger">*</span></label>
									<input name="flightHitSource" type="text" class="form-control" id="flightHitSource" value="<?php echo stripslashes($editresult['flightHitSource']); ?>">
						   </div>
						</div>
						
						 <div class="col-md-3">
						<div class="form-group">
									<label>A ID<span class="text-danger">*</span></label>
									<input name="flightA_ID" type="text" class="form-control" id="flightA_ID" value="<?php echo stripslashes($editresult['flightA_ID']); ?>">
						   </div>
						</div>
						
						
						 <div class="col-md-3">
						<div class="form-group">
									<label>PWD<span class="text-danger">*</span></label>
									<input name="flightPWD" type="text" class="form-control" id="flightPWD" value="<?php echo stripslashes($editresult['flightPWD']); ?>">
						   </div>
						</div>
						
							 <div class="col-md-3">
						<div class="form-group">
									<label>U ID<span class="text-danger">*</span></label>
									<input name="flightU_ID" type="text" class="form-control" id="flightU_ID" value="<?php echo stripslashes($editresult['flightU_ID']); ?>">
						   </div>
						</div>
					  
						 
					</div>
					
					
					
					
				
					</div>
					
				   
					
				</div>
				<div class="card">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Hotel API Settings</h5>
					</div>
					
					<div class="card-body">
					<div class="row">
						 <div class="col-md-12">
						<div class="form-group">
									<label>API Key<span class="text-danger">*</span></label>
									<input name="hotelApiKey" type="text" class="form-control" id="hotelApiKey" value="<?php echo stripslashes($editresult['hotelApiKey']); ?>">
						   </div>
						</div>
						
						   
						  
						
							  
					  
						 
					</div>
					
					
					
					
				
					</div>
					
				  <div class="card-footer text-right">
								<button type="submit" class="btn btn-primary">Save Changes &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="saveapisetting" />
						</div>
					
				</div>
				</form>
				</div>
				</div>
</div>




   