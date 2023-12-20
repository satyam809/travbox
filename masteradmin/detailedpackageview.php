<?php
$a=GetPageRecord('*','quotationMaster','  id="'.$quotationInfo['id'].'"'); 
$quotationInfo=mysqli_fetch_array($a);

$b=GetPageRecord('*','sys_branchMaster','userId="'.$quotationInfo['addBy'].'"'); 
$quotationmaker=mysqli_fetch_array($b);

$a=GetPageRecord('*','queryMaster','   id="'.$quotationInfo['queryId'].'" order by id asc '); 
$rest=mysqli_fetch_array($a);
?>
<style>
.thumbimg{width:330px; position:relative; height:300px; overflow:hidden; border:0px solid #ddd; margin-right:0px; min-width:140px;}
.thumbimg img{ border-top-right-radius:20px; border-bottom-right-radius:20px;}
	 body{overflow:auto !important;}
.hotelcategorystar{color:#FF9900; font-size:16px;}
.hideinmobile{ display:inline-table; !important; }
.showonmobile{ display:none !important; }
.sectionboxx{margin-bottom:20px;
    margin-top: 10px;
    border: 1px solid #ddd;
    width: 100%; 
    box-shadow: 0px 0px 10px #00000038;}

@media only screen and (max-width: 600px) {
 
    .page-content{padding:0px;display: block !important;}
 	.col-md-12{padding:0px;}
	.padding0{padding:0px !important;}
	.margin0{margin:0px !important;}
	.responsivetable{display:inline-block !important; width:100% !important;}
	.responsivetable div{ margin-left:0px !important; }
	.padding10{ padding:10px !important;}
	.thumbimg{height:auto !important; width:100% !important;  }
	.marginauto{ margin:auto !important; }
	.showonmobile{ display:block !important;}
	.hideinmobile{ display:none !important; } 
	
	.thumbimg img{ border-top-right-radius:0px !important;  border-bottom-right-radius:0px !important; }
 
}
	 </style>

<div style=" width:100%;">

<div style="text-align:center; padding-top:10px;"><img src="<?php echo $fullurl; ?>upload/<?php echo $quotationmaker['companyLogo']; ?>" alt="<?php echo stripslashes($quotationmaker['companyName']); ?>" style="  height:70px;"></div>
<div style="font-size:25px; font-weight:500; text-align:center; padding:20px 0px;"><?php echo stripslashes($quotationInfo['name']); ?>
<div style="width:100%; margin-top:2px; color:#666666; font-size:14px;">ID: #<?php echo encode($quotationInfo['id']); ?></div>
</div>


<?php if($quotationInfo['bannerImg']!=''){ ?><div style="margin-bottom:20px;"><img src="<?php echo $fullurl; ?>upload/<?php echo $quotationInfo['bannerImg']; ?>" style=" width:100%;border-radius: 20px;"></div><?php } ?>

<?php   
$quotationId=$quotationInfo['id'];

$no=1;
$rs=GetPageRecord('*','sys_quickPackageOptions','   quotationId="'.$quotationInfo['id'].'"   order by id asc');
while($optiondata=mysqli_fetch_array($rs)){ 
?> 
<div style="margin-bottom:20px; border:1px solid #ddd; width: 100%;"> 
 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%" align="center" valign="middle" style="padding:20px; "  class="responsivetable">
	
		<div style="font-size:22px; font-weight:500; margin-bottom:0px;line-height: 25px;">
		
		 
		 <?php echo number_format($optiondata['perAdult']).' '.currencyname($optiondata['currencyId']); ?> / Per Person</div>
	 
	  
	<div style="font-size:12px;"><?php echo $quotationInfo['nights']; ?> Nights / <?php echo ($quotationInfo['nights']+1); ?> Days <?php if($quotationInfo['dayWise']!=1){ ?>- <strong>Date:</strong> <?php echo date('d-m-Y',strtotime($quotationInfo['startDate'])); ?> To <?php echo date('d-m-Y',strtotime($quotationInfo['endDate'])); ?> <?php } ?></div>	</td>
  </tr>
</table> 
</div>
<?php if(trim($quotationInfo['packageItinerary'])!=''){ ?>
<div class="sectionboxx">
<div style="padding:20px;">
<div style="margin-bottom:10px; font-size:16px; font-weight:600;">Package Overview</div>
<?php echo nl2br(stripslashes($quotationInfo['packageItinerary'])); ?> 
</div> 
</div>
<?php } ?>
<?php $no++; } ?>

 



<?php $n=1; for ($x = 0; $x <= $quotationInfo['nights']; $x++) {


$c=GetPageRecord('*','packageDays',' quotationId="'.$quotationInfo['id'].'" and dayId="'.$n.'"  order by id asc '); 
$dayDetails=mysqli_fetch_array($c);
 ?>
<div style="margin-bottom:10px;">
<div style="text-align:center; font-size:18px; padding:10px; border-bottom:1px solid #ddd; margin-top:20px; margin-bottom:10px;  border-top:1px solid #ddd; background-color:#F0F0F0; font-weight:600; ">Day <?php echo $n; ?></div> 
</div>

<div style="padding:20px; background-color: #f3f9ff; position:relative; margin-bottom:10px;"> 
<div style="font-size:16px; font-weight:600; margin-bottom:2px;"><?php echo stripslashes($dayDetails['title']); ?></div>
<div style="font-size:13px;"><?php echo nl2br(stripslashes($dayDetails['description'])); ?></div>
</div>


<?php

$a=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'" and dayId="'.$n.'" order by checkInTime asc');
while($listhotel=mysqli_fetch_array($a)){

if($listhotel['eventType']=='hotel'){ ?>
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#ec407a; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-bed" aria-hidden="true"></i> &nbsp;Hotel</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="padding:0px; padding-right:0px;" class="responsivetable"><div class="thumbimg"><img src="<?php echo $fullurl; if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:25px;">	<div style="font-size:15px; font-weight:500; margin-bottom:5px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?> <span class="hotelcategorystar"><?php echo hotelcategory($listhotel['category']); ?></span></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($listhotel['cityId']); ?>   &nbsp; | &nbsp;  <span style="color:#999999;"><i class="fa fa-share-alt-square" aria-hidden="true"></i></span>
	
	<?php 
	
	$f=GetPageRecord('*','sys_HotelRoomTypeCost',' id="'.$listhotel['roomType'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	echo gethotelroomtype($roomcost['roomTypeId']); ?>   &nbsp; | &nbsp;  <span style="color:#999999;"><i class="fa fa-cutlery" aria-hidden="true"></i></span> 
	
	<?php 
	
	$f=GetPageRecord('*','sys_HotelMealPlanCost','  id="'.$listhotel['mealPlan'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	echo gethotelmealplan($roomcost['mealPlanId']); ?> </div>
	
	<div style="font-size:12px;  margin-bottom:4px;"><span style="color:#999999;">Check-In:</span> <?php if($quotationInfo['dayWise']!=1){ ?><?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?><?php } ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-Out:</span><?php if($quotationInfo['dayWise']!=1){ ?> <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?><?php } ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkOutTime'])); ?> &nbsp;| &nbsp;Stay: <?php $nights=dateDifference($listhotel['checkInDate'],$listhotel['checkOutDate']);  if($nights==0){ echo '1'; } else { echo $nights; } ?> Night(s)</div>
	
	<div style="font-size:12px;"><?php echo stripslashes($listhotel['eventDetails']); ?></div></td>
  </tr>
</table>
</div>

<?php } ?>

<?php if($listhotel['eventType']=='Sightseeing'){ ?> 
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#66bb6a; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;Sightseeing</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div  class="thumbimg" ><img src="<?php echo $fullurl;if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:25px;">		<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($listhotel['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-In:</span> <?php if($quotationInfo['dayWise']!=1){ ?><?php  echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?><?php } ?> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['eventDuration']); ?></div>
	<div style="font-size:12px; margin-top:2px; margin-bottom:2px;">
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;">Vehicle: </span>
	<strong><?php
		
	$f=GetPageRecord('*','sys_vehicleCost',' id="'.$listhotel['vehicleId'].'"'); 
$roomcost=mysqli_fetch_array($f);
	
	 echo vehiclename($roomcost['vehicleId']); ?> (<?php echo vehiclenamepax($roomcost['vehicleId']); ?> Pax)</strong></div>
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div></td>
  </tr>
</table>
</div>

<?php } ?>
<?php if($listhotel['eventType']=='Activity'){ ?> 
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#ec490a; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-blind" aria-hidden="true"></i> &nbsp;Activity</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div  class="thumbimg" ><img src="<?php echo $fullurl;if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:25px;">		<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($listhotel['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-In:</span> <?php if($quotationInfo['dayWise']!=1){ ?><?php  echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?><?php } ?> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['eventDuration']); ?></div>
	<div style="font-size:12px; margin-top:2px; margin-bottom:2px;">
	 
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div></td>
  </tr>
</table>
</div>

<?php } ?>
<?php if($listhotel['eventType']=='Cruise'){ ?> 
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#0a79ec; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-ship" aria-hidden="true"></i> &nbsp;Cruise</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div  class="thumbimg" ><img src="<?php echo $fullurl;if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:25px;">		<div style="font-size:15px; font-weight:500; margin-bottom:10px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getdestinationname($listhotel['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-In:</span> <?php if($quotationInfo['dayWise']!=1){ ?><?php  echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?><?php } ?> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['eventDuration']); ?></div>
	<div style="font-size:12px; margin-top:2px; margin-bottom:2px;">
	 
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div></td>
  </tr>
</table>
</div>

<?php } ?>


<?php if($listhotel['eventType']=='Transport'){ 

$d=GetPageRecord('*','sys_vehicleMaster','  id="'.$listhotel['vehicleId'].'" order by id asc '); 
$vehicleData=mysqli_fetch_array($d);
?> 
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#607d8b; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-car" aria-hidden="true"></i> &nbsp;Transport</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div class="marginauto"  style=" width:160px; position:relative; height:130px; overflow:hidden; border:1px solid #ddd; margin-right:0px;"><img src="<?php echo $fullurl; if($listhotel['transportType']=='Private Cab'){ if($vehicleData['eventPhoto']!=''){ ?>upload/<?php echo $vehicleData['eventPhoto']; } else { ?>assets/pvtcab.png<?php } } ?><?php if($listhotel['transportType']=='SIC'){ ?>assets/siccab.png<?php } ?><?php if($listhotel['transportType']=='Bus'){ ?>assets/busicon.png<?php } ?><?php if($listhotel['transportType']=='Train'){ ?>assets/trainicon.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" style="padding:10px; padding-left:20px;" class="responsivetable">		<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo getDestination($listhotel['cityId']); ?> &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp; <?php echo getdestinationname($listhotel['toCityId']); ?></div>
	<div style="font-size:12px;  margin-bottom:5px;"><?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-car" aria-hidden="true"></i></span> <?php echo stripslashes($vehicleData['name']); ?> (Pax: <?php echo stripslashes($vehicleData['pax']); ?>) <?php } ?><span style="color:#999999;"><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?> - <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?></div>
	
	<div style="font-size:12px;  margin-bottom:5px;"><span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo (stripslashes($listhotel['transportType'])); ?> &nbsp; | &nbsp; <?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-user" aria-hidden="true"></i></span> Driver &nbsp; | &nbsp; <?php } ?><span style="color:#999999;"><i class="fa fa-life-ring" aria-hidden="true"></i></span> <?php if($listhotel['transportType']=='Train'){ echo $listhotel['trainClass']; } else {  ?>AC<?php } ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-suitcase" aria-hidden="true"></i></span> Luggage Bags</div>
	
	
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div></td>
  </tr>
</table>
</div>

<?php } ?>




<?php if($listhotel['eventType']=='Flight'){ ?> 
<div class="sectionboxx" style="position:relative;"> 
<div style=" position:absolute; right:0px; top:0px; padding:2px 8px; background-color:#29b6f6; font-size:11px; color:#fff; text-transform:uppercase; border-bottom-left-radius:4px; z-index:99; "> <i class="fa fa-plane" aria-hidden="true"></i> &nbsp;Flight</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" class="responsivetable"><div  class="marginauto" style="  width:160px;  position:relative;  overflow:hidden; margin-right:0px;"><img src="<?php echo $fullurl; if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/flightnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:10px; padding-left:20px;">		
	
 
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo stripslashes($listhotel['name']); ?> <span style="font-size:16px; color:#999999;">- <?php echo stripslashes($listhotel['trainClass']); ?></span></div>
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div style="font-size: 14px;   font-weight: 500; margin-bottom: 5px;"><strong>Departure </strong><?php echo date('D, j M Y',strtotime($listhotel['checkInDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-right:0px;">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($listhotel['fromDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($listhotel['cityId']); ?></div>
	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($listhotel['departureFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" />
	<div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo stripslashes($listhotel['viaFlightDeparture']); ?></div>
	</td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($listhotel['toDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($listhotel['toCityId']); ?></div></td>
  </tr>
  
</table>
</div></td>
    <td width="50%" class="responsivetable"><?php if('Round Trip'==$listhotel['flightTripType']){ ?><div style=" margin-left:10px; font-size: 14px; font-weight: 500; margin-bottom: 5px;"><strong>Return </strong><?php echo date('D, j M Y',strtotime($listhotel['checkOutDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-left:10px;">
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($listhotel['fromReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($listhotel['toCityId']); ?></div>
	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($listhotel['returnFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" /><div style="font-size:12px; margin-top:2px;color:#999999;"><?php echo stripslashes($listhotel['viaFlightReturn']); ?></div></td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($listhotel['toReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($listhotel['cityId']); ?></div></td>
  </tr>
  
</table></div><?php } ?></td>
  </tr>
</table>
 
	
	
 <div style="font-size:12px; margin-top:10px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div>
	</td>
  </tr>
</table>
</div>

<?php } ?>



<?php if($listhotel['eventType']=='Visa'){ ?>
<div class="sectionboxx"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="hideinmobile">
  <tr>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Visa Name </td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Country</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"> Travel Date </td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Days</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Traveller</td>
    <td style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Description</td>
    </tr>
<?php   
$ha=GetPageRecord('*','quotationEvents',' quotationId="'.$quotationInfo['id'].'" and dayId="'.$n.'" and eventType="Visa" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 
?>  <tr>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listdata['name']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo $listdata['visaCategory']; ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo getCountryName($listdata['country']); ?><div style="font-size:12px; color:#999999;"><?php echo stripslashes($listdata['entryType']); ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo date('d-m-Y', strtotime($listdata['checkInDate'])); ?></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listdata['visaValidity']); ?></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;">Adult: <?php echo stripslashes($listdata['adult']); ?> - Child: <?php echo stripslashes($listdata['child']); ?> - Infant: <?php echo stripslashes($listdata['infant']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo getnationality($listdata['nationality']); ?></div></td>
    <td style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listdata['eventDetails']); ?></td>
    </tr><?php } ?> 
</table>


<?php   
$ha=GetPageRecord('*','quotationEvents',' quotationId="'.$quotationInfo['id'].'" and dayId="'.$n.'" and eventType="Visa" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 
?>
<div style="margin-bottom:5px; border:1px solid #ddd; width:100%;" class="showonmobile">

<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="font-size:12px;">
  <tr>
    <td bgcolor="#FBFBFB"><strong>Visa Name </strong></td>
    <td width="70%"><?php echo stripslashes($listdata['name']); ?>  - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo $listdata['visaCategory']; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FBFBFB"><strong>Country</strong></td>
    <td width="70%"><?php echo getCountryName($listdata['country']); ?>  - <span style="font-size:12px; color:#999999;"><?php echo stripslashes($listdata['entryType']); ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FBFBFB"><strong>Travel Date</strong></td>
    <td width="70%"><?php echo date('d-m-Y', strtotime($listdata['checkInDate'])); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FBFBFB"><strong>Traveller</strong></td>
    <td width="70%">Adult: <?php echo stripslashes($listdata['adult']); ?> - Child: <?php echo stripslashes($listdata['child']); ?> - Infant: <?php echo stripslashes($listdata['infant']); ?><span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo getnationality($listdata['nationality']); ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FBFBFB"><strong>Description</strong></td>
    <td width="70%"><?php echo stripslashes($listdata['eventDetails']); ?></td>
  </tr>
</table>

</div>
<?php } ?>
</div>


<?php } ?>



<?php if($listhotel['eventType']=='Miscellaneous'){ ?>
<div class="sectionboxx"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="160" bgcolor="#F7F7F7" style="padding:10px; font-weight:500;   font-size:12px; border-bottom:1px solid #ddd;">Name </td>
    <td width="80%" style="padding:10px;  font-weight:500;   font-size:12px; border-bottom:1px solid #ddd;"> <?php echo stripslashes($listhotel['name']); ?> </td>
    </tr>
  <tr>
    <td width="160" bgcolor="#F7F7F7" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><strong>Date </strong></td>
    <td width="80%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo date('d-m-Y', strtotime($listhotel['checkInDate'])); ?></td>
    </tr>
  <tr>
    <td width="160" bgcolor="#F7F7F7" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><strong>Description</strong></td>
    <td width="80%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listhotel['eventDetails']); ?></td>
    </tr> 
</table>
</div>
<?php } ?>

<?php } ?>

<?php $n++;} ?>




 

<?php $ha=GetPageRecord('*','quotationTerms','    quotationId="'.$quotationInfo['id'].'" order by id asc');
while($listdataterm=mysqli_fetch_array($ha)){ ?>

<div style="margin-bottom:20px;">
 <div style="text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #ddd; margin-top:20px; margin-bottom:20px;  border-top:1px solid #ddd; background-color:#F0F0F0; font-weight:500;"> &nbsp;<?php echo stripslashes($listdataterm['termType']); ?></div>
 </div>
  <div style="padding: 0px 0px;"><?php echo (stripslashes($listdataterm['termDescription'])); ?></div> 
 
<?php } 


$b=GetPageRecord('*','sys_userMaster','id="'.$quotationInfo['addBy'].'"'); 
$packagecreate=mysqli_fetch_array($b);
?>


<div style="text-align:center; padding:30px 0px; background-color:#293a50; color:#FFFFFF; margin-top:20px; border-top:5px solid #ec407a; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;">
<div style=" font-size:14px; margin-bottom:5px; font-size:20px;">Contact Details</div>
<div style=" font-size:14px; margin-bottom:5px;">Contact Person: <strong><?php echo stripslashes($packagecreate['name']); ?></strong></div>
<div style=" font-size:14px; margin-bottom:5px;">Contact Number: <strong><?php echo stripslashes($packagecreate['phone']); ?></strong></div>
<div style=" font-size:14px; margin-bottom:5px;">Email: <strong><a href="mailto:<?php echo stripslashes($packagecreate['email']); ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;"><?php echo stripslashes($packagecreate['email']); ?></a></strong></div> 
</div>
</div>