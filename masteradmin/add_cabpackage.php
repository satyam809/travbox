<?php

if($_REQUEST['id']!=''){ 

$select1='*';    

$where1='id="'.decode($_REQUEST['id']).'"';  

$rs1=GetPageRecord($select1,'cab_packages',$where1);   

$editresult=mysqli_fetch_array($rs1); 

}





$rs111=GetPageRecord('*','tariff_settting','1');   

$editresult11=mysqli_fetch_array($rs111); 

?>

 <script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>



<div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Back</a>  -  <strong><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?>Cab Package</strong> </h4> 
			</div> 
		</div>
		
				
	</div>

<div class="page-content pt-0"> 
		
		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 

		<div class="col-lg-12">

			<div class="row"> 

				<div class="col-lg-6">

					<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px; background-color:#FFFFFF;">

						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Basic Information</div>

						</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Package Type <span class="redmtext">*</span></label>

		<select name="package_category" id="package_category" class="form-control" onchange="packageType(this.value)">

			<option value="1" <?php if($editresult['package_category']=='1'){ ?>selected="selected"<?php } ?>>Local</option>

			<option value="2" <?php if($editresult['package_category']=='2'){ ?>selected="selected"<?php } ?>>Airport transfer</option>

			<option value="3" <?php if($editresult['package_category']=='3'){ ?>selected="selected"<?php } ?>>Out station</option>

		</select>

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Available For <span class="redmtext">*</span></label>

		<select name="available_for" id="available_for" class="form-control">

			<option value="1" <?php if($editresult['available_for']=='1'){ ?>selected="selected"<?php } ?>>One-way</option>

			<option value="2" <?php if($editresult['available_for']=='2'){ ?>selected="selected"<?php } ?>>Round-trip</option>

			<option value="3" <?php if($editresult['available_for']=='3'){ ?>selected="selected"<?php } ?>>Both</option>

		</select>

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Select Category</label>

			<select name="cab_category" class="form-control"  autocomplete="off">  

			<?php

				$rs33=GetPageRecord('*','vehicle_category','status="1" '); 

				while($vehicle_category=mysqli_fetch_array($rs33)){

			?>

				<option value="<?php echo $vehicle_category["id"]; ?>" <?php if($vehicle_category["id"]==$editresult['cab_category']){ ?>selected="selected"<?php } ?>><?php echo $vehicle_category["name"]; ?></option> 

			<?php } ?>

			</select>

	</div>

</div>



<div class="col-lg-12">	

	<div class="form-group">

		<label for="validationCustom02">Location <span class="redmtext">*</span></label>

		<select name="location" class="form-control"  autocomplete="off">  

			<?php

				$rs33=GetPageRecord('*','destination','status="1" '); 

				while($destination=mysqli_fetch_array($rs33)){

			?>

				<option value="<?php echo $destination["name"]; ?>" <?php if($destination["name"]==$editresult['location']){ ?>selected="selected"<?php } ?>><?php echo $destination["name"]; ?></option> 

			<?php } ?>

			</select>

	</div>

</div>



<div class="col-lg-6" id="div1" style="<?php if($editresult['package_category']=="3"){ ?>display:none;<?php } ?>">	

	<div class="form-group">

		<label for="validationCustom02">Min. Hrs. Per Day <span class="redmtext">*</span></label>

		<input type="number" id="min_hrs_per_day" name="min_hrs_per_day" class="form-control" placeholder="Min. Hrs. Per Day" value="<?php echo stripslashes($editresult['min_hrs_per_day']); ?>">

	</div>

</div>



<div class="col-lg-6" id="div2" style="<?php if($editresult['package_category']=="3"){ ?>display:none;<?php } ?>">	

	<div class="form-group">

		<label for="validationCustom02">Extra Charges Per Hrs. <span class="redmtext">*</span></label>

		<input type="number" id="extra_charges_per_hrs" name="extra_charges_per_hrs" class="form-control" placeholder="Extra Charges Per Hrs." value="<?php echo stripslashes($editresult['extra_charges_per_hrs']); ?>">

	</div>

</div>





<div class="col-lg-6">	

	<div class="form-group">

		<label for="validationCustom02">Min. Klm. Per Day <span class="redmtext">*</span></label>

		<input type="number" id="min_klm_per_day" name="min_klm_per_day" class="form-control" placeholder="Min. Klm. Per Day" value="<?php echo stripslashes($editresult['min_klm_per_day']); ?>">

	</div>

</div>



<div class="col-lg-6">	

	<div class="form-group">

		<label for="validationCustom02">Tariff Basic Cost/Day <span class="redmtext">*</span></label>

		<input type="number" id="tariff_cost" name="tariff_cost" class="form-control" placeholder="Tariff Cost" value="<?php echo stripslashes($editresult['tariff_cost']); ?>">

	</div>

</div>



