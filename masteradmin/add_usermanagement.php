<?php  
include "settingheader.php"; 
?>


<div class="page-content pt-0"> 
		
<?php
include "settingleft.php";
if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','sys_userMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
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
						<h5 class="card-title"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> User</h5>
					</div>
					
<div class="card-body">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Name<span class="text-danger">*</span></label>
						<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email (Username)<span class="text-danger">*</span></label>
						<input name="email" type="text" class="form-control" id="email" value="<?php echo stripslashes($editresult['email']); ?>" <?php if($_REQUEST['id']!=''){ ?>readonly="readonly"<?php } ?>>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone</label>
						<input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($editresult['phone']); ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Profile Photo</label>
						<input name="profilePhoto" type="file" class="form-control" id="profilePhoto">
						<br />
						<?php if(isset($editresult["profilePhoto"])){ ?>
						<img src="upload/<?php echo $editresult["profilePhoto"]; ?>" height="150" width="150">
						<?php } ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Address </label>
						<input name="address" type="text" class="form-control" id="address" value="<?php echo stripslashes($editresult['address']); ?>" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Branch<span class="text-danger">*</span> </label>
						<select id="branchId" name="branchId" class="form-control select-clear"  data-placeholder="Select Branch"  autocomplete="off">   
<?php 
$rs=GetPageRecord('*','sys_branchMaster','  parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($editresult['branchId']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['companyName']; ?></option>  
 <?php } ?>
</select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Role / Permission<span class="text-danger">*</span> </label>
						<select id="roleId" name="roleId" class="form-control select-clear"  data-placeholder="Select Profile"  autocomplete="off">   
 <?php  
$rs=GetPageRecord('*','rolePermissionProfile','  parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>"  <?php if($editresult['roleId']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Credit Amount Limit</label>
						<input name="staffCreditLimit" type="number" class="form-control" id="staffCreditLimit" value="<?php echo stripslashes($editresult['staffCreditLimit']); ?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label class="d-block font-weight-semibold">Status</label>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input name="status" type="checkbox" class="custom-control-input" id="status" value="1" <?php if($editresult['status']==1){ ?>checked<?php } ?>>
							<label class="custom-control-label" for="status">Active User (Login and manage all the assigned options)</label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="d-block font-weight-semibold">Login Credentials</label>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input name="logincredentials" type="checkbox" class="custom-control-input" id="logincredentials" value="1" >
							<label class="custom-control-label" for="logincredentials">Reset and send login credentials to user email.</label>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-md-6">
<div class="card mg-b-20">
	<div class="card-body"> 
		<div class="tab-pane active">
			<h5 class="tx-10 text-uppercase mb-3">Permissions</h5>
            <div class="row" style="max-height:460px; overflow:auto;">
				<div class="col-12">
					<table class="table table-bordered mg-b-0 text-md-nowrap">
						<thead>
							<tr>
								<th align="left">Module</th>
								<th align="center" style="padding:4px 4px;">
								<div align="center"><label style=" margin-bottom: 0px;">View / Add<br />
								<input type="checkbox" id="viewAllCheck" name="viewAllCheck"/></label></div>
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function () {
    $("#viewAllCheck").click(function () {
        if ($("#viewAllCheck").is(':checked')) {
            $(".stip1").prop("checked", true);
        } else {
            $(".stip1").prop("checked", false);
        }
    });
	
	
	$("#addAllCheck").click(function () {
        if ($("#addAllCheck").is(':checked')) {
            $(".stip2").prop("checked", true);
        } else {
            $(".stip2").prop("checked", false);
        }
    });
	
	$("#editAllCheck").click(function () {
        if ($("#editAllCheck").is(':checked')) {
            $(".stip3").prop("checked", true);
        } else {
            $(".stip3").prop("checked", false);
        }
    });
});
</script>
								</th>
								<th align="center"  style="padding:4px 4px;display:none;"><div align="center"><label style=" margin-bottom: 0px;">Add<br />
								<input type="checkbox" id="addAllCheck" name="addAllCheck"/></label></div></th>
								<th align="center" style="padding:4px 4px;display:none;"><div align="center"><label style=" margin-bottom: 0px;">Edit<br />
								<input type="checkbox" id="editAllCheck" name="editAllCheck"/></label></div></th>
							</tr>
						</thead>
						<tbody>

