<?php 
include "config/database.php";
include "config/function.php";
include "config/setting.php";
?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">-->
      <title><?php echo $systemname; ?></title> 
	  <?php include "headerinc.php"; ?>  
   </head>
   <body> 




<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>Signup Form</h4> 
		</div> 
	</div>
</div>

<div class="page-content pt-0">		
<div class="content-wrapper">
	<!-- Content area -->
	<div class="content">
	<!-- Icons alignment -->
		<form action="signup_action.php" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
			<div class="card">
				<div class="card-header bg-light header-elements-inline">
					<h5 class="card-title">Agency Details</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Name<span class="text-danger">*</span></label>
										<input name="name" type="text" class="form-control" id="name" value="" required="required">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Email<span class="text-danger">*</span></label>
										<input name="email" type="text" class="form-control" id="email" value="" required="required">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone<span class="text-danger">*</span></label>
										<input name="phone" type="text" class="form-control" id="phone" value="" required="required">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Register For<span class="text-danger">*</span></label>
										<select id="agentType" name="agentType" class="form-control" required="required">  
								<option value="BWL">Basic White Level</option>   
								<option value="AWL">Advanced White Level</option>   
								<option value="CWL">Complete White Level</option>   
								<option value="AG">Agent</option>   
								<option value="CP">Corporate</option>   
							</select>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Agency Name<span class="text-danger">*</span></label>
										<input name="companyName" type="text" class="form-control" id="companyName" value="" required="required">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>PAN<span class="text-danger">*</span></label>
										<input name="pan" type="text" class="form-control" id="pan" value="" required="required">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Attached PAN Card Copy<span class="text-danger">*</span></label>
										<input name="panCopy" type="file" required="required">
										<br />
										<span class="text-danger">Only formats are allowed: jpeg,jpg,png,pdf and size should be less than 3MB.</span>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Attached Aadhar Card Copy<span class="text-danger">*</span></label>
										<input name="aadharCopy" type="file" required="required">
										<br />
										<span class="text-danger">Only formats are allowed: jpeg,jpg,png,pdf and size should be less than 3MB.</span>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Mobile Number<span class="text-danger">*</span></label>
										<input name="mobile" type="text" class="form-control" id="mobile" value="" required="required">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Agency Address<span class="text-danger">*</span></label>
										<input name="address" type="text" class="form-control" id="address" value="" required="required">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Address2</label>
										<input name="address2" type="text" class="form-control" id="address2" value="">
									</div>
								</div>
							<div class="col-md-3">
									<div class="form-group">
										<label>Fax</label>
										<input name="fax" type="text" class="form-control" id="fax" value="">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Pincode<span class="text-danger">*</span></label>
										<input name="pincode" type="text" class="form-control" id="pincode" value="" required="required">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
									<label>Country<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
										<select id="country" name="country" class="form-control select-clear" data-placeholder="Select Country" autocomplete="off" onchange="selectstate();" required="required">  
											<option value="">Select Country</option>  
 <?php  
$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
									  </div>
									</div>
								</div>
							<div class="col-md-3">
									<div class="form-group">
									<label>State<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
										<select id="state" name="state" class="form-control select-clear"  data-placeholder="Select State" displayname="state" autocomplete="off" onchange="selectcity();" required="required">  
											<option value="">Select State</option>  
 <?php  
 if($_REQUEST['id']!=''){
$rs=GetPageRecord('*','stateMaster',' countryId="'.$editresult['country'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>  
 <?php } }  ?>
										</select>
									  </div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>City<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
										<select id="city" name="city" class="form-control select-clear" displayname="city"  data-placeholder="Select City" autocomplete="off" required="required">
											<option value="">Select City</option>
<?php   
 if($_REQUEST['id']!=''){
$rs=GetPageRecord('*','cityMaster',' stateId="'.$editresult['state'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
                                      <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                                      <?php }}  ?>
										</select>
									</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Business Type<span class="text-danger">*</span></label>
										<div class="input-group input-group-lg"> 
											<select id="businessType" name="businessType" class="form-control select-clear" data-placeholder="Select Business Type" required="required">  
												<option value="">Select Type</option>  
												<option value="1">Proprietorship</option>  
												<option value="2">Partnership</option>  
												<option value="3">Limited Partnership</option>  
												<option value="4">Corporation</option>  
												<option value="5">Limited Liability Company </option>  
												<option value="6">Nonprofit Organization </option>  
												<option value="7">Cooperative</option>  
											</select>
										</div>
									</div>
								</div>	
							</div>
		
						</div>
					</div>
				</div>
			</div>
			
			<div class="card-header bg-light header-elements-inline">
				<h5 class="card-title">Agency GST Details</h5>
			</div>
			<div class="card-body">
				<div class="row">
					
					<div class="col-md-3">
						<div class="form-group">
							<label>Agency GSTIN<span class="text-danger">*</span></label>
							<input name="gstin" type="text" class="form-control" id="gstin" value="" required="required">
						</div>
					</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Contact Person<span class="text-danger">*</span></label>
								<input name="contactPerson" type="text" class="form-control" id="contactPerson" value="" required="required">
							</div>
						</div>
					<div class="col-md-3">
							<div class="form-group">
								<label>Phone Number<span class="text-danger">*</span></label>
								<input name="gstphoneNumber" type="text" class="form-control" id="gstphoneNumber" value="" required="required">
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label>Mobile Number </label>
								<input name="gstmobileNumber" type="text" class="form-control" id="gstmobileNumber" value="">
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label>Email Id </label>
								<input name="gstemailId" type="text" class="form-control" id="gstemailId" value="">
							</div>
						</div>
					<div class="col-md-3">
							<div class="form-group">
								<label>Correspondence Mail Id</label>
								<input name="correspondenceMailId" type="text" class="form-control" id="correspondenceMailId" value="">
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label>HSN/SAC Code<span class="text-danger">*</span></label>
								<input name="hsn" type="text" class="form-control" id="hsn" value="" required="required">
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label>GSTIN Registration Status</label>
								<select name="gstinStatus" class="form-control" id="gstinStatus">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
			
					</div>
					
			</div>
			</div>
					
			<div class="card-footer text-right">
				<a href="<?php echo $websiteurl; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		        <span class="ladda-label">Login</span>
	            </button></a>
								
				<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
				<input name="action" type="hidden" id="action" value="agentRegistration" />
			</div>
					
				</div>
				
				</form>
				</div>
				</div>
</div>




<script>
 

function getSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}




function selectcity(){
	var stateId = $('#state').val();
	$('#city').load('loadcity.php?id='+stateId+'&selectId=');
	}
	
	function selectstate(){
	var countryId = $('#country').val(); 
	$('#state').load('loadstate.php?id='+countryId+'&selectId='); 
	}
	 
</script>  


       <?php include "footer.php"; ?>  
	 
   </body>
   
</html>