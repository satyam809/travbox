<?php
$a=GetPageRecord('*','quotationMaster','  id="'.$quotationInfo['id'].'"'); 
$quotationInfo=mysqli_fetch_array($a);

$b=GetPageRecord('*','sys_branchMaster','userId="'.$quotationInfo['addBy'].'"'); 
$quotationmaker=mysqli_fetch_array($b);

 

$c=GetPageRecord('*','queryMaster','   id="'.$quotationInfo['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>
<style>
.thumbimg{width:100%; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:0px; min-width:140px;}
 
	 body{overflow:auto !important;}
.hotelcategorystar{color:#FF9900; font-size:16px;}
.hideinmobile{ display:inline-table; !important; }
.showonmobile{ display:none !important; }

@media only screen and (max-width: 600px) {
 
    .page-content{padding:0px;display: block !important;}
 	.col-md-12{padding:0px;}
	.padding0{padding:0px !important;}
	.margin0{margin:0px !important;}
	.responsivetable{display:inline-block !important; width:100% !important;}
	.responsivetable div{ margin-left:0px !important; margin-top:5px !important;}
	.padding10{ padding:10px !important;}
	.thumbimg{height:auto !important;  }
	.marginauto{ margin:auto !important; }
	.showonmobile{ display:block !important;}
	.hideinmobile{ display:none !important; } 
 
}
	 </style>

<div style="overflow:hidden; width:100%;">

<div style="text-align:center; padding-top:10px;"><img src="<?php echo $fullurl; ?>upload/<?php echo $quotationmaker['companyLogo']; ?>" alt="<?php echo stripslashes($quotationmaker['companyName']); ?>" style="  height:40px;"></div>
<div style="font-size:25px; font-weight:500; text-align:center; padding:20px 0px;"><?php echo stripslashes($quotationInfo['name']); ?><div style="width:100%; margin-top:2px; color:#666666; font-size:14px;">Quotation ID: #QT<?php echo encode($quotationInfo['id']); ?></div></div>


<?php if($quotationInfo['bannerImg']!=''){ ?><div style="margin-bottom:20px;"><img src="<?php echo $fullurl; ?>upload/<?php echo $quotationInfo['bannerImg']; ?>" style=" width:100%;border-radius: 20px;"></div><?php } ?>

<?php   
$quotationId=$quotationInfo['id'];
 
?> 
  




 
 
 <?php
$a=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'" and  	eventType="Transport" order by id asc '); 
$eventdata=mysqli_fetch_array($a);

if($eventdata['id']!=''){ ?> 

<div style="margin-bottom:20px;">
  
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	
	<?php 	$n=1;    
$ha=GetPageRecord('*','quotationEvents',' quotationId="'.$quotationInfo['id'].'" and eventType="Transport" order by id asc');
while($listhotel=mysqli_fetch_array($ha)){ 
 

$d=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$listhotel['vehicleId'].'" order by id asc '); 
$vehicleData=mysqli_fetch_array($d);
?>
<div style="text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #ddd;  border-top:1px solid #ddd; background-color:#F0F0F0; margin-top:20px; "><strong>Option <?php echo $n; ?></strong></div>
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $listhotel['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $listhotel['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php echo $fullurl; if($listhotel['transportType']=='Private Cab'){ if($vehicleData['eventPhoto']!=''){ ?>upload/<?php echo $vehicleData['eventPhoto']; } else { ?>assets/pvtcab.png<?php } } ?><?php if($listhotel['transportType']=='SIC'){ ?>assets/siccab.png<?php } ?><?php if($listhotel['transportType']=='Bus'){ ?>assets/busicon.png<?php } ?><?php if($listhotel['transportType']=='Train'){ ?>assets/trainicon.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"> 
	
	
	 
	
	<input name="eventId" type="hidden" value="<?php echo encode($listhotel['id']); ?>">
	<input name="action" type="hidden" value="saveupdatesightseeingimage">
	<input name="cityId2" type="hidden" value="<?php echo $listhotel['cityId']; ?>">
	<input name="evenetname" type="hidden" value="<?php echo $listhotel['name']; ?>"> 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
 
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo getDestination($listhotel['cityId']); ?> &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp; <?php echo getDestination($listhotel['toCityId']); ?></div>
	<div style="font-size:12px;  margin-bottom:5px;"><?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-car" aria-hidden="true"></i></span> <?php echo stripslashes($vehicleData['name']); ?> (Pax: <?php echo stripslashes($vehicleData['pax']); ?>) <?php } ?><?php if($listhotel['transportType']=='Private Cab'){ ?><i class="fa fa-car" aria-hidden="true"></i></span> <?php echo stripslashes($vehicleData['name']); ?> (Pax: <?php echo stripslashes($vehicleData['pax']); ?>) <?php } ?><span style="color:#999999;"><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> - <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?>  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;  margin-bottom:5px;"><span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo (stripslashes($listhotel['transportType'])); ?> &nbsp; | &nbsp; <?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-user" aria-hidden="true"></i></span> Driver &nbsp; | &nbsp; <?php } ?><span style="color:#999999;"><i class="fa fa-life-ring" aria-hidden="true"></i></span> <?php if($listhotel['transportType']=='Train'){ echo $listhotel['trainClass']; } else {  ?>AC<?php } ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-suitcase" aria-hidden="true"></i></span> Luggage Bags</div>
	
	
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div>
  
  
   
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <?php $taxyes=0; if($listhotel['CGSTValue']>0){ $taxyes=1; } if($listhotel['SGSTValue']>0){ $taxyes=1; } if($listhotel['IGSTValue']>0){ $taxyes=1; } if($listhotel['TCSValue']>0){ $taxyes=1; } if($listhotel['showTaxDetails']==0){ ?>
  <tr>
    <td colspan="2" align="right" style="padding-bottom:5px; padding-left:20px; position:relative; padding-bottom:10px;">
<?php if($listhotel['transportType']!='Private Cab'){ ?>
 <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant:
<?php } else { ?>
<strong>Number Of Vehicle:</strong> <?php echo $listhotel['noOfVehicle']; ?> -  <strong>Per Vehicle Price:</strong> <?php echo $listhotel['adultCost']; ?> <?php echo currencyname($listhotel['currencyId']); ?>:
<?php } ?>


 </td>
    </tr>
	<?php } ?>
 <?php if($listhotel['showTaxDetails']==1){ ?>	
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">
<?php if($listhotel['transportType']!='Private Cab'){ ?>
<strong>Base Price:</strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant:
<?php } else { ?>
<strong>Number Of Vehicle:</strong> <?php echo $listhotel['noOfVehicle']; ?> -  <strong>Per Vehicle Price:</strong> <?php echo $listhotel['adultCost']; ?> <?php echo currencyname($listhotel['currencyId']); ?>:
<?php } ?>


 </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['quotationMarkup']+$listhotel['quotationCost']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
    
  
 <?php if($listhotel['CGSTValue']>0){ $taxyes=1; ?>
   
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['CGSTValue']); ?>% <?php echo stripslashes($listhotel['CGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['CGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
   <?php if($listhotel['SGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['SGSTValue']); ?>% <?php echo stripslashes($listhotel['SGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['SGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
     <?php if($listhotel['IGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['IGSTValue']); ?>% <?php echo stripslashes($listhotel['IGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['IGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
  <?php if($listhotel['TCSValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['TCSValue']); ?>% <?php echo stripslashes($listhotel['TCS']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $listhotel['TCSamount']; ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
	<?php } ?>
   <?php } ?>
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listhotel['perPerson']==0){ echo 'Per Person Price';} else { echo 'Total Price'; }?>:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listhotel['perPerson']==1){ echo $listhotel['quotationCostWithTax']; } else { echo round($listhotel['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?>
      <div style="color:#666666; font-size:11px; width:120px;"><?php if($taxyes==1){ ?>Include all taxes<?php } else { ?>Taxes are not included<?php } ?></div></td>
  </tr>
</table>

	</div>
 
	</td>
  </tr>
</table>
</form>
</div>
<?php $n++;} ?> 
 
 
 
</td>
    </tr>
</table>




</div>

<?php } ?>




  
<div class="form-group"><div  style="text-align: left; font-size: 14px; padding: 10px; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; background-color: #f0f0f0; margin-top: 20px;">   
<span class="text-muted" style="font-weight:500; color:#000000 !important;">Terms & Conditions</span>
</div>
<div style="border:1px solid #d8d8d8;">

   <?php if($quotationInfo['packageItinerary']!=''){ ?> <div style="padding: 15px 15px;"><?php echo (stripslashes($quotationInfo['packageItinerary'])); ?></div> <?php } else { ?>
   
   <div style="padding: 15px 15px; text-align:center; font-size:12px; color:#666666;">Terms & Conditions Not Added</div>
   <?php } ?>
</div>
</div>
 



 

 <?php


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