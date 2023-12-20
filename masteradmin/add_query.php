<?php  

$fromdate=date('d-m-Y');
$todate=date('d-m-Y', strtotime("+2 days")); 
 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($rs5);

 $fromdate=date('d-m-Y', strtotime($editresult['startDate']));
 $todate=date('d-m-Y', strtotime($editresult['endDate']));
}


$rs7=GetPageRecord('*','sys_queryStageMaster',' parentId="'.$LoginUserDetails['parentId'].'" order by id asc '); 
$queryStageres=mysqli_fetch_array($rs7);
?>

	<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4 style="font-weight:500;"><a href="<?php echo $fullurl; ?>display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">All Queries</span></a> - <?php if($_REQUEST['id']==''){ echo 'Create New'; } else { echo 'Edit'; } ?> Query</h4> 
			</div>  
		</div>
		</div>

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
<div class="page-content pt-0">
<?php include "queryleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">
<script>
function checkquerytype(){
var selectedVal = "";
var selected = $("input[type='radio'][name='queryType']:checked");
if (selected.length > 0) {
    selectedVal = selected.val();
	
	if(selectedVal==1){
	$('.companynamediv').hide();
	} else {
	$('.companynamediv').show(); 
	}
}
}

</script>
			<!-- Content area -->
			<div class="content">
			
 <div class="card">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title">Customer Details</h5>
					</div>
				<div class="card-body">
