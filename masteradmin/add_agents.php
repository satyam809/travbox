<div class="page-header">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Agents List</span></a> - Add Agent</h4> 
			</div> 
		</div>
		
				
	</div>

<div class="page-content pt-0"> 
		
<?php
if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_userMaster',' id="'.decode($_REQUEST['id']).'"'); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo stripslashes($editresult['companyName']); } else { echo 'Add'; } ?> - Agent</h5>
				  </div>
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-8">
					<div class="row">
					
					<div style="padding:5px 10px; background-color:#F5F5F5; margin-bottom:10px; width:100%;"><strong>Account Information</strong></div>
  
					<div class="col-md-6" style="display:none;">
						<div class="form-group">
							<label>Type</label>
							<select id="agentType" name="agentType" class="form-control" >  
								<option value="BWL" <?php if('BWL'==$editresult['agentType']){ ?>selected="selected"<?php } ?>>Basic White Level</option>   
								<option value="AWL" <?php if('AWL'==$editresult['agentType']){ ?>selected="selected"<?php } ?>>Advanced White Level</option>   
								<option value="CWL" <?php if('CWL'==$editresult['agentType']){ ?>selected="selected"<?php } ?>>Complete White Level</option>   
								<option value="AG" <?php if('AG'==$editresult['agentType']){ ?>selected="selected"<?php } ?>>Agent</option>   
								<option value="CP" <?php if('CP'==$editresult['agentType']){ ?>selected="selected"<?php } ?>>Corporate</option>   
							</select>
					  </div>
					</div>
 
						
					<div class="col-md-6" style="display:none;">
						<div class="form-group">
									<label>Agent Margin Category<span class="text-danger">*</span></label>
						<select id="agentCategory" name="agentCategory" class="form-control" >   
						<?php  
						$rs=GetPageRecord('*','sys_agentMarginCategory',' parentId="'.$LoginUserDetails['parentId'].'"   order by id asc');
						while($rest=mysqli_fetch_array($rs)){ 
						?> 
						<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['agentCategory']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
						<?php } ?>
						</select>
				      </div>
					  </div>
					  
					  <div class="col-md-4">
							<div class="form-group">
								<label>Agent Group <span class="text-danger">*</span></label>
								<div class="input-group input-group-lg"> 
									<select id="commissionType" name="commissionType" class="form-control"   autocomplete="off" >  
 <?php  
