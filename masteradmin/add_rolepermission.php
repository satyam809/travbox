<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php  
include "settingleft.php"; 

if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','rolePermissionProfile',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Role / Permission Profile</h5>
					</div>
					
					<div class="card-body">
			
			<div class="col-md-6">
					<div class="row">
						 <div class="col-md-12">
						<div class="form-group">
									<label>Name<span class="text-danger">*</span></label>
									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>">
						   </div>
						</div>
						
						 <div class="col-md-12">
						<div class="form-group">
									<label>Description </label>
									<textarea name="description" rows="3" class="form-control" id="description"><?php echo stripslashes($editresult['description']); ?></textarea>
						   </div>
						</div>
						
						
						  
						
							  
					<?php if($_REQUEST['id']==''){ ?>
					
					<div class="col-md-12">
						<div class="form-group">
									<label>Clone </label>
									<select id="profileClone" name="profileClone" class="form-control select-clear"  data-placeholder="Select Profile"  autocomplete="off">   
 <?php  
$rs=GetPageRecord('*','rolePermissionProfile','  parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
				      </div>
						</div>
						
					<?php } ?> 
						
						
						 
						
						 
						
						 
						
						
						  
						
						
						 
						
						
						
					</div>
					
					</div>
					
					
					
					
				
					</div>
					
				  <div class="card-footer text-right">
								<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
		                        	<span class="ladda-label">Cancel</span>
	                        	 </button></a>
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="saverolepermission" />
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