<div class=""> 
<div class="ccustom-control custom-checkbox custom-control-inline" style="margin-right:60px; font-weight:500;">Query Type:</div>
									<?php  if($_REQUEST['id']==''){ ?>	 
										<div class="ccustom-control custom-checkbox custom-control-inline">
										<input name="queryType"  type="radio" class="custom-control-input" onclick="checkquerytype();" id="B2C" value="1" <?php if($editresult['queryType']==1 || $_REQUEST['id']==''){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="B2C">B2C</label>
										</div>
											<div class="custom-control custom-checkbox custom-control-inline" style="margin-left:20px; margin-right:30px;">
										<input name="queryType" type="radio" class="custom-control-input" onclick="checkquerytype();"  id="b2b" value="2" <?php if($editresult['queryType']==2){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="b2b">Travel Agent (B2B)</label>
										</div>
											<div class="custom-control custom-checkbox custom-control-inline">
										<input name="queryType" type="radio" class="custom-control-input" onclick="checkquerytype();"  id="Corporate" value="3"  <?php if($editresult['queryType']==3){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="Corporate">Corporate</label> 
								 
									</div>
									<?php } else { ?>
									
									<div class="ccustom-control custom-checkbox custom-control-inline"> 
										<?php echo getquerytypename($editresult['queryType']); ?><input name="queryType" type="hidden" value="<?php echo $editresult['queryType']; ?>" />
										</div>
									<?php } ?>
				  </div>
									<hr />
									
									<div class="row">
									
									<div class="col-md-3">
									<div class="form-group">
									<label>Customer Contact Number<span class="text-danger">*</span></label>
									<input name="clientId" id="clientId" type="hidden" value="<?php echo encode($editresult['clientId']); ?>" autocomplete="nope" />
									
									<div class="input-group input-group-lg">
											<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i>
</span>
											</span>
											<input type="text" class="form-control" name="contactNumber" id="contactNumber" maxlength="10" value="<?php echo stripslashes($editresult['contactNumber']); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'');" onfocus="checkclienthave();" onblur="checkclienthave();">
									  </div>
						   </div>
									</div>
									<div class="col-md-3">
									<div class="form-group">
									<label>Customer E-Mail ID<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
</span>
											</span>
											<input type="text" class="form-control" name="contactEmail" id="contactEmail" maxlength="150"  value="<?php echo stripslashes($editresult['contactEmail']); ?>" onfocus="checkclienthave();" onblur="checkclienthave();">
									  </div>
						   </div>
									</div>
									
									 
									 <div class="col-md-3 companynamediv" <?php if($editresult['queryType']==1 || $_REQUEST['id']==''){  ?>style="display:none;"<?php } ?>>
									<div class="form-group">
									<label>Company Name<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-building" aria-hidden="true"></i>
</span>
											</span>
											<input name="companyName" type="text" class="form-control" id="companyName" value="<?php echo stripslashes($editresult['companyName']); ?>" maxlength="50">
									  </div>
						   </div>
									</div>
									
									
									<div class="col-md-3">
									<div class="form-group">
									<label>Contact Person Name<span class="text-danger">*</span></label>
									<div class="input-group">
											<div class="input-group-prepend">
											<select name="nameHead" id="nameHead" class="form-control">
								  <option value="Mr." <?php if($editresult['nameHead']=='Mr.'){ ?>selected="selected"<?php } ?>>Mr.</option>
								  <option value="Mrs." <?php if($editresult['nameHead']=='Mrs.'){ ?>selected="selected"<?php } ?>>Mrs.</option>
								  <option value="Ms." <?php if($editresult['nameHead']=='Ms.'){ ?>selected="selected"<?php } ?>>Ms.</option>
								  <option value="Dr." <?php if($editresult['nameHead']=='Dr.'){ ?>selected="selected"<?php } ?>>Dr.</option>
								  <option value="Prof." <?php if($editresult['nameHead']=='Prof.'){ ?>selected="selected"<?php } ?>>Prof.</option>
		  </select>
											</div>
											<input name="contactPerson" type="text" class="form-control" id="contactPerson" value="<?php echo stripslashes($editresult['contactPerson']); ?>">
									  </div>
						   </div>
									</div>
									
									</div>
									
											<div class="row">
											
											<div class="col-md-3">
									<div class="">
									<label>Customer  Country<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
											<select id="country" name="contactCountry" class="form-control select-clear"  data-placeholder="Select Country"  autocomplete="off" onchange="selectstate();">  
											<option></option>  
 <?php  
$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['contactCountry']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
									  </div>
						   </div>
									</div>
									
									
									<div class="col-md-3">
									<div class="">
									<label>Customer State</label>
									<div class="input-group input-group-lg"> 
											<select id="state" name="contactState" class="form-control select-clear"  data-placeholder="Select State" displayname="state" autocomplete="off" onchange="selectcity();">  
											<option></option>  
 <?php  
 if($_REQUEST['id']!=''){
$rs=GetPageRecord('*','stateMaster',' countryId="'.$editresult['contactCountry'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['contactState']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } }  ?>
</select>
									  </div>
						   </div>
									</div>
									
									<div class="col-md-3">
									<div class="">
									<label>Customer City</label>
									<div class="input-group input-group-lg"> 
											<select id="city" name="contactCity" class="form-control select-clear" displayname="city"  data-placeholder="Select City" autocomplete="off" >
                                      <option></option>
<?php   
 if($_REQUEST['id']!=''){
$rs=GetPageRecord('*','cityMaster',' stateId="'.$editresult['contactState'].'" order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['contactCity']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
                                      <?php }}  ?>
                                    </select>
									  </div>
						   </div>
									</div>
											
											</div>
						
			 
		</div>
		
		<div class="card-header bg-light header-elements-inline" style="border-top: 1px solid rgba(0,0,0,.125);">
						<h5 class="card-title">Travel Details</h5>
					</div>
					
					<div class="card-body">
					
					<div class="row">
					
					<div class="col-md-3">
									<div class="form-group">
									<label>From City</label>
									<div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
									<div class="input-group input-group-lg">  
									<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo getDestination($editresult['travelFromCity']); ?>" autocomplete="nope" >
														
														 <input name="travelFromCity" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['travelFromCity']); ?>" autocomplete="nope" />
  
									  </div>
						   </div>
									</div>
									
					<div class="col-md-3">
									<div class="form-group">
									<label>Travel Location<span class="text-danger">*</span></label>
									<div style="height:0px; font-size:0px; position:relative;  " id="searchcityliststoCity"></div>
									<div class="input-group input-group-lg"> 
									<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
</span>
									  </span>
			<input type="texr" class="form-control" requered  onkeyup="getSearchCIty('toCitySearchfromCity','travelLocation','searchcityliststoCity');" id="toCitySearchfromCity" name="toCitySearchfromCity123" value="<?php echo getDestination($editresult['travelLocation']); ?>" autocomplete="nope" >
			
			<input name="travelLocation" id="travelLocation" type="hidden" value="<?php echo stripslashes($editresult['travelLocation']); ?>" autocomplete="nope" />
									  </div>
						   </div>
									</div>
									
					<div class="col-md-3">
									<div class="form-group">
									<label>Start Date<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i>
</span>
									  </span>
											<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo $fromdate; ?>">
									  </div>
						   </div>
									</div>
									
									
									<div class="col-md-3">
									<div class="form-group">
									<label>End Date<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i>
</span>
									  </span>
											<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo $todate; ?>">
									  </div>
						   </div>
									</div>
									
				<script>
				$( function() {
				$( "#startDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});
				$( "#endDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });
				} );
				</script>
									
									<div class="col-md-2">
									<div class="form-group">
									<label>Adult(s)<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									<span class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-male"></i>
</span>
									  </span>
											<input name="adult" type="number" class="form-control" id="adult" min="1" value="<?php if($editresult['adult']==0 || $result['adult']=''){ echo '1'; } else {  echo stripslashes($editresult['adult']); } ?>">
									  </div>
						   </div>
									</div>
									
									<div class="col-md-1">
									<div class="form-group">
									<label>Child</label>
									<div class="input-group input-group-lg"> 
									 
											<input name="child" type="number" class="form-control" min="0" id="child" value="<?php echo stripslashes($editresult['child']); ?>">
									  </div>
						   </div>
									</div>
									<div class="col-md-1">
									<div class="form-group">
									<label>Infant</label>
									<div class="input-group input-group-lg"> 
									 
											<input type="number" class="form-control" id="infant" min="0" name="infant" value="<?php echo stripslashes($editresult['infant']); ?>">
									  </div>
						   </div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									<label>Query Source<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									 
											<select id="querySource" name="querySource" class="form-control select-clear"  data-placeholder="Select Source"  autocomplete="off" >   
 <?php  
$rs=GetPageRecord('*','sys_travelSource','  status=1 and parentId="'.$LoginUserDetails['parentId'].'"  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['querySource']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
									  </div>
						   </div>
									</div>
									
									<div class="col-md-2">
									<div class="form-group">
									<label>Query Priority<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									 
									<select id="queryPriority" name="queryPriority" class="form-control" autocomplete="off">  
									<option value="0" <?php if(0==$editresult['queryPriority']){ ?>selected="selected"<?php } ?>>General Query</option>
									<option value="1" <?php if(1==$editresult['queryPriority']){ ?>selected="selected"<?php } ?>>Hot Query</option>   						 
									</select>	
									  </div>
						   </div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									<label>Assign To<span class="text-danger">*</span></label>
									<div class="input-group input-group-lg"> 
									 
											<select id="assignTo" name="assignTo" class="form-control"  data-placeholder="Select User"  autocomplete="off" >    

 <?php  
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'"  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['assignTo']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>  
 <?php } ?>
</select>
									  </div>
						   </div>
									</div>
									
									
									
									
									 
					</div>
					<hr />
					<div class=""> 
<div class="ccustom-control custom-checkbox custom-control-inline" style="margin-right:60px; font-weight:500;">
									Requirement Type
			</div>
										 
										<div class="ccustom-control custom-checkbox custom-control-inline">
										<input name="typePackage"  type="checkbox" class="custom-control-input" id="Package" value="1" <?php if($editresult['typePackage']==1){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="Package">Package</label>
										</div>
											<div class="custom-control custom-checkbox custom-control-inline" style="margin-left:20px; margin-right:30px;">
										<input name="typeFlight" type="checkbox" class="custom-control-input" id="Flight" value="1"  <?php if($editresult['typeFlight']==1){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="Flight">Flight</label>
										</div>
											<div class="custom-control custom-checkbox custom-control-inline">
										<input name="typeTransfer" type="checkbox" class="custom-control-input" id="Transfer" value="1" <?php if($editresult['typeTransfer']==1){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="Transfer">Transfer</label> 
								 
									</div>
									
										<div class="custom-control custom-checkbox custom-control-inline" style="margin-left:20px; margin-right:30px;">
										<input name="typeHotel" type="checkbox" class="custom-control-input" id="Hotel"  value="1" <?php if($editresult['typeHotel']==1){ ?> checked<?php } ?>>
										<label class="custom-control-label" for="Hotel">Hotel</label>
										</div>
										
										<div class="custom-control custom-checkbox custom-control-inline">
										<input name="typeSightseeing" type="checkbox" class="custom-control-input" id="Sightseeing"  value="1" <?php if($editresult['typeSightseeing']==1){ ?> checked<?php } ?>  >
										<label class="custom-control-label" for="Sightseeing">Sightseeing</label> 
								 
									</div>
									
										<div class="custom-control custom-checkbox custom-control-inline" style="margin-left:20px; margin-right:30px;">
										<input name="typeMiscellaneous" type="checkbox" class="custom-control-input" id="Miscellaneous"  value="1" <?php if($editresult['typeMiscellaneous']==1){ ?> checked<?php } ?> >
										<label class="custom-control-label" for="Miscellaneous">Miscellaneous</label>
										</div>
									
				  </div>
					
					</div>
					
					
					<div class="card-footer text-right">
								<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		                        	<span class="ladda-label">Cancel</span>
	                        	 </button></a>
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savequery">
							    <input name="queryStage" type="hidden" id="queryStage" value="<?php echo encode($queryStageres['id']); ?>">
							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">
				  </div>

</div></div>

</div></div>

</form>
</div>
    <script type="text/javascript">
        $('#travelFromCity').select2({
            placeholder: 'Select an item',
            ajax: {
                url: '/ajax-city-search.php',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
            }
        });
    </script>
	
 
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

 
function checkclienthave(){ 
var contactNumber = $('#contactNumber').val();
var contactEmail = $('#contactEmail').val();
$('#loadcheckclienthavediv').load('checkclienthave.php?phone='+contactNumber+'&email='+contactEmail); 
}
</script>

<div style="display:none;" id="loadcheckclienthavediv"></div>