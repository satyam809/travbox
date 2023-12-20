<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_branchMaster',' userId="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'" '); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Branch</h5>
					</div>
					
					<div class="card-body">
					<div class="row">
						 <div class="col-md-3">
						<div class="form-group">
									<label>Branch Name<span class="text-danger">*</span></label>
									<input name="companyName" type="text" class="form-control" id="companyName" value="<?php echo stripslashes($editresult['companyName']); ?>">
						   </div>
						</div>
						
						 <div class="col-md-3">
						<div class="form-group">
									<label>Contact Person<span class="text-danger">*</span></label>
									<input name="contactPerson" type="text" class="form-control" id="contactPerson" value="<?php echo stripslashes($editresult['contactPerson']); ?>">
						   </div>
						</div>
						
						
						 <div class="col-md-3">
						<div class="form-group">
									<label>Email<span class="text-danger">*</span></label>
									<input name="email" type="text" class="form-control" id="email" value="<?php echo stripslashes($editresult['email']); ?>">
						   </div>
						</div>
						
							 <div class="col-md-3">
						<div class="form-group">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($editresult['phone']); ?>">
						   </div>
						</div>
					
					
					<div class="col-md-4">
						<div class="form-group">
									<label>Country<span class="text-danger">*</span></label>
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
						
					<div class="col-md-4">
						<div class="form-group">
									<label>State<span class="text-danger">*</span></label>
									<select id="state" name="state" class="form-control select-clear"  data-placeholder="Select State" displayname="state" autocomplete="off" onchange="selectcity();">  
											<option></option>  
 <?php  
