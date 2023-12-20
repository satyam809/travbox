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
$a=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'" and  	eventType="Flight" order by id asc '); 
$eventdata=mysqli_fetch_array($a);

if($eventdata['id']!=''){ ?> 

<div style="margin-bottom:20px;">
  
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><?php   
$n=1;
$ha=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'"   and eventType="Flight" order by id asc');
while($eventdata=mysqli_fetch_array($ha)){ 
?>
<div style="text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #ddd;  border-top:1px solid #ddd; background-color:#F0F0F0; margin-top:20px; "><strong>Option <?php echo $n; ?></strong></div>
<div style=" border:1px solid #ddd;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" class="responsivetable" style="padding:10px;"><div  class="marginauto" style="border-radius: 20px; width:140px; position:relative;  overflow:hidden; border:1px solid #ddd; margin-right:0px;"><img src="<?php echo $fullurl; if($eventdata['eventPhoto']!=''){ echo 'upload/'.stripslashes($eventdata['eventPhoto']); } else { ?>assets/flightnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td width="90%" align="left" valign="top" class="responsivetable" style="padding:10px;">		
	
 
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo stripslashes($eventdata['name']); ?> <span style="font-size:16px; color:#999999;">- <?php echo stripslashes($eventdata['trainClass']); ?></span></div>
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="responsivetable"><div style="font-size: 14px;   font-weight: 500; margin-bottom: 5px;"><strong>Departure </strong><?php echo date('D, j M Y',strtotime($eventdata['checkInDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-right:0px;">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdata['fromDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdata['cityId']); ?></div>	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($eventdata['departureFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" />
	<div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo stripslashes($eventdata['viaFlightDeparture']); ?></div>	</td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdata['toDepartureFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdata['toCityId']); ?></div></td>
  </tr>
</table>
</div></td>
    <td width="50%" class="responsivetable"><?php if('Round Trip'==$eventdata['flightTripType']){ ?><div style=" margin-left:10px; font-size: 14px; font-weight: 500; margin-bottom: 5px;"><strong>Return </strong><?php echo date('D, j M Y',strtotime($eventdata['checkOutDate'])); ?></div><div style="padding:10px; background-color:#f5f5f5; margin-left:10px;">
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdata['fromReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdata['toCityId']); ?></div>	</td>
    <td width="33%" align="center">
	<div style="font-size:12px; margin-bottom:2px;"><?php echo stripslashes($eventdata['returnFlightHour']); ?></div>
	<img src="<?php echo $fullurl; ?>assets/flightgoicon.png" style="width: 100px;" /><div style="font-size:12px; margin-top:2px;color:#999999;"><?php echo stripslashes($eventdata['viaFlightReturn']); ?></div></td>
    <td width="33%" align="center"><div style="font-size:18px; font-weight:600; margin-bottom:4px;"><?php echo date('h:i A',strtotime($eventdata['toReturnFlightTime'])); ?></div>
	<div style="font-size:13px;"><?php echo getDestination($eventdata['cityId']); ?></div></td>
  </tr>
</table></div><?php } ?></td>
  </tr>
</table>
 
	
	
 <div style="font-size:12px; margin-top:10px;"><?php echo nl2br(stripslashes($eventdata['eventDetails'])); ?> <span>
 
  </span></div>
  
  <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
  <?php  $taxyes=0; if($eventdata['CGSTValue']>0){ $taxyes=1; } if($eventdata['SGSTValue']>0){ $taxyes=1; } if($eventdata['IGSTValue']>0){ $taxyes=1; } if($eventdata['TCSValue']>0){ $taxyes=1; } if($eventdata['showTaxDetails']==0){ ?>
  <tr>
    <td colspan="2" align="right" style="padding-bottom:5px; padding-left:20px; position:relative; padding-bottom:10px;"><?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant</td>
    </tr>
	<?php } ?>
	
	<?php if($eventdata['showTaxDetails']==1){ ?>
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
Base Fare:</strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdata['quotationCost']+$eventdata['quotationMarkup']); ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?></td>
  </tr>
    
  
 <?php if($eventdata['CGSTValue']>0){ $taxyes=1; ?>
   
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($eventdata['CGSTValue']); ?>% <?php echo stripslashes($eventdata['CGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdata['CGSTamount']); ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?></td>
  </tr>
  <?php }   ?>
   <?php if($eventdata['SGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($eventdata['SGSTValue']); ?>% <?php echo stripslashes($eventdata['SGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdata['SGSTamount']); ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?></td>
  </tr>
  <?php } ?>
     <?php if($eventdata['IGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($eventdata['IGSTValue']); ?>% <?php echo stripslashes($eventdata['IGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($eventdata['IGSTamount']); ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?></td>
  </tr>
  <?php } ?>
  <?php if($eventdata['TCSValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($eventdata['TCSValue']); ?>% <?php echo stripslashes($eventdata['TCS']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $eventdata['TCSamount']; ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?></td>
  </tr>
<?php } ?>
   <?php } ?>
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdata['perPerson']==0){ echo 'Per Person Fare';} else { echo 'Total Fare'; }?>:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($eventdata['perPerson']==1){ echo $eventdata['quotationCostWithTax']; } else { echo round($eventdata['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($eventdata['currencyId']); ?>
      <div style="color:#666666; font-size:11px; width:120px;"><?php if($taxyes==1){ ?>Include all taxes<?php } else { ?>Taxes are not included<?php } ?></div></td>
  </tr>
</table>
	</div>	</td>
  </tr>
</table>
</div>
 <?php $n++; } ?></td>
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