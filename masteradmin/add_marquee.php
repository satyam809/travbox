<?php  

include "settingheader.php"; 

?>





<div class="page-content pt-0"> 

		

<?php  

include "settingleft.php"; 



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','sys_Marquee',' id="'.decode($_REQUEST['id']).'" '); 

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

					<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Marquee</h5>

				</div>

					

						<div class="card-body">

							<div class="row">
							
							<div class="col-md-3">
									<div class="form-group">
										<label>Type<span class="text-danger">*</span></label>
										<select name="messageType" class="form-control" >
										  
										  <option value="dashboard" <?php if($editresult['messageType']=='dashboard'){ ?>selected="selected"<?php  } ?>>Dashbaord</option>
										  <option value="flight" <?php if($editresult['messageType']=='flight'){ ?>selected="selected"<?php  } ?>>Flight</option>
										  <option value="flightb2c" <?php if($editresult['messageType']=='flightb2c'){ ?>selected="selected"<?php  } ?>>Flight B2C Website</option>
										  <option value="hotel" <?php if($editresult['messageType']=='hotel'){ ?>selected="selected"<?php  } ?>>Hotel</option>
										  <option value="hotelb2c" <?php if($editresult['messageType']=='hotelb2c'){ ?>selected="selected"<?php  } ?>>Hotel B2C Website</option>
										  <option value="package" <?php if($editresult['messageType']=='package'){ ?>selected="selected"<?php  } ?>>Package</option>
										  <option value="packageb2c" <?php if($editresult['messageType']=='packageb2c'){ ?>selected="selected"<?php  } ?>>Package B2C Website</option>
										  <option value="bus" <?php if($editresult['messageType']=='bus'){ ?>selected="selected"<?php  } ?>>Bus</option>
										  <option value="busb2c" <?php if($editresult['messageType']=='busb2c'){ ?>selected="selected"<?php  } ?>>Bus B2C Website</option>
										</select>
									</div>
								</div>

								<div class="col-md-3">

									<div class="form-group">

										<label>Title<span class="text-danger">*</span></label>

										<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>">

									</div>

								</div>

								

								<div class="col-md-4">

									<div class="form-group">

										<label>Url<span class="text-danger">*</span></label>

										<input name="url" type="text" class="form-control" id="url" value="<?php echo stripslashes($editresult['url']); ?>">

									</div>

								</div>						

	

								<div class="col-md-2">

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

					<input name="action" type="hidden" id="action" value="addmarquee" />

					<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />

				</div>

			</div>

		</form>

	</div>

</div>

</div>