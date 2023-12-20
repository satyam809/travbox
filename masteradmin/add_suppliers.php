<div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Suppliers List</span></a> - Add Supplier</h4> 
			</div> 
		</div>
		
				
	</div>

<div class="page-content pt-0"> 
		
<?php   

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'" '); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Supplier</h5>
					</div>
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-8">
					<div class="row">
					<div class="col-md-12">
						<div class="form-group">
									<label>Company<span class="text-danger">*</span></label>
									<input name="companyName" type="text" class="form-control" id="companyName" value="<?php echo stripslashes($editresult['companyName']); ?>">
						   </div>
						</div>
						 <div class="col-md-12">
						<div class="form-group">
									<label>Name<span class="text-danger">*</span></label>
									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>">
						   </div>
						</div>
						 <div class="col-md-6">
						<div class="form-group">
									<label>Email<span class="text-danger">*</span></label>
									<input name="email" type="text" class="form-control" id="email" value="<?php echo stripslashes($editresult['email']); ?>" <?php if($_REQUEST['id']!=''){ ?>readonly="readonly"<?php } ?>>
						   </div>
						</div>
						
						 <div class="col-md-2">
						<div class="form-group">
									<label>Country Code</label>
									<input name="countryCode" type="text" class="form-control" id="countryCode" value="<?php echo stripslashes($editresult['countryCode']); ?>">
					      </div>
						</div>
						
						<div class="col-md-4">
						<div class="form-group">
									<label>Phone</label>
									<input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($editresult['phone']); ?>">
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
						
						 <div class="col-md-12">
						<div class="form-group">
									<label>Address </label>
									<input name="address" type="text" class="form-control" id="address" value="<?php echo stripslashes($editresult['address']); ?>" />
						   </div>
						</div>
						
								  
	 <div class="col-md-12">
						<div class="form-group">
									<label>Description </label>
									<input name="description" type="text" class="form-control" id="description" value="<?php echo stripslashes($editresult['description']); ?>" />
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
										<input name="status" type="checkbox" class="custom-control-input" id="status" value="1" <?php if($editresult['status']==1){ ?>checked<?php } ?>>
										<label class="custom-control-label" for="status">Active Supplier 
									</div>
						
						</div>
						
						<div class="form-group" style="display:none;">
									<label class="d-block font-weight-semibold">Login Credentials</label>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input name="logincredentials" type="checkbox" class="custom-control-input" id="logincredentials" value="1" >
										<label class="custom-control-label" for="logincredentials">Reset and send login credentials to supplier's email.</label>
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
							    <input name="action" type="hidden" id="action" value="savesupplier" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
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