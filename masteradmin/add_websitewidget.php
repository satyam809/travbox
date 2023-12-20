<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_queryWidget',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> <?php echo stripslashes($moduleDataName['name']); ?></h5>
					</div>
					
					
					
					<div class="card-body">
					
				<div class="row">
							
			<div class="col-md-6"> 
			<h5 class="card-title">Choose Fields</h5> 
			<div class="row"> 
			<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="customerName" type="checkbox" class="custom-control-input" id="customerName" value="1" <?php if($editresult['customerName']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="customerName">Customer Name</label> 
									</div>
						
						</div>
						</div>
						 
						
						<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="email" type="checkbox" class="custom-control-input" id="email" value="1" <?php if($editresult['email']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="email"> Email ID</label> 
									</div>
						
						</div>
						</div>
						
						
							<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="phone" type="checkbox" class="custom-control-input" id="phone" value="1" <?php if($editresult['phone']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="phone"> Contact Number</label> 
									</div>
						
						</div>
						</div>
							<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="address" type="checkbox" class="custom-control-input" id="address" value="1" <?php if($editresult['address']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="address">Address</label> 
									</div>
						
						</div>
						</div>
							<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="travelLocation" type="checkbox" class="custom-control-input" id="travelLocation" value="1" <?php if($editresult['travelLocation']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="travelLocation">Travel Location</label> 
									</div>
						
						</div>
						</div>
						<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="country" type="checkbox" class="custom-control-input" id="country" value="1" <?php if($editresult['country']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="country">Country, State, City</label> 
									</div>
						
						</div>
						</div>
						<div class="col-md-6"> 
			<div class="form-group"> 
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="traveldate" type="checkbox" class="custom-control-input" id="traveldate" value="1" <?php if($editresult['traveldate']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="traveldate">Travel Date</label> 
									</div>
						
						</div>
						</div>
						
					
			</div>
			 
 <h5 class="card-title">Widget Setting</h5> 
					<div class="row">
					
					
							<div class="col-md-6"> 
						<div class="form-group">
									<label>Custom Width<span class="text-danger">*</span></label>
									<input name="customWidth" type="number" min="200" class="form-control" id="customWidth" value="<?php if($editresult['customWidth']<1){ echo '400'; } else { echo stripslashes($editresult['customWidth']); } ?>">
						   </div>
						   
						   </div>
						   
						   </div>
						   		<div class="row">
								
								<div class="col-md-6">
								<div class="form-group row"> 
								<div class="col-md-3">
										<input name="widgetBackgroud" type="color" class="form-control" id="widgetBackgroud" style="padding: 0px 2px; width: 100%; height: 30px;" value="<?php if($editresult['widgetBackgroud']!=''){  echo '#'.stripslashes($editresult['widgetBackgroud']); } else { echo '#ffffff'; }?>"> 
										
										<input name="widgetBackgroud1" id="widgetBackgroud1" type="hidden" value="<?php if($editresult['widgetBackgroud']!=''){  echo '#'.stripslashes($editresult['widgetBackgroud']); } else { echo '#ffffff'; }?>" />
								  </div>
									<label class="col-form-label col-md-9">Background</label>
									
								</div>
								</div>
								
								<div class="col-md-6">
								<div class="form-group row"> 
								<div class="col-md-3">
										<input name="widgetTitleBackgroud" type="color" class="form-control" id="widgetTitleBackgroud" style="padding: 0px 2px; width: 100%; height: 30px;" value="<?php if($editresult['widgetTitleBackgroud']!=''){  echo '#'.stripslashes($editresult['widgetTitleBackgroud']); } else { echo '#0a865c'; }?>"> 
										<input name="widgetTitleBackgroud1" id="widgetTitleBackgroud1" type="hidden" value="<?php if($editresult['widgetTitleBackgroud']!=''){  echo '#'.stripslashes($editresult['widgetTitleBackgroud']); } else { echo '#0a865c'; }?>" />
								  </div>
									<label class="col-form-label col-md-9">Title Backgroud</label>
									
								</div>
								</div>
								
								<div class="col-md-6">
								<div class="form-group row"> 
								<div class="col-md-3">
										<input name="buttonBackgroud" type="color" class="form-control" id="buttonBackgroud" style="padding: 0px 2px; width: 100%; height: 30px;" value="<?php if($editresult['buttonBackgroud']!=''){  echo '#'.stripslashes($editresult['buttonBackgroud']); } else { echo '#004fa2'; }?>"> 
										<input name="buttonBackgroud1" id="buttonBackgroud1" type="hidden" value="<?php if($editresult['buttonBackgroud']!=''){  echo '#'.stripslashes($editresult['buttonBackgroud']); } else { echo '#004fa2'; }?>" />
								  </div>
									<label class="col-form-label col-md-9">Button Backgroud</label>
									
								</div>
								</div>
								
								<div class="col-md-6">
								<div class="form-group row"> 
								<div class="col-md-3">
										<input name="widgetTitleBackgroudColor" type="color" class="form-control" id="widgetTitleBackgroudColor" style="padding: 0px 2px; width: 100%; height: 30px;" value="<?php if($editresult['widgetTitleBackgroudColor']!=''){  echo '#'.stripslashes($editresult['widgetTitleBackgroudColor']); } else { echo '#ffffff'; }?>"> 
										<input name="widgetTitleBackgroudColor1" id="widgetTitleBackgroudColor1" type="hidden" value="<?php if($editresult['widgetTitleBackgroudColor']!=''){  echo '#'.stripslashes($editresult['widgetTitleBackgroudColor']); } else { echo '#ffffff'; }?>" />
								  </div>
									<label class="col-form-label col-md-9">Title Color</label>
									
								</div>
								</div>
								
								
								<div class="col-md-6">
								<div class="form-group">
									<label>Form Title<span class="text-danger">*</span></label>
									<input name="formTitle" type="text" class="form-control" id="formTitle" value="<?php echo stripslashes($editresult['formTitle']); ?>">
						   </div> 
								</div>
								
								
								<div class="col-md-6">
								<div class="form-group">
									<label>Form Sub Title<span class="text-danger">*</span></label>
									<input name="formSubtitle" type="text" class="form-control" id="formSubtitle" value="<?php echo stripslashes($editresult['formSubtitle']); ?>">
						   </div> 
								</div>
								
								
								<div class="col-md-6">
								<div class="form-group">
									<label>Notification Email ID<span class="text-danger">*</span></label>
									<input name="notificationEmail" type="text" class="form-control" id="notificationEmail" value="<?php echo stripslashes($editresult['notificationEmail']); ?>">
						   </div> 
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Website Name<span class="text-danger">*</span></label>
									<input name="websiteName" type="text" class="form-control" id="websiteName" value="<?php echo stripslashes($editresult['websiteName']); ?>">
						   </div> 
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Thanks Page Title<span class="text-danger">*</span></label>
									<input name="thankTitle" type="text" class="form-control" id="thankTitle" value="<?php echo stripslashes($editresult['thankTitle']); ?>">
						   </div> 
								</div>
								
								<div class="col-md-6">
								<div class="form-group">
									<label>Thanks Page Sub Title<span class="text-danger">*</span></label>
									<input name="thankSubtitle" type="text" class="form-control" id="thankSubtitle" value="<?php echo stripslashes($editresult['thankSubtitle']); ?>">
						   </div> 
								</div>
								
					
						 <div class="col-md-6">
						
						   
						   
						   <div class="form-group">
									<label class="d-block font-weight-semibold">Status</label>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="status" type="checkbox" class="custom-control-input" id="status" value="1" <?php if($editresult['status']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="status">Active this Widget</label> 
									</div>
						
						</div>
						</div> 
						
						
					</div>
					
			 
					</div>		
					
					
					
					
								<div class="col-md-6"> 
			<h5 class="card-title" style="text-align:center;">Widget Preview</h5> 
			<div style=" max-width:100%; width:400px; margin:auto; overflow:hidden; border-radius: 4px; border:2px solid #ddd;" id="boxouter">
			<div style="padding:20px; text-align:center;" id="titlebgview">
			<div style=" font-size:22px; font-weight:500;" id="formtitaleview"></div>
			<div style=" font-size:16px; font-weight:400;" id="formsubtitaleview"></div>
			
			</div>
			<div style="padding:20px;">
			
			<div style="margin-bottom:10px;" id="customernameview">
			<div style="font-size:13px; margin-bottom:2px;">Customer Name</div>
			<input  type="text" class="form-control">
			
			</div>
			
			
			<div style="margin-bottom:10px;" id="emailview">
			<div style="font-size:13px; margin-bottom:2px;">Email ID</div>
			<input  type="text" class="form-control">
			
			</div>
			
			
			<div style="margin-bottom:10px;"  id="phoneview">
			<div style="font-size:13px; margin-bottom:2px;">Contact Number</div>
			<input  type="text" class="form-control">
			
			</div>
			
			
			
			<div style="margin-bottom:10px;" id="addressview">
			<div style="font-size:13px; margin-bottom:2px;">Address</div>
			<input  type="text" class="form-control">
			
			</div>
			
			<div style="margin-bottom:10px;" id="countryview">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%">Country</td>
    <td width="33%">State</td>
    <td width="33%">City</td>
  </tr>
  <tr>
    <td width="33%"><input  type="text" class="form-control"></td>
    <td width="33%"><input  type="text" class="form-control"></td>
    <td width="33%"><input  type="text" class="form-control"></td>
  </tr>
</table>

			 
			 
			
			</div>
			
			
			<div style="margin-bottom:10px;" id="locationview">
			<div style="font-size:13px; margin-bottom:2px;">Travel Location</div>
			<input  type="text" class="form-control">
			
			</div>
			
			
			
			
			
			
			<div style="margin-bottom:10px;" id="traveldateview">
			<div style="font-size:13px; margin-bottom:2px;">Travel Date</div>
			<input  type="text" class="form-control">
			
			</div>
			<div style="text-align:right;">
			<button type="button" class="btn btn-primary" id="perviewbutton">Submit Your Enquiry</button>
			</div>
			</div>
			
			
			</div>
			
			</div>
					</div>
				
					</div>
					
				  <div class="card-footer text-right">
								<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		                        	<span class="ladda-label">Cancel</span>
	                        	 </button></a>
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savewebsitewidget" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				  </div>
					
				</div>
				
				</form>
				</div>
				</div>
</div>




<script>
document.getElementById('widgetBackgroud').onchange=function(){  
  $('#widgetBackgroud1').val(this.value); 
}

document.getElementById('widgetTitleBackgroud').onchange=function(){  
  $('#widgetTitleBackgroud1').val(this.value); 
}
document.getElementById('widgetTitleBackgroudColor').onchange=function(){  
  $('#widgetTitleBackgroudColor1').val(this.value); 
}

document.getElementById('buttonBackgroud').onchange=function(){  
  $('#buttonBackgroud1').val(this.value); 
}

 function showpreview(){
 var customWidth = $('#customWidth').val();
 var widgetBackgroud = $('#widgetBackgroud1').val();
 var widgetTitleBackgroud = $('#widgetTitleBackgroud1').val();
 var widgetTitleBackgroudColor = $('#widgetTitleBackgroudColor1').val();
 var buttonBackgroud = $('#buttonBackgroud1').val();
 var formTitle = $('#formTitle').val();
 var formSubtitle = $('#formSubtitle').val();
 
 $('#boxouter').css('width',customWidth+'px');
 $('#boxouter').css('background-color',widgetBackgroud);
 $('#titlebgview').css('background-color',widgetTitleBackgroud);
 $('#perviewbutton').css('background-color',buttonBackgroud);
 
 
 $('#titlebgview').css('color',widgetTitleBackgroudColor); 
 $('#formtitaleview').html(formTitle); 
 $('#formsubtitaleview').html(formSubtitle);
 
 if ($('#customerName').is(':checked')) {
 $('#customernameview').show();
 } else {
 $('#customernameview').hide();
 }
 
 if ($('#phone').is(':checked')) {
 $('#phoneview').show();
 } else {
 $('#phoneview').hide();
 }
 
 if ($('#email').is(':checked')) {
 $('#emailview').show();
 } else {
 $('#emailview').hide();
 }
 if ($('#address').is(':checked')) {
 $('#addressview').show();
 } else {
 $('#addressview').hide();
 }
 if ($('#country').is(':checked')) {
 $('#countryview').show();
 } else {
 $('#countryview').hide();
 }
 if ($('#travelLocation').is(':checked')) {
 $('#locationview').show();
 } else {
 $('#locationview').hide();
 }
 if ($('#traveldate').is(':checked')) {
 $('#traveldateview').show();
 } else {
 $('#traveldateview').hide();
 }
  
 
 }

 window.setInterval(function(){
  showpreview();
}, 500);



</script>  