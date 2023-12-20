<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 
$emailtype='New Lead';
$rs5=GetPageRecord('*','packageTermsConditions',' parentId="'.$LoginUserDetails['parentId'].'" '); 
$editresult=mysqli_fetch_array($rs5);
 


?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			
				
				  <?php   
$ha=GetPageRecord('*','packageTermsConditions','  parentId="'.$LoginUserDetails['parentId'].'" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 
?>
			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
				<div class="card">
				 
					
					<div class="card-body">
			<div class="row">
			<div class="col-md-12">
					<div class="row">
					
					  
						 <div class="col-md-12"> 
						 
						   <div class="form-group">
						   	<label><strong>Title</strong></label>
							<input name="termType" type="text"  class="form-control" id="termType" value="<?php echo stripslashes($listdata['termType']); ?>" />
						   </div>
						   <div class="form-group">
									<label><strong>Description</strong></label>
									<textarea name="termDescription" class="form-control" id="content<?php echo stripslashes($listdata['id']); ?>"><?php echo stripslashes($listdata['termDescription']); ?></textarea>
									<script type="text/javascript"> 
	var editor = CKEDITOR.replace('content<?php echo stripslashes($listdata['id']); ?>'); 
	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 
	</script>
						   </div>
						    
					 
						</div> 
						
						
					</div>
					
					</div>
					
					
					<div class="col-md-3">
					<div class="row">
				 
					</div> 
					</div>
						</div>
				
					</div>
					
				  <div class="card-footer text-right">
								 
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savetermspackagemaster" />
							    <input name="editid" type="hidden" id="editid" value="<?php echo encode($listdata['id']); ?>" /> 
				  </div>
					
				</div>
					</form>
	<?php } ?>			
			
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