<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$quotationid=decode($_REQUEST['quotationid']);
$daydate=$_REQUEST['daydate'];
$dayid=$_REQUEST['dayid']; 

if($_REQUEST['did']!=''){ 
deleteRecord('quotationEvents','id="'.decode($_REQUEST['did']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}


$b=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationid.'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$c=GetPageRecord('*','packageDays',' parentId="'.$LoginUserDetails['parentId'].'" and quotationId="'.$quotationDetail['id'].'" and dayId="'.$dayid.'"  order by id asc '); 
$dayDetails=mysqli_fetch_array($c);


$c=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$quotationDetail['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>
<div style="border:1px solid #d8d8d8;">

<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;"  data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> Add Events</span>

<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
															
<a style="cursor:pointer;"  id="hoteladdnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Hotel - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotelopenb2b&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($queryData['endDate'])); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i> Hotel</a>
									
									
									
															
<a style="cursor:pointer;"  id="sightseeingaddnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Sightseeing - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeingdetails&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> Sightseeing</a>
					
					
					
															
<a style="cursor:pointer;"  class="dropdown-item"  onclick="loadpop('Add Transport - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtransportdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-car" aria-hidden="true"></i> Transport</a>
					
					
					
					
								 
 <a style="cursor:pointer;"  class="dropdown-item"   onclick="loadpop('Add Flight - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-plane" aria-hidden="true"></i> Flight</a>											 
 
 
 <a style="cursor:pointer;"  class="dropdown-item"  onclick="loadpop('Add Visa - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addvisadetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> Visa</a>									 
 
 
 <a style="cursor:pointer;"  class="dropdown-item"  onclick="loadpop('Add Miscellaneous - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmiscellaneousdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>"><i class="icon-cube3" aria-hidden="true"></i> Miscellaneous</a>
	
															
															 
							  </div>

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-calendar" aria-hidden="true"></i> Day <?php echo $dayid; ?> - <?php echo getdestinationname($dayDetails['destinationId']); ?><?php if($quotationDetail['dayWise']!=1){ ?> - <?php echo date('l, j M Y',strtotime($daydate)); ?><?php } ?></span>
</div>


<div style="padding: 15px 15px;">
<?php if($dayDetails['title']==''){ ?>
<div style=" padding: 40px 20px; text-align: center; background-color: #f1f9ff; font-weight: 500;"><div style="font-size:40px;"><i class="fa fa-file-text-o" aria-hidden="true" style=" color:#2196f3;"></i></div>Write About The Day<br />

<button type="button" class="btn btn-primary" style="cursor:pointer; margin-top:10px;" onclick="loadpop('Edit Day <?php echo $dayid; ?> Details',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editdaydetails&id=<?php echo encode($dayDetails['id']); ?>&quotationid=<?php echo $_REQUEST['quotationid']; ?>&daydate=<?php echo $_REQUEST['daydate']; ?>&dayid=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</button>

</div>
<?php } else { ?>
<div style="padding: 15px; background-color: #f3f9ff; position:relative;">

<span class="badge bg-blue" style="position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" onclick="loadpop('Edit Day <?php echo $dayid; ?> Details',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editdaydetails&id=<?php echo encode($dayDetails['id']); ?>&quotationid=<?php echo $_REQUEST['quotationid']; ?>&daydate=<?php echo $_REQUEST['daydate']; ?>&dayid=<?php echo $_REQUEST['dayid']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>


<div style="font-size:16px; font-weight:600; margin-bottom:2px;"><?php echo stripslashes($dayDetails['title']); ?></div>
<div style="font-size:13px;"><?php echo nl2br(stripslashes($dayDetails['description'])); ?></div>
</div>
<?php } ?>




<?php   $ha=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and quotationId="'.$quotationid.'" and dayId="'.$dayid.'" order by checkInTime asc');
while($eventdays=mysqli_fetch_array($ha)){

if($eventdays['eventType']=='hotel'){ ?>
<hr />
<div class="form-group">
 <div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /><span class="badge bg-blue" style="position:absolute; right:2px; top:2px; cursor:pointer;">Change</span>
          <input name="eventPhoto" onchange="$('#addeditfrm<?php echo $eventdays['id']; ?>').submit();" type="file" style="width:100%; height:100%; z-index:9; left:0px; top:0px; position:absolute;opacity: 0;" />
          <input name="eventId" type="hidden" value="<?php echo encode($eventdays['id']); ?>" />
          <input name="action" type="hidden" value="saveupdatehotelimagepackage" />
          <input name="cityId2" type="hidden" value="<?php echo $eventdays['cityId']; ?>" />
          <input name="hotelname" type="hidden" value="<?php echo $eventdays['name']; ?>" />
          <input name="dayid" type="hidden" value="<?php echo $dayid; ?>" />
          <input name="daydate" type="hidden" value="<?php echo $daydate; ?>" />
    </div></td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="hoteladdbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Hotel',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotelopenb2b&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this hotel?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
		  </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:5px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?> <span class="hotelcategorystar"><?php echo hotelcategory($eventdays['category']); ?></span></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['roomType']); ?> &nbsp; | &nbsp;    <span style="color:#999999;"><i class="fa fa-cutlery" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['mealPlan']); ?></div>
	
	<div style="font-size:12px;  margin-bottom:4px;"><span style="color:#999999;">Check-In:</span> <?php echo date('d-m-Y',strtotime($eventdays['checkInDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-Out:</span> <?php echo date('d-m-Y',strtotime($eventdays['checkOutDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?></div>
	
	
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	
	 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right" style="padding-bottom:5px; padding-left:20px; position:relative; padding-bottom:10px;  ">Stay <strong><?php echo dateDifference($eventdays['checkInDate'],$eventdays['checkOutDate']);  ?></strong> Nights - <?php if($eventdays['singleRoom']>0){  echo '<strong>Single</strong> '.$eventdays['singleRoom'].' X '.$eventdays['singleRoomCost'].' '.currencyname($eventdays['currencyId']).' - '; }  ?>
<?php if($eventdays['doubleRoom']>0){  echo '<strong>Double</strong> '.$eventdays['doubleRoom'].' X '.$eventdays['doubleRoomCost'].' '.currencyname($eventdays['currencyId']).' - '; } ?> 
<?php if($eventdays['tripleRoom']>0){  echo '<strong>Triple</strong> '.$eventdays['tripleRoom'].' X '.$eventdays['tripleRoomCost'].' '.currencyname($eventdays['currencyId']).' - '; } ?>
<?php if($eventdays['extraAdultRoom']>0){  echo '<strong>Extra Adult</strong>'.$eventdays['extraAdultRoom'].' X '.$eventdays['extraAdultRoomCost'].' '.currencyname($eventdays['currencyId']).' - '; } ?>
<?php if($eventdays['childWithBedRoom']>0){  echo '<strong>child With Bed</strong> '.$eventdays['childWithBedRoom'].' X '.$eventdays['childWithBedRoomCost'].' '.currencyname($eventdays['currencyId']).' - '; } ?></td>
    </tr>
   
     <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; $taxyes=0;  ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
  
 
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Price:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>       </td>
  </tr>
</table>
	</div>
 </td>
  </tr>
</table>
</form>

</div>
</div>
<?php } ?>


<?php if($eventdays['eventType']=='Transport'){ 



$d=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$eventdays['vehicleId'].'" order by id asc '); 
$vehicleData=mysqli_fetch_array($d);

?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['transportType']=='Private Cab'){ if($vehicleData['eventPhoto']!=''){ ?>upload/<?php echo $vehicleData['eventPhoto']; } else { ?>assets/pvtcab.png<?php } } ?><?php if($eventdays['transportType']=='SIC'){ ?>assets/siccab.png<?php } ?><?php if($eventdays['transportType']=='Bus'){ ?>assets/busicon.png<?php } ?><?php if($eventdays['transportType']=='Train'){ ?>assets/trainicon.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"> 
	
	
	 
	
	<input name="eventId" type="hidden" value="<?php echo encode($eventdays['id']); ?>">
	<input name="action" type="hidden" value="saveupdatesightseeingimage">
	<input name="cityId2" type="hidden" value="<?php echo $eventdays['cityId']; ?>">
	<input name="evenetname" type="hidden" value="<?php echo $eventdays['name']; ?>"> 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="sightseeingaddbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Transport',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtransportdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this transport?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo getDestination($eventdays['cityId']); ?> &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp; <?php echo getdestinationname($eventdays['toCityId']); ?></div>
	<div style="font-size:12px;  margin-bottom:5px;"><?php if($eventdays['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-car" aria-hidden="true"></i></span> <?php echo stripslashes($vehicleData['name']); ?> (Pax: <?php echo stripslashes($vehicleData['pax']); ?>) <?php } ?><span style="color:#999999;"><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php echo date('d-m-Y',strtotime($eventdays['checkInDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> - <?php echo date('d-m-Y',strtotime($eventdays['checkOutDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;  margin-bottom:5px;"><span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo (stripslashes($eventdays['transportType'])); ?> &nbsp; | &nbsp; <?php if($eventdays['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-user" aria-hidden="true"></i></span> Driver &nbsp; | &nbsp; <?php } ?><span style="color:#999999;"><i class="fa fa-life-ring" aria-hidden="true"></i></span> <?php if($eventdays['transportType']=='Train'){ echo $eventdays['trainClass']; } else {  ?>AC<?php } ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-suitcase" aria-hidden="true"></i></span> Luggage Bags</div>
	
	
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
  
  
    
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">
	<?php if($eventdays['transportType']!='Private Cab'){ ?>
 
<?php } else { ?>
<strong>Number Of Vehicle:</strong> <?php echo $eventdays['noOfVehicle']; ?> -  <strong>Per Vehicle Price:</strong> <?php echo $eventdays['adultCost']; ?> <?php echo currencyname($eventdays['currencyId']); ?>:
<?php } ?>	 </td>
    </tr>
     <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
 
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Price</td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>       </td>
  </tr>
</table>

	</div>
 
	</td>
  </tr>
</table>
</form>
</div>

<?php } ?>

<?php if($eventdays['eventType']=='Sightseeing'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"><span class="badge bg-blue" style="position:absolute; right:2px; top:2px; cursor:pointer;">Change</span>
	
	
	<input name="eventPhoto" onChange="$('#addeditfrm<?php echo $eventdays['id']; ?>').submit();" type="file" style="width:100%; height:100%; z-index:9; left:0px; top:0px; position:absolute;opacity: 0;">
	
	<input name="eventId" type="hidden" value="<?php echo encode($eventdays['id']); ?>">
	<input name="action" type="hidden" value="saveupdatesightseeingimagepackage">
	<input name="cityId2" type="hidden" value="<?php echo $eventdays['cityId']; ?>">
	<input name="evenetname" type="hidden" value="<?php echo $eventdays['name']; ?>">
	<input name="dayid" type="hidden" value="<?php echo $dayid; ?>" />
          <input name="daydate" type="hidden" value="<?php echo $daydate; ?>" />
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="sightseeingaddbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Sightseeing',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeingdetails&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this sightseeing?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php echo date('d-m-Y',strtotime($eventdays['checkInDate'])); ?>  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['eventDuration']); ?></div>
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
 </strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['quotationCost']); ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
     <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
  
 
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Price:</td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>
       </td>
  </tr>
</table>

	</div>
 
	</td>
  </tr>
</table>
</form>
</div>
<?php } ?>



<?php if($eventdays['eventType']=='Flight'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:110px; position:relative; height:110px; overflow:hidden; margin-left:15px; border:1px solid #ddd; text-align:center; margin-right:25px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/flightnoimage.png<?php } ?>" style=" max-height:100%; height:auto; min-height:100%;"><span class="badge bg-blue" style="position:absolute; right:2px; top:2px; cursor:pointer;">Change</span> 
	
	
	 
		<input name="eventPhoto" onChange="$('#addeditfrm<?php echo $eventdays['id']; ?>').submit();" type="file" style="width:100%; height:100%; z-index:9; left:0px; top:0px; position:absolute;opacity: 0;">
	<input name="eventId" type="hidden" value="<?php echo encode($eventdays['id']); ?>">
	<input name="action" type="hidden" value="saveupdateflightimagepackage"> 
	<input name="evenetname" type="hidden" value="<?php echo $eventdays['name']; ?>"> 
	<input name="dayid" type="hidden" value="<?php echo $dayid; ?>" />
          <input name="daydate" type="hidden" value="<?php echo $daydate; ?>" />
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="sightseeingaddbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Flight',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this flight?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo stripslashes($eventdays['name']); ?> <span style="font-size:16px; color:#999999;">- <?php echo stripslashes($eventdays['trainClass']); ?></span></div>
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="font-size: 14px;   font-weight: 500; margin-bottom: 5px;"><strong>Departure </strong><?php echo date('D, j M Y',strtotime($eventdays['checkInDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-right:10px;">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdays['fromDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdays['cityId']); ?></div>
	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($eventdays['departureFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" />
	<div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo stripslashes($eventdays['viaFlightDeparture']); ?></div>
	</td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdays['toDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdays['toCityId']); ?></div></td>
  </tr>
  
</table>
</div></td>
    <td width="50%"><?php if('Round Trip'==$eventdays['flightTripType']){ ?><div style=" margin-left:10px; font-size: 14px; font-weight: 500; margin-bottom: 5px;"><strong>Return </strong><?php echo date('D, j M Y',strtotime($eventdays['checkOutDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-left:10px;">
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdays['fromReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdays['toCityId']); ?></div>
	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($eventdays['returnFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" /><div style="font-size:12px; margin-top:2px;color:#999999;"><?php echo stripslashes($eventdays['viaFlightReturn']); ?></div></td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdays['toReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdays['cityId']); ?></div></td>
  </tr>
  
</table></div><?php } ?></td>
  </tr>
</table>
 
	
	
 <div style="font-size:12px; margin-top:10px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
 </strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['quotationCost']); ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
     <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
  
 
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Fare:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>
       </td>
  </tr>
</table>

	</div>
 

	</td>
  </tr>
</table>
</form>
</div>

<?php } ?>





<?php if($eventdays['eventType']=='Visa'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Visa Name </td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Country</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"> Date </td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Days</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Traveller</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Description</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($eventdays['name']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo $eventdays['visaCategory']; ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo getCountryName($eventdays['country']); ?><div style="font-size:12px; color:#999999;"><?php echo stripslashes($eventdays['entryType']); ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo date('d-m-Y', strtotime($eventdays['checkInDate'])); ?></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($eventdays['visaValidity']); ?></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;">Adult: <?php echo stripslashes($eventdays['adult']); ?> - Child: <?php echo stripslashes($eventdays['child']); ?> - Infant: <?php echo stripslashes($eventdays['infant']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo getnationality($eventdays['nationality']); ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($eventdays['eventDetails']); ?></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd; padding-right:0px;"><div class="btn-group" style="width: 80px; float: right;"> 
 
 
 <button type="button"   class="btn btn-light"  onclick="loadpop('Edit Visa',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addvisadetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this visa?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div></td>
  </tr>
 
  <td colspan="7" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
Base Price:</strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['quotationCost']); ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
     
 
    <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
  
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==0){ echo 'Per Person Price';} else { echo 'Total Price'; }?>:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>       </td>
  </tr>
</table>

	</div></td>
  </tr> 

</table>
</form>
</div>

<?php } ?>




<?php if($eventdays['eventType']=='Miscellaneous'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Name </td>
    <td width="20%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"> Date </td>
    <td width="40%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Description</td>
    <td width="10%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"></td>
  </tr>
 <tr>
    <td width="30%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($eventdays['name']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo getnationality($eventdays['nationality']); ?></div></td>
    <td width="20%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo date('d-m-Y', strtotime($eventdays['checkInDate'])); ?></td>
    <td width="40%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($eventdays['eventDetails']); ?></td>
    <td width="10%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd; padding-right:0px;"><div class="btn-group" style="width:90px; float: right;"> 
      <h5>
        <button type="button"   class="btn btn-light"  onclick="loadpop('Edit Miscellaneous',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmiscellaneousdetails&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
		
		
        <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this miscellaneous?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
      </h5>
    </div></td>
  </tr>
 
<tr>
  <td colspan="6" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><div style=" padding-top:10px;">
 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
Base Price:</strong> <?php $taxyes=0; echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['quotationCost']); ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
     
  
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['quotationMarkup']; ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?></td>
  </tr>
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Price:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdays['perPerson']==1){ echo $eventdays['quotationCostWithTax']; } else { echo round($eventdays['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdays['currencyId']); ?>       </td>
  </tr>
</table>

	</div></td>
  </tr></td>
  </tr>

</table>
</div>

<?php } ?>
<?php } ?>
</div>
</div>

<?php
$totalqtcost=0;
$quotationMarkup=0;
$totalqtcostwithtax=0;
 
$ha=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and quotationId="'.$quotationid.'" ');
while($eventdays=mysqli_fetch_array($ha)){

$totalqtcostwithtax=($totalqtcostwithtax+$eventdays['quotationCostWithTax']);
$quotationMarkup=($quotationMarkup+$eventdays['quotationMarkup']);
$totalqtcost=($totalqtcost+$eventdays['quotationCost']);

}

$ab=GetPageRecord('*','sys_quickPackageOptions',' queryId="'.$queryData['id'].'" and quotationId="'.$quotationDetail['id'].'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc '); 
$optiondata=mysqli_fetch_array($ab);

$totaltax=($optiondata['CGSTamount']+$optiondata['SGSTamount']+$optiondata['IGSTamount']+$optiondata['TCSamount']);



$a=GetPageRecord('*','sys_quickPackageOptions',' parentId="'.$LoginUserDetails['parentId'].'" and quotationId="'.$quotationDetail['id'].'"');
$qtcost=mysqli_fetch_array($a);

$namevalue ='quotationCost="'.$totalqtcost.'",quotationCostWithTax="'.($totalqtcostwithtax+$totaltax+$qtcost['quotationMarkup']).'"';  

$where='parentId="'.$LoginUserDetails['parentId'].'"   and quotationId="'.$quotationDetail['id'].'"';   
updatelisting('sys_quickPackageOptions',$namevalue,$where); 
?>

<script>
loaddetailpackagecost();
</script>