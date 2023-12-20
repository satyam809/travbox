<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$quotationid=decode($_REQUEST['quotationid']);
$daydate=$_REQUEST['daydate'];
$dayid=$_REQUEST['dayid']; 

if($_REQUEST['did']!=''){ 
deleteRecord('quotationEvents','id="'.decode($_REQUEST['did']).'"'); 
}


$b=GetPageRecord('*','quotationMaster','  id="'.$quotationid.'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$c=GetPageRecord('*','packageDays','  quotationId="'.$quotationDetail['id'].'" and dayId="'.$dayid.'"  order by id asc '); 
$dayDetails=mysqli_fetch_array($c);


$c=GetPageRecord('*','queryMaster','   id="'.$quotationDetail['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>
<div style="border:1px solid #d8d8d8;">

<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
 

<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
															
<a style="cursor:pointer;"  id="hoteladdnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Hotel - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotelopenb2b&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($queryData['endDate'])); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i> Hotel</a>
									
									
									
															
<a style="cursor:pointer;"  id="activityaddnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Activity - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addactivitydetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-blind" aria-hidden="true"></i> Activity</a>
		
<a style="cursor:pointer;"  id="sightseeingaddnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Sightseeing - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeingdetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> Sightseeing</a>			
					
		
<a style="cursor:pointer;"  id="cruiseaddnewbtn<?php echo $_REQUEST['id']; ?>"  class="dropdown-item"  onclick="loadpop('Add Cruise / Ferry - Day <?php echo $dayid; ?>',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcruisedetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-ship" aria-hidden="true"></i> Cruise / Ferry</a>											
															 
							  </div>

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-calendar" aria-hidden="true"></i> Day <?php echo $dayid; ?></span>
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




<?php   $ha=GetPageRecord('*','quotationEvents','   quotationId="'.$quotationid.'" and dayId="'.$dayid.'" order by checkInTime asc');
while($eventdays=mysqli_fetch_array($ha)){

if($eventdays['eventType']=='hotel'){ ?>
<hr />
<div class="form-group">
 <div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" />
           
 
    </div></td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="hoteladdbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Hotel',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotelopenb2b&optionid=&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this hotel?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
		  </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:5px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?> <span class="hotelcategorystar"></span></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?>&nbsp; |&nbsp; <?php echo hotelcategory($eventdays['category']); ?></div>
	
	<div style="font-size:12px;  margin-bottom:4px;"><span style="color:#999999;">Check-In:</span> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-Out:</span>  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?></div>
	
	
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	
	 
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
   
     <tr>
       <td align="right" style="padding-bottom:5px; padding-left:20px;">Stay: </td>
       <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo dateDifference($eventdays['checkInDate'],$eventdays['checkOutDate']);  ?> Nights</td>
     </tr>
     <tr>
       <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php 
	
	$f=GetPageRecord('*','sys_HotelRoomTypeCost','   id="'.$eventdays['roomType'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	echo gethotelroomtype($roomcost['roomTypeId']); ?> Price: </td>
       <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo ($eventdays['singleRoomCost']*dateDifference($eventdays['checkInDate'],$eventdays['checkOutDate'])).' '.currencyname($eventdays['currencyId']); ?></td>
     </tr>
     <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px;"><?php 
	
	$f=GetPageRecord('*','sys_HotelMealPlanCost','   id="'.$eventdays['mealPlan'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	echo gethotelmealplan($roomcost['mealPlanId']); ?> Meal Price:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo ($eventdays['mealPlanCost']*dateDifference($eventdays['checkInDate'],$eventdays['checkOutDate'])).' '.currencyname($eventdays['currencyId']); ?></td>
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

 

<?php if($eventdays['eventType']=='Sightseeing'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;">
	
	
	
	
 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="sightseeingaddbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Sightseeing',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeingdetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this sightseeing?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['eventDuration']); ?></div>
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong><?php
		
	$f=GetPageRecord('*','sys_vehicleCost','   id="'.$eventdays['vehicleId'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	 echo vehiclename($roomcost['vehicleId']); ?> (<?php echo vehiclenamepax($roomcost['vehicleId']); ?> Pax)</strong></td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['noOfVehicle']); ?></td>
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

<?php if($eventdays['eventType']=='Activity'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"> 
	
	
	
	
 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="activityaddnewbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Activity',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addactivitydetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this activity?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['eventDuration']); ?></div>
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>Pax:</strong></td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['adult']); ?></td>
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

<?php if($eventdays['eventType']=='Cruise'){ ?>
<hr />
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $eventdays['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $eventdays['id']; ?>"> 


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($eventdays['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdays['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"> 
	
	
	
 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="cruiseaddnewbtn<?php echo encode($eventdays['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Cruise / Ferry',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcruisedetailsb2b&quotationid=<?php echo $_REQUEST['quotationid']; ?>&startdate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&enddate=<?php echo date('Y-m-d',strtotime($daydate)); ?>&qt=other&package=1&dayId=<?php echo $_REQUEST['dayid']; ?>&id=<?php echo encode($eventdays['id']); ?>&destination=<?php echo $dayDetails['destinationId']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this cruise?')) selectthisdaydelete<?php echo encode($id); ?>('<?php echo $dayid; ?>','<?php echo $dayid; ?>','<?php echo $daydate; ?>','<?php echo encode($eventdays['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($eventdays['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($eventdays['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($eventdays['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($eventdays['eventDuration']); ?></div>
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($eventdays['eventDetails'])); ?> <span>
 
  </span></div>
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px;"><?php 
	
	 $f=GetPageRecord('*','sys_CruseCost','  id="'.$eventdays['seatId'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	echo cruiseSeatName($roomcost['seatId']); ?> Seat Category Price:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdays['cruiseCost'].' '.currencyname($eventdays['currencyId']); ?></td>
  </tr>
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>Pax:</strong></td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdays['adult']); ?></td>
  </tr>
     
  
 
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;">Total Price:</td>
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


 
 
<?php } ?>
</div>
</div>

<?php
$totalqtcost=0;
$quotationMarkup=0;
$totalqtcostwithtax=0;
 
$ha=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationid.'" ');
while($eventdays=mysqli_fetch_array($ha)){

$totalqtcostwithtax=($totalqtcostwithtax+$eventdays['quotationCostWithTax']);
$quotationMarkup=($quotationMarkup+$eventdays['quotationMarkup']);
$totalqtcost=($totalqtcost+$eventdays['quotationCost']);

}

$ab=GetPageRecord('*','sys_quickPackageOptions',' queryId="'.$queryData['id'].'" and quotationId="'.$quotationDetail['id'].'" order by id desc '); 
$optiondata=mysqli_fetch_array($ab);

$totaltax=($optiondata['CGSTamount']+$optiondata['SGSTamount']+$optiondata['IGSTamount']+$optiondata['TCSamount']);



$a=GetPageRecord('*','sys_quickPackageOptions','   quotationId="'.$quotationDetail['id'].'"');
$qtcost=mysqli_fetch_array($a);

$namevalue ='quotationCost="'.$totalqtcost.'",quotationCostWithTax="'.($totalqtcostwithtax+$totaltax+$qtcost['quotationMarkup']).'"';  

$where='  quotationId="'.$quotationDetail['id'].'"';   
updatelisting('sys_quickPackageOptions',$namevalue,$where); 
?>

<script>
loaddetailpackagecost();
</script>