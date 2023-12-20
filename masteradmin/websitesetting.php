<?php  
include "settingheader.php"; 

$rs5=GetPageRecord('*','websiteSetting',' id=1 '); 
$editresult=mysqli_fetch_array($rs5);
?>


<div class="page-content pt-0"> 
		
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
						<h5 class="card-title">Website Setting</h5>
					</div>
					
					<div class="card-body">
					<div class="row">
						 <div class="col-md-6">
						<div class="form-group">
									<label>Meta Title <span class="text-danger">*</span></label>
									<input name="metaTitle" type="text" class="form-control" id="metaTitle" value="<?php echo stripslashes($editresult['metaTitle']); ?>">
						   </div>
						</div>
						
						 <div class="col-md-6">
						<div class="form-group">
									<label>Meta Keyword </label>
									<input name="metaKeyword" type="text" class="form-control" id="metaKeyword" value="<?php echo stripslashes($editresult['metaKeyword']); ?>">
						   </div>
						</div>
						
						
						 <div class="col-md-12">
						<div class="form-group">
									<label>Meta Description </label>
									<textarea name="metaDescription" rows="3" class="form-control" id="metaDescription"><?php echo stripslashes($editresult['metaDescription']); ?></textarea>
						   </div>
						</div>
						
							 
					 
						
						 
						
						<div class="col-md-12">
						<div class="form-group">
									<label>Header Script (Google Analytics Code etc.)</label>
									<textarea name="headerScript" rows="3" class="form-control" id="headerScript"><?php echo stripslashes($editresult['headerScript']); ?></textarea>
									
									
					      </div>
						</div>
						
						<div class="col-md-12">
						<div class="form-group">
									<label>Footer Script (Chat Script etc.)</label>
									<textarea name="footerScript" rows="3" class="form-control" id="footerScript"><?php echo stripslashes($editresult['footerScript']); ?></textarea>
									
									
					      </div>
						</div>
					
				
					
						<div class="col-md-2">
						<div class="form-group">
				<div style="width: 100%;  padding: 17px; border-radius: 4px; text-align: center;"><img src="<?php echo $fullurl; ?>upload/<?php echo $editresult['websiteFavicon']; ?>" width="32" height="32" style="max-width:100%; height:30px;"></div>
				
				<input name="oldcompanyLogo" type="hidden" value="<?php echo $editresult['websiteFavicon']; ?>" />
									 
					      </div>
						</div>
						
						
						<div class="col-md-5">
						<div class="form-group">
									<label>Favicon<span class="text-danger"> &nbsp;Recommended Size (PX): 32 X 32 </span></label>
									<input name="companyLogo" type="file" class="form-control" id="companyLogo" style="padding: 4px;">
					      </div>
						</div>
						
						
				 	<div class="col-md-5">
						<div class="form-group">
									<label>WhatsApp Number</label>
									<input name="whatsAppNumber" type="text" class="form-control" id="whatsAppNumber" value="<?php echo stripslashes($editresult['whatsAppNumber']); ?>">
				      </div>
						</div>
						 
					</div>
					
					
					
					
				
					</div>
					
				  <div class="card-footer text-right">
								<button type="submit" class="btn btn-primary">Save Changes &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savewebsitesetting" />
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