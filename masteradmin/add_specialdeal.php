<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_specialDeal',' id="'.decode($_REQUEST['id']).'" '); 
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
					<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Special Deal</h5>
				</div>
					
						<div class="card-body">
							<div class="row">
							 <div class="col-md-4">
									<div class="form-group">
										<label>Type<span class="text-danger">*</span></label>
										<select name="dealtype" id="dealtype" class="form-control" onchange="selecttype();" >
										  
										  <option value="flight" <?php if($editresult['dealType']=='flight'){ ?>selected="selected"<?php  } ?>>Flight</option>
										  <option value="flightb2c" <?php if($editresult['dealType']=='flightb2c'){ ?>selected="selected"<?php  } ?>>Flight B2C Website</option>
										  <option value="hotel" <?php if($editresult['dealType']=='hotel'){ ?>selected="selected"<?php  } ?>>Hotel</option>
										  <option value="bus" <?php if($editresult['dealType']=='bus'){ ?>selected="selected"<?php  } ?>>Bus</option>
										  <option value="hotelb2c" <?php if($editresult['dealType']=='hotelb2c'){ ?>selected="selected"<?php  } ?>>Hotel B2C Website</option>
										  <option value="packageb2c" <?php if($editresult['dealType']=='packageb2c'){ ?>selected="selected"<?php  } ?>>Package B2C Website</option>
										  <option value="cabsb2c" <?php if($editresult['dealType']=='cabsb2c'){ ?>selected="selected"<?php  } ?>>Cabs B2C Website</option>
										  <option value="dashboard" <?php if($editresult['dealType']=='dashboard'){ ?>selected="selected"<?php  } ?>>Dashboard Banner</option>
										</select>
									</div>
								</div>
							
								<div class="col-md-8">
									<div class="form-group">
										<label id="changetitle"><?php if($editresult['dealType']=='dashboard'){ echo 'URL'; } else { echo 'Title'; } ?><span class="text-danger">*</span></label>
										<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>">
									</div>
								</div>
								
								<div class="col-md-6" style="display:none;">
									<div class="form-group">
										<label>Url<span class="text-danger">*</span></label>
										<input name="url" type="text" class="form-control" id="url" value="#">
									</div>
								</div>	
								
								<div class="col-md-12 typedashbaord">
									<div class="form-group">
										<label>Description</label>
										<textarea name="description" rows="8" class="form-control" id="description"><?php echo stripslashes($editresult['description']); ?></textarea>
									</div>
								</div>	
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Image<span class="text-danger">*</span></label>
										<input name="image" type="file" id="image">
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
					
				<div class="card-footer text-right">
					<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius"><span class="ladda-label">Cancel</span></button></a>
								
					<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					<input name="action" type="hidden" id="action" value="addspecialdeal" />
					<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				</div>
			</div>
		</form>
	</div>
</div>
</div>

<script>
function selecttype(){
var dealtype = $('#dealtype').val();
$('.typedashbaord').show();
$('#changetitle').text('Title');
if(dealtype=='dashboard'){
$('.typedashbaord').hide();
$('#changetitle').text('URL');
}
}
</script>
<?php if($editresult['dealType']=='dashboard'){ ?>
<style>
.typedashbaord{display:none;}
</style>
<?php } ?>