<div class="col-lg-6">	

	<div class="form-group">

		<label for="validationCustom02">Driver Allowance/Day <span class="redmtext">*</span></label>

		<input type="number" id="driver_allowance" name="driver_allowance" class="form-control" placeholder="Driver Allowance" value="<?php echo stripslashes($editresult['driver_allowance']); ?>">

	</div>

</div>



<div class="col-lg-6">	

	<div class="form-group">

		<label for="validationCustom02">Extra Per Klm. Charges <span class="redmtext">*</span></label>

		<input type="number" id="extra_per_klm_charges" name="extra_per_klm_charges" class="form-control" placeholder="Extra Per Klm. Charges" value="<?php echo stripslashes($editresult['extra_per_klm_charges']); ?>">

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Night Shift Start Time <span class="redmtext">*</span></label>

		<input type="time" id="night_shift_start_time" name="night_shift_start_time" class="form-control" placeholder="Night Shift Start Time" value="<?php echo stripslashes($editresult['night_shift_start_time']); ?>">

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Night Shift End Time <span class="redmtext">*</span></label>

		<input type="time" id="night_shift_end_time" name="night_shift_end_time" class="form-control" placeholder="Night Shift End Time" value="<?php echo stripslashes($editresult['night_shift_end_time']); ?>">

	</div>

</div>





<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Night Shift Allowence <span class="redmtext">*</span></label>

		<input type="number" id="night_shift_allowence" name="night_shift_allowence" class="form-control" placeholder="Night Shift Allowence" value="<?php echo stripslashes($editresult['night_shift_allowence']); ?>">

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Convenience Fee <span class="redmtext">*</span></label>

		<input type="number" id="convenience_fee" name="convenience_fee" class="form-control" placeholder="Convenience Fee" value="<?php echo stripslashes($editresult['convenience_fee']); ?>">

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Tax <span class="redmtext">*</span></label>

		<input type="number" id="tax" name="tax" class="form-control" placeholder="Tax" value="<?php echo stripslashes($editresult['tax']); ?>">

	</div>

</div>



<div class="col-lg-4">	

	<div class="form-group">

		<label for="validationCustom02">Status <span class="redmtext">*</span></label>

<select name="status" class="form-control" autocomplete="off">  

	<option value="1" <?php if('1'==$editresult['status']){ ?>selected="selected"<?php } ?>>Active</option> 

	<option value="0" <?php if('0'==$editresult['status']){ ?>selected="selected"<?php } ?>>Inactive</option>  

</select>

	</div>

</div>



<div class="col-lg-12">

	<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Cab Contents</div>

</div>

<div class="col-lg-12">	

	<?php

	$rs44=GetPageRecord('*','cab_content','status="1"'); 

	while($cab_contents=mysqli_fetch_array($rs44)){

	?>

	<div><input type="checkbox" name="cab_contents[]" value="<?php echo $cab_contents["id"]; ?>"  <?php echo checkifvalue($editresult['cab_contents'],$cab_contents['id']); ?> />&nbsp;&nbsp;<?php echo $cab_contents["name"]; ?> </div>

	<?php } ?>

</div>



					</div>

				</div>

					

				<div class="col-lg-6">

					<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px; background-color:#FFFFFF;">



						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Inclusion & Exclusion</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="inclusion_exclusion" class="form-control editorclass" ><?php if($_REQUEST['id']==''){ echo $editresult11["inclusion_exclusion"]; }else{ echo stripslashes($editresult['inclusion_exclusion']); } ?></textarea>
							
							<script type="text/javascript">

var editor = CKEDITOR.replace('inclusion_exclusion');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>

						</div>

						

						

						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Cancellation policy</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="cancellation_policy" class="form-control editorclass" >

							<?php if($_REQUEST['id']==''){ echo $editresult11["cancellation_policy"]; }else{ echo stripslashes($editresult['cancellation_policy']); } ?>

							</textarea>
							
							<script type="text/javascript">

var editor = CKEDITOR.replace('cancellation_policy');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>

						</div>



						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Govt. advisory & safety guidelines</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="govt_advisory" class="form-control editorclass">

							<?php if($_REQUEST['id']==''){ echo $editresult11["govt_advisory"]; }else{ echo stripslashes($editresult['govt_advisory']); } ?>

							</textarea>
							
							
							<script type="text/javascript">

var editor = CKEDITOR.replace('govt_advisory');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>

						</div>

						

						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Other information</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="other_information" class="form-control editorclass">

							<?php if($_REQUEST['id']==''){ echo $editresult11["other_information"]; }else{ echo stripslashes($editresult['other_information']); } ?>

							</textarea>
							
							<script type="text/javascript">

var editor = CKEDITOR.replace('other_information');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>

						</div>

						

					</div>

				</div>

			</div>  

									

			<div class="row">

				<div class="col-lg-12">

					<div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">

						<button type="submit" id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" >Save Package</button>

                        <input autocomplete="false" name="action" type="hidden" id="action" value="addCabPackage" />

						<input autocomplete="false" name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />

					</div>

				</div>

			</div>

		</div>

	</form>
		  </div>
 




   