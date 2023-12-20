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
 $a=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'" and eventType="Hotel" order by id asc '); 
$listevent=mysqli_fetch_array($a);

if($listevent['id']!=''){ ?> 

<div style="margin-bottom:20px;">
 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	
	<?php 	$n=1;    
$ha=GetPageRecord('*','quotationEvents',' quotationId="'.$quotationInfo['id'].'" and eventType="Hotel" order by id asc');
while($listhotel=mysqli_fetch_array($ha)){ 
?> 
<div style="text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #ddd;  border-top:1px solid #ddd; background-color:#F0F0F0; margin-top:20px; "><strong>Option <?php echo $n; ?></strong></div>
 <div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $listhotel['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $listhotel['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php echo $fullurl; if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/sightseeingnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;">
	
	 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;"> 
	<div style="font-size:15px; font-weight:500; margin-bottom:5px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?> <span class="hotelcategorystar"><?php echo hotelcategory($listhotel['category']); ?></span></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getDestination($listhotel['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['roomType']); ?> &nbsp; | &nbsp;    <span style="color:#999999;"><i class="fa fa-cutlery" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['mealPlan']); ?></div>
	
	<div style="font-size:12px;  margin-bottom:4px;"><span style="color:#999999;">Check-In:</span> <?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-Out:</span> <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;"><?php echo stripslashes($listhotel['eventDetails']); ?></div>
	
	
 
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right" style="padding-bottom:5px; padding-left:20px; position:relative; padding-bottom:10px; border-bottom:1px solid #ddd;"><?php $taxyes=0; if($listhotel['CGSTValue']>0){ $taxyes=1; } if($listhotel['SGSTValue']>0){ $taxyes=1; } if($listhotel['IGSTValue']>0){ $taxyes=1; } if($listhotel['TCSValue']>0){ $taxyes=1; } echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant | 
	
	
	<?php if($listhotel['showTaxDetails']==0){  if($listhotel['singleRoom']>0){  echo '| <strong>Single Room</strong> '.$listhotel['singleRoom'].' - '; } ?>
<?php if($listhotel['doubleRoom']>0){  echo '<strong>Double Room</strong> '.$listhotel['doubleRoom'].' - '; } ?> 
<?php if($listhotel['tripleRoom']>0){  echo '<strong>Triple Room</strong> '.$listhotel['tripleRoom'].' - '; } ?>
<?php if($listhotel['extraAdultRoom']>0){  echo '<strong>Extra Adult</strong>'.$listhotel['extraAdultRoom'].' - '; } ?>
<?php if($listhotel['childWithBedRoom']>0){  echo '<strong>child With Bed</strong> '.$listhotel['childWithBedRoom'].' - '; } } ?>

	</td>
    </tr>
<?php if($listhotel['showTaxDetails']==1){ ?>   <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative; padding-top:10px;"><?php if($listhotel['singleRoom']>0){  echo '<strong>Single Room</strong> '.$listhotel['singleRoom'].' - '; } ?>
<?php if($listhotel['doubleRoom']>0){  echo '<strong>Double Room</strong> '.$listhotel['doubleRoom'].' - '; } ?> 
<?php if($listhotel['tripleRoom']>0){  echo '<strong>Triple Room</strong> '.$listhotel['tripleRoom'].' - '; } ?>
<?php if($listhotel['extraAdultRoom']>0){  echo '<strong>Extra Adult</strong>'.$listhotel['extraAdultRoom'].' - '; } ?>
<?php if($listhotel['childWithBedRoom']>0){  echo '<strong>child With Bed</strong> '.$listhotel['childWithBedRoom'].' - '; } ?></td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500; padding-top:10px;"><?php echo stripslashes($listhotel['quotationCost']+$listhotel['quotationMarkup']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
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
<?php $n++; } ?>  
 
 
 
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