$rs=GetPageRecord('*','sys_commissionType','  1 and  parentId="'.$_SESSION['userid'].'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['commissionType']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
							  </div>
						   </div>
					  </div>
					  
					  <div class="col-md-4">
						<div class="form-group">
									<label>Name<span class="text-danger">*</span></label>
									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>">
						   </div>
						</div>
						
						<div class="col-md-4">
						<div class="form-group">
									<label>Last Name<span class="text-danger">*</span></label>
									<input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo stripslashes($editresult['lastName']); ?>">
						   </div>
						</div>
						
						
								 <div class="col-md-6">
						<div class="form-group">
									<label>Email (Username)<span class="text-danger">*</span></label>
									<input name="email" type="text" class="form-control" id="email" value="<?php echo stripslashes($editresult['email']); ?>" >
						   </div>
						</div>
						
						 <div class="col-md-2" style="display:none;">
						<div class="form-group">
									<label>Country Code</label>
									<input name="countryCode" type="text" class="form-control" id="countryCode" value="<?php echo stripslashes($editresult['countryCode']); ?>">
					      </div>
						</div>
						
						<div class="col-md-6">
						<div class="form-group">
									<label>Phone</label>
									<input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($editresult['phone']); ?>">
					      </div>
						</div>
						
					  
					  
					  	<div class="col-md-4">
							<div class="form-group">
								<label>Country<span class="text-danger">*</span></label>
								<div class="input-group input-group-lg"> 
									<select id="userCountry" name="userCountry" class="form-control select-clear"  data-placeholder="Select Country"  autocomplete="off" onchange="selectstate();">  
										<option></option>  
 <?php  
$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['userCountry']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
							  </div>
						   </div>
		  </div>


						<div class="col-md-4">
						<div class="form-group">
						<label>State</label>
						<div class="input-group input-group-lg"> 
								<select id="userState" name="userState" class="form-control select-clear"  data-placeholder="Select State" displayname="state" autocomplete="off" onchange="selectcity();">  
								<option></option>  
	<?php  
	if($_REQUEST['id']!=''){
	$rs=GetPageRecord('*','stateMaster',' countryId="'.$editresult['country'].'" order by name asc');
	while($rest=mysqli_fetch_array($rs)){ 
	?> 
	<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['userState']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
	<?php } }  ?>
	</select>
						  </div>
			   </div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
						<label>City</label>
						<div class="input-group input-group-lg"> 
								<select id="userCity" name="userCity" class="form-control select-clear" displayname="city"  data-placeholder="Select City" autocomplete="off" >
						  <option></option>
	<?php   
	if($_REQUEST['id']!=''){
	$rs=GetPageRecord('*','cityMaster',' stateId="'.$editresult['state'].'" order by name asc');
	while($rest=mysqli_fetch_array($rs)){ 
	?>
						  <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['userCity']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
						  <?php }}  ?>
						</select>
						  </div>
			   </div>
						</div>
									
									<div class="col-md-4" style="display:none;">
					<div class="form-group">
						<label>Payment Gateway<span class="text-danger">*</span> </label>
						<select id="paymentGatway" name="paymentGatway" class="form-control select-clear"  data-placeholder="Select Payment Gateway"  autocomplete="off">   
							<option value="agent" <?php if($editresult['paymentGatway']=='agent'){ ?>selected="selected"<?php } ?>>Agent</option>
							<option value="admin" <?php if($editresult['paymentGatway']=='admin'){ ?>selected="selected"<?php } ?>>Admin</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-4" style="display:none;">
					<div class="form-group">
						<label>Merchant Key </label>
						<input name="MERCHANT_KEY" type="text" class="form-control" id="MERCHANT_KEY" value="<?php echo stripslashes($editresult['MERCHANT_KEY']); ?>" />
					</div>
				</div>
				
				<div class="col-md-4" style="display:none;">
					<div class="form-group">
						<label>Salt </label>
						<input name="SALT" type="text" class="form-control" id="SALT" value="<?php echo stripslashes($editresult['SALT']); ?>" />
					</div>
				</div>
						
						 <div class="col-md-6">
							<div class="form-group">
								<label>Residential Address </label>
								<input name="address" type="text" class="form-control" id="address" value="<?php echo stripslashes($editresult['address']); ?>" />
							</div>
						</div>
						<div class="col-md-12" style="display:none;">
							<div class="form-group">
								<label>Address2</label>
								<input name="address2" type="text" class="form-control" id="address2" value="<?php echo stripslashes($editresult['address2']); ?>">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Pincode<span class="text-danger">*</span></label>
								<input name="pincode" type="text" class="form-control" id="pincode" value="<?php echo stripslashes($editresult['pincode']); ?>" >
							</div>
						</div>
					  
					  
					  <div style="padding:5px 10px; background-color:#F5F5F5; margin-bottom:10px; width:100%;"><strong>Agency Information</strong></div>
					  
					
					<div class="col-md-4">
						<div class="form-group">
									<label>Company<span class="text-danger">*</span></label>
									<input name="companyName" type="text" class="form-control" id="companyName" value="<?php echo stripslashes($editresult['companyName']); ?>">
				      </div>
					  </div>
						 
						<div class="col-md-4" style="display:none;">
							<div class="form-group">
								<label>Assign Sales Manager<span class="text-danger">*</span></label>
								<div class="input-group input-group-lg"> 
									<select id="salesManager" name="salesManager" class="form-control select-clear" data-placeholder="Select Sales Manager" >  
										<option value="">Select Manager</option>
<?php
$user=GetPageRecord('*','sys_userMaster',' userType="staff" and status=1 and parentAgentId=0 and agentId=0 order by name asc');
while($userData=mysqli_fetch_array($user)){
?>
<option value="<?php echo $userData['id']; ?>" <?php if($userData['id']==$editresult['salesManager']){ ?>selected="selected"<?php } ?>><?php echo $userData['name']; ?></option> 
<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
									<label>Company Mobile<span class="text-danger">*</span></label>
									<input name="companyMobile" type="text" class="form-control" id="companyMobile" value="<?php echo stripslashes($editresult['companyMobile']); ?>">
				      </div>
					  </div>
						
						
				
						<div class="col-md-4">
							<div class="form-group">
								<label>Business Type<span class="text-danger">*</span></label>
								<div class="input-group input-group-lg"> 
									<select id="businessType" name="businessType" class="form-control select-clear" data-placeholder="Select Business Type" >  
										<option value="">Select Type</option>  
										<option value="1" <?php if(1==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Proprietorship</option>  
										<option value="2" <?php if(2==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Partnership</option>  
										<option value="3" <?php if(3==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Limited Partnership</option>  
										<option value="4" <?php if(4==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Corporation</option>  
										<option value="5" <?php if(5==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Limited Liability Company </option>  
										<option value="6" <?php if(6==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Nonprofit Organization </option>  
										<option value="7" <?php if(7==$editresult['businessType']){ ?>selected="selected"<?php } ?>>Cooperative</option>  
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
						<div class="form-group">
							<label>Pan Number<span class="text-danger">*</span></label>
							<input name="pan" type="text" class="form-control" id="pan" value="<?php echo stripslashes($editresult['pan']); ?>" >
						</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Agency GSTIN<span class="text-danger">*</span></label>
								<input name="gstin" type="text" class="form-control" id="gstin" value="<?php echo stripslashes($editresult['gstin']); ?>" >
							</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label>Pin Code<span class="text-danger">*</span></label>
							<input name="companyPincode" type="text" class="form-control" id="companyPincode" value="<?php echo stripslashes($editresult['companyPincode']); ?>" >
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label>Company Address<span class="text-danger">*</span></label>
							<input name="companyAddress" type="text" class="form-control" id="companyAddress" value="<?php echo stripslashes($editresult['companyAddress']); ?>" >
						</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label>Country<span class="text-danger">*</span></label>
								<div class="input-group input-group-lg"> 
									<select id="country" name="country" class="form-control select-clear"  data-placeholder="Select Country"  autocomplete="off" onchange="selectstate();">  
										<option></option>  
 <?php  
$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['country']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
							  </div>
						   </div>
		  </div>

						<div class="col-md-4">
						<div class="form-group">
						<label>State</label>
						<div class="input-group input-group-lg"> 
								<select id="state" name="state" class="form-control select-clear"  data-placeholder="Select State" displayname="state" autocomplete="off" onchange="selectcity();">  
								<option></option>  
	<?php  
	if($_REQUEST['id']!=''){
	$rs=GetPageRecord('*','stateMaster',' countryId="'.$editresult['country'].'" order by name asc');
	while($rest=mysqli_fetch_array($rs)){ 
	?> 
	<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['state']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
	<?php } }  ?>
	</select>
						  </div>
			   </div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
						<label>City</label>
						<div class="input-group input-group-lg"> 
								<select id="city" name="city" class="form-control select-clear" displayname="city"  data-placeholder="Select City" autocomplete="off" >
						  <option></option>
	<?php   
	if($_REQUEST['id']!=''){
	$rs=GetPageRecord('*','cityMaster',' stateId="'.$editresult['state'].'" order by name asc');
	while($rest=mysqli_fetch_array($rs)){ 
	?>
						  <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['city']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
						  <?php }}  ?>
						</select>
						  </div>
			   </div>
						</div>
						
						
		
		
		<div class="col-md-6">
			<div class="form-group">
				<label>Website<span class="text-danger">*</span></label>
				<input name="website" type="text" class="form-control" id="website" value="<?php echo stripslashes($editresult['website']); ?>" >
			</div>
		</div>
		
		
				<div class="col-md-3">
						<div class="form-group">
									<label>Company Logo</label>
									<input name="companyLogo" type="file" class="form-control" id="companyLogo" style="padding: 4px;">
									
						</div>
						</div>
						
					<?php if($editresult['companyLogo']!=''){ ?>
						<div class="col-md-3">
						<div class="form-group">
				<div style="width: 100%; background-color: #fff; border:1px solid #293a50; padding: 17px; border-radius: 4px; text-align: center;"><img src="<?php echo $fullurl; ?>upload/<?php echo $editresult['companyLogo']; ?>" alt="<?php echo stripslashes($editresult['companyName']); ?>" style="max-width:100%; height:30px;"></div>
				
				<input name="oldcompanyLogo" type="hidden" value="<?php echo $editresult['companyLogo']; ?>" />
									 
					      </div>
						</div>
						<?php } ?>
						
								<div style="padding:5px 10px; background-color:#F5F5F5; margin-bottom:10px; width:100%;"><strong>Documents</strong></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Attached PAN Card Copy</label>
								<input name="panCopy" type="file">
								<br />
								<?php
								if(isset($editresult['panCopy'])){
								?>
								<a target="_blank" href='upload/<?php echo $editresult['panCopy']; ?>'>Click here to view</a><br />
								<?php } ?>
								<span class="text-danger">Only formats are allowed: jpeg,jpg,png,pdf and size should be less than 3MB.</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Attached Aadhar Card Copy</label>
								<input name="aadharCopy" type="file">
								<br />
								<?php
								if(isset($editresult['aadharCopy'])){
								?>
								<a target="_blank" href='upload/<?php echo $editresult['aadharCopy']; ?>'>Click here to view</a><br/>
								<?php } ?>
								<span class="text-danger">Only formats are allowed: jpeg,jpg,png,pdf and size should be less than 3MB.</span>
							</div>
						</div>
						
								
					
								
						<div class="col-md-6" style="display:none;">
							<div class="form-group">
								<label>Fax</label>
								<input name="fax" type="text" class="form-control" id="fax" value="<?php echo stripslashes($editresult['fax']); ?>">
							</div>
						</div>
						
				
								  
						<div class="col-md-12">
							<div class="form-group">
								<label>Remark </label>
								<textarea name="description" rows="5" class="form-control" id="description"><?php echo stripslashes($editresult['description']); ?></textarea>
							</div>
						</div>
<div class="card-header bg-light header-elements-inline" style="display:none;">
	<h5 class="card-title">Agency GST Details</h5>
</div>
<div class="card-body" style="display:none;">
	<div class="row">
		
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>Contact Person<span class="text-danger">*</span></label>
				<input name="contactPerson" type="text" class="form-control" id="contactPerson" value="<?php echo stripslashes($editresult['contactPerson']); ?>" >
			</div>
		</div>
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>Phone Number<span class="text-danger">*</span></label>
				<input name="gstphoneNumber" type="text" class="form-control" id="gstphoneNumber" value="<?php echo stripslashes($editresult['gstphoneNumber']); ?>" >
			</div>
		</div>
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>Mobile Number </label>
				<input name="gstmobileNumber" type="text" class="form-control" id="gstmobileNumber" value="<?php echo stripslashes($editresult['gstmobileNumber']); ?>">
			</div>
		</div>
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>Email Id</label>
				<input name="gstemailId" type="text" class="form-control" id="gstemailId" value="<?php echo stripslashes($editresult['gstemailId']); ?>">
			</div>
		</div>
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>Correspondence Mail Id</label>
				<input name="correspondenceMailId" type="text" class="form-control" id="correspondenceMailId" value="<?php echo stripslashes($editresult['correspondenceMailId']); ?>">
			</div>
		</div>
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>HSN/SAC Code<span class="text-danger">*</span></label>
				<input name="hsn" type="text" class="form-control" id="hsn" value="<?php echo stripslashes($editresult['hsn']); ?>" >
			</div>
		</div>	
		<div class="col-md-3" style="display:none;">
			<div class="form-group">
				<label>GSTIN Registration Status</label>
					<select name="gstinStatus" class="form-control" id="gstinStatus">
						<option value="1" <?php if(1==$editresult['gstinStatus']){ ?>selected="selected"<?php } ?>>Active</option>
						<option value="0" <?php if(0==$editresult['gstinStatus']){ ?>selected="selected"<?php } ?>>Inactive</option>
					</select>
			</div>
		</div>
		
		
		
											
<div class="col-md-3" style="display:none;">
										<div class="form-group">
											<label>Debit Card PG Charges</label> 
											<div class="input-group input-group-lg">
											<span class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></span></span>
											<input name="debitCard" type="text" class="form-control" id="debitCard" value="<?php echo stripslashes($editresult['debitCard']); ?>">
											</div>
										</div>
					  </div>
									
									<div class="col-md-3" style="display:none;">
										<div class="form-group">
											<label>Credit Card PG Charges</label> 
											<div class="input-group input-group-lg">
											<span class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></span></span>
											<input name="creditCard" type="text" class="form-control" id="creditCard" value="<?php echo stripslashes($editresult['creditCard']); ?>">
											</div>
										</div>
									</div>
									
									<div class="col-md-3" style="display:none;">
										<div class="form-group">
											<label>UPI PG Charges</label> 
											<div class="input-group input-group-lg">
											<span class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></span></span>
											<input name="upi" type="text" class="form-control" id="upi" value="<?php echo stripslashes($editresult['upi']); ?>">
											</div>
										</div>
									</div>
									
									<div class="col-md-3" style="display:none;">
										<div class="form-group">
											<label>Net Banking PG Charges</label> 
											<div class="input-group input-group-lg">
											<span class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></span></span>
											<input name="netBanking" type="text" class="form-control" id="netBanking" value="<?php echo stripslashes($editresult['netBanking']); ?>">
											</div>
										</div>
									</div>
									
	</div>
</div>
						
					</div>
					
			  </div>
					
					
					<div class="col-md-4">
					<div class="row">
					<div class="col-md-12">
						
						
				<div class="form-group">
									<label class="d-block font-weight-semibold">Status</label>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="agentstatus" type="checkbox" class="custom-control-input" id="agentstatus" value="1" <?php if($editresult['status']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="agentstatus">Active Agent (Login and manage all agent options)</label>
										.
									</div>
						
					  </div>
						
						<div class="form-group">
									<label class="d-block font-weight-semibold">Login Credentials</label>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="logincredentials" type="checkbox" class="custom-control-input" id="logincredentials" value="1"  >
										<label class="custom-control-label" for="logincredentials">Reset and send login credentials to agent's email.</label>
									</div>
						
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Assign Mail</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="salesmanagermail" type="checkbox" class="custom-control-input" id="salesmanagermail" value="1" >
								<label class="custom-control-label" for="salesmanagermail">Send assign sales manager mail to agent's email.</label>
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Default Markup</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="defaultMarkup" type="checkbox" class="custom-control-input" id="defaultMarkup" value="1" checked="checked" >
								<label class="custom-control-label" for="defaultMarkup">Default Markup.</label>
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Default Commision</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="defaultCommision" type="checkbox" class="custom-control-input" id="defaultCommision" value="1" checked="checked" >
								<label class="custom-control-label" for="defaultCommision">Default Commision.</label>
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Holidays</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="permissionView[]" id="holidays" type="checkbox" class="custom-control-input" value="holidays" <?php echo checkifvalue($editresult['permissionView'],"holidays"); ?>/>
								<label class="custom-control-label" for="holidays">Holidays</label>
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Bus</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="permissionView[]" id="bus" type="checkbox" class="custom-control-input" value="bus" <?php echo checkifvalue($editresult['permissionView'],"bus"); ?>/>
								<label class="custom-control-label" for="bus">Bus</label>
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="d-block font-weight-semibold">Weekend Gateway</label>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input name="permissionView[]" id="weekendgetaway" type="checkbox" class="custom-control-input" value="weekendgetaway" <?php echo checkifvalue($editresult['permissionView'],"weekendgetaway"); ?>/>
								<label class="custom-control-label" for="weekendgetaway">Weekend Gateway</label>
							</div>
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
							    <input name="action" type="hidden" id="action" value="saveagents" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
				  </div>
					
				</div>
				
				<div class="card" style="display:none;">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Flights Markup</h5>
				  </div>
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-12">
					<div class="row">
					 <table class="table">
							<thead>
								<tr>
								  <th width="2%"><div align="center">Sr.</div></th>
									<th width="40%">Name</th>
									<th width="35%"><div align="center">Fare Type</div></th>
									<th><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

if($_REQUEST['keyword']!=''){
$search.=' and name like "%'.$_REQUEST['keyword'].'%" ';
} 

$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','domesticFlightsMarkupMaster',' where parentId="'.$LoginUserDetails['parentId'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
								  <td width="2%"><div align="center"><?php echo $sNo; ?>.</div></td>
									<td width="40%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td width="35%" style="text-align:center;"> 
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Fare Type Markup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentfaretypedomesticFlightsMarkup&id=<?php echo encode($rest['id']); ?>&agentId=<?php echo $_REQUEST['id']; ?>">
<?php 
$roomslist='';
$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' flightId="'.$rest['id'].'" and agentId="'.decode($_REQUEST['id']).'" order by id desc');
if(mysqli_num_rows($a)>0){ while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }  echo $roomslist; } ?> 
									</div> </td>
									
									<td><div align="center">
									<button type="button" class="btn btn-primary btn-icon btn-sm"   onclick="loadpop('Add Fare Type Markup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentfaretypedomesticFlightsMarkup&id=<?php echo encode($rest['id']); ?>&agentId=<?php echo $_REQUEST['id']; ?>"> <i class="fa fa-plus" aria-hidden="true"></i> Add Fare Type</button>
									
									<a  style="cursor:pointer;" onclick="loadpop('Edit Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=adddomesticflightsmarkup&id=<?php echo encode($rest['id']); ?>"> 
								    </a></div></td>
								</tr> 
								<?php $sNo++; } ?>
							</tbody>
					  </table>	
					</div>
					
			  </div>
					
					
					 
					
				
					</div>
					</div>
					 
					
				</div>
				
				
				<div class="card" style="display:none;">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Flights Commission
</h5>
				  </div>
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-12">
					<div class="row">
					 <table width="100%" class="table">
							<thead>
								<tr>
								  <th width="2%"><div align="center">Sr.</div></th>
									<th width="25%">Name</th>
								  <th width="25%"><div align="center">Fare Type</div></th>
									<th width="25%">Cash Back </th>
									<th width="23%"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
								<?php 
								$limit=clean($_GET['records']);
								$page=clean($_GET['page']); 
								$sNo=1; 
								
								if($_REQUEST['keyword']!=''){
								$search.=' and name like "%'.$_REQUEST['keyword'].'%" ';
								} 
								
								$search.='';
								
								
								$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
								$rs=GetRecordList('*','domesticFlightsCommissionMaster',' where parentId="'.$LoginUserDetails['parentId'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
								$totalentry=$rs[1]; 
								$paging=$rs[2];  
								while($rest=mysqli_fetch_array($rs[0])){  
								?>
								<tr>
								  <td width="2%"><div align="center"><?php echo $sNo; ?>.</div></td>
								  <td width="25%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td width="25%" style="text-align:center;"> 
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Fare Type Commission',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentfaretypedomesticFlightscommission&id=<?php echo encode($rest['id']); ?>&agentId=<?php echo $_REQUEST['id']; ?>">
<?php
$roomslist='';
$a=GetPageRecord('*','agent_fareTypedomesticFlightsCommissionMaster',' flightId="'.$rest['id'].'" and agentId="'.decode($_REQUEST['id']).'" order by id desc');
if(mysqli_num_rows($a)>0){ while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }  echo $roomslist; } ?> 
								  </div> </td>
									
									<td width="25%"><div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Fare Type Commission',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentfaretypedomesticFlightscommission&id=<?php echo encode($rest['id']); ?>&agentId=<?php echo $_REQUEST['id']; ?>">
<?php
$roomslist2='';
$ab=GetPageRecord('*','agent_fareTypedomesticFlightsCommissionMaster',' flightId="'.$rest['id'].'" and agentId="'.decode($_REQUEST['id']).'" order by id desc');
if(mysqli_num_rows($ab)>0){ while($roomlistcb=mysqli_fetch_array($ab)){ $roomslist2.='<div class="roomratelist">'.($roomlistcb['name']).' '.($roomlistcb['cashBackValue']).' '.($roomlistcb['cashBackType']).'</div>'; }  echo $roomslist2; } ?> 
								  </div></td>
									<td width="23%"><div align="center">
									<button type="button" class="btn btn-primary btn-icon btn-sm"   onclick="loadpop('Add Fare Type Commission',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentfaretypedomesticFlightscommission&id=<?php echo encode($rest['id']); ?>&agentId=<?php echo $_REQUEST['id']; ?>"> <i class="fa fa-plus" aria-hidden="true"></i> Add Fare Type </button>
									
									
								  </div></td>
								</tr> 
								<?php $sNo++; } ?>
							</tbody>
			</table>	
					</div>
					
			  </div>
					
					
					 
					
				
					</div>
					</div>
					 
					
				</div>
				
				
				<?php //if($_REQUEST['id']!='' && ($editresult['agentType']=='BWL' || $editresult['agentType']=='AWL' || $editresult['agentType']=='CWL' && )){ ?>
				<?php if($_REQUEST['id']==1){ ?>
				 
				<?php } ?>
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