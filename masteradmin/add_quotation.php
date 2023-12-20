<?php  
$b=GetPageRecord('*','quotationMaster','   addBy="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

if($quotationDetail['queryId']>0){
$a=GetPageRecord('*','queryMaster','  addBy="'.$_SESSION['userid'].'" and  id="'.$quotationDetail['queryId'].'" order by id asc '); 
$rest=mysqli_fetch_array($a);
}
?>

	<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
			
			<?php if($quotationDetail['queryId']>0){ ?>
				<h4 style="font-weight:500;"><a href="<?php echo $fullurl; ?>display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">All Quotation</span></a> - <?php if($_REQUEST['id']==''){ echo 'Create New'; } else { echo 'Edit'; } ?> Quotation</h4> 
				<?php } else { ?>
				
				<h4 style="font-weight:500;"><a href="<?php echo $fullurl; ?>display.html?ga=itinerary"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">All Itinerary</span></a> - <?php if($_REQUEST['id']==''){ echo 'Create New'; } else { echo 'Edit'; } ?> Itinerary</h4> 
				
				<?php } ?>
				
				
			</div>  
	  </div>
</div>

 <div class="page-content pt-0">
 <?php if($quotationDetail['queryId']>0){ ?>
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start" style="max-width: 300px;"> 
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile"> 
					<div class="card-body p-0">
					<div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;">Query Info.</span> 
							
							<ul class="list-inline mb-0">
									<li class="list-inline-item"><a style="cursor:pointer;" href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Query</a></li> 
					  </ul>
			</div>
			
			<div class="card-body">
			<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">From City</td>
    <td align="left" style=" padding-bottom:10px; font-weight:500;"><?php echo getDestination($rest['travelFromCity']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Location</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo getDestination($rest['travelLocation']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Start Date</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo date('d-m-Y', strtotime($rest['startDate'])); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">End Date</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Travellers</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo stripslashes($rest['adult']); ?> <span style="color:#7d7d7d; font-size:11px;">Adult</span> <?php echo stripslashes($rest['child']); ?> <span style="color:#7d7d7d; font-size:11px;">Clild</span> <?php echo stripslashes($rest['infant']); ?> <span style="color:#7d7d7d; font-size:11px;">Infant</span></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Query Source</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getquerysourcename($rest['querySource']); ?></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;">Query ID</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500; color:#2196f3;"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>">#<?php echo encode($rest['id']); ?></a></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;"> Priority</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><span class="badge bg-blue" <?php if($rest['queryPriority']==1){ ?>style=" background-color:#dc0808;"<?php } ?>><?php if($rest['queryPriority']==1){ echo 'Hot Query'; } else { echo 'General Query'; } ?></span></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Assign To</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getUserName($rest['assignTo']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Requirement</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><div class="blueicons">
<?php if($rest['typePackage'] ==1){ ?><i class="fa fa-suitcase" aria-hidden="true" title="Package"></i><?php } ?>
<?php if($rest['typeFlight'] ==1){ ?><i class="fa fa-plane" aria-hidden="true" title="Flight"></i><?php } ?>
<?php if($rest['typeTransfer'] ==1){ ?><i class="fa fa-car" aria-hidden="true" title="Transfer"></i><?php } ?>
<?php if($rest['typeHotel'] ==1){ ?><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i><?php } ?> 
<?php if($rest['typeSightseeing'] ==1){ ?><i class="fa fa-picture-o" aria-hidden="true" title="Sightseeing"></i><?php } ?> 
<?php if($rest['typeMiscellaneous'] ==1){ ?><i class="fa fa-cubes" aria-hidden="true" title="Miscellaneous"></i><?php } ?>
 </div></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Created By </td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getUserName($rest['addBy']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Created Date </td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo date('d/m/Y',strtotime($rest['addDate'])); ?></td>
  </tr>
</table>
			
			</div>
			
					</div>
			  </div>
	  </div>
	</div>
	<?php } ?>
					
					

		<!-- Main content -->
		<div class="content-wrapper">
 
			<!-- Content area -->
			<div class="content">
	<?php if($quotationDetail['quotationType']=='Quick Package'){ include "add_quick_package.php"; } ?>
			
 	<?php if($quotationDetail['quotationType']=='Flight'){ include "add_flight_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Sightseeing'){ include "add_sightseeing_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Transport'){ include "add_transport_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Visa'){ include "add_visa_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Miscellaneous'){ include "add_miscellaneous_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Hotel'){ include "add_hotel_quotation.php"; } ?>
	
 	<?php if($quotationDetail['quotationType']=='Detailed Package'){ include "add_detailed_package.php"; } ?>

	
	

</div>

</div>


</div>

</div>
      
	  
	  
	  <script>

	
	
	
	
	
	
	
function getSearchHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;
var pickupCityfromCity = $('#pickupCityfromCity').val();
var hotelCategory = $('#hotelCategory').val();

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchhotellist.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield+'&pickupCityfromCity='+pickupCityfromCity+'&hotelCategory='+hotelCategory);
}
}	
	
	
	
function getSearchHotelOpen(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;
var pickupCityfromCity = $('#pickupCityfromCity').val();
var hotelCategory = $('#hotelCategory').val();

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchhotellistopen.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield+'&pickupCityfromCity='+pickupCityfromCity+'&hotelCategory='+hotelCategory);
}
}

function getSearchSightseeing(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;
var pickupCityfromCity = $('#pickupCityfromCity').val(); 

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchsightseeinglist.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield+'&pickupCityfromCity='+pickupCityfromCity);
}
}



function getSearchActivity(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;
var pickupCityfromCity = $('#pickupCityfromCity').val(); 

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchactivitylist.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield+'&pickupCityfromCity='+pickupCityfromCity);
}
}


function getSearchCruise(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;
var pickupCityfromCity = $('#pickupCityfromCity').val(); 

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcruiselist.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield+'&pickupCityfromCity='+pickupCityfromCity);
}
}



function getSearchFlight(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield; 

if(citysearchfieldval==''){
$('#'+listsearch).hide();
}

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchflightlist.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}

	</script>