<tr>
	<th align="left" bgcolor="#EFEFEF" scope="row">Bookings</th>
	<th align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"></th>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Flight Bookings</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"  class="stip1" value="flightbooking"  <?php echo checkifvalue($editresult['permissionView'],"flightbooking"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2"  value="flightbooking" <?php echo checkifvalue($editresult['permissionAdd'],"flightbooking"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="flightbooking" <?php echo checkifvalue($editresult['permissionEdit'],"flightbooking"); ?> /></div></td>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Hotel Enquiry</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox" class="stip1" value="offlinehotelBookings" <?php echo checkifvalue($editresult['permissionView'],"offlinehotelBookings"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="offlinehotelBookings" <?php echo checkifvalue($editresult['permissionAdd'],"offlinehotelBookings"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="offlinehotelBookings" <?php echo checkifvalue($editresult['permissionEdit'],"offlinehotelBookings"); ?> /></div></td>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Package Bookings</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox" class="stip1" value="packageBookings" <?php echo checkifvalue($editresult['permissionView'],"packageBookings"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="packageBookings" <?php echo checkifvalue($editresult['permissionAdd'],"packageBookings"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="packageBookings" <?php echo checkifvalue($editresult['permissionEdit'],"packageBookings"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Itinerary</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="itinerary"  <?php echo checkifvalue($editresult['permissionView'],"itinerary"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="itinerary"  <?php echo checkifvalue($editresult['permissionAdd'],"itinerary"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="itinerary" <?php echo checkifvalue($editresult['permissionEdit'],"itinerary"); ?> /></div></td>
</tr>


<tr style="display:none;">
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Query</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="query"  <?php echo checkifvalue($editresult['permissionView'],"query"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="query"  <?php echo checkifvalue($editresult['permissionAdd'],"query"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="query" <?php echo checkifvalue($editresult['permissionEdit'],"query"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Invoice</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="invoice"  <?php echo checkifvalue($editresult['permissionView'],"invoice"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="invoice"  <?php echo checkifvalue($editresult['permissionAdd'],"invoice"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="invoice" <?php echo checkifvalue($editresult['permissionEdit'],"invoice"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF" scope="row">Agents</th>
	<th align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"></th>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Agents Master</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="agents" <?php echo checkifvalue($editresult['permissionView'],"agents"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="agents" <?php echo checkifvalue($editresult['permissionAdd'],"agents"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="agents" <?php echo checkifvalue($editresult['permissionEdit'],"agents"); ?> /></div></td>
</tr>


<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;GST Report</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="gstreport" <?php echo checkifvalue($editresult['permissionView'],"gstreport"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="gstreport"  <?php echo checkifvalue($editresult['permissionAdd'],"gstreport"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="gstreport" <?php echo checkifvalue($editresult['permissionEdit'],"gstreport"); ?> /></div></td>
</tr>


<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Topup Request</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="topupoffline" <?php echo checkifvalue($editresult['permissionView'],"topupoffline"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="topupoffline"  <?php echo checkifvalue($editresult['permissionAdd'],"topupoffline"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="topupoffline" <?php echo checkifvalue($editresult['permissionEdit'],"topupoffline"); ?> /></div></td>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Web Query</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="webquery" <?php echo checkifvalue($editresult['permissionView'],"webquery"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="webquery"  <?php echo checkifvalue($editresult['permissionAdd'],"webquery"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="webquery" <?php echo checkifvalue($editresult['permissionEdit'],"webquery"); ?> /></div></td>
</tr>

<tr>
	<th align="left" scope="row" style="font-weight:400; font-size:12px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 10px; color: #b5b5b5;"></i> &nbsp;Flight Search Log</th>
	<td align="center" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="flightSearchLogs" <?php echo checkifvalue($editresult['permissionView'],"flightSearchLogs"); ?>/></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="flightSearchLogs"  <?php echo checkifvalue($editresult['permissionAdd'],"flightSearchLogs"); ?> /></div></td>
	<td align="center" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="flightSearchLogs" <?php echo checkifvalue($editresult['permissionEdit'],"flightSearchLogs"); ?> /></div></td>
</tr>



<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Clients</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="clients"  <?php echo checkifvalue($editresult['permissionView'],"clients"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="clients"  <?php echo checkifvalue($editresult['permissionAdd'],"clients"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="clients" <?php echo checkifvalue($editresult['permissionEdit'],"clients"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Suppliers</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="suppliers"  <?php echo checkifvalue($editresult['permissionView'],"suppliers"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="suppliers"  <?php echo checkifvalue($editresult['permissionAdd'],"suppliers"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="suppliers" <?php echo checkifvalue($editresult['permissionEdit'],"suppliers"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Flight Cancellation Request</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="ticketcancelrequest"  <?php echo checkifvalue($editresult['permissionView'],"ticketcancelrequest"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="ticketcancelrequest"  <?php echo checkifvalue($editresult['permissionAdd'],"ticketcancelrequest"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="ticketcancelrequest" <?php echo checkifvalue($editresult['permissionEdit'],"ticketcancelrequest"); ?> /></div></td>
</tr>

<tr>
	<th align="left" bgcolor="#EFEFEF"  scope="row">Settings</th>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;"><input name="permissionView[]" type="checkbox"   class="stip1" value="generalsettings"  <?php echo checkifvalue($editresult['permissionView'],"generalsettings"); ?>/></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionAdd[]" type="checkbox" class="stip2" value="generalsettings"  <?php echo checkifvalue($editresult['permissionAdd'],"generalsettings"); ?> /></div></td>
	<td align="center" bgcolor="#EFEFEF" style="padding:4px 4px;display:none;"><div align="center"><input name="permissionEdit[]" type="checkbox" class="stip3" value="generalsettings" <?php echo checkifvalue($editresult['permissionEdit'],"generalsettings"); ?> /></div></td>
</tr>


						</tbody>
					</table>
				</div> <!-- end col -->
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>
					
<div class="card-footer text-right">
	<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><button type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button mr-1" data-spinner-color="#333" data-style="radius">
	<span class="ladda-label">Cancel</span></button></a>
	<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
		<input name="action" type="hidden" id="action" value="savesystemuser" />
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