$rs=GetPageRecord('*','stateMaster',' countryId="'.$editresult['country'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['state']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php }   ?>
</select>
						   </div>
						</div>
						
						
						<div class="col-md-4">
						<div class="form-group">
									<label>City<span class="text-danger">*</span></label>
						            <select id="city" name="city" class="form-control select-clear" displayname="city"  data-placeholder="Select City" autocomplete="off" >
                                      <option></option>
                                      <?php   
$rs=GetPageRecord('*','cityMaster',' stateId="'.$editresult['state'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['city']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
                                      <?php }  ?>
                                    </select>
						</div>
						</div>
						
						<div class="col-md-4">
						<div class="form-group">
									<label>Address<span class="text-danger">*</span></label>
									<input name="address" type="text" class="form-control" id="address"  value="<?php echo stripslashes($editresult['address']); ?>">
									
									
						   </div>
						</div>
						
						 
						
						
						 
						
						
						<div class="col-md-4">
						<div class="form-group">
									<label>Time Zone<span class="text-danger">*</span></label>
									<select name="userTimeZone" class="form-control select-clear" >
									
<?php
$utc = new DateTimeZone('UTC');
$dt = new DateTime('now', $utc);
 
foreach(DateTimeZone::listIdentifiers() as $tz) {
    $current_tz = new DateTimeZone($tz);
    $offset =  $current_tz->getOffset($dt);
    $transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
    $abbr = $transition[0]['abbr']; ?>

  <option value="<?php echo $tz; ?>" <?php if($editresult['userTimeZone']==$tz){ ?>selected="selected"<?php } ?>><?php echo $tz. ' [' .$abbr. ' '. formatOffset($offset).']'; ?></option>
<?php } ?>
 </select> 

									
									
						   </div>
						</div>
						
							<div class="col-md-4">
						<div class="form-group"> 
									</div>
									</div>
						
						
						<?php if($editresult['companyLogo']!=''){ ?>
						<div class="col-md-4">
						<div class="form-group">
				<div style="width: 100%; background-color: #fff; border:1px solid #293a50; padding: 17px; border-radius: 4px; text-align: center;"><img src="<?php echo $superadminurl; ?>upload/<?php echo $editresult['companyLogo']; ?>" alt="<?php echo stripslashes($editresult['companyName']); ?>" style="max-width:100%; height:30px;"></div>
				
				<input name="oldcompanyLogo" type="hidden" value="<?php echo $editresult['companyLogo']; ?>" />
									 
						   </div>
						</div>
						<?php } ?>
						
						<div class="col-md-4">
						<div class="form-group">
									<label>Company Logo<span class="text-danger"> &nbsp;Recommended Size (PX): 150 X 40<span class="text-danger">*</span></label>
									<input name="companyLogo" type="file" class="form-control" id="companyLogo" style="padding: 4px;">
									
						</div>
						</div>
						
					</div>
					
					
					
					
				
					</div>
					
					<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Invoice Details</h5>
					</div>
						<div class="card-body">
						<div class="row">
				 <div class="col-md-4">
						<div class="form-group">
									<label>Billing Currency<span class="text-danger">*</span></label>
						            <select id="currency" name="currency" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 
                                      <?php   
$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
                                      <?php }  ?>
                                    </select>
						</div>
						</div>
								 <div class="col-md-4">
						<div class="form-group">
									<label>Invoice, Voucher Voucher Email<span class="text-danger">*</span></label>
									<input name="invoiceBookingEmail" type="text" class="form-control" id="invoiceBookingEmail" value="<?php echo stripslashes($editresult['invoiceBookingEmail']); ?>">
						   </div>
						</div>
						
						 <div class="col-md-4">
						<div class="form-group">
									<label>Invoice, Voucher Phone<span class="text-danger">*</span></label>
									<input name="invoiceBookingPhone" type="text" class="form-control" id="invoiceBookingPhone" value="<?php echo stripslashes($editresult['invoiceBookingPhone']); ?>">
						   </div>
						</div>
						
						
						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Name 1</label>
									<input name="taxName1" type="text" class="form-control" placeholder="CGST" id="taxName1" value="<?php echo stripslashes($editresult['taxName1']); ?>">
						   </div>
						</div>
						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Value 1</label>
									<input name="taxValue1" type="text" class="form-control" id="taxValue1" value="<?php echo stripslashes($editresult['taxValue1']); ?>">
						   </div>
						</div>

						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Name 2</label>
									<input name="taxName2" type="text" class="form-control" placeholder="SGST"  id="taxName2" value="<?php echo stripslashes($editresult['taxName2']); ?>">
						   </div>
						</div>
						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Value 2</label>
									<input name="taxValue2" type="text" class="form-control"id="taxValue2" value="<?php echo stripslashes($editresult['taxValue2']); ?>">
						   </div>
						</div>

						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Name 3</label>
									<input name="taxName3" type="text" class="form-control" placeholder="IGST" id="taxName3" value="<?php echo stripslashes($editresult['taxName3']); ?>">
						   </div>
						</div>
						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Value 3</label>
									<input name="taxValue3" type="text" class="form-control" id="taxValue3" value="<?php echo stripslashes($editresult['taxValue3']); ?>">
						   </div>
						</div>
						
						
							 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Name 4</label>
									<input name="taxName4" type="text" class="form-control" placeholder="TCS"  id="taxName4" value="<?php echo stripslashes($editresult['taxName4']); ?>">
						   </div>
						</div>
						 <div class="col-md-2">
						<div class="form-group">
									<label>Tax Value 4</label>
									<input name="taxValue4" type="text" class="form-control" id="taxValue4" value="<?php echo stripslashes($editresult['taxValue4']); ?>">
						   </div>
						</div>

<div class="col-md-4">
						<div class="form-group">
									<label>Tax ID</label>
									<input name="taxId" type="text" class="form-control" placeholder="GSTN: YOUR TAX ID"  id="taxId" value="<?php echo stripslashes($editresult['taxId']); ?>">
						   </div>
						</div>
						
						
						<div class="col-md-12">
						<div class="form-group">
									<label>Terms & Conditions</label>
									<textarea name="termsCondition" rows="10" class="form-control" id="termsCondition" ><?php echo stripslashes($editresult['termsCondition']); ?></textarea>
					      </div>
						</div>
				 </div>
					</div>
					
					
					
				  <div class="card-footer text-right">
								<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		                        	<span class="ladda-label">Cancel</span>
	                        	 </button></a>
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savebranch" />
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