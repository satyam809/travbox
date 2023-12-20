<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 
$emailtype='New Lead';
$rs5=GetPageRecord('*','emailTemplates',' parentId="'.$LoginUserDetails['parentId'].'" and emailTemplateType="'.$emailtype.'" '); 
$editresult=mysqli_fetch_array($rs5);
 


?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
				<div class="card">
				<div class="card-header bg-light header-elements-inline">
						<h5 class="card-title"><?php echo stripslashes($moduleDataName['name']); ?> Template</h5>
					</div>
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-9">
					<div class="row">
					
					 <div class="col-md-12">
					 		<div class="form-group">
					 Here you can configure your email which will be sent to your customer at the time of creating new lead (Thank You / Acknowledgement email)
					 </div> </div>
						 <div class="col-md-12">
						<div class="form-group">
									<label>E-Mail Subject:<span class="text-danger">*</span></label>
									<input name="emailSubject" type="text" class="form-control" id="emailSubject" value="<?php echo stripslashes($editresult['emailSubject']); ?>">
						   </div>
						   
						   
						   <div class="form-group">
									<label>Reply-to E-Mail ID:<span class="text-danger">*</span></label>
									<input name="replyEmail" type="text" class="form-control" id="replyEmail" value="<?php echo stripslashes($editresult['replyEmail']); ?>">
						   </div>
						   
						   
						   <div class="form-group">
									<label>E-Mail Content:<span class="text-danger">*</span></label>
									<textarea name="emailContent" class="form-control" id="emailContent"><?php echo stripslashes($editresult['emailContent']); ?></textarea>
									<script type="text/javascript"> 
	var editor = CKEDITOR.replace('emailContent'); 
	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 
	</script>
						   </div>
						    
						</div> 
						
						
					</div>
					
					</div>
					
					
					<div class="col-md-3">
					<div class="row">
				<div style="border: 1px dashed #ddd; background-color: #f9f9f9; padding: 20px; margin-bottom:30px;">
							<h5 class="card-title" id="scrollspy">Tips</h5>
							Following are Dynamic variables with help you to customize email when sent automatically from software.<br />
<br />
You can specify the bold color text replace values dynamically.<br />

Example if you use #customer_name# in email template (left hand side box) then it will be replaced by the customer name automatically.<br />
<br />
#company_name# - Your company name</div>
					</div> 
					</div>
						</div>
				
					</div>
					
				  <div class="card-footer text-right">
								 
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="saveemailtemplate" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>" />
							    <input name="pagename" type="hidden" id="pagename" value="<?php echo $_REQUEST['ga']; ?>" />
							    <input name="emailtype" type="hidden" id="emailtype" value="<?php echo $emailtype; ?>" />
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