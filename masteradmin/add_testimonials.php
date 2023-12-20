<?php  

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_testimonials',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($rs5);
} 

?>





<div class="page-content pt-0" style="margin-top: 70px;"> 

		

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
					<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Testimonials</h5>
				</div>
					
						<div class="card-body">
							<div class="row">
								<div class="col-md-4" style="display:none;">
									<div class="form-group">
										<label>Title<span class="text-danger">*</span></label>
										<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>">
									</div>
								</div>
								
									<div class="col-md-12">
									<div class="form-group">
										<label>Testimonial<span class="text-danger">*</span></label>
										<textarea name="description" rows="3" class="form-control" id="description"><?php echo stripslashes($editresult['description']); ?></textarea>
									</div>
								</div>
								
									<div class="col-md-4">
									<div class="form-group">
										<label>Name<span class="text-danger">*</span></label>
										<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>">
									</div>
								</div>
								
								
									<div class="col-md-4" style="display:none;">
									<div class="form-group">
										<label>Destination<span class="text-danger">*</span></label>
										<input name="destination" type="text" class="form-control" id="destination" value="<?php echo stripslashes($editresult['destination']); ?>">
									</div>
								</div>
								
									<div class="col-md-4" style="display:none;">
									<div class="form-group">
										<label>Travel Date<span class="text-danger">*</span></label>
										<input name="dateoftravel" type="text" class="form-control" id="dateoftravel" value="<?php echo stripslashes($editresult['dateoftravel']); ?>">
										
										  <script>
  $( function() {
    $( "#dateoftravel" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  </script>
									</div>
								</div>
								
									<div class="col-md-4">
									<div class="form-group">
										<label>Rating<span class="text-danger">*</span></label>
										 
										<select name="starRating" class="form-control" >
										  <option value="1" <?php if($editresult['starRating']==1){ ?>selected="selected"<?php } ?>>1 Star</option>
										  <option value="2" <?php if($editresult['starRating']==2){ ?>selected="selected"<?php } ?>>2 Star</option>
										  <option value="3" <?php if($editresult['starRating']==3){ ?>selected="selected"<?php } ?>>3 Star</option>
										  <option value="4" <?php if($editresult['starRating']==4){ ?>selected="selected"<?php } ?>>4 Star</option>
										  <option value="5" <?php if($editresult['starRating']==5){ ?>selected="selected"<?php } ?>>5 Star</option>
										</select>
									</div>
								</div>
								
								
						  
								 
								
								<div class="col-md-4">
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
					<input name="action" type="hidden" id="action" value="addtestimonial" />
					<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				</div>
			</div>
		</form>

	</div>

</div